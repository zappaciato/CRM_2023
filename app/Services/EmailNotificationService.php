<?php

namespace App\Services;

use App\Mail\MessageToClient;
use App\Models\Email;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailNotificationService 
{

    static function sendEmailNotification(int $email_id, $notification_content, $notification_subject, $notification_from, int $order_id) {

        $email = Email::findOrFail($email_id);
        // Sending email notification to the relevant people;
        // Specify the message details or do sth about it;
        $messageToClient = ['content' => $notification_content, 'subject' => $notification_subject, 'order_id' => $order_id, 'from' => $notification_from];
        // $messageToClient = ['content' => 'nic nic', 'subject' => 'cos cos', 'number' => 10, 'from' => 'mj@k.pl'];
Log::info('Message to client subject BELOW:::::');
Log::debug($messageToClient['subject']);
        if ($email->cc !== '' && $email->bcc !==  '') {

            Mail::to([$email->from_address, $email->cc, $email->bcc, env('ADMIN_EMAIL')])->send(new MessageToClient($messageToClient));
        } else {

            Mail::to([$email->from_address, env('ADMIN_EMAIL')])->send(new MessageToClient($messageToClient));
        }



    }

}