<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client; // make sure to import the Twilio client

class SmsTwilioController extends Controller
{
    public function sendSms($contactphone , $title, $message)
    {
        // $receiverNumber = '+584165800403'; // Replace with the recipient's phone number
        // $message = 'hi testing'; // Replace with your desired message
        $contactphone = substr($contactphone, 1);
        if(strlen($contactphone) == 10){
            
            $receiverNumber = '+58'.$contactphone;

            $sid = env('TWILIO_SID');
            $token = env('TWILIO_AUTH_TOKEN');
            $fromNumber = env('TWILIO_NUMBER');

            try {
                $client = new Client($sid, $token);
                $client->messages->create($receiverNumber, [
                    'from' => $fromNumber,
                    'body' => $title. ' '. $message
                ]);

                return 'SMS Sent Successfully.';
            } catch (Exception $e) {
                return 'Error: ' . $e->getMessage();
            }
        }
        
    }
}