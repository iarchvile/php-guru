<?php

return [
    'yandex' => [
        'client_id' => env('OAUTH_YANDEX_CLIENT_ID'),
        'client_secret' => env('OAUTH_YANDEX_PASSWORD'),
        'scope' => env('OAUTH_YANDEX_SCOPE'),
    ],
    'vk' => [
        'client_id' => env('OAUTH_VC_CLIENT_ID'),
        'client_secret' => env('OAUTH_VC_PASSWORD'),
        'scope' => env('OAUTH_VC_SCOPE'),
    ],
];
