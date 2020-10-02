<?php

// Creando nuestros propios archivos de configuracion

return [
    'cookie' => [
        'name' => env('CART_COOKIE_NAME', 'cart_cookie'),
        'time_expiration' => 7 * 24 * 60, // Una Semmana
    ],
];
