<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Pedido;
use App\Models\PedidoProduto;

class PedidoProdutoController extends Controller
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
    public function create($pedido_id)
    {
        $pedido = Pedido::find($pedido_id);
        $produtos = Produto::all();
        return view('private.pedido-produto.create', ['pedido' => $pedido, 'produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $pedido_id)
    {
        $regras = [
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ];

        $mensagens = [
            'produto_id.required' => 'O campo produto é obrigatório.',
            'produto_id.exists' => 'O produto selecionado é inválido.',
            'quantidade.required' => 'O campo quantidade é obrigatório.',
            'quantidade.integer' => 'O campo quantidade deve ser um número inteiro.',
            'quantidade.min' => 'O campo quantidade deve ser um número positivo.',
        ];

        $request->validate($regras, $mensagens);

        PedidoProduto::create([
            'pedido_id' => $pedido_id,
            'produto_id' => $request->input('produto_id'),
            'quantidade' => $request->input('quantidade'),
        ]);

        return redirect()->route('pedidos-produtos.create', ['pedido_id' => $pedido_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, int $pedido_id)
    {
        PedidoProduto::where('id', $id)->where('pedido_id', $pedido_id)->delete();

        return redirect()->route('pedidos-produtos.create', ['pedido_id' => $pedido_id]);
    }
}
