<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ShipmentUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $status;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($status, $user)
    {
        $this->status = $status;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Shipment Updated')
                    ->view('emails.shipment_updated')
                    ->with(['status' => $this->status, 'user' => $this->user]);
    }
}
