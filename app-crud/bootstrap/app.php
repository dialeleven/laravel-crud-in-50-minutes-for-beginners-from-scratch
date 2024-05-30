<?php

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
        //
        $middleware->alias([
            // 'admin' => \App\Http\Middleware\IsAdmin::class,
            // 'check.admin.role' => \App\Http\Middleware\CheckAdminRole::class,
            
            'auth.adminsite.user' => \App\Http\Middleware\AuthAdminsiteUser::class,
            'auth.adminsite.admin' => \App\Http\Middleware\AuthAdminsiteAdmin::class,
            'auth.adminsite.superadmin' => \App\Http\Middleware\AuthAdminsiteSuperadmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
