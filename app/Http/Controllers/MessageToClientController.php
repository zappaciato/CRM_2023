<?php

namespace App\Http\Controllers;

use App\Mail\MessageToClient;
use App\Models\FileComment;
use App\Models\MessageToClient as ModelsMessageToClient;
use App\Models\OrderNotification;
use App\Services\Email2OrderService;
use App\Services\MessageToClientService;
use App\Services\OrderNotificationsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MessageToClientController extends Controller
{
    public function index() {

        $title = "Contacts";
        $breadcrumb = "New Contacts";
        $messages = MessageToClient::all();
        return view('pages.contacts.contacts-list', compact('title', 'messages'));

    }


    protected function validator($data)
    {
        Log::info('I am BEFORE validating the contact message to the client.');
        Log::debug($data);

        $validated =  Validator::make($data, [

            'from' => 'required|min:3' ,
            'to' => 'required|min:3',
            'cc' => 'nullable',
            'subject' => 'required|min:3',
            'content' => 'required|min:3',
            'order_id' => 'required',
            'msg-attachment' => 'nullable',

        ])->validate();

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

        $messageToClient = ModelsMessageToClient::create($data);


        Alert::alert('Gratulacje!', 'Wiadomość została wysłana', 'success');

        $message = new MessageToClientService($messageToClient);
        $message->sendMessage();

        (new OrderNotificationsService())->createNotification('message_sent', 'Wiadomość do klienta została wysłana: ' . $messageToClient['content'], $messageToClient['id'], $request->order_id);

        if(isset($data['msg-attachment'])) {
            $message->saveFileAndCommentFromMsg($messageToClient, $request);
        }

        return Redirect::back();

    }

}
