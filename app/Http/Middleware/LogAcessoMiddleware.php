<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\LogAcesso;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    //A função abaixo define o que o middleware deve a ação do middleware
    public function handle(Request $request, Closure $next): Response
    {
        //dd($request); //dd é uma função do Laravel que exibe o conteúdo de uma variável e interrompe a execução do código. Neste caso, ela exibe o conteúdo da variável $request, que contém informações sobre a requisição HTTP feita pelo cliente, como o método HTTP, a URL, os parâmetros, os cabeçalhos, etc.
        LogAcesso::create([
            'log' => "O IP {$request->ip()} requisitou a URL: {$request->url()}",
        ]);

        //$request - manipula a requisição antes de ser processada pelo controlador
        //$next - função que encaminha a requisição para o próximo middleware ou para o controlador
        $resposta = $next($request);
        //O código abaixo será executado após o controlador gerar a resposta. Manipula a resposta antes de ser enviada para o cliente
        $resposta->setStatusCode(201, 'O status code foi alterado pelo middleware LogAcessoMiddleware');
        
        return $resposta;
    }
}
