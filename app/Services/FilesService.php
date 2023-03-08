<?php

namespace App\Services;

use App\Mail\MessageToClient;
use App\Models\Email;
use App\Models\FileComment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FilesService
{

    public function addFileComment ($commentData, $newStoredFile, $order) {

        Log::info('I am in AddfileCommment method FIlesServices');
        $fileComment = new FileComment();
        //check if there's a comment given
        // if ($commentData['file_comment']) {
        //     $fileComment->file_comment = $commentData['file_comment'];
        // } else {
        //     $fileComment->file_comment = $commentData;
            
        //     // 'Ten plik jest związany ze zgłoszeniem o tytule: ' . $order->title . ' i numerze Id: ' . $order->id;
        // }
        $fileComment->file_comment = $commentData;
        $fileComment->media_id = $newStoredFile->id;
        $fileComment->order_id = $order->id;
        $fileComment->save();


    }

    public function fileDataValidation ($request) {
        Log::info('I am validating a file data... in FilesServce');
        $data = $request->validate([
            'order_id' => 'required|numeric|exists:orders,id',
            'new_file' => 'required',
            'order_id' => 'required',
            'file_comment' => 'nullable',
        ]);

        return $data;
    }


}

