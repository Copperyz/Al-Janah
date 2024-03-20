<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShipmentCreated extends Mailable
{
    use Queueable, SerializesModels;

    // Define public properties here if you need to pass data to the view
    public $shipment;
    public $user;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Shipment Created')
                    ->view('emails.shipment_created')
                    ->with(['user' => $this->user]);
    }
}
