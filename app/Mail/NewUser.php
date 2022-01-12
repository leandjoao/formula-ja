<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUser extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
    * Create a new message instance.
    *
    * @return void
    */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
    * Build the message.
    *
    * @return $this
    */
    public function build()
    {
        return $this->view('mail.newUser')
        ->from(config('app.contact'), config('app.name'))
        ->replyTo(config('app.contact'), config('app.name'))
        ->subject("🎉 Boas vindas ao FormulaJá!")
        ->with([
            'name' => $this->data['name'],
            'password' => $this->data['password'],
            'email' => $this->data['email']
        ]);
    }
}
