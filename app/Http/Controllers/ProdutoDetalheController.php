<?php

namespace App\Http\Controllers;

use App\Models\ProdutoDetalhe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unidade;

class ProdutoDetalheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = Unidade::all();
        return view('private.produto-detalhes.create', ['unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validação antes de salvar
        $regras = [
            'produto_id' => 'exists:produtos,id',
            'comprimento' => 'required',
            'largura' => 'required',
            'altura' => 'required',
            'unidade_id' => 'exists:unidades,id',
        ];

        $mensagens = [
            'produto_id.exists' => 'O produto escolhido não existe.',
            'required' => 'O campo :attribute é obrigatório.',
            'unidade_id.exists' => 'A unidade escolhida não existe.',
            'unidade_id.required' => 'O campo unidade é obrigatório.',
        ];

        $request->validate($regras, $mensagens);

        //Cadastro
        ProdutoDetalhe::create($request->all());
        return redirect()->route('produtos.index')->with('mensagem', 'Detalhes do produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProdutoDetalhe $produtoDetalhe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProdutoDetalhe $produtoDetalhe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProdutoDetalhe $produtoDetalhe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProdutoDetalhe $produtoDetalhe)
    {
        //
    }
}
