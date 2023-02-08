<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderNotificationController extends Controller
{
    public function index (){
        // for later to list all notifications in opcje notifications Log
        $orderNotifications = OrderNotification::all();
        
        Log::info('BELOW is data for ordernotification');
        Log::debug(response()->json(['orderNotifications' => $orderNotifications]));


        return response()->json(['orderNotifications' => $orderNotifications]);
    }

    static function createNotification($data) {

        
        //Add this event to OrderNotification table;
        $notification = new OrderNotification();
        $notification->type = 'order_created';
        $notification->content = 'Zgłoszenie zostało utowrzone' . $data->name;
        $notification->subjectId = $data->id;
        if($data->id) {
            $notification->order_id = $data->id;
        } else {
            $notification->order_id = null;
        }
        
        $notification->save();
        Log::debug($notification);

    }
}
