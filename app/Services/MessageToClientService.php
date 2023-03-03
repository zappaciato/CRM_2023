<?php

namespace App\Services;

use App\Mail\MessageToClient;
use App\Models\Email;
use App\Models\FileComment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MessageToClientService
{
    private $messageToClient;

    public function __construct($messageToClient)
    {
        $this->messageToClient = $messageToClient;
    }


    public function saveFileAndCommentFromMsg($request)
    {
        Log::info('Checked and the msg-attachment is uploaded fine');
        Log::info('Below I am adding msg-attachment to the media collection');

        $this->messageToClient->addMediaFromRequest("msg-attachment")->toMediaCollection("file#order#$request->order_id");

        Log::info('The uploaded attachment::::::: is getting a default comment');

        //add a defualt comment to the attachment to be refactored to Service;
        //get the last attachemnt just added
        $attachment = Media::where('collection_name', 'file#order#' . $request->order_id)->latest()->first();
        //add a default comment
        $fileComment = new FileComment();
        $fileComment->media_id = $attachment->id;
        $fileComment->file_comment = "Plik przesłany w wiadomości do klienta: " . '"' . $this->messageToClient->subject . '"' . " o numerze id: " . $this->messageToClient->id;
        $fileComment->order_id = $request->order_id;
        $fileComment->save();
    }

    public function sendMessage() {
        //
        // wysłanie wiadomosci email do klienta:: attempt to read property on null; TODO fix it

        if ($this->messageToClient['to'] !== '' && $this->messageToClient['cc'] !== '') {
            Log::info('Debuggin email address to000000000000000000000000');
            Log::debug($this->messageToClient['to']);
            $recipients = [$this->messageToClient['to'], $this->messageToClient['from'], env('ADMIN_EMAIL')];

            $multiRecipietsCC = explode(', ', $this->messageToClient['cc']); // divide the address so they are "addres", "address" NOT like "address, address"
            //push it to the recipients array
            foreach ($multiRecipietsCC as $recipient) {
                array_push($recipients, $recipient);
            }

            Mail::to($recipients)->send(new MessageToClient($this->messageToClient));
            Mail::to(['kris@dupa.pl', 'daro@dick.pl', 'costam@facebok.com'])->send(new MessageToClient($this->messageToClient));
        } else {

            Mail::to([$this->messageToClient['from'], env('ADMIN_EMAIL')])->send(new MessageToClient($this->messageToClient));
        }

    }


}

