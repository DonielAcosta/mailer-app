<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {


    public function basic_email() {

        $data = array('name'=>"Virat Gandhi");
        // dd($data);
        Mail::send(['text' => 'mail'], $data, function($message) {
           $message->to('anacontrera1911@gmail.com', 'Tutorials Point')->subject('Laravel Basic Testing Mail');
           $message->from('anacontrera1911@gmail.com','Laravel');
           
        //    $message->to('foo@example.com')->cc('bar@example.com');
        });
      }

//    public function basic_email() {
//       $data = array('name'=>"Virat Gandhi");
//    var_dump($data);
//       Mail::send(['text'=>'mail'], $data, function($message) {
//          $message->to('doniel@gmail.com', 'Tutorials Point')->subject
//             ('Laravel Basic Testing Mail');
//          $message->from('dubexy@gmail.com','Virat Gandhi');
//       });

    

    
//       echo "Basic Email Sent. Check your inbox.";
//    }
//    public function html_email() {
//       $data = array('name'=>"Virat Gandhi");
//       Mail::send('mail', $data, function($message) {
//          $message->to('doniel@gmail.com', 'Tutorials Point')->subject
//             ('Laravel HTML Testing Mail');
//          $message->from('dubexy@gmail.com','Virat Gandhi');
//       });
//       echo "HTML Email Sent. Check your inbox.";
//    }


//    public function attachment_email() {
//       $data = array('name'=>"Virat Gandhi");
//       Mail::send('mail', $data, function($message) {
//          $message->to('doniel@gmail.com', 'Tutorials Point')->subject
//             ('Laravel Testing Mail with Attachment');
//          $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
//          $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
//          $message->from('xyz@gmail.com','Virat Gandhi');
//       });
//       echo "Email Sent with attachment. Check your inbox.";
//    }
}

// use Mail;
// use App\User;
// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
 
// class UserController extends Controller
// {
//     /**
//      * Send an e-mail reminder to the user.
//      *
//      * @param  Request  $request
//      * @param  int  $id
//      * @return Response
//      */
    // public function sendEmailReminder(Request $request, $id)
    // {
    //     $user = User::findOrFail($id);
 
    //     Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
    //         $m->from('hello@app.com', 'Your Application');
 
    //         $m->to($user->email, $user->name)->subject('Your Reminder!');
    //     });
    // }


  

// }