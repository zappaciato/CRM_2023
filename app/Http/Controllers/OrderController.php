<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Email;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Psy\CodeCleaner\FunctionContextPass;

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

        $companies = Company::all()->pluck('name', 'id')->prepend(trans('Wybierz FIRMĘ'), '');
        Log::debug($companies);

        return view('pages.orders.order-add', compact('title', 'breadcrumb', 'companies'));
    }






    protected function validator($data)
    {
        Log::info('I am validating the order record.');
        Log::debug($data);

        $validated =  Validator::make($data, [
            'title' => 'required',
            'company_id' => 'required|integer',
            'email_id' => 'required|integer',
            'contact_person' => 'required',
            'address' => 'required',
            'lead_person' => 'required',
            'involved_person' => 'required',
            'priority' => 'required',
            'order_content' => 'required',
            'order_notes' => 'required',
            'deadline' => 'required',
            'status' => 'required',

        ])->validate();


        Log::info('ORDER Record has been validated!!');

        // $validated = Arr::add($validated, 'published', 0);
        // $validated = Arr::add($validated, 'premium', 0);

        return $validated;
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
        Log::info('I am tryign to store the data and redirect');
        $data = $this->validator($request->all());
        Log::info('I am trying to debug the data to store - ORDER!');
Log::debug($data);

Order::create($data);

        // return view('pages.orders.orders-service', compact('data', 'title', 'breadcrumb'));

        return redirect(route('new.orders'));
    }
}
