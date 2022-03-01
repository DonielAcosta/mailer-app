<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\EmailForQueuing;
use App\Models\Email;
use App\Models\User;
use Mail;
use Swift_SmtpTransport;
use Swift_Message;
use Swift_Mailer;

class SendEmail implements ShouldQueue{

  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public $mailData;
  public $subject;
  public $body;

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
    * Método de cola como enviar correo electrónico
   *
   * @return void
   */
  public function handle(){


    $transport = (new Swift_SmtpTransport(
                env('MAIL_HOST', 'smtp.mailgun.org'),
                env('MAIL_PORT', 465), 
                env('MAIL_ENCRYPTION', 'ssl'))
              )->setUsername(env('MAIL_USERNAME'))
               ->setPassword( env('MAIL_PASSWORD'));


    $mailer = new Swift_Mailer($transport);

    $message = (new Swift_Message($this->mailData->subject))
            ->setTo($this->mailData->email)
            ->setFrom(['donielacosta1995@gmail.com' => 'Doniel'])
            ->setBody($this->mailData->body);

    $result = $mailer->send($message);   

    $this->mailData->status = 'Enviado';
    $this->mailData->save();
      
  }
}