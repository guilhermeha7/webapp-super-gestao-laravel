<?php

use App\Http\Middleware\LogAcessoMiddleware;
use App\Models\LogAcesso;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    ) //Implementa middlewares para todas as rotas da aplicação
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(LogAcessoMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
