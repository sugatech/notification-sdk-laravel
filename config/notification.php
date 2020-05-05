<?php

return [
    'api_url' => env('NOTIFICATION_API_URL'),
    'oauth' => [
        'url' => env('NOTIFICATION_OAUTH_URL', env('NOTIFICATION_API_URL').'/oauth/token'),
        'client_id' => env('NOTIFICATION_OAUTH_CLIENT_ID'),
        'client_secret' => env('NOTIFICATION_OAUTH_CLIENT_SECRET'),
    ],
    'channel_background' => env('NOTIFICATION_CHANNEL_BACKGROUND', false),
];
