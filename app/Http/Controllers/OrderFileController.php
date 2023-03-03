<?php

namespace App\Http\Controllers;

use App\Models\FileComment;
use App\Models\MessageToClient;
use App\Models\Order;
use App\Models\OrderFile;
use App\Services\FilesService;
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
        // $orderId = $request->order_id;
        $file = new FilesService();

        $data = $file->fileDataValidation($request);

        if (isset($data['new_file'])) {

            $newFile = $order->addMediaFromRequest("new_file")->toMediaCollection("file#order#$request->order_id");
        }

        if($newFile) {

            $file->addFileComment($data, $newFile, $request, $order);

            } else {
                
                return redirect()->back();
        }

        Alert::alert('Gratulacje!', 'Plik został dodany!', 'success');

        return redirect()->back();

    }
}
