<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Swift_SmtpTransport;
use Swift_Message;
use Swift_Mailer;
use Mail;
use App\Jobs\SendEmail;
use Validator;
use App\Models\Email;
use App\Models\User;


// use App\Http\Controllers\Mail\WelcomeEmail;

class EmailController extends Controller{

    public function mail(Request $request){


      $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
      ->setUsername('anacontreras1911@gmail.com')
      ->setPassword(12049948);

      // Create the Mailer using your created Transport
      $mailer = new Swift_Mailer($transport);

      // Create a message
      $message = (new Swift_Message('News Letter Subscription'))
      ->setFrom(['slina0697@gmail.com' => 'lina'])
      ->setTo(['donielacosta1995@gmail.com' => 'Doniel'])
      ->setBody(' mensaje prueba ')
      ;

      // Send the message
      $result = $mailer->send($message);

      
      
      return response()->json(
         [
            'listed' => True,
            'message' => 'su mensaje ha sido enviado  exitosamente'
         ],
         200
     );
   }
   public function create(Request $request){


      $validator = Validator::make($request->all(), [
         'users_id' => 'numeric|required ',
         'email' => 'required|string|email|max:255|unique:users',
         'subject' => 'string',
         'body' => 'string',
         'status' => 'string',
     ]);

     if ($validator->fails()) {
         return response()->json($validator->errors()->toJson(), 400);
     }


     $email = Email::create([
      'users_id' => $request->get('users_id'),
      'email' => $request->get('email'),
      'subject' => $request->get('subject'),
      'body' => $request->get('body'),
      'status' => $request->get('status'),

     ]);
     $email->save();
     return response()->json(
      [
          'listed' => True,
          'message' => 'Elemento obtenido exitosamente'
      ],
      200
  );

   }
   
}
