<?php

namespace App\Services;

use App\Models\Email;
use App\Models\EmailsToOrder;
use App\Models\FileComment;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Email2OrderService
{

    static function getEmailAttachments($email_id, $order_id)
    {
        Log::info('I am in getEmailattachments');
        $attachments = Media::where('collection_name', 'file#email#' . $email_id)->get();
        $email = Email::findOrFail($email_id);

        //for ech of the attachments add a default comment
        foreach ($attachments as $file) {

            $fileComment = new FileComment();
            $fileComment->media_id = $file->id;
            $fileComment->file_comment = "Plik przesłany w emailu: " . '"' . $email->subject . '"' . " o numerze id: " . $email->id . ". Dołączony do zgłoszenia nr: " . $order_id;
            $fileComment->save();
        }
    }

    public static function addEmail2Order(int $orderId, int $emailId, int $userId = 1, string $notes = 'Email automatycznie przydzielony do zgłoszenia' ) {
        Log::info('I am in addEmail2Order');
        $email2order = new EmailsToOrder(); 
        $email2order->order_id = $orderId;
        $email2order->email_id = $emailId;
        $email2order->user_id = $userId;
        $email2order->notes = $notes;
        $email2order->save();

        Email2OrderService::getEmailAttachments($emailId, $orderId);
        Log::info('I have already done the attachments');
        return $email2order;
    }

    static function changeEmailStatus($email_id) {
        //zmiana statusu emaila powtarza sie DRY extract to service;
        Log::info('I am chainging the email status');
        $email = Email::findOrFail($email_id);
        $email['emailstatus'] = 'assigned';
        $email->update([$email['emailstatus'] => 'assigned']);
        Log::info("Email status updated");
    }

    

}