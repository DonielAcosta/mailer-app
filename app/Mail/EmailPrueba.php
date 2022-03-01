<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Email;


class EmailPrueba extends Mailable
{
    use Queueable, SerializesModels;

    
    public $mailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Email $mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->from('email') // correo usado para remitente
             ->subject('Asunto')
             ->body('Mensaje a enviar' );
       
    }
}
