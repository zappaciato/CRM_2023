<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Email;
use App\Models\EmailsToOrder;
use App\Models\Order;
use App\Models\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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


        $emails = $emailsAll->where('emailstatus', '!=', 'assigned');
        $emailsAssigned = $emailsAll->where('emailstatus', '=', 'assigned');

        // Log::debug($emailsAll->id);
        // Log::debug($emails);
        Log::debug($emailsAssigned);

        return view('pages.emails.emails-inbox', compact('title', 'breadcrumb', 'emails', 'emailsAssigned', 'read'));
    }

    public function indexAssigned() {
        $title = "Emaile przypisane";
        $breadcrumb = "Przypisane emaile";
        $emailsAll = Email::all();


        $emails = $emailsAll->where('emailstatus', '!=', 'assigned');
        $emailsAssigned = $emailsAll->where('emailstatus', '=', 'assigned');
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

        // $notification = new OrderNotification();
        // $notification->type = $type;
        // $notification->content = $content;
        // $notification->subjectId = $subjectId;
        // $notification->order_id = $orderId;
        // $notification->save();
        // Log::debug($notification);

        Log::info('This is teh request data from add2order');
        Log::debug($request);
        $data = $request->all();
Log::debug($data);
        $email2order = new EmailsToOrder();
        $email2order->order_id = $data['order_id'];
        $email2order->email_id = $data['email_id'];
        $email2order->user_id = $data['user_id'];
        $email2order->save();


        return redirect('/modern-dark-menu/emails/mailbox/inbox');
    }


    public function show ($id) {

        Log::info('I am showing the record email. below Id of the email.');
        Log::debug($id);
        $title = "Emaile";
        $breadcrumb = "Wybrany email";

        // $email = Email::where('id', $id)->get();
        $email = Email::findOrFail($id);

        $email->emailstatus = ['przeczytany']; //pyta sie o array a ja tu dawalem string.. jednak do bazy wpisyje z bracketami i ""
        $email->update($email->emailstatus);
        // Email::update('status' => 'przecztany')->where('id', $id);

Log::debug($email);
        return view('pages.emails.email-single', compact('title', 'breadcrumb', 'email'));
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

        $email = Email::findOrFail($request->email_id);
        $email['emailstatus'] = 'assigned';
        $email->update([$email['emailstatus']=> 'assigned']);
        Log::info("Email status updated");

        //add notification set as a static function in OrderNotificat (string $type, string $content, int $subjectId, int $orderId )
        OrderNotificationController::createNotification('order_created', 'Zgłoszenie zostało utworzone!', $newOrder->id, $newOrder->id);




        // return view('pages.orders.orders-service', compact('data', 'title', 'breadcrumb'));

        return redirect(route('service.orders'));
    }


        public function createFromEmail($id) {
            $title = "Dodawanie zamówienia z emaila";
            $breadcrumb = "Dodawanie nowego zamówienia z emaila";
            $email = Email::findOrFail($id);

            $contacts = Contact::select('id','company_id', 'email', 'name', 'surname')->get();
            foreach ($contacts as $contact) {

                if($contact->email == $email->from_address) {
                Log::info('This is the company which sent this email!');
                    $company  =  Company::where('id', $contact->company_id)->firstOrFail();
                // $contact = Contact::where('id', $contact->id);
                    Log::info("Below is 1 company and 2 contact!!!!!!!!!!!!!!!!!!!");
                    Log::debug($company);
                    Log::debug($contact);
                    
                    break;
                }
            }

        $emailPlain = \Soundasleep\Html2Text::convert($email->text_html);

            Log::info('This is the final contact out of scope!');
            // Log::debug($contact);
            // Log::debug($company);
            return view('pages.orders.order-email-create', compact('title', 'breadcrumb', 'email', 'company', 'contact', 'emailPlain'));
        }


        public function displayAssignedEmails($id){
            $emails = Email::where('id', $id)->get();
Log::debug($emails);
            return view('pages.orders.order-emails', compact('emails'));
        }

}
