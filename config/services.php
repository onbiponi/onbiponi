<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
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

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    'google' => [
        'client_id' => '69985241475-hhq9keqnnqe6eq986r1ulb0gsbtv18d6.apps.googleusercontent.com',
        'client_secret' => 'DX44Vl_4s3VgxgLPIcArSF-s',
        'redirect' => 'https://onbiponi.com/login/google/callback',
    ],
    'facebook' => [
        'client_id' => '2588391271421526',
        'client_secret' => '9cd4313bf3c00ba9ab76cd275b797483',
        'redirect' => 'https://onbiponi.com/login/facebook/callback',
    ],

];
