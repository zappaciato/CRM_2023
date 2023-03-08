<?php

namespace App\Services;

use App\Mail\MessageToClient;
use App\Mail\OrderChanged;
use App\Models\Contact;
use App\Models\Email;
use App\Models\FileComment;
use App\Models\Order;
use App\Models\OrderNotification;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class OrderService
{
    public function validator($data)
    {
        Log::info('I am validating the order record.');
        Log::debug($data);

        $validated =  Validator::make($data, [
            'title' => 'required',
            'code' => 'nullable',
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


    public function generateCode()
    {
        // count orders and add +1 to the new order code;
        $ordersCount = Order::select('id')->orderBy('id', 'desc')->first(); 
        //check if there are any orders in the db
        if ($ordersCount !== null) {
            // add the order code for recognition and scanning
            $code = '[#order#id#' . $ordersCount->id + 1 . '#]';
        } else {
            $code = '[#order#id#' . 1 . '#]';
        }


        // $ordersCount = Order::select('id')->orderBy('id', 'desc')->first();
        // //check if there are any orders in the db
        // if ($ordersCount !== null) {
        //     // add the order code for recognition and scanning
        //     $data['code'] = '[#order#id#' . $ordersCount->id + 1 . '#]';
        //     $data['title'] = $data['title'] . '[#order#id#' . $ordersCount->id + 1 . '#]';
        // } else {
        //     $data['code'] = '[#order#id#' . 1 . '#]';
        //     $data['title'] = $data['title'] . '[#order#id#' . 1 . '#]';
        // }

        return $code;
    }
}