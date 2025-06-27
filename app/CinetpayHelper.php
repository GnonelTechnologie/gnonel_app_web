<?php

namespace App;

use App\User;
use GuzzleHttp\Client;

class CinetpayHelper
{
    public static  function generatePaymentLink($transactionId, $amount, $description, $returnUrl, $cancelUrl, User $user)
    {
        $client = new Client();

        // Define fields to send
        $payload = [
            'apikey' => "12844209366552ddae22fd35.22978729",
            'site_id' => "197761",
            'transaction_id' => $transactionId,
            'amount' => $amount, // The amount must be a multiple of 5
            'currency' => 'XOF',
            'description' => $description,
            'notify_url' => "https://gnonel.com" . '/api/cp-payment-callback',
            'return_url' => "https://gnonel.com" . $returnUrl,
            'cancel_url' => "https://gnonel.com" . $cancelUrl,
            'channels' => 'ALL',
            'lang' => 'fr',

            // Client's information to activate payment via credit card
            'customer_id' => $user->id, // Client's Id
            'customer_name' => $user->name, // Client's lastname
            'customer_surname' => $user->prenom, // Client's firstname
            'customer_phone_number' => $user->telephone, // Client's phone
            'customer_email' => $user->email, // Client's email
            'customer_address' => 'Lomé', // Client's address
            'customer_city' => 'Lomé', // Client's city
            'customer_country' => 'TG', // Country code
            'customer_state' => '228', // State code
            'customer_zip_code' => '00000', // Client's zip code

        ];

        try {
            // Sending the request
            $response = $client->post('https://api-checkout.cinetpay.com/v2/payment', [
                'json' => $payload
            ]);

            // Handle the response
            $data = json_decode($response->getBody(), true);

            return response()->json($data);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public static function checkTransaction($transactionId)
    {
        $client = new Client();

        // Define fields to send
        $payload = [
            'apikey' => '12844209366552ddae22fd35.22978729',
            'site_id' => '197761',
            'transaction_id' => $transactionId,
        ];

        try {
            // Sending the request
            $response = $client->post('https://api-checkout.cinetpay.com/v2/payment/check', [
                'json' => $payload
            ]);

            // Handle the response
            $data = json_decode($response->getBody(), true);

            // If the payment was successful $data['code'] wil be '00'
            return response()->json($data);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public static function generateToken()
    {
        $client = new Client();

        // Define fields to send
        $payload = [
            'apikey' => env('CINETPAY_API_KEY'),
            'password' => env('CINETPAY_PASSWORD'),
        ];

        try {
            // Sending the request
            $response = $client->post('https://client.cinetpay.com/v1/auth/login?lang=fr', [
                'form_params' => $payload, // Using 'form_params' for x-www-form-urlencoded
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ]
            ]);

            // Handle the response
            $data = json_decode($response->getBody(), true);

            return $data;
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public static function getAccountBalance($token)
    {
        $client = new Client();

        // Define fields to send
        $payload = [
            'token' => $token,
            'lang' => "fr",
        ];

        try {
            // Sending the request
            $response = $client->get('https://client.cinetpay.com/v1/transfer/check/balance', [
                'query' => $payload
            ]);

            // Handle the response
            $data = json_decode($response->getBody(), true);

            return $data;
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public static function addContact(User $user, $token)
    {
        $client = new Client();

        // Define fields to send
        $contacts = [];
        $contacts[] = [
            'prefix' => "228",
            'phone' => $user->phone_number, // Client's phone without the country code
            'email' => $user->email,
            'surname' => $user->firstname,
            'name' => $user->lastname
        ];

        // Define fields to send in the query
        $payloadQuery = [
            'token' => $token,
            'lang' => "fr"
        ];

        $payload = [
            'data' => json_encode($contacts) // JSON data encoding
        ];

        try {
            // Sending the request
            $response = $client->post('https://client.cinetpay.com/v1/transfer/contact', [
                'query' => $payloadQuery,
                'form_params' => $payload,
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ]
            ]);

            // Handle the response
            $data = json_decode($response->getBody(), true);

            return $data;
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public static function sendMoney(User $user, $amount, $clientTransactionId)
    {
        $client = new Client();

        // Get Token
        $responseToken = CinetpayHelper::generateToken();
        if ($responseToken['code'] != 0) {
            return response()->json(['error' => 'Failed to generate token'], 500);
        }
        $token = $responseToken['data']['token'];

        // Get Account Balance
        $responseAccountBalance = CinetpayHelper::getAccountBalance($token);
        if ($responseAccountBalance['code'] != 0) {
            return response()->json(['error' => 'Failed to get account balance'], 500);
        } /*
        Activate later
        else if ($responseAccountBalance['data']['data']['available'] == 0) {
            return response()->json(['error' => 'Insufficient balance'], 500);
        }
            */

        // Add contact
        $responseAddContact = CinetpayHelper::addContact($user, $token);
        if ($responseAddContact['code'] != 0) {
            return response()->json(['error' => 'Failed to add contact'], 500);
        }


        // Define fields to send
        $contacts = [];
        $contacts[] = [
            'prefix' => "228",
            'phone' => $user->phone_number, // Client's phone without the country code
            'email' => $user->email,
            'surname' => $user->firstname,
            'name' => $user->lastname,
            'amount' => $amount,
            'client_transaction_id' => $clientTransactionId,
            'notify_url' => env('IP_URL') .  '/api/cp-transfer-callback',
        ];

        // Define fields to send in the query
        $payloadQuery = [
            'token' => $token,
            'lang' => "fr"
        ];

        $payload = [
            'data' => json_encode($contacts) // JSON data encoding
        ];

        try {
            // Sending the request
            $response = $client->post('https://client.cinetpay.com/v1/transfer/money/send/contact', [
                'query' => $payloadQuery,
                'form_params' => $payload,
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ]
            ]);

            // Handle the response
            $data = json_decode($response->getBody(), true);

            return $data;
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
