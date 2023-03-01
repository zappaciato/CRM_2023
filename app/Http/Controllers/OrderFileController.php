<?php

namespace App\Http\Controllers;

use App\Models\FileComment;
use App\Models\MessageToClient;
use App\Models\Order;
use App\Models\OrderFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class OrderFileController extends Controller
{
    // This is for manual upload (not automatic from email, etc. For this action the methods are respectively in the email or wherever it is done)
    public function store(Request $request) {

        $order = Order::find($request->order_id);
        $orderId = $request->order_id;

        $data = $request->validate([
            'order_id' => 'required|numeric|exists:orders,id',
            'new_file' => 'required',
            'order_id' => 'required',
            'file_comment' => 'nullable', 
        ]);


        // $order->addMediaFromRequest($data['new_file'])->toMediaCollection("file#order#$request->order_id");
        if (isset($data['new_file'])) {

            $newFile = $order->addMediaFromRequest("new_file")->toMediaCollection("file#order#$request->order_id");
        }

        if($newFile) {

            $fileComment = new FileComment();
            //check if there's a comment given
            if($data['file_comment']) {
                    $fileComment->file_comment = $data['file_comment'];
            } else {
                    $fileComment->file_comment = 'Ten plik jest związany ze zgłoszeniem o tytule: ' . $order->title . ' i numerze Id: ' . $order->id;
            }
            
                    $fileComment->media_id = $newFile->id;
                    $fileComment->order_id = $request->order_id;
                    $fileComment->save();

            } else {
                return redirect()->back();
        }

        Alert::alert('Gratulacje!', 'Plik został dodany!', 'success');

        return redirect()->back();

    }
}
