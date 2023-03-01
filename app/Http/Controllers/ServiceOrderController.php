<?php

namespace App\Http\Controllers;

use App\Mail\OrderChanged;
use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\Contact;
use App\Models\Email;
use App\Models\EmailsToOrder;
use App\Models\FileComment;
use App\Models\MessageToClient;
use App\Models\Order;
use App\Models\OrderComment;
use App\Models\OrderNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ServiceOrderController extends Controller
{
    public function index() {

        $title = "Zgłoszenia serwisowe";
        $breadcrumb = "Zgłoszenia serwisowe";

        // tutaj ma wyciagnac ordersy ale tylko te z statusem otearte czy przyjęte;
        // tutaj rowniez mozemy skrocic kwerendę do wywloania jedynie firm i za pomoca relationships dostac sie do adresow i kontaktow oraz orders na razie nie zmieniam bo dziala. W razie oblozenia bazy danych mozna to zmienic. Pamietac o zmianie w widoku na inne zapisy
        $orders = Order::all()->sortByDesc('created_at');

        $companies = Company::select('id', 'name')->get();
        $users = User::select('id', 'name')->get(); 

        return view('pages.orders.orders-service-list', compact('title', 'breadcrumb', 'orders', 'companies', 'users'));
    }


    public function userIndex()
    {
        Log::info('I am in userIdex');
        $title = "New Orders";
        $breadcrumb = "Nowe Service Orders";
        $users = User::select('id', 'name')->get(); 
        $loggedUser = Auth::user();

        //Show orders only for the loggegd in user; 
        // Sorting orders does not work as it shows datatable which automatically orders them according to id.. 
        $orders = Order::where(['involved_person' => $loggedUser->id])->orWhere(['lead_person' => $loggedUser->id])->lazyByIdDesc();
        $companies = Company::select('id', 'name')->get();

        return view('pages.orders.orders-user-service-list', compact('title', 'breadcrumb', 'orders', 'companies', 'users', 'loggedUser'));
      
    }

    protected function validator($data)
    {
        $validated =  Validator::make($data, [
            'title' => 'required',
            'company_id' => 'required|integer',
            'email_id' => 'required|integer',
            'contact_person' => 'required',
            'address' => 'required',
            'lead_person' => 'required',
            'involved_person' => 'required',
            'priority' => 'required',
            'order_content' => 'required',
            'order_notes' => 'required',
            'deadline' => 'required',
            'status' => 'required',

        ])->validate();

        return $validated;
    }

    public function show($id)
    {
        //return a query only firstorfail() lets me query other tables with fk order_id relationship; however firstorfail() doesn't let me paginate later;
        $singleOrder = Order::where('id', $id)->firstOrFail();

        // for this order
        //Get all messages to client throu relations set in the model
        $messagesToClient = $singleOrder->messagesToClients;
        //get the notifications for this single order. 
        $orderNotifications = $singleOrder->orderNotifications;
        //get all comments // paginate nie dziala jesli wyciagamy z collection. dziala tylko w query DB::where().
        // $comments = $singleOrder->orderComments;
        $comments = OrderComment::where('order_id', $id)->orderBy('created_at', 'desc')->paginate(2);

        //all the contacts for the company which owns the order. We expect emails exchange only from those addresses; If the contact is unknown it should be added. However it works only when I do foreach all;
        $contacts = Contact::all();
        // define emails array to get ids for the search for links for emails assigned to the order
        $emailsArray = [];//??

        //timeline links part
        // find emails with type email_received from orderNotifications for this single order to proivide links in the timeline

        foreach($orderNotifications as $notification)
            if($notification->type === 'email_received') {
                //push the emails id to the array if the orderNotification has type emailreceived; 
                array_push($emailsArray, Email::where('id', $notification->subjectId)->get()[0]->id);
            }
        // strip it from the keys and leave only values like: [10,2,7]
        $emailsAssignedIds = array_values($emailsArray);

        // find the relevant emails 
        $emailsAssigned = Email::findMany($emailsAssignedIds);

        // get all other data required for this order view
        $users = User::select('id', 'name')->get();

        //ponizej do zmiany eloqnet relationships to $contact
        // $contactPerson = Contact::where('company_id', $singleOrder->company_id)->firstOrFail();
        $contactPerson = Contact::where('id', $singleOrder->contact_person)->firstOrFail();
        $contactPersons = Contact::where('company_id', $singleOrder->company_id)->get();
        $company = Company::where('id', $singleOrder->company_id)->firstOrFail();

        $title = 'Zgłoszenie nr: ' . $singleOrder->id;
        $breadcrumb = 'Zgłoszenie nr: ' . $singleOrder->id;

        // set the media collection name where files are stored in the media table
        $files = 'file#order#'.$singleOrder->id;

        //define array with attachment links
        $attachmentsLinks = [];

        // iterate over all messages to client for this ORDER
        foreach($messagesToClient as $msg) {
        if($msg->getFirstMedia($files) === null) {
        // do something if there are not attachments for each message individually

        } else {
        //do this if there are some attachment for each message individually
        $attachments = $msg->getMedia($files);
        Log::info('BELOW attachemtns:: ');
        Log::debug($attachments);

        foreach ($attachments as $attachment) {
            Log::info('BELOW ::: single attachment $attachemnt');
            Log::debug($attachment);
            $attachmentsLinks[$attachment->model_id] = [$attachment->getUrl(), $attachment->name, $msg->id];
            // array_push($attachmentsLinks,  $attachment->getUrl());
            // $attachmentsLinks = $attachments->getUrl();
        }

                Log::info('Attachment links in the foreach below:::::');
                Log::debug($attachmentsLinks);
                
            }
            
            
            
}

        Log::info('Attachment links FINAL below:::::');
        Log::debug($attachmentsLinks);
        // $attachments = MessageToClient::latest()->getFirstMedia('msg-attachments');

        return view('pages.orders.order-single-service', compact('title', 'breadcrumb', 'singleOrder', 'users', 'company', 'orderNotifications','contacts', 'contactPersons', 'contactPerson', 'messagesToClient', 'comments', 'attachmentsLinks', 'emailsAssigned'));
    }


    public function edit($id)
    {
        Log::info('I am tryign to edit the order!');
        $singleOrder = Order::findOrFail($id);
        $company = Company::findOrFail($singleOrder->company_id);
        $contacts = Contact::where('company_id', $singleOrder->company_id)->get();
        $users = User::select('name', 'id')->get();
        $addresses = CompanyAddress::where('company_id', $company->id)->get();
        //dodawanie powiadomienia OrderNotification
        Log::debug($singleOrder->id);
        Log::debug($company->name);
        Log::debug($users);
        
// Tutaj trzeba jeszcze wrzucic notyfikacje o zmianach!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        $title = 'Edycja zgłoszenia';
        $breadcrumb = 'Edycja zgłoszenia ' . $singleOrder->title;

        return view('pages.orders.order-single-service-edit', compact('title', 'breadcrumb', 'singleOrder', 'company', 'contacts', 'users', 'addresses'));
    }

    public function update(Request $request, $id)
    {
        Log::info('This is data order being updated');
        $singleOrder = Order::findOrFail($id);

        $data = $this->validator($request->all());
        // $data['status'] = $request->status;

        Log::debug($data);

        $singleOrder->update($data);

        //add notification set as a static function in OrderNotificat like this: OrderNotificationController::createNotification (string $type, string $content, int $subjectId, int $orderId );
        OrderNotificationController::createNotification('order_update', Auth::user()->name, $singleOrder->id, $singleOrder->id);

        //Notification to the client TO REFACTOR
        //dane potrzebne do wstrzykniecia do zmiennych do emaila do klienta
        // wysłanie wiadomosci email do klienta:: attempt to read property on null; TODO fix it
        $recipients = [];
        $contact = Contact::where('id', $singleOrder->contact_person)->get('email', 'name', 'surname');
        $users = User::whereIn('id', [$singleOrder->lead_person, $singleOrder->involved_person])->get();
        // $lead_person_name = '';
        // $involved_person_name = '';
        // $userx = User::whereIn('id', [$singleOrder->lead_person, $singleOrder->involved_person])->get('email', 'name');
        array_push($recipients, $contact[0]['email']);
        array_push($recipients, env('ADMIN_EMAIL'));
        if(count($users)>1) {
        foreach($users as $user) {
            array_push($recipients, $user['email']);
            if($user->id == $singleOrder->lead_person) {
                Log::info('Lead person name');
                
                $lead_person_name = $user->name;
                Log::debug($lead_person_name);
            } elseif ($user->id == $singleOrder->involved_person) {
                Log::info('Involved person name');

                $involved_person_name = $user->name;
                Log::debug($involved_person_name);
            };
        }
    } elseif(count($users) == 1) {
        array_push($recipients, $users[0]['email']);
        $lead_person_name = $users[0]->name;
        $involved_person_name = $users[0]->name;
    }

        //zmienne do email template przekazujemy je w obiekcie OrderChanged
            Mail::to($recipients)->send(new OrderChanged($singleOrder, $lead_person_name, $involved_person_name));
        // }
        Alert::alert('Gratulacje!', 'Dane zgłoszenia zostały zaktualizowane!', 'success');
        return redirect(route('single.service.order', $singleOrder->id))->with('message', 'Your have finished editing and the selected company is now updated!');
    }

    public function sendEmail($id) {
// ta metoda jest jedynie do testu.. trzeba ja zmienic refaktor i wyciagnac ja do message to client Controller np.. ale działa
        $singleOrder = Order::findOrFail($id);
        Log::info('Below is the 1 single order data 2 usersemails 3 cntact emails');
        Log::debug($singleOrder);
        // do kogo email?
        // to lead person involved and the email from the contact for this particular order
        $usersEmails = User::whereIn('id', [$singleOrder->lead_person, $singleOrder->involved_person])->get();
        // $contactEmails = Contact::whereIn('id', [$singleOrder->contact_person])->firstOrFail();
        $contactEmails = Contact::select('email')->where('id', $singleOrder->contact_person)->get();
Log::debug($usersEmails);
        Log::debug($contactEmails);

        // $usersEmails = User::select('email')->where('id', $singleOrder->lead_person)->get();        // $recipients = ['k@k.pl', 'test@go.pl'];
        // $recipients = [$usersEmails->email, $contactEmails];

        $recipients = [];
        foreach ($usersEmails as $email) {
            Log::debug($email);
            array_push($recipients, $email);
        }

        foreach ($contactEmails as $email) {
            Log::debug($email);
            array_push($recipients, $email);
        }


        // $recipients['email'] =+  $usersEmails->email;
        // $recipients['email'] =+ $contactEmails->email;
        Log::info('Below the RECIPIENTS ALL');
        Log::debug($recipients);
        // Log::debug($contactEmails->email);
        foreach ($recipients as $recipient) {
            Log::info('Below the RECIPIENTS ine by ONE');
            Log::debug($recipient->email);
            return Mail::to($recipient->email)->send(new OrderChanged());
        }

                
}

    public function cancelOrder($id) {

                    Log::info('I am cancelling the order!');
                    $singleOrder = Order::findOrFail($id);
                    $data['status'] = 'anulowane';
                    $singleOrder->update($data);

                    Alert::alert('Gratulacje!', 'Zgłoszenie zostało anulowane!', 'success');

                    //send email as a notification to all required people
                    $this->sendEmail($id);


        //add notification set as a static function in OrderNotificat like this: OrderNotificationController::createNotification (string $type, string $content, int $subjectId, int $orderId );
        OrderNotificationController::createNotification('order_status', $singleOrder->status, $singleOrder->id, $singleOrder->id);

        // Log::debug(new OrderChanged(['status' => $data['status']]));
        return redirect(route('single.service.order', $singleOrder->id))->with('message', 'Your have finished editing and the selected company is now updated!');
    }


    


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $singleOrder = Order::findOrFail($id);

        $singleOrder->delete();

        Alert::alert('Gratulacje!', 'Dane zgłoszenia zostały usnięte!', 'success');

        return redirect(route('service.orders'));
    }
    


// scanning throu string email titles

public function scanEmails() {
    $emails = Email::all();

    
}

public function displayAssignedFiles($id){

    Log::info('I am in show AssignedFiles');
        $order = Order::find($id);

$title = "Pliki zwiazane ze zgłoszeniem";
$breadcrumb = 'Pliki';

// na razie działa tak jak jest jeśli nie to: 
// 1. Sprawdzic ktore emaile sa podpiete do orderu
// 2. wyciagnac id tych emaili
// 3. przeszukac i wbic do array search data te pliki ktorych email id pasuje do tych przyłączonych
// 4. Wyciągnać z bazy te pliki Media::

$searchedEmails = [];
$searchData = ['file#order#' . $id];
//  1. && 2.
$orderEmails = EmailsToOrder::where('order_id', $id)->get(); //wypluwa id emailstoorder table; 
//  3.
foreach($orderEmails as $emailId) {
    array_push($searchData, 'file#email#'.$emailId->email_id);
}
    Log::info('THIS IS FILES CONTROLLER AND BELOW is $searchData. It shows all attached files to file#email#id');
        Log::debug($searchData);
//  4.
        $orderFiles = Media::whereIn('collection_name', $searchData)->get();
        $fileComments = FileComment::select('file_comment', 'media_id', 'id')->get();
    
    return view('pages.orders.order-files', compact('orderFiles', 'title', 'breadcrumb', 'order', 'fileComments'));

}

public function editAssignedFile($id){

    $comment = FileComment::findOrFail($id);
    
    return view('pages.orders.order-files-edit', compact('comment'));
}

public function updateFileComment(Request $request, $id) {

        $singleComment = FileComment::findOrFail($id);

        $data['file_comment'] = $request->input('file_comment');

        Log::debug($data);

        $singleComment->update($data);

        return $this->displayAssignedFiles($singleComment->order_id);

}

}
