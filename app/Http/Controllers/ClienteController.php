<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
        $clientes = Cliente::paginate(10);

        return view('private.cliente.index', ['clientes' => $clientes, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('private.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('mensagem', 'Cliente criado com sucesso!');
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
    public function destroy(string $id)
    {
        //
    }

    public function validate(Request $request) {
        $regras = [
            'nome' => 'required|min:2|max:100'
        ];

        $mensagens = [
            'required' => 'O campo :attribute é obrigatório.',
            'nome.min' => 'O campo nome deve conter no mínimo 2 caracteres.',
            'nome.max' => 'O campo nome deve conter no máximo 100 caracteres.'
        ];

        $request->validate($regras, $mensagens);
    }
}
