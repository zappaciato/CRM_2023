<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index () {
        $title = "New Orders";
        $breadcrumb = "Nowe zamówienia";

        $orders = Order::all();

        return view('pages.dashboard.new-orders', compact('title', 'breadcrumb', 'orders'));
    }
}
