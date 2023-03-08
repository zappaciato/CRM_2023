<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class XSendEmailController extends Controller
{
    public function create(){
        $title = 'Send email';
        $breadcrumb = 'Send email';
        return view('send-email', compact('title', 'breadcrumb'));
    }
    public function sendEmail(Request $request){

        $data = $request->all();
        Log::info('Data from Request email send');
        Log::debug($data);

        $theEmail = Email::create($data);

        // $theEmail->addMediaFromRequest("e_attachment")->toMediaCollection("file#email#$theEmail->id");

        Log::info('This is the email just sent internally. ');
        Log::debug($theEmail->from_address);

        Log::info('Does this email have an attachment?');
        Log::debug($request->has('e_attachment'));

        if($request->has('e_attachment')) {
            $theEmail->addMediaFromRequest("e_attachment")->toMediaCollection("file#email#$theEmail->id");
        } else {
            
            return redirect()->back();

        }

        // if (!empty($theEmail->e_attachment)) {
        //     $theEmail->addMediaFromRequest("e_attachment")->toMediaCollection("file#email#$theEmail->id");
        // } else {

        //     return redirect()->back();
        // }



        return redirect()->back();

    }
}
