<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Order;
use App\Models\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    

    public function index () {

        $title = "Emaile";
        $breadcrumb = "Nowe emaile";

        //email statuses
        $read = 'mailInbox';

        $emails = Email::get();


// foreach ($emails as $email) {
//         if($email->status = 'read') {
//             $status = 'mailInbox';
//         } else if ($email->status = 'unread') {

//                 $status = 'unread';

//         } 

//         return $status;
// }
        Log::debug($emails);

        return view('pages.emails.emails-inbox', compact('title', 'breadcrumb', 'emails', 'read'));
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
