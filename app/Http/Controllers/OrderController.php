<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\Email;
use App\Models\Order;
use App\Services\EmailNotificationService;
use App\Services\OrderNotificationsService;
use App\Services\OrderService;
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
        Log::info('I am validating the order record. Manual Create');
        Log::debug($data);

        $validated = (new OrderService())->validator($data); 

        Log::info('Manually created ORDER Record has been validated!!');

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
        $data = $this->validator($request->all());


        // Get the name of the correct address based on the id from $request->address
        $address = CompanyAddress::findOrFail($request->address); 
        $data['address'] = $address->name;


        $orderCode = (new OrderService())->generateCode();

        Log::info('Generated code BELOW');
        Log::debug($orderCode);

        $data['code'] = $orderCode;
        $data['title'] = $data['title'] .'..'. $orderCode;

        Log::info('I am trying to debug the FINAL data to store - ORDER!');
        Log::debug($data);
        //here we create the new order; 
        $newOrder = Order::create($data);

        (new OrderNotificationsService)->createNotification('order_created', 'Zgłoszenie zostało utworzone!', $newOrder->id, $newOrder->id);

        //Sent email notification on creating the order

        $emailNotifications = new EmailNotificationService();
        //Send email notification to all relevant persons
        // $theOrder = Order::findOrFail($newOrder->id);
        //provide all necessary details in the message;
        $messageToClient = [
            'content' =>    '<h3 style="color: red">Utworzono zgłoszenie dotyczące Twojej prośby.</h3>
                            <h3> Kod zgłoszenia to: </h3>
                            <h1 style="color: rgb(255, 81, 0)">"' . $newOrder->code . '"</h1> <p>Żeby usprawnić komunikację, prosmy pamiętać aby umieścić powyższy kod w tytule każdego emaila dotyczacego tego zgłoszenia. Dziękujemy!</p>',
            'subject' => 'Zgłoszenie utworzone! :: ' . $newOrder->code,
            'order_id' => $newOrder->id,
            'from' => env('ADMIN_EMAIL')
        ];

        $emailNotifications->sendEmailNotification($messageToClient, $data['email_id']);

        return redirect(route('service.orders'));
    }
}
