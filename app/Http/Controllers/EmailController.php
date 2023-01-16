<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index () {
        return view('pages.orders.order-single-serivce');
    }


    public function show () {

        $title = "New Orders";
        $breadcrumb = "Nowe zamówienia";
        return view('pages.emails.email-single', compact('title', 'breadcrumb'));
    }
}
