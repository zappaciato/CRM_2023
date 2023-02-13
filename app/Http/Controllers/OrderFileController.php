<?php

namespace App\Http\Controllers;

use App\Models\MessageToClient;
use App\Models\Order;
use App\Models\OrderFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class OrderFileController extends Controller
{
    public function store(Request $request)
    {

        // Order Id zawsze wybija jako 7... prawdopodobnie tzerba dodac parametr id i rowniez w web.route;


        
        // $order = Order::where('id', $request->order_id)->get();
        $order = Order::find($request->order_id);
        // $media = Media::find(1);
        // $messageToCLient = MessageToClient::where('id', 1)->get();
        Log::info('This is the request when adding a new file to collection. and ORDER details');
        Log::debug($request);
        Log::debug($order);
        $data = $request->validate([
            'order_id' => 'required|numeric|exists:orders,id',
            'new_file' => 'required', 
        ]);
        Log::info('Below DATA from inpit file upload');
        Log::debug($data);

        // $order->addMediaFromRequest($data['new_file'])->toMediaCollection("file#order#$request->order_id");
        if (isset($data['new_file'])) {

            Log::info('Checked and the new_file is uploaded fine');
            Log::info('Below I am adding new_file to the media collection');

            $order->addMediaFromRequest("new_file")->toMediaCollection("file#order#$request->order_id");
        }

        // OrderComment::create(Arr::add($data, 'user_id', $request->user()->id));

        // Log::info('Below is the comment data after validation and upload to db.');
        // Log::debug($data);

        Alert::alert('Gratulacje!', 'Plik został dodany!', 'success');
        Log::info('I am about to finish the file upload');
        return back()->with('messsage', 'Your file has been added!');
    }
}
