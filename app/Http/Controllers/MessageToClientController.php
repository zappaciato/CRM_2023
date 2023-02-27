<?php

namespace App\Http\Controllers;

use App\Mail\MessageToClient;
use App\Models\FileComment;
use App\Models\MessageToClient as ModelsMessageToClient;
use App\Models\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MessageToClientController extends Controller
{
    public function index()
    {
// will index all messages sent to cients from ALL users!
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


        Log::info('Message to the client  has been validated!!');

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
        // $data['content'] = $request->input('content');

        Log::info('This is message to client data AFTER validation');
        Log::debug($data);

        // if($data->())

        $messageToClient = ModelsMessageToClient::create($data);


        Alert::alert('Gratulacje!', 'Wiadomość została wysłana', 'success');
        Log::info('Below is the $message variable shoulbd be the same as $data;');
Log::debug($messageToClient);

// wysłanie wiadomosci email do klienta:: attempt to read property on null; TODO fix it

        if($messageToClient['to'] !== '' && $messageToClient['cc'] !== '') {
            Log::info('Debuggin email address to000000000000000000000000');
            Log::debug($messageToClient['to']);
            $recipients = [$messageToClient['to'], $messageToClient['from'], env('ADMIN_EMAIL')];

            $multiRecipietsCC = explode(', ', $messageToClient['cc']); // divide the address so they are "addres", "address" NOT like "address, address"
            //push it to the recipients array
            foreach($multiRecipietsCC as $recipient) {
                array_push($recipients, $recipient);
            }

            
            Log::info('Debuggin email address RECIPIENTS    0000000000000000000');
            Log::debug($recipients);

            Mail::to($recipients)->send(new MessageToClient($messageToClient));
            Mail::to(['kris@dupa.pl', 'daro@dick.pl', 'costam@facebok.com'])->send(new MessageToClient($messageToClient));
        } else {

            Mail::to([$messageToClient['from'], env('ADMIN_EMAIL')])->send(new MessageToClient($messageToClient));
            }



        //add notification set as a static function in OrderNotificat like this: OrderNotificationController::createNotification (string $type, string $content, int $subjectId, int $orderId );
        OrderNotificationController::createNotification('message_sent', 'Wiadomość do klienta została wysłana: ' . $messageToClient['content'], $messageToClient['id'], $request->order_id);


        if (isset($data['msg-attachment'])) {
            Log::info('Checked and the msg-attachment is uploaded fine');
            Log::info('Below I am adding msg-attachment to the media collection');

            $messageToClient->addMediaFromRequest("msg-attachment")->toMediaCollection("file#order#$request->order_id");

            Log::info('The uploaded attachment::::::: is getting a default comment');

            //add a defualt comment to the attachment
            //get the last attachemnt just added
            $attachment = Media::where('collection_name', 'file#order#' . $request->order_id)->latest()->first(); 
            //add a default comment
            $fileComment = new FileComment();
            $fileComment->media_id = $attachment->id;
            $fileComment->file_comment = "Plik przesłany w wiadomości do klienta: " . '"' . $messageToClient->subject . '"' . " o numerze id: " . $messageToClient->id;
            $fileComment->order_id = $request->order_id;
            $fileComment->save();


        }

        return Redirect::back();
        // return redirect(route('contact.list', $contact->id));
    }








    // public function show($id)
    // {

    //     $singleContact = Contact::where('id', $id)->firstOrFail();

    //     $company = Company::where('id', $singleContact->company_id)->firstOrFail();

    //     $companyAddress = CompanyAddress::where('company_id', $company['id'])->firstOrFail();

    //     Log::debug($singleContact);
    //     Log::debug($company);
    //     Log::debug($companyAddress);

    //     $title = "Osoba kontaktowa";
    //     $breadcrumb = "Kontakt:  ";


    //     // dd($company);
    //     return view('pages.contacts.contact', compact('title', 'breadcrumb', 'singleContact', 'company', 'companyAddress'));
    // }


    // public function edit($id)
    // {
    //     Log::info('I am editing the record.-> Contact');
    //     $contact = Contact::findOrFail($id);


    //     $title = 'Edycja kontaktu';
    //     $breadcrumb = 'Eduycja kontaktu ' . $contact->name . '' . $contact->surname;

    //     return view('pages.contacts.contact-edit', compact('title', 'breadcrumb', 'contact'));
    // }


    // public function update(Request $request, $id)
    // {
    //     Log::info('I am in update contact method');
    //     $contact = Contact::findOrFail($id);



    //     $data = $this->validator($request->all());


    //     $contact->update($data);
    //     Log::info('I am updating the record.');

    //     Alert::alert('Gratulacje!', 'Kontakt: ' . $contact->name . ' ' . $contact->surname . ' został zaktualizowany!', 'success');

    //     return redirect(route('contact.list'));
    // }


    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     $contact = Contact::findOrFail($id);

    //     $contact->delete();

    //     Alert::alert('Gratulacje!', 'Dane osoby kontaktowej zostały usnięte!', 'success');

    //     return redirect(route('contact.list'));
    // }
}
