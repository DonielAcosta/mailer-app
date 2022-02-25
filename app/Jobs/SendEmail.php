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


class SendEmail implements ShouldQueue{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

     protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user){
        
        $this->User = $user;
    }

   /**
           * Método de cola como enviar correo electrónico
     *
     * @return void
     */
    public function handle(){
        Log::info('Entered Job Email handle method');

        $email =  Email::where(["id" => $this->Email["id"]]);
        
        $email = Email::find('id'); 
        $email->Email;
        $email->save();

        Log::info('Exited from Job  handle method');

        // $email = new EmailForQueuing();
        // Mail::to($this->details['email'])->send($email);
    }
}