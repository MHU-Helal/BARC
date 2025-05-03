<?php
return [

    'defaults' => [
        'supports_credentials' => true,
        'allowed_origins' => ['*'], // Update this with your allowed origins (e.g., ['http://localhost:3000'])
        'allowed_headers' => ['*'], // This allows all headers
        'allowed_methods' => ['*'], // This allows all methods
        'exposed_headers' => [],
        'max_age' => 0,
    ],

    'paths' => ['api/*'],  // This ensures CORS is applied only to API routes
];
    

?>