<?php
return [
    'enabled' => env('DATA_ENCRYPTION', false),
    'key' => env('ENCRYPTION_KEY', 'your_secret_key'),
    'cipher' => 'aes-256-cbc',
];
