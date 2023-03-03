<?php

namespace App\Services;

use App\Models\Email;
use App\Models\EmailsToOrder;
use App\Models\FileComment;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Email2OrderService
{

    private $email_id;

    public function __construct(int $email_id)
    {
        $this->email_id = $email_id;
    }

    //to do innego servisu idze
    public function saveFileComment($order_id)
    {
        Log::info('I am in getEmailattachments');
        $attachments = Media::where('collection_name', 'file#email#' . $this->email_id)->get();
        $email = Email::findOrFail($this->email_id);
        //sprawdzic jak to wyglada w innej metodzie i podpiac podobna logike; if there is an attachment then do this if not don't do anything;???
        //for ech of the attachments add a default comment
        foreach ($attachments as $file) {

            $fileComment = new FileComment();
            $fileComment->media_id = $file->id;
            $fileComment->order_id = $order_id;
            $fileComment->file_comment = "Plik przesłany w emailu: " . '"' . $email->subject . '"' . " o numerze id: " . $this->email_id . ". Dołączony do zgłoszenia nr: " . $order_id;
            $fileComment->save();
        }
    }

    
    public function addEmail2Order(int $orderId, int $userId = 1, string $notes = 'Email automatycznie przydzielony do zgłoszenia' ) {
        Log::info('I am in addEmail2Order');
        $email2order = new EmailsToOrder(); 
        $email2order->order_id = $orderId;
        $email2order->email_id = $this->email_id;
        $email2order->user_id = $userId;
        $email2order->notes = $notes;
        $email2order->save();

        // Email2OrderService::getEmailAttachments($this->email_id, $orderId);
        // Log::info('I have already done the attachments');
        return $email2order;
    }

    public function changeEmailStatus() {
        //zmiana statusu emaila powtarza sie DRY extract to service;
        Log::info('I am chainging the email status');
        $email = Email::findOrFail($this->email_id);
        $email['emailstatus'] = 'assigned';
        $email->update([$email['emailstatus'] => 'assigned']);
        Log::info("Email status updated");
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////
    // private function sendEmailNotification(arr $content, arr $subject, arr ) {
    //     // Sending email notification to the relevant people;
    //     // Specify the message details or do sth about it;
    //     $messageToClient = ['content' => 'Dupa dupa', 'subject' => 'jajca jajca', 'number' => 10, 'from' => 'mj@k.pl'];

    //     if($email->cc !== '' && $email->bcc !==  '') {

    //         Mail::to([$email->from_address, $email->cc, $email->bcc, env('ADMIN_EMAIL')])->send(new MessageToClient($messageToClient));

    //     } else {

    //         Mail::to([$email->from_address, env('ADMIN_EMAIL')])->send(new MessageToClient($messageToClient));
    //     }
    //     // do tego miejsca refactoring wyniesc to gdzie indziej
    // }

}