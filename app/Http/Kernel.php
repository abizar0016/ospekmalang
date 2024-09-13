<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use App\Http\Middleware\CheckUserRole;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Middleware\RedirectIfAuthenticated;

class Kernel extends HttpKernel
{
    protected $middleware = [
        EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        VerifyCsrfToken::class,
        SubstituteBindings::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            SubstituteBindings::class,
        ],
    ];

    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => SubstituteBindings::class,
        'can' => Authorize::class,
        'guest' => RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'throttle' => ThrottleRequests::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'roleaccess' => CheckUserRole::class,   
    ];
}
