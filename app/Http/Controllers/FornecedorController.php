<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::all();
        $fornecedores = Fornecedor::paginate(10); //paginate($quantidade_por_página) é um método do Eloquent que retorna os resultados paginados. Ele recebe como parâmetro a quantidade de registros que devem ser exibidos por página.
        return view('private.fornecedor.index', compact('fornecedores'));
    }

    public function adicionar(Request $request)
    {
        //Criação de fornecedor
        if ($request->isMethod('post')) {

            $regras = [
                'nome' => 'required|max:100',
                'site' => 'required|max:200',
                'uf' => 'required|size:2',
                'email' => 'required|email|max:100'
            ];

            $mensagens = [
                'required' => 'O campo :attribute é obrigatório',
                'nome.max' => 'O campo nome deve ter no máximo 100 caracteres',
                'email.email' => 'O campo email deve ser um endereço de email válido',
                'email.max' => 'O campo email deve ter no máximo 100 caracteres',
                'site.max' => 'O campo site deve ter no máximo 200 caracteres',
                'uf.size' => 'O campo uf deve ter 2 caracteres',
            ];

            $request->validate($regras, $mensagens);

            Fornecedor::create($request->all());

            return redirect()->route('fornecedores')->with('mensagem', 'Fornecedor cadastrado com sucesso!');
        }

        //Exibição do formulário
        return view('private.fornecedor.adicionar');
    }

    public function consultar()
    {
        return view('private.fornecedor.consultar');
    }

    public function consultaPersonalizada(Request $request)
    {
        $fornecedores = Fornecedor::where('nome', 'like', "%{$request->nome}%")
            ->where('email', 'like', "%{$request->email}%")
            ->where('uf', 'like', "%{$request->uf}%")
            ->where('site', 'like', "%{$request->site}%")
            ->paginate(10); //paginate($quantidade_por_página) é um método do Eloquent que retorna os resultados paginados. Ele recebe como parâmetro a quantidade de registros que devem ser exibidos por página.

        return view('private.fornecedor.index', ['fornecedores' => $fornecedores, 'request' => $request->all()]); //request->all() retorna um array com todos os dados da requisição, incluindo os parâmetros de consulta. Esses dados serão usados para preencher os campos do formulário de consulta personalizada com os valores que o usuário digitou, facilitando a navegação entre as páginas de resultados sem perder os filtros aplicados.
    }

    public function editar($id, Request $request)
    {
        if ($request->isMethod('post')) {
            $regras = [
                'nome' => 'required|max:100',
                'site' => 'required|max:200',
                'uf' => 'required|size:2',
                'email' => 'required|email|max:100'
            ];

            $mensagens = [
                'required' => 'O campo :attribute é obrigatório',
                'nome.max' => 'O campo nome deve ter no máximo 100 caracteres',
                'email.email' => 'O campo email deve ser um endereço de email válido',
                'email.max' => 'O campo email deve ter no máximo 100 caracteres',
                'site.max' => 'O campo site deve ter no máximo 200 caracteres',
                'uf.size' => 'O campo uf deve ter 2 caracteres',
            ];

            $request->validate($regras, $mensagens);

            $fornecedor = Fornecedor::find($id);
            try {
                $fornecedor->update($request->all());
            } catch (\Exception $e) {
                return redirect()->route('fornecedores')->with('mensagem', 'Ocorreu um erro ao atualizar o fornecedor: ' . $e->getMessage());
            }

            return redirect()->route('fornecedores')->with('mensagem', 'Fornecedor atualizado com sucesso!');
        }

        $fornecedor = Fornecedor::find($id);
        if ($fornecedor === null) {
            return redirect()->route('fornecedores')->with('mensagem', 'Fornecedor não encontrado');
        }
        return view('private.fornecedor.editar', compact('fornecedor'));
    }

    public function excluir($id) {
        $fornecedor = Fornecedor::find($id);
        if ($fornecedor === null) {
            return redirect()->route('fornecedores')->with('mensagem', 'Fornecedor não encontrado');
        }

        try {
            $fornecedor->delete();
            return redirect()->route('fornecedores')->with('mensagem', 'Fornecedor excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('fornecedores')->with('mensagem', 'Ocorreu um erro ao excluir o fornecedor: ' . $e->getMessage());
        }
    }
}
