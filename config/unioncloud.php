<?php

return [

    /*
    |--------------------------------------------------------------------------
    | UnionCloud Service
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'unioncloud' => [
        'email' => env('UNIONCLOUD_EMAIL'),
        'password' => env('UNIONCLOUD_PASSWORD'),
        'app_id' => env('UNIONCLOUD_APP_ID'),
        'baseuri' => env('UNIONCLOUD_BASEURI'),
        'app_secret' => env('UNIONCLOUD_APP_SECRET')
    ]


];
