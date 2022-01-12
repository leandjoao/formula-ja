<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewBudget extends Mailable
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
        return $this->view('mail.newBudget')
        ->from(config('app.contact'), config('app.name'))
        ->replyTo(config('app.contact'), config('app.name'))
        ->subject("📢 Novo pedido no FormulaJá!")
        ->with([
            'name' => $this->data['name'],
            'date' => $this->data['date'],
            'file' => $this->data['file']
        ]);
    }
}
