<?php

namespace App\Mail;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $notification;

    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    public function build()
    {
        return $this->subject($this->notification->subject)
                    ->markdown('emails.password.reset', [
                        'url' => $this->notification->toMail($this->notification->notifiable),
                    ]);
    }
}