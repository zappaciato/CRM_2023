<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceOrderController extends Controller
{
    public function index() {
        $title = "New Orders";
        $breadcrumb = "Nowe zamówienia";
        // tutaj ma wyciagnac ordersy ale tylko te z statusem otearte czy przyjęte;
        $orders = Order::where('status', 'new')->get();
        

        return view('pages.orders.orders-service', compact('title', 'breadcrumb', 'orders'));
    }

    public function show($id)
    {
        // $singleOrder = Order::where('id', $id)->get();  to nie daje mi kolekcji we wlasciwym formacie
        $singleOrder = Order::findOrFail($id);
        Log::debug($singleOrder->id);
        $title = 'Zgłoszenie nr: ' . $singleOrder->id;
        $breadcrumb = 'Zgłoszenie nr: ' . $singleOrder->id;

        return view('pages.orders.order-single-service', compact('title', 'id', 'breadcrumb', 'singleOrder'));
    }

    
}
