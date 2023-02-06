<?php

namespace App\Http\Controllers;

use App\Models\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderNotificationController extends Controller
{
    public function index (){
        $orderNotifications = OrderNotification::all();
Log::debug(response()->json(['orderNotifications' => $orderNotifications]));
        return response()->json(['orderNotifications' => $orderNotifications]);
    }
}
