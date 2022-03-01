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
use Swift_Message;


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
        // Log::info('Entered Job Email handle method');

        // $email =  Email::where(["id" => $this->Email["id"]]);
        
        // $email = Email::find('id'); 
        // $email->Email;
        // $email->save();

        // Log::info('Exited from Job  handle method');

        // Mail::send($this->mailData->email, function($msj) use($subject){
        //     $msj->from("anacontreras1911@gmail.com","Ana");
        //     $msj->subject($this->subject);
        //      $msj->to();
        // });


        $message = (new Swift_Message('Laravel'))
                ->setFrom($this->mailData->email)
                ->setTo(['donielacosta1995@gmail.com' => 'Doniel'])
                ->setBody($this->mailData->body);
                // echo "Basic Email Sent. Check your inbox.";

        
        $this->mailData->status = 'Enviado';
        $this->mailData->save();
        Log::alert('Soy de la cola y envié un correo electrónico',['email' => $this->mailData->email]);
//  dd($message);
        // Mail::to($this->mailData->email)
        //             ->subject($this->subject)
        //             ->body($this->body)
        //             ->send();


    }
}