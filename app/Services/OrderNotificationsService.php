<?php

namespace App\Services;

use App\Mail\MessageToClient;
use App\Mail\OrderChanged;
use App\Models\Contact;
use App\Models\Email;
use App\Models\FileComment;
use App\Models\OrderNotification;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class OrderNotificationsService
{

    public function getAssignedEmailsLinksForTimeline($orderNotifications) {
        // define emails array to get ids for the search for links for emails assigned to the order
        $emailsArray = []; //??

        //timeline links part
        // find emails with type email_received from orderNotifications for this single order to proivide links in the timeline

        foreach ($orderNotifications as $notification)
            if ($notification->type === 'email_received') {
                //push the emails id to the array if the orderNotification has type emailreceived; 
                array_push($emailsArray, Email::where('id', $notification->subjectId)->get()[0]->id);
            }
        // strip it from the keys and leave only values like: [10,2,7]
        $emailsAssignedIds = array_values($emailsArray);

        // find the relevant emails 
        $emailsAssigned = Email::findMany($emailsAssignedIds);

        return $emailsAssigned;
    }


    public function createNotification(string $type, string $content, int $subjectId, int $orderId)
    {
        Log::info('I am in OrderNotificationService and about to create a new notification!');
        //Add this event to OrderNotification table;
        $notification = new OrderNotification(); 
        $notification->type = $type;
        $notification->content = $content;
        $notification->subjectId = $subjectId;
        $notification->order_id = $orderId;
        $notification->save();
        Log::info('BELOW IS the notification from ORderNotigicationService->createNotification');
        Log::debug($notification);
        return $notification;
    }

    public function sendEmailNotificationToClient ($singleOrder) {

        //Notification to the client TO REFACTOR
        //dane potrzebne do wstrzykniecia do zmiennych do emaila do klienta
        // wysłanie wiadomosci email do klienta:: attempt to read property on null; TODO fix it
        $recipients = []; 
        $contact = Contact::where('id', $singleOrder->contact_person)->get('email', 'name', 'surname');
        $users = User::whereIn('id', [$singleOrder->lead_person, $singleOrder->involved_person])->get();
        // $lead_person_name = '';
        // $involved_person_name = '';
        // $userx = User::whereIn('id', [$singleOrder->lead_person, $singleOrder->involved_person])->get('email', 'name');
        array_push($recipients, $contact[0]['email']);
        array_push($recipients, env('ADMIN_EMAIL'));
        if (count($users) > 1) {
            foreach ($users as $user) {
                array_push($recipients, $user['email']);
                if ($user->id == $singleOrder->lead_person) {
                    Log::info('Lead person name');

                    $lead_person_name = $user->name;
                    Log::debug($lead_person_name);
                } elseif ($user->id == $singleOrder->involved_person) {
                    Log::info('Involved person name');

                    $involved_person_name = $user->name;
                    Log::debug($involved_person_name);
                };
            }
        } elseif (count($users) == 1) {
            array_push($recipients, $users[0]['email']);
            $lead_person_name = $users[0]->name;
            $involved_person_name = $users[0]->name;
        } 

        //zmienne do email template przekazujemy je w obiekcie OrderChanged
        Mail::to($recipients)->send(new OrderChanged($singleOrder, $lead_person_name, $involved_person_name));
        // }

    }

    



}