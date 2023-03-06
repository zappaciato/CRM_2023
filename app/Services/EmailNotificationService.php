<?php

namespace App\Services;

use App\Mail\MessageToClient;
use App\Models\Email;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailNotificationService 
{

    public function sendEmailNotification($messageToClient, $email_id) {
        $email = Email::findOrFail($email_id);

        if ($email->cc !== '' && $email->bcc !==  '') {

            Mail::to($email->from_address, $email->cc, $email->bcc, env('ADMIN_EMAIL'))->send(new MessageToClient($messageToClient));
        } else {

            Mail::to([$email->from_address, env('ADMIN_EMAIL')])->send(new MessageToClient($messageToClient));
        }

        return $messageToClient;
    }


//     public function sendEmailNotificationOnAutomaticAssignment($messageToClient, $email_id) {
//         $email = Email::findOrFail($email_id);

//         // Sending email notification to the relevant people;
//         // Specify the message details or do sth about it;
        
//         // $messageToClient = ['content' => 'nic nic', 'subject' => 'cos cos', 'number' => 10, 'from' => 'mj@k.pl'];
// Log::info('Message to client subject BELOW:::::');
// Log::debug($messageToClient['subject']);

//         if ($email->cc !== '' && $email->bcc !==  '') {

//             Mail::to($email->from_address, $email->cc, $email->bcc, env('ADMIN_EMAIL'))->send(new MessageToClient($messageToClient));
//         } else {

//             Mail::to([$email->from_address, env('ADMIN_EMAIL')])->send(new MessageToClient($messageToClient));
//         }

//         return $messageToClient;

//     }

//     public function sendEmailNotificationOnOrderCreate($messageToClient, $email_id) {
//         $email = Email::findOrFail($email_id);

//         // Sending email notification to the relevant people;
//         // Specify the message details or do sth about it;

//         // $messageToClient = ['content' => 'nic nic', 'subject' => 'cos cos', 'number' => 10, 'from' => 'mj@k.pl'];
//         Log::info('Message to client subject BELOW:::::');
//         Log::debug($messageToClient['subject']);

//         if ($email->cc !== '' && $email->bcc !==  '') {

//             Mail::to($email->from_address, $email->cc, $email->bcc, env('ADMIN_EMAIL'))->send(new MessageToClient($messageToClient));
//         } else {

//             Mail::to([$email->from_address, env('ADMIN_EMAIL')])->send(new MessageToClient($messageToClient));
//         }

//         return $messageToClient;
//     }



    public function findMatchedEmails()
    {

        // $emails = Email::all();
        // the search for matched emails goes to email2orderService; 
        //get all emails with status new or read (as the user can read email before the scan) 
        $emails = Email::whereIn('emailstatus', ['new', 'read'])->get();
        // create an array with all email titles eligible for the scan
        $emailsTitles = [];

        foreach ($emails as $email) {
            Log::info('Something is going on in for each emails');
            // create key - email_id and value email_subject
            $emailsTitles[$email->id] = $email->subject;
            Log::debug($email->id);
        }

        Log::info('Emails titles HERE WE ARE BELOW: ');
        Log::debug($emailsTitles); //works great!

        // create array of all orders with non archived status (add later filter for non archived), create the codes based on order id, and add key order Id and value $the email code [#order#id#3#]
        $emailCodes = [];
        $orders = Order::all(); 
        foreach ($orders as $order) {
            $emailCodes[$order->id] = "[#order#id#" . $order->id . "#]"; //it needs to be in this form for seaching purposes
            // $emailCodes[$order->id] = $order->id;
        };

        Log::info('Here are Email Condes from Orders Titles BELOW:');
        Log::debug($emailCodes);

        // $tytul = 'df[#order#id#2#] cos tam cos tam BEZ ZALCZNIKA 2';
        // $kod = '[#order#id#2#]';

        // Log::info('TeSSSSSST');
        // Log::debug(strpos($tytul, $kod));

        $matchedEmails = [];
        // foreach ($emailCodes as $emailKey => $emailCode) {
        foreach ($emailsTitles as $titleKey => $emailTitle) {
            Log::info('It iterates through emails titles');
            foreach ($emailCodes as  $emailCode) {
                Log::info('It iterates through email codes');
                Log::info('Now $email title! BELOW::::');
                Log::debug($emailTitle);
                Log::info('Now $emailcode BELOW:::: ');
                Log::debug($emailCode);
                Log::debug(strpos($emailTitle, $emailCode));
                if (strpos($emailTitle, $emailCode)) {
                    Log::info('It has found an email!!! WOW!');
                    $matchedEmails[$titleKey] = $emailCode;
                    Log::debug($matchedEmails);
                };
            }
        }
        Log::info('All matched emails with order titles!;');
        Log::debug($matchedEmails);

        return $matchedEmails;
    }
    }
