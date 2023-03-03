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

    public function addFileComment ($data, $newFile, $request, $order) {

        Log::info('I am in AddfileCommment method FIlesServices');
        $fileComment = new FileComment();
        //check if there's a comment given
        if ($data['file_comment']) {
            $fileComment->file_comment = $data['file_comment'];
        } else {
            $fileComment->file_comment = 'Ten plik jest związany ze zgłoszeniem o tytule: ' . $order->title . ' i numerze Id: ' . $order->id;
        }

        $fileComment->media_id = $newFile->id;
        $fileComment->order_id = $request->order_id;
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

