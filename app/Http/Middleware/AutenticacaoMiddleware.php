<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $metodo_autenticacao): Response
    {
        session_start();

        if (isset($_SESSION['permissao']) && $_SESSION['permissao'] == true) {
            return $next($request); //Se o usuário tiver permissão, a requisição é encaminhada para o próximo middleware ou para o controlador
        } else {
            return redirect()->route('login')->with('mensagem_de_erro', 'Acesso negado. Faça login para acessar esta página.'); //Se o usuário não tiver permissão, ele é redirecionado para a página de login
        }
    }
}
