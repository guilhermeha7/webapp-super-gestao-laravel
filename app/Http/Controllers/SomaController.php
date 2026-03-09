<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SomaController extends Controller
{
    public function soma(int $n1, int $n2)
    {
        $soma = $n1 + $n2;
        return view('public.soma', ['n1' => $n1, 'n2' => $n2, 'soma' => $soma]); //Passando os valores para a view/tela de soma como um array associativo (chave => valor)
    }
}
