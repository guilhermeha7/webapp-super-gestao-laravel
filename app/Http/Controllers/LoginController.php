<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('public.login');
    }

    public function autenticar(Request $request)
    {
        //Validação
        $regras = [
            'email' => 'required',
            'senha' => 'required'
        ];
        $mensagens = [
            'email.required' => 'O e-mail é obrigatório',
            'senha.required' => 'A senha é obrigatória'
        ];

        $request->validate($regras, $mensagens);


        //Tentativa de Login
        $email = $request->input('email');
        $senha = $request->input('senha');

        $usuario = User::where('email', $email)->where('password', $senha)->first(); //Retorna o usuário que tiver o e-mail e a senha informados. Se não encontrar nenhum usuário, retorna null

        if ($usuario <> null) { //Se o email e a senha forem encontrados, os dados do usuário serão armazenados na sessão
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;
            $_SESSION['permissao'] = true; //Valor que indica que o usuário tem permissão para acessar as páginas privadas. Este valor será verificado pelo middleware de autenticação

            header('Location: ' . route('home')); 
            exit();
        } else {
            return redirect()->route('login')->with('mensagem_de_erro', 'E-mail ou senha inválidos'); //O método with() passa dados diretamente para a view.
        }
    }

    public function logout()
    {
        session_destroy(); //Destrói a sessão, ou seja, remove todos os dados armazenados na sessão. Isso efetivamente "desloga" o usuário, pois os dados que indicam que ele está logado (como o nome, email e permissão) são removidos.
        //return redirect()->route('principal');
        header('Location: ' . route('principal')); 
        exit();
    }
}
