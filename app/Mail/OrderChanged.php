<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OrderChanged extends Mailable
{
    use Queueable, SerializesModels;


    public $singleOrder;
    public $involved_person_name;
    public $lead_person_name;
    // public $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($singleOrder, $involved_person_name, $lead_person_name)
    {

        $this->singleOrder = $singleOrder;
        $this->involved_person_name = $involved_person_name;
        $this->lead_person_name = $lead_person_name;
        // $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->singleOrder['title'])->view('emails.order-changed');
    }

    /**
     * Get the message envelope.
    //  *
    //  * @return \Illuminate\Mail\Mailables\Envelope
    //  */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Order Changed',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  *
    //  * @return \Illuminate\Mail\Mailables\Content
    //  */
    // public function content()
    // {
    //     return new Content(
    //         view: 'emails.orderChanged',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array
    //  */
    // public function attachments()
    // {
    //     return [];
    // }
}
