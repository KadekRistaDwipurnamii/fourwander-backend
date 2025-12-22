<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ContactMessageMail extends Mailable
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this
            ->subject('New Contact Message - FourWanders')
            ->view('emails.contact-message');
    }
}
