<?php

namespace App\Services;

use App\Mail\MessageToClient;
use App\Models\Email;
use App\Models\FileComment;
use App\Models\OrderNotification;
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


    



}