<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OTPController extends Controller
{


    public function addNUmber()
    {

        return view('addnumber');
    }

    public function sendCode()
    {

        $clientID = env('HUBTEL_CLIENT_ID');
        $clientSecret = env('HUBTEL_CLIENT_SECRET');

        $fields = [
            'senderId' => 'Turndale',
            'phoneNumber' => '0548535080',
            'countryCode' => 'GH'
        ];

        $json_data = json_encode($fields);

        $ch = curl_init();

        $credentials = base64_encode($clientID . ':' . $clientSecret);

        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER => [
                'Content-type: application/json',
                'Authorization:  Basic ' . $credentials,
            ],
            CURLOPT_URL => "https://api-otp.hubtel.com/otp/send",
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $json_data,
            CURLOPT_RETURNTRANSFER => true
        ]);



        $response = curl_exec($ch);

        if ($response === false) {
            dd('cURL Error: ' . curl_error($ch));  // Check if there was an error
        }

        $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpStatusCode != 200) {
            dd('Error: HTTP ' . $httpStatusCode . ' - ' . $response);
        }
        dd($response);

        curl_close($ch);
    }
}