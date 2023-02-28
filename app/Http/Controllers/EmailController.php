<?php

namespace App\Http\Controllers;

use App\Mail\MessageToClient;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Email;
use App\Models\EmailComment;
use App\Models\EmailsToOrder;
use App\Models\FileComment;
use App\Models\Order;
use App\Models\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EmailController extends Controller
{
    

    // public function exampleEmail() {
    //     $email = [
    //         'message_id' => 
    //         'headers_raw'
    //         'headers'
    //         'from_name'
    //         'from_address'
    //         'subject'
    //         'to'
    //         'to_string'
    //         'cc'
    //         'bcc'
    //         'replay_to'
    //         'text_plain'
    //         'text_html'
    //         'user_id'
    //         'date'
    //         'emailstatus'
    //     ]
    // }

    public function index () {

        $title = "Emaile";
        $breadcrumb = "Nowe emaile";

        //email statuses
        $read = 'mailInbox';
        $emailsAll = Email::all();

//orderBy() doesn't work on eloquent collection should use sortBySec();
        $emails = $emailsAll->where('emailstatus', '!=', 'assigned')->sortByDesc('created_at');
        $emailsAssigned = $emailsAll->where('emailstatus', '=', 'assigned')->sortByDesc('created_at');
        

        // Log::debug($emailsAll->id);
        // Log::debug($emails);
        Log::debug($emailsAssigned);

        return view('pages.emails.emails-inbox', compact('title', 'breadcrumb', 'emails', 'emailsAssigned', 'read'));
    }

    public function indexAssigned() {
        $title = "Emaile przypisane";
        $breadcrumb = "Przypisane emaile";
        $emailsAll = Email::all();


        $emails = $emailsAll->where('emailstatus', '!=', 'assigned')->sortByDesc('created_at');
        $emailsAssigned = $emailsAll->where('emailstatus', '=', 'assigned')->sortByDesc('created_at');
        // $emailsAssigned = Email::where('emailstatus', 'assigned')->get();

        Log::info('I am about to display all assigned emails');
        Log::debug($emailsAssigned);
        // dd($emails);

        return view('pages.emails.emails-assigned', compact('emailsAssigned', 'emails', 'title', 'breadcrumb'));
    }

    public function add2orderCreate($id) {
Log::info("Is it the right IDDDDD?????????????????");
Log::debug($id);
        $title = "Dodawanie zamówienia z emaila";
        $breadcrumb = "Dodawanie nowego zamówienia z emaila";
        $email = Email::findOrFail($id);
Log::info('Adding email to an order 1 email 2 order');
Log::debug($email);
        $orders = Order::select('title', 'id')->get();
Log::debug($orders);




        return view('pages.emails.add-email-to-order', compact('orders', 'email'));

    }

    public function add2order(Request $request) {

        Log::info('This is teh request data from add2order');
        Log::debug($request);
        $data = $request->all();
Log::debug($data);
// create entry in the EmailsToORde db
        $email2order = new EmailsToOrder();
        $email2order->order_id = $data['order_id'];
        $email2order->email_id = $data['email_id'];
        $email2order->user_id = $data['user_id'];
        $email2order->notes = $request->input('notes');
        $email2order->save();

        //zmiana statusu emaila powtarza sie DRY
        $email = Email::findOrFail($request->email_id);
        $email['emailstatus'] = 'assigned';
        $email->update([$email['emailstatus'] => 'assigned']);
        Log::info("Email status updated");


        //get the attachments for this email
        $attachments = Media::where('collection_name', 'file#email#' . $email->id)->get();

        //Dla każdegoz tych plików dodaj defaultową notatkę
        foreach ($attachments as $file) {

            $fileComment = new FileComment();
            $fileComment->media_id = $file->id;
            $fileComment->file_comment = "Plik przesłany w emailu: " . '"' . $email->subject . '"'. " o numerze id: " . $email->id . ". Dołączony do zgłoszenia nr: " . $email2order->order_id;
            $fileComment->save();
        }

        //add notification set as a static function in OrderNotificat (string $type, string $content, int $subjectId, int $orderId )
        OrderNotificationController::createNotification('email_received', 'Email w sprawie zgłoszenia!', $request->email_id, $email2order->order_id);
        // Sending email notification to the relevant people;
        
        // Specify the message details or do sth about it;
        $messageToClient = ['content' => 'Dupa dupa', 'subject' => 'jajca jajca', 'number' => 10, 'from' => 'mj@k.pl'];

        if($email->cc !== '' && $email->bcc !==  '') {

            Mail::to([$email->from_address, $email->cc, $email->bcc, env('ADMIN_EMAIL')])->send(new MessageToClient($messageToClient));

        } else {
            Mail::to([$email->from_address, env('ADMIN_EMAIL')])->send(new MessageToClient($messageToClient));
        }
        

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
        // $email = Email::where('id', $id)->get();
        // $email = Email::findOrFail($id);
        $email = Email::find($id);

        $eFlag = 0;
        // check if the email has already been assigned status if not update the status to 'open'
        if($email->emailstatus !== 'assigned' || $email->emailstatus == 'new') {
            Log::info('The email status has no assigned status');
            Log::debug($email->emailstatus);
            Log::debug($email->emailstatus !== 'assigned');
            $email->emailstatus = ['read']; //pyta sie o array a ja tu dawalem string.. jednak do bazy wpisyje z bracketami i "" zmienic an ENGLISH
            $email->update($email->emailstatus);
            // if email has status assigned nothing should be done with it.. this flag disables email action buttons
            $eFlag = 1;
        // Email::update('status' => 'przecztany')->where('id', $id);
        } else {
            Log::info('The email status has assigned status');
            Log::debug($email->emailstatus);
            Log::debug($email->emailstatus == 'assigned');
            $eFlag = 0;
        }
        

        
        $emailAttachments = Media::where('collection_name', 'file#email#'.$id)->get();


        // //check if this email is already in emails to orders 
        // // 1. Get all email_id 's from emails-to-order and set up a flag
        // $allEmailIds = EmailsToOrder::select('id')->get();
        // $eFlag = 0;
        // // 2. Check if this email id is, and change the flag accordingly 
        // foreach($allEmailIds as $eId) {
        //     if($eId->id === $id) {
        //         Log::info('$eId has a match with $email->id');
        //         Log::info("1.eId and 2 is id");
        //         Log::debug($eId['id']);
        //         Log::debug($id);
        //         $eFlag = 1;
        //         break;
        //     } else {
        //         Log::info('$eId has no match with $email->id, so it is a NEW unassigned Email');
        //         $eFlag = 0;
        //         Log::info('$eId has a match with $email->id');
        //         Log::info("1.eId and 2 is id");
        //         Log::debug($eId->id);
        //         Log::debug($id);
        //     }
        // }
        // // 3. Hide action buttons in single email if the flag is true(there is email id in emails-to-order)
        // Log::info('THIS IS $eFlag VALUE');
        // Log::debug($eFlag);


        //make a flag if there's anything fetched as $emailAttachments if it is empty then show that there are no attachments
        $attachmentFlag = 0;

        Log::info('$emailAttachments are:');
        Log::debug($emailAttachments);

        if(count($emailAttachments) == 0) {
            $attachmentFlag = 0;
        } else {
            $attachmentFlag = 1;
        }

        Log::info('This is the value of the attachment FLAG');
        Log::debug($attachmentFlag);




        //Check id the contact is already in the database
        $contacts = Contact::select('email')->get();
        $contactPerson = 0;
        Log::info('Poczatkowo $contact ma wartość: ');
        Log::debug($contactPerson);

        # I need to use break after the contact is found and matched otherwise it will check other contacts and give NO MATCH. Once the Match is found it has to stop!
        foreach($contacts as $contact) {
            Log::info('All contacts no condition');
            Log::debug($contact);
            if($contact->email !== $email->from_address) {
                Log::info('NIE Mamy contact MATCH!');
                Log::debug($contact);
                $contactPerson = 0;

            } else {
                Log::info('JEST! Mamy contact MATCH!');
                $contactPerson = 1;
                break;
            }
        }

        Log::info('Ostatecznie $contact ma wartość: ');
        Log::debug($contactPerson);
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

        Log::debug($email);
        return view('pages.emails.email-single', compact('title', 'breadcrumb', 'email', 'emailAttachments', 'contactPerson', 'attachmentFlag', 'eFlag', 'orders'));
    }


    protected function validator($data)
    {
        Log::info('I am validating the order record.');
        Log::debug($data);

        $validated =  Validator::make($data, [
            'title' => 'required',
            'company_id' => 'required|integer',
            'email_id' => 'required|integer',
            'contact_person' => 'required',
            'address' => 'nullable',
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

        // $validated = Arr::add($validated, 'published', 0);
        // $validated = Arr::add($validated, 'premium', 0);

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
        $title = '';
        $breadcrumb = '';
        Log::info('I am tryign to store the data and redirect');
        $data = $this->validator($request->all());
        Log::info('I am trying to debug the data to store - ORDER!');
        Log::debug($data);
        $data['address'] = "jaki adres";
        
        $newOrder = Order::create($data);
// To wywalic do funkcji bo powtórka
        $email = Email::findOrFail($request->email_id);
        $email['emailstatus'] = 'assigned';
        $email->update([$email['emailstatus']=> 'assigned']);
        Log::info("Email status updated");

        // create entry in the EmailsToORder db
        $email2order = new EmailsToOrder();
        $email2order->order_id = $newOrder->id;
        $email2order->email_id = $data['email_id'];
        $email2order->user_id = Auth::user()->id;
        $email2order->notes = $data['order_notes'];
        $email2order->save();


        // TU powinno sie znaleźc również wsad do bazy order files

        //get the attachments for this email
        $attachments = Media::where('collection_name', 'file#email#' . $request->email_id)->get();

        //Dla każdegoz tych plików dodaj defaultową notatkę
        foreach ($attachments as $file) {
            Log::info('The attachments:::::::');
            Log::debug($file);
            $fileComment = new FileComment();
            $fileComment->media_id = $file->id;
            $fileComment->file_comment = "Plik przesłany w emailu: " . '"' . $email->subject . '"' . " o numerze id: " . $email->id;
            $fileComment->order_id = $newOrder->id;
            $fileComment->save();
        }

        //add notification set as a static function in OrderNotificat (string $type, string $content, int $subjectId, int $orderId )
        OrderNotificationController::createNotification('order_created', 'Zgłoszenie zostało utworzone!', $newOrder->id, $newOrder->id);




        // return view('pages.orders.orders-service', compact('data', 'title', 'breadcrumb'));

        return redirect(route('service.orders'));
    }


        public function createFromEmail($id) {
            $title = "Dodawanie zamówienia z emaila";
            $breadcrumb = "Dodawanie nowego zamówienia z emaila";
            //get the email data
            $email = Email::findOrFail($id);
Log::info('This is the data regarding EMAIL');
Log::debug($email);
            // //get the attachments for this email
            // $attachments = Media::where('collection_name', 'file#email#'.$id)->get();

            // //Dla każdegoz tych plików dodaj defaultową notatkę
            // foreach($attachments as $file){
            //     Log::info('The attachments:::::::');
            //     Log::debug($file);
            //     $fileComment = new FileComment();
            //     $fileComment->media_id = $file->id;
            //     $fileComment->file_comment = "Plik przesłany w emailu: ". '"' . $email->subject .'"' . " o numerze id: " . $email->id;
            //     $fileComment->save();

            // }


        // Log::info('This is the data regarding Attchaments');
        // Log::debug($attachments);
        // dd($attachments);
            $contacts = Contact::select('id','company_id', 'email', 'name', 'surname')->get();


        $contactPerson = 0;
        Log::info('Poczatkowo $contact ma wartość: ');
        Log::debug($contactPerson);

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

            Log::info('This is the final contact out of scope!');
            Log::debug($contact);
            Log::debug($company);

            
            return view('pages.orders.order-email-create', compact('title', 'breadcrumb', 'email', 'company', 'contact', 'contactPerson','emailPlain'));
        }

// ponizej do zrobienia potem:: czyli wyświetlanie wszysktich emaili do danego orderu
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

            //find the emails assigned
            $emails = Email::findMany($emailsIds);

        $emailComments = EmailsToOrder::where('order_id', $order->id)->get();

            // $emails = Email::where('id', $id)->get();
            // Log::debug($emails);
            return view('pages.orders.order-emails', compact('emails', 'breadcrumb', 'title', 'order', 'emailComments'));
        }

        public function addEmailAttachments(){
            //
        }



        public function emailCommentEdit($id) {
            
            $emailComment = EmailsToOrder::findOrFail($id);

            return view ('pages.orders.order-email-comment-edit', compact('emailComment'));
        }

        public function emailCommentUpdate(Request $request, $id) {
        Log::info('This is EMAIL COMMENT is being updated and below is the Request data!');
        $emailComment = EmailsToOrder::findOrFail($id);

        $data = $request->all(); // Header may not contain more than a single header, new line detected
        // $data['notes'] = $request->notes;

        Log::debug($data);

        $emailComment->update($data);

        //add notification set as a static function in OrderNotificat like this: OrderNotificationController::createNotification (string $type, string $content, int $subjectId, int $orderId );
        // OrderNotificationController::createNotification('order_update', Auth::user()->name, $singleOrder->id, $singleOrder->id);

        Alert::alert('Gratulacje!', 'Notatka emaila została zaktualizowana!', 'success');
        // return redirect($this->displayAssignedEmails($emailComment->order_id));
        // return view(route('display.assigned.emails'));
        return redirect(route('display.assigned.emails', $emailComment->order_id));
        }
}
