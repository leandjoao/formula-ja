<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPartner extends Mailable
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
        return $this->view('mail.newPartner')
        ->from(config('app.contact'), config('app.name'))
        ->replyTo(config('app.contact'), config('app.name'))
        ->subject("🤝 Parceiro FormulaJá!")
        ->with([
            'name' => $this->data['name'],
            'partnerName' => $this->data['partnerName'],
            'address' => $this->data['address'],
        ]);
    }
}
