<?php

namespace App\Http\Controllers;

use App\Mail\MessageToClient;
use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\Contact;
use App\Models\Email;
use App\Models\EmailComment;
use App\Models\EmailsToOrder;
use App\Models\FileComment;
use App\Models\Order;
use App\Models\OrderNotification;
use App\Services\Email2OrderService;
use App\Services\EmailNotificationService;
use App\Services\FilesService;
use App\Services\OrderNotificationsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EmailController extends Controller
{

    public function index () {

        $title = "Emaile";
        $breadcrumb = "Nowe emaile";

        //email status assigned or not
        $read = 'mailInbox';
        $emailsAll = Email::all();
        $emails = $emailsAll->where('emailstatus', '!=', 'assigned')->sortByDesc('created_at');
        $emailsAssigned = $emailsAll->where('emailstatus', '=', 'assigned')->sortByDesc('created_at');

        Log::debug($emailsAssigned);

        return view('pages.emails.emails-inbox', compact('title', 'breadcrumb', 'emails', 'emailsAssigned', 'read'));
    }

    public function indexAssigned() {
        //show individually assigned emails;
        $title = "Emaile przypisane";
        $breadcrumb = "Przypisane emaile";

        $emailsAll = Email::all();
        $emails = $emailsAll->where('emailstatus', '!=', 'assigned')->sortByDesc('created_at');
        $emailsAssigned = $emailsAll->where('emailstatus', '=', 'assigned')->sortByDesc('created_at');

        return view('pages.emails.emails-assigned', compact('emailsAssigned', 'emails', 'title', 'breadcrumb'));
    }

    public function add2orderCreate($id) {

        $title = "Dodawanie zamówienia z emaila";
        $breadcrumb = "Dodawanie nowego zamówienia z emaila";
        $email = Email::findOrFail($id);
        $orders = Order::select('title', 'id')->get();

        return view('pages.emails.add-email-to-order', compact('orders', 'email'));
    }

    public function add2order(Request $request) {


        $data = $request->all();
        Log::info('DANE add2order emaila przypisywanego ręcznie');
        Log::debug($data);

        $newEmailAssigned = new Email2OrderService($data['email_id']);
        $newEmailAssigned->addEmail2Order($data['order_id'], Auth::user()->id, $notes = 'Email ręcznie przydzielony do zgłoszenia');
        $newEmailAssigned->saveFileComment($data['order_id']);
        $status = 'assigned';
        $newEmailAssigned->changeEmailStatus($status);


        $orderNotifications = new OrderNotificationsService();
        $newNotification = $orderNotifications->createNotification('email_received', 'Email w sprawie zgłoszenia ręcznie dodany!', $data['email_id'], $data['order_id']);
        
        Log::info('New NOTIFICATION');
        Log::debug($newNotification);
        $emailNotifications = new EmailNotificationService();


        //Send email notification to all relevant persons
        $assignedEmail = Email::findOrFail($data['email_id']);
        //provide all necessary details in the message;
        $messageToClient = [
            'content' => 'Utworzono zgłoszenie na podstawie Twojego emaila.' . 'Tytuł emaila: ' . $assignedEmail->subject . ' dodany do zgłoszenia kodem zgłoszenia ' . $data['order_id'], 
            'subject' => '', 
            'order_id' => $data['order_id'], 
            'from' => env('ADMIN_EMAIL')
        ];

        $emailNotifications->sendEmailNotificationOnOrderCreate($messageToClient, $data['email_id']);

        
        
        Alert::alert('Gratulacje!', 'Email został przypisany!', 'success');

        return redirect('/modern-dark-menu/emails/mailbox/inbox');
    }


    public function show ($id) {

        Log::info('I am showing the record email. below Id of the email.');
        Log::debug($id);
        $title = "Emaile";
        $breadcrumb = "Wybrany email";
        // we need $orders for the modal where we assign email to order
        $orders = Order::select('title', 'id')->get();
        $email = Email::find($id);

        $eFlag = 0;
        // check if the email has already been assigned status if not update the status to 'open'
        if($email->emailstatus !== 'assigned' || $email->emailstatus == 'new') {
            Log::info('The email status has no assigned status');
            // $email->emailstatus = ["read"]; //pyta sie o array a ja tu dawalem string.. jednak do bazy wpisyje z bracketami i "" zmienic an ENGLISH
            // $email->update($email->emailstatus[0]);


            //zmiana statusu emaila powtarza sie DRY extract to service;
            $email['emailstatus'] = 'read';
            $email->update([$email['emailstatus'] => 'read']);
            Log::info("Email status updated");




            // if email has status assigned nothing should be done with it.. this flag disables email action buttons
            $eFlag = 1;
        // Email::update('status' => 'przecztany')->where('id', $id);
        } else {
            Log::info('The email status has assigned status');
            $eFlag = 0;
        }
               
        $emailAttachments = Media::where('collection_name', 'file#email#'.$id)->get();

        //make a flag if there's anything fetched as $emailAttachments if it is empty then show that there are no attachments
        $attachmentFlag = 0;

        Log::info('$emailAttachments are:');
        Log::debug($emailAttachments);

        if(count($emailAttachments) == 0) {
            $attachmentFlag = 0;
        } else {
            $attachmentFlag = 1;
        }

        //Check id the contact is already in the database
        $contacts = Contact::select('email')->get();
        $contactPerson = 0;
        Log::info('Poczatkowo $contact ma wartość: ');
        Log::debug($contactPerson);

        # I need to use break after the contact is found and matched otherwise it will check other contacts and give NO MATCH. Once the Match is found it has to stop!
        foreach($contacts as $contact) {

            if($contact->email !== $email->from_address) {

                $contactPerson = 0;

            } else {

                $contactPerson = 1;
                break;
            }
        }

        // ta czesc logiki była do testów.. usunąć potem bo juz znajduje sie w widoku
        if($emailAttachments->isNotEmpty()) {

        foreach($emailAttachments as $a){
            Log::info('This is a url link');
            Log::debug($a->getUrl());
        };
        
    } else {
        Log::info('No attachments!');
        }

        //koniec testowej logiki

        return view('pages.emails.email-single', compact('title', 'breadcrumb', 'email', 'emailAttachments', 'contactPerson', 'attachmentFlag', 'eFlag', 'orders'));
    }


    protected function validator($data) {
        Log::info('I am validating the order record.');
        Log::debug($data);

        $validated =  Validator::make($data, [
            'title' => 'required',
            'code' => 'nullable',
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
            // 'notes' => 'nullable' add2order na razie nie ma walidacji!!!!!!!!!

        ])->validate();

        Log::info('ORDER Record has been validated!!');

        return $validated;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validator($request->all());
        Log::info('I am trying to debug the data to store - ORDER!');
        Log::debug($data);
        // count orders and add +1 to the new order code;
        $ordersCount = Order::select('id')->orderBy('id', 'desc')->first();
        // Get the name of the address based on the id from $request->address
        $address = CompanyAddress::findOrFail($request->address);
        $data['address'] = $address->name;
        
        //check if there are any orders in the db
        if ($ordersCount !== null) {
            // add the order code for recognition and scanning
            $data['code'] = '[#order#id#' . $ordersCount->id + 1 . '#]';
            $data['title'] = $data['title'] . '[#order#id#' . $ordersCount->id + 1 . '#]';

        } else {
            $data['code'] = '[#order#id#' . 1 . '#]';
            $data['title'] = $data['title'] . '[#order#id#' . 1 . '#]';
        }
        
        //here we create the new order; 
        $newOrder = Order::create($data);
        
        // Assign the original email to the order and change emails status to assigned;
        $newEmailAssigned = new Email2OrderService($request->email_id);

        $status = 'assigned';
        $newEmailAssigned->changeEmailStatus($status);
        $newEmailAssigned->addEmail2Order($newOrder->id, Auth::user()->id, $data['order_notes']);

        //get the attachments for this email
        $attachments = Media::where('collection_name', 'file#email#' . $request->email_id)->get();

        //add default comment to each of the files
        foreach ($attachments as $file) {

        $email = Email::findOrFail($request->email_id);

        $commentData = "Plik przesłany w emailu: " . '"' . $email->subject . '"' . " o numerze id: " . $email->id;
        $fileComment = new FilesService();
        $fileComment->addFileComment($commentData, $file, $newOrder);

        }

        (new OrderNotificationsService)->createNotification('order_created', 'Zgłoszenie zostało utworzone!', $newOrder->id, $newOrder->id);
        
        return redirect(route('service.orders'));
    }


        public function createFromEmail($id) {
            $title = "Dodawanie zamówienia z emaila";
            $breadcrumb = "Dodawanie nowego zamówienia z emaila";
            //get the email data
            $email = Email::findOrFail($id);

            $contacts = Contact::select('id','company_id', 'email', 'name', 'surname')->get();


            $contactPerson = 0;


        # I need to use break after the contact is found and matched otherwise it will check other contacts and give NO MATCH. Once the Match is found it has to stop!
        foreach ($contacts as $contact) {
            Log::info('All contacts no condition');
            Log::debug($contact);
            if ($contact->email !== $email->from_address) {
                Log::info('NIE Mamy contact MATCH!');
                Log::debug($contact);
                $contactPerson = 0;
                $company = Company::all();
            } else {
                Log::info('JEST! Mamy contact MATCH!');
                $contactPerson = 1;
                $company  =  Company::where('id', $contact->company_id)->firstOrFail();
                break;
            }
        }

        $emailPlain = \Soundasleep\Html2Text::convert($email->text_html);
            
            return view('pages.orders.order-email-create', compact('title', 'breadcrumb', 'email', 'company', 'contact', 'contactPerson','emailPlain'));
        }

        // display all emails which belong to the order;
        public function displayAssignedEmails($id){
            $order = Order::find($id);
            $title = 'Emails assigned';
            $breadcrumb = "Emails assigned";
        

            $emailsAssigned = EmailsToOrder::where('order_id', $id)->get('email_id');

            $emailsIds = [];

            foreach($emailsAssigned as $singleEmail) {
                array_push($emailsIds, $singleEmail->email_id);
            };
            Log::debug($emailsIds);

            //find the emails assigned and get the commetnt for this email;
            $emails = Email::findMany($emailsIds);

            $emailComments = EmailsToOrder::where('order_id', $order->id)->get();

            return view('pages.orders.order-emails', compact('emails', 'breadcrumb', 'title', 'order', 'emailComments'));
        }


        public function emailCommentEdit($id) {
            
            $emailComment = EmailsToOrder::findOrFail($id);

            return view ('pages.orders.order-email-comment-edit', compact('emailComment'));
        }

        public function emailCommentUpdate(Request $request, $id) {

            Log::info('This is EMAIL COMMENT is being updated and below is the Request data!');
            $emailComment = EmailsToOrder::findOrFail($id);

            $data = $request->all(); 

            Log::debug($data);

            $emailComment->update($data);

            Alert::alert('Gratulacje!', 'Notatka emaila została zaktualizowana!', 'success');

            return redirect(route('display.assigned.emails', $emailComment->order_id));
        }


    public function showScanReport()
    {
        // get all newly assigned emails
        //get all modified orders
        //
    }



}
