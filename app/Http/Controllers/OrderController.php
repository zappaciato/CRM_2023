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

        return view('pages.orders.orders-new-list', compact('title', 'breadcrumb', 'orders'));
    }

    public function create () {
        $title = "Dodawanie zamówienia";
        $breadcrumb = "Dodawanie nowego zamówienia";

        return view('pages.orders.order-add', compact('title', 'breadcrumb'));
    }
}
