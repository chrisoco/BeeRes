<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsController extends Controller
{
    public static function sendSmsNotification($to, $message)
    {
        $basic  = new \Vonage\Client\Credentials\Basic(config('services.nexmo.key'), config('services.nexmo.secret'));
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("41765813596", config('services.nexmo.sms_from'), $message)
        );

        return $response->current()->getStatus();
    }
}
