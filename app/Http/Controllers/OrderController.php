<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        Log::info('I am creating the view for adding a new order.');
        // $companies = Company::select('id', 'name')->get();
        // $companies =  Company::get(['name', 'id']);
        $companies = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        Log::debug($companies);
        // Log::debug($companies2);
        return view('pages.orders.order-add', compact('title', 'breadcrumb', 'companies'));
    }



    public function createFromEmail($id) {
        $title = "Dodawanie zamówienia z emaila";
        $breadcrumb = "Dodawanie nowego zamówienia z emaila";

        return view('pages.orders.order-add', compact('title', 'breadcrumb'));
    }

    protected function validator($data)
    {
        Log::info('I am tryign to validate the data for the order.');
        Log::debug($data);

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = '';
        $breadcrumb = '';
        Log::info('I am tryign to store the data');
        $data = $this->validator($request->all());
Log::debug($data);
        return view('welcome', compact('data', 'title', 'breadcrumb'));

        // return redirect(route('contact.list', $contact->id));
    }
}
