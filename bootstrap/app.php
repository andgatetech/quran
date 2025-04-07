<?php

use App\Http\Middleware\CheckSession;
use App\Http\Middleware\ClientAuthMiddleware;
use FontLib\Table\Type\name;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\Middleware\StartSession;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function(){
            // Route::prefix('client/quran')->name('quran')->group(base_path('routes/quran.php'));
            // Route::prefix('client/poetry')->name('poetry')->group(base_path('routes/poetry.php'));
            // Route::prefix('client/quiz')->name('quiz')->group(base_path('routes/quiz.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->authenticateSessions();
        // $middleware->append(ClientAuthMiddleware::class);
        $middleware->alias([
            'client' => ClientAuthMiddleware::class,
        ]);
        
        // $middleware->append(StartSession::class);
        // $middleware->append(CheckSession::class);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
