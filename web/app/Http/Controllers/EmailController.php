<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class EmailController extends Controller
{
    public function sendWelcomeEmail( Request $request)
    {
        $toEmail ="reslanhassanlb@gmail.com";

        //$subject = 'No Subject';
         $subject = $request->input('subject');
         $emailfrom = $request->input('email');
          $name = $request->input('name');
        $msg = $request->input('message');

        //$response =  Mail::to($toEmail)->send(new WelcomeEmail($msg,$subject,$toEmail,$emailfrom,$name));
        try{
            Mail::to($toEmail)->send(new WelcomeEmail($msg,$subject,$emailfrom,$toEmail,$name));

            // ✅ success message
            return redirect()->back()->with('msg', [
                'type' => 'success',
                'text' => 'Email sent successfully!',
            ]);

        }catch(Exception $ex){

            return redirect()->back()->with('msg', [
            'type' => 'error',
            'text' => "We’ve got an error while sending the email!",
            ]);
        }

        return redirect()->back()->with('msg', $alert);
    }
}
