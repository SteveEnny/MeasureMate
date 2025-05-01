<?php

return [
    'verify_provider' => env("VERIFY_PROVIDER", "identity_pass"),
    'route_prefix' => env("ROUTE_PREFIX", "lawyard_"),

    'live_env' => [
        "live",
        "production"
    ],

    'status' => [
        'failed' => false,
        'success' => true,
    ],

    'code' => [
        'success' => '200',
        'not_exist' => '02',
        'exists' => '03',
        'network_error' => '05',
        'failed' => '06',
        'not_found' => '404',
        'server_error' => '500',
        'not_allowed' => '403',
        'bad_request' => '400'
    ],

    "roles" => [
        "superadmin",
        "user",
        "lawyer",
        "firm"
    ],


    "identity_type" => [
        "bvn",
        "nin",
        "address",
        "id_card" => [
            "passport",
            "driving_licence",
            "voters_card"
        ]
    ],

    "identity_pass" => [
        "env" => env("IDENTITY_ENV"),
        "base_url" => env("IDENTITY_PASS_BASE_URL"),
        "api_key" => env("IDENTITY_PASS_API_KEY"),
        "app_id" => env("IDENTITY_PASS_APP_ID"),
    ],

];