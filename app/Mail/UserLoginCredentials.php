<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserLoginCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $customer;
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->customer = $user->customer;
    }

    public function build()
    {
        return $this->subject('Login Credentials')
        ->view('emails.login_credentials')
        ->with(['user' => $this->user, 'customer' => $this->customer]);
    }

    
}
