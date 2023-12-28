<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\UserConfirmationEmail;

class SendUserConfirmationEmail
{
    use InteractsWithQueue;

    public function __construct()
    {
        //
    }


    public function handle(UserRegistered $event): void
    {
        Mail::to($event->user->email)->send(new UserConfirmationEmail($event->user));
    }
}
