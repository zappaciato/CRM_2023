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

    
}

