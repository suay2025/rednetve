<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Mail\TestMail;
use App\Models\Notificacion;
use Mail;
class SendMailController extends Controller
{
    public function sendMailWithAttachment($user, $title = '', $body = '')
    {
        // Laravel 8

        $data["email"] = $user->email;
        $data["from"] = 'ventas@panexpres.com';
        $data["title"] = "Techsolutionstuff";
        $data["body"] = "This is test mail with attachment";
 
        $files = [
            public_path('img/regalo.png'),
            public_path('img/test_pdf.pdf'),
        ];
  
        Mail::send('emails.test_mail', $data, function($message) use ($data, $files) {
            $message->to($data["email"])
                    ->from($data["from"])
                    ->subject($data["title"]);
 
            foreach ($files as $file){
                $message->attach($file);
            }            
        });

        // $mailData = [
        //     'title' => 'This is Test Mail',
        //     'files' => [
        //         public_path('img/regalo.png'),
        //         public_path('img/test_pdf.pdf'),
        //     ],
        // ];
           
        // Mail::to('to@gmail.com')->send(new TestMail($mailData));
 
    }


    public function sendMailNotificacion($user, Notificacion $notificacion)
    {
        // Laravel 8

        $data["email"] = $user->email;
        $data["title"] = $notificacion->title;
        $data["body"] = $notificacion->content;
 
        $files = [
            $notificacion->file_url,
        ];
  
        Mail::send('emails.test_mail', $data, function($message) use ($data, $files) {
            $message->to($data["email"])
                    ->subject($data["title"]);
 
            foreach ($files as $file){
                $message->attach($file);
            }            
        });

    }
}