<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;
use Swift_SmtpTransport;
use Swift_Message;
use Swift_Mailer;
use Mail;
use App\Jobs\SendEmail;
use Validator;
use App\Models\Email;
use App\Models\User;
use App\Mail\EmailPrueba;
use DispatchesJobs;

class EmailController extends Controller{



    public function enviarEmail(Request $request) {

        $subject = "Asunto del correo";
         $for = "donielacosta1995@gmail.com";
        $sendE = Email::pluck('email');

        // dd($sendE);
        Mail::send($sendE, function($msj) use($subject,$sendE){
            $msj->from("anacontreras1911@gmail.com","Ana");
            $msj->subject($subject);
            $msj->to();
        });

        return response()->json(
            [
                'listed' => True,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }


    public function enviar(Request $request){


      $validator = Validator::make($request->all(), [
          
          'email' => 'required|string',
          'subject' => 'string',
          'body' => 'string',
          'status' => 'string',
      ]);

      if ($validator->fails()) {
          return response()->json($validator->errors()->toJson(), 400);
      }
      foreach(explode(',',$request->get('email')) as $mail) {
        $emails = Email::create([
          'users_id' => $request->get('users_id'),
          'email' => $mail,
          'subject' => $request->get('subject'),
          'body' => $request->get('body'),
          'status' => 'No enviado'
        ]);
        $emails->save();
        SendEmail::dispatch($emails);
      }
      return response()->json(
          [
              'listed' => True,
              'message' => 'Email sent Successfully'
          ],
          200
      );

    }

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
      ->setBody(' ing cristian')
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
