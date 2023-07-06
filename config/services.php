<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    
     'stripe' => [
     'secret' => env('STRIPE_SECRET'),
 ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '837946990402685',
        'client_secret' => 'ee12c25d899a6bae52f8a1f41bae11f6',
        'redirect' => env('APP_URL').'/auth/facebook/callback',
    ],

     'google' => [
        'client_id' => '36895600322-t5ioldebpkjdp88mr14g779kaikcu1hq.apps.googleusercontent.com',
        'client_secret' => 'oQhZgXJNOh7ZvJUr0nh4pDpI',
        'redirect' => env('APP_URL').'/auth/google/callback',
    ],

];
