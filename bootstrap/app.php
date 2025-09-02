<?php

use App\Http\Middleware\AdminMiddlware;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append([
            SetLocale::class,
        ]);

        $middleware->alias([
            'admin' => AdminMiddlware::class,
        ]); 

        // Redirect unauthenticated users automatically to login page
        $middleware->redirectGuestsTo('/login');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle session expiry / unauthenticated exceptions gracefully
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->expectsJson()) {
                // If it's an API request, return JSON
                return response()->json([
                    'message' => 'انتهت جلستك، الرجاء إعادة تسجيل الدخول.'
                ], 401);
            }

            // Otherwise redirect to login with a friendly flash message
            return redirect('/login')
                ->with('warning', 'انتهت جلستك، الرجاء إعادة تسجيل الدخول.');
        });
    })
    ->create();
