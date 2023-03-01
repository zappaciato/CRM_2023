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

    static function createNotification(string $type, string $content, int $subjectId, int $orderId ) {

        
        //Add this event to OrderNotification table;
        $notification = new OrderNotification();
        $notification->type = $type;
        $notification->content = $content;
        $notification->subjectId = $subjectId;
        $notification->order_id = $orderId;
        $notification->save();
        Log::debug($notification);

    }
}

