<?php

namespace App\Http\Controllers;

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


    public function show () {

        $title = "New Orders";
        $breadcrumb = "Nowe zamówienia";
        return view('pages.emails.email-single', compact('title', 'breadcrumb'));
    }
}
