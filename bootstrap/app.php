<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\App;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
->withMiddleware(function (Middleware $middleware): void {
    $middleware->append(\App\Http\Middleware\DownForMaintenaceWM::class);
    $middleware->append(\App\Http\Middleware\CheckMustChangePassword::class);
    $middleware->alias([
        'maintenace' => \App\Http\Middleware\DownForMaintenaceWM::class,
        'access.control' => \App\Http\Middleware\AccessControlMiddleware::class,
        'promotion' => \App\Http\Middleware\PromotionMiddleware::class,
    ]);
})
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
