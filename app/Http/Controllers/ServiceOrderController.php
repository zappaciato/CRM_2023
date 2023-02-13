<?php

namespace App\Http\Controllers;

use App\Mail\OrderChanged;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Email;
use App\Models\MessageToClient;
use App\Models\Order;
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

        Log::info('I am in serviceorder index');
        $title = "Zgłoszenia serwisowe";
        $breadcrumb = "Zgłoszenia serwisowe";
        // tutaj ma wyciagnac ordersy ale tylko te z statusem otearte czy przyjęte;
        // tutaj rowniez mozemy skrocic kwerendę do wywloania jedynie firm i za pomoca relationships dostac sie do adresow i kontaktow oraz orders na razie nie zmieniam bo dziala. W razie oblozenia bazy danych mozna to zmienic. Pamietac o zmianie w widoku na inne zapisy
        $orders = Order::all();

        // $orders = Order::with('company')->get();

        $companies = Company::select('id', 'name')->get();
        $users = User::select('id', 'name')->get(); 
        Log::info('BELOW $orders form Service Orders list and 2 x below the same $companies');
        Log::debug($orders);

        Log::debug($companies);
        

        return view('pages.orders.orders-service-list', compact('title', 'breadcrumb', 'orders', 'companies', 'users'));
    }


    public function userIndex()
    {
        Log::info('I am in userIdex');
        $title = "New Orders";
        $breadcrumb = "Nowe Service Orders";
        $users = User::select('id', 'name')->get(); 
        $loggedUser = Auth::user();

        $orders = Order::where(['involved_person' => $loggedUser->id])->orWhere(['lead_person' => $loggedUser->id])->get();
        $companies = Company::select('id', 'name')->get();
        // foreach($orders as $order) {
        //     if($user->id === $order->lead_person || $user->id === $order->involved_person) [

        //         $assignedOrders = $order->where('')

        //     ]
        Log::info('I am debuggon orders for inividual user');
        // dd($orders);
        Log::debug($orders);
        Log::debug($loggedUser->id);

        return view('pages.orders.orders-user-service-list', compact('title', 'breadcrumb', 'orders', 'companies', 'users', 'loggedUser'));
      
    }

    protected function validator($data)
    {
        Log::info('I am validating the user record.');
        Log::debug($data);
        $validated =  Validator::make($data, [
            'name' => 'required|min:3',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
        ])->validate();


        Log::info('User Record has been validated!!');

        // $validated = Arr::add($validated, 'published', 0);
        // $validated = Arr::add($validated, 'premium', 0);

        return $validated;
    }

    public function show($id)
    {
        // $singleOrder = Order::where('id', $id)->get();  to nie daje mi kolekcji we wlasciwym formacie
        // $singleOrder = Order::findOrFail($id);
        $singleOrder = Order::where('id', $id)->firstOrFail();

        $messagesToClient = $singleOrder->messagesToClients;
        $orderNotifications = $singleOrder->orderNotifications;
        $comments = $singleOrder->orderComments;

        Log::debug($singleOrder);
        $users = User::select('id', 'name')->get();
        //ponizej do zmiany eloqnet relationships to $contact
        $contact = Contact::where('company_id', $singleOrder->company_id)->firstOrFail();
        $company = Company::where('id', $singleOrder->company_id)->firstOrFail();
        // $messagesToClient = MessageToClient::where('order_id', $singleOrder->id)->get();
        $title = 'Zgłoszenie nr: ' . $singleOrder->id;
        $breadcrumb = 'Zgłoszenie nr: ' . $singleOrder->id;

        // $orderNotifications = OrderNotification::where('order_id', $singleOrder->id)->get();
Log::info('Below is 1 ORDER NOTIFICATIONS list and 2 messagesToClient');
Log::debug($orderNotifications);
Log::debug($messagesToClient);

$files = 'file#order#'.$singleOrder->id;

Log::info('Files associated:::::::');
Log::debug(strval($files));

$attachmentsLinks = [];


foreach($messagesToClient as $msg) {
if($msg->getFirstMedia($files) === null) {

    


} else {

                $attachments = $msg->getMedia($files);
                Log::info('BELOW attachemtns:: ');
                Log::debug($attachments);
                $attachmentsLinks = [];
                foreach ($attachments as $attachment) {
                    Log::info('BELOW ::: single attachment $attachemnt');
                    Log::debug($attachment);
                    array_push($attachmentsLinks, $attachment->getUrl());
                    // $attachmentsLinks = $attachments->getUrl();
                }

                Log::info('Attachment links below:::::');
                Log::debug($attachmentsLinks);
                
}
            
            
}
        // $attachments = MessageToClient::latest()->getFirstMedia('msg-attachments');

        return view('pages.orders.order-single-service', compact('title', 'breadcrumb', 'singleOrder', 'users', 'company', 'orderNotifications', 'contact', 'messagesToClient', 'comments', 'attachmentsLinks'));
    }


    public function edit($id)
    {
        $singleOrder = Order::findOrFail($id);

        //dodawanie powiadomienia OrderNotification

        


        $title = 'Edycja zgłoszenia';
        $breadcrumb = 'Edycja zgłoszenia ' . $singleOrder->title;

        return view('pages.orders.order-single-service-edit', compact('title', 'breadcrumb', 'singleOrder'));
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


    public function update(Request $request, $id)
    {
        Log::info('This is data order being updated');
        $singleOrder = Order::findOrFail($id);

        // $data = $this->validator($request->all());
        $data['status'] = $request->status;
        
        Log::debug($data);

        $singleOrder->update($data);

        //add notification set as a static function in OrderNotificat like this: OrderNotificationController::createNotification (string $type, string $content, int $subjectId, int $orderId );
        OrderNotificationController::createNotification('order_update', Auth::user()->name, $singleOrder->id, $singleOrder->id);

        Alert::alert('Gratulacje!', 'Dane zgłoszenia zostały zaktualizowane!', 'success');
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

    Log::info('I am in sidplayAssignedFiles');
        $order = Order::find($id);

$title = "Pliki zwiazane ze zgłoszeniem";
$breadcrumb = 'Pliki';

        $orderFiles = Media::where('collection_name', 'file#order#'.$id)->get();


    Log::info('BELOW order files: ');
    Log::debug($orderFiles);
    
    return view('pages.orders.order-files', compact('orderFiles', 'title', 'breadcrumb', 'order'));

}

}
