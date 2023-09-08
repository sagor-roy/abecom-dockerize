<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/addToCompare',
        'sslcommerz/success',
        'sslcommerz/failed',
        'sslcommerz/cancel',
        'sslcommerz/ipn',
        'guest/sslcommerz/success',
        'guest/sslcommerz/failed',
        'guest/sslcommerz/cancel',
        'guest/sslcommerz/ipn',
    ];
}
