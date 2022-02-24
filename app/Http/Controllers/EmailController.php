<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Swift_SmtpTransport;
use Swift_Message;
use Swift_Mailer;
use Mail;

class EmailController extends Controller{

    public function mail(){

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

    public function basic_email() {
        $data = array('name'=>"Virat Gandhi");

        Mail::send(['text'=>'mail'], $data, function($message) {
           $message->to('abc@gmail.com', 'Tutorials Point')->subject
              ('Laravel Basic Testing Mail');
           $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "Basic Email Sent. Check your inbox.";
     }
     public function html_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
           $message->to('abc@gmail.com', 'Tutorials Point')->subject
              ('Laravel HTML Testing Mail');
           $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "HTML Email Sent. Check your inbox.";
     }
     public function attachment_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
           $message->to('abc@gmail.com', 'Tutorials Point')->subject
              ('Laravel Testing Mail with Attachment');
           $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
           $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
           $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "Email Sent with attachment. Check your inbox.";
     }
}
