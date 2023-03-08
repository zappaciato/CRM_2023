<?php

namespace App\Services;

use App\Models\Email;
use App\Models\EmailsToOrder;
use App\Models\FileComment;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AttachmentsService 

{
    

    public function getAttachmentsLinks($order_id, $messagesToClient) {

        //////////////////////////
        // set the media collection name where files are stored in the media table
        $files = 'file#order#' . $order_id;

        //define array with attachment links
        $attachmentsLinks = [];

        // iterate over all messages to client for this ORDER
        foreach ($messagesToClient as $msg) {
            if ($msg->getFirstMedia($files) === null) {
                // do something if there are not attachments for each message individually

            } else {
                //do this if there are some attachment for each message individually
                $attachments = $msg->getMedia($files);
                Log::info('BELOW attachemtns:: ');
                Log::debug($attachments);

                foreach ($attachments as $attachment) {
                    Log::info('BELOW ::: single attachment $attachemnt');
                    Log::debug($attachment);
                    $attachmentsLinks[$attachment->model_id] = [$attachment->getUrl(), $attachment->name, $msg->id];
                    // array_push($attachmentsLinks,  $attachment->getUrl());
                    // $attachmentsLinks = $attachments->getUrl();
                }

                Log::info('Attachment links in the foreach below:::::');
                Log::debug($attachmentsLinks);
            };
      


    };

    // return json_decode(json_encode($attachmentsLinks), true);
    return $attachmentsLinks;

    }
}