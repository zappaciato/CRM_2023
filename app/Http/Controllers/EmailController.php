<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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



        public function createFromEmail($id) {
            $title = "Dodawanie zamówienia z emaila";
            $breadcrumb = "Dodawanie nowego zamówienia z emaila";
            $email = Email::findOrFail($id);
            // Jak sprawdzic z emaila z ktorej firmy to doszlo? za pomoca from_email
            // $companies = Company::all()->pluck('name', 'id');

            $contacts = Contact::select('id','company_id', 'email', 'name', 'surname')->get();
            foreach ($contacts as $contact) {

//to sie nie danadje bo najpeirw zrobi a potem sprawdzi czy jest true zeby zrobic jeszcze raz. 
                // do {
                // $company  =  Company::where('id', $contact->company_id)->firstOrFail();
                // $contact = Contact::where('id', $contact->id);
                // } while ($contact->email == $email->from_address)

                // switch($contact->email) {
                //     case($email->from_address):
                //         Log::debug($contact->email);
                //     $company  =  Company::where('id', $contact->company_id)->firstOrFail();
                //     $contact = Contact::where('id', $contact->id);
                //     break;

                // };



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

            Log::info('This is the final contact out of scope!');
            // Log::debug($contact);
            // Log::debug($company);
            return view('pages.orders.order-email-create', compact('title', 'breadcrumb', 'email', 'company', 'contact'));
        }


}
