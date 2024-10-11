<?php

use App\Http\Middleware\AuthEcorrectionAdmin;
use App\Http\Middleware\AuthEcorrectionUploader;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\AuthenticateAdmin;
use App\Http\Middleware\AuthKamiPeduliUploader;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'user' =>  Authenticate::class,
            'admin' => AuthenticateAdmin::class,
            'ecorrectionAdmin' => AuthEcorrectionAdmin::class,
            'ecorrectionUploader' => AuthEcorrectionUploader::class,
            'kamiPeduliUploader' => AuthKamiPeduliUploader::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
