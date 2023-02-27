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
    public function store(Request $request)
    {

        // Adding a file manually to the order; 

$title = 'Files';
$breadcrumb = "files";
        
        // $order = Order::where('id', $request->order_id)->get();
        $order = Order::find($request->order_id);
        $orderId = $request->order_id;
        // $media = Media::find(1);
        // $messageToCLient = MessageToClient::where('id', 1)->get();
        Log::info('This is the request when adding a new file to collection. and ORDER details');
        Log::debug($request);
        Log::debug($order);
        $data = $request->validate([
            'order_id' => 'required|numeric|exists:orders,id',
            'new_file' => 'required',
            'order_id' => 'required',
            'file_comment' => 'nullable', 
        ]);
        Log::info('Below DATA from inpit file upload');
        Log::debug($data);

        // $order->addMediaFromRequest($data['new_file'])->toMediaCollection("file#order#$request->order_id");
        if (isset($data['new_file'])) {

            Log::info('Checked and the new_file is uploaded fine');
            Log::info('Below I am adding new_file to the media collection');

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
        // OrderComment::create(Arr::add($data, 'user_id', $request->user()->id));

        // Log::info('Below is the comment data after validation and upload to db.');
        // Log::debug($data);

        Alert::alert('Gratulacje!', 'Plik został dodany!', 'success');
        Log::info('I am about to finish the file upload');
        return redirect()->back();

    }
}
