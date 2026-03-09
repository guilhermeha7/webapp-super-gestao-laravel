<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Fornecedor;
use App\Models\Unidade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::all();
        $produtos = Produto::paginate(4);
        return view('private.produto.index', ['produtos' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('private.produto.create', ['unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request);

        Produto::create($request->all());
        return redirect()->route('produtos.index')->with('mensagem', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('private.produto.edit', ['produto' => $produto, 'unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $this->validate($request);

        $produtoASerAtualizado = Produto::find($produto->id);
        $produtoASerAtualizado->update($request->all());
        return redirect()->route('produtos.index')->with('mensagem', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $produtoASerDeletado = Produto::find($produto->id);
        $produtoASerDeletado->delete();
        return redirect()->route('produtos.index')->with('mensagem', 'Produto excluído com sucesso!');
    }

    public function validate(Request $request) {
        $regras = [
            'nome' => 'required|max:100',
            'descricao' => 'required|max:2000',
            'unidade_id' => 'required|exists:unidades,id', //exists:<tabela>,<coluna> verifica se o valor existe na tabela e coluna especificada
            'fornecedor_id' => 'required|exists:fornecedores,id'
        ];

        $mensagens = [
            'required' => 'O campo :attribute é obrigatório',
            'unidade_id.required' => 'O campo unidade é obrigatório',
            'fornecedor_id.required' => 'O campo fornecedor é obrigatório',
            'nome.max' => 'O campo nome deve ter no máximo 100 caracteres',
            'descricao.max' => 'O campo descrição deve ter no máximo 2000 caracteres',
            'unidade_id.exists' => 'A unidade selecionada não existe',
            'fornecedor_id.exists' => 'O fornecedor selecionado não existe'
        ];

        $request->validate($regras, $mensagens);
    }
}