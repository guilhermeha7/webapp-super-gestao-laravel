<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Fornecedor;

class PrincipalController extends Controller
{
    public function index()
    {
        return view('public.principal'); //subpasta_dentro_de_views.arquivo

        /*Criando um fornecedor no banco (com método save)
        $fornecedor = new \App\Models\Fornecedor;

        $fornecedor->nome = 'Mei Misaki';
        $fornecedor->uf = 'SP';
        $fornecedor->email = 'mei@gmail.com';

        $fornecedor->save(); //O método save serve tanto para criar um Fornecedor como para atualizar um existente
        echo $fornecedor->nome;
        */


        /* Mostrando todos os fornecedores do banco (método all)
        $fornecedores = Fornecedor::all(); //O Eloquent vai acessar a tabela associada ao modelo Fornecedor e vai retornar todos os registros dentro de uma collection
        
        foreach ($fornecedores as $fornecedor) {
            echo "$fornecedor->nome <br>";
        }
        */

        /* Usando o método find() para mostrar fornecedores específicos
        $fornecedores = Fornecedor::find([1, 3]); //find(primary key ou [primary keys]): retorna os elementos com as primary keys especificadas

        foreach ($fornecedores as $f) {
            echo "$f->uf<br>";
        }
        */

        /* Usando o método where para mostrar fornecedores específicos
        $fornecedores = Fornecedor::where('id', '<', 1)->get(); //where(nome_da_coluna, operador, valor): retorna todos os elementos cujo valor da coluna é igual ao valor especificado. É preciso usar get() para efetivamente fazer a consulta no banco com o where e retornar uma Collection, se não o where vai retornar um Builder, ou seja, uma consulta em andamento.

        foreach ($fornecedores as $f) {
            echo "$f->nome<br>";
        }
        */

        /* Usando o método whereIn para mostrar fornecedores específicos
        $fornecedores = Fornecedor::whereIn('id', [1, 2, 3])->get(); //whereIn(nome_da_coluna, vários valores): retorna todos os elementos cujo valor da coluna é igual a qualquer um dos valores especificados. whereNotIn faz o inverso.

        foreach ($fornecedores as $f) {
            echo "$f->nome<br>";
        }
        */

        /* Selecionando registros com whereBetween
        $fornecedores = Fornecedor::whereBetween('id', [2, 4])->get(); //whereBetween(nome_da_coluna, intervalo de valores): retorna todos os elementos cujo valor da coluna esteja dentro do intervalo especificado
        foreach ($fornecedores as $f) {
            echo "$f->nome<br>";
        }
        */

        /*Selecionando registros que atendem a várias condições (todas as condições devem ser cumpridas para o fornecedor aparecer)
        $fornecedores = Fornecedor::where('nome', '<>', 'Mei Misaki')->whereIn('id', [1, 3, 5])->whereBetween('created_at', ['2026-02-01 00:00:00', '2026-02-15 00:00:00'])->get();
        foreach ($fornecedores as $f) {
            echo "$f->nome<br>";
        }*/

        /*Selecionando registros que atendam somente uma condição dentre várias
        $fornecedores = Fornecedor::where('nome', 'Naomi')->orWhereIn('id', [1,2])->orWhereBetween('created_at', ['2026-02-01 00:00:00', '2026-02-15 00:00:00'])->get();
        foreach ($fornecedores as $f) {
            echo "$f->nome<br>";
        }*/

        /*Selecionando registros nulos ou não-nulos
        $fornecedores = Fornecedor::whereNotNull('site')->get(); //whereNotNull('nome_da_coluna'): Seleciona todos os registros que não tenham um valor nulo na coluna especificada
        foreach ($fornecedores as $f) {
            echo "$f->nome<br>";
        }*/

        /*Selecionando registros criados em uma determinada data
        $fornecedores = Fornecedor::whereDate('created_at','2026-02-14')->get();
        foreach ($fornecedores as $f) {
            echo "$f->nome<br>";
        }*/

        /*Selecionando registros que possuam o mesmo valor em duas colunas diferentes
        $fornecedores = Fornecedor::whereColumn('created_at','updated_at')->get();
        foreach ($fornecedores as $f) {
            echo "$f->nome<br>";
        }*/

        /*Ordenando registros de forma ascendente ou descendente
        $fornecedores = Fornecedor::orderBy('id', 'asc')->orderBy('nome', 'desc')->get(); //Ordena primeiro por id de forma ascendente e depois por nome de forma descendente
        foreach ($fornecedores as $f) {
            echo "$f->nome<br>";
        }*/

        /*Escolhendo uma coluna de uma tabela para pegar seus dados e transformar em uma coleção (com pluck)
        $emails_dos_fornecedores = Fornecedor::pluck('email','id'); //pluck('atributo', 'opcional: atributo que virará indice do array associativo')
        print_r($emails_dos_fornecedores);
        foreach ($emails_dos_fornecedores as $e) {
            echo "$e<br>";
        }*/

        /*Atualizando um registro no banco (fill e save)
        $fornecedor = Fornecedor::find(1);
        $fornecedor->nome = 'Aya Asagiri';
        $fornecedor->email = 'aya@gmail.com';
        //Para atualizar os campos com novos valores é possível também utilizar o método fill, onde se deve passar um array associativo como parâmetro. Mas exige a prop $fillable no model Fornecedor
        //$fornecedor->fill(['nome'=>'Fornecedor', 'email'=>'email@gmail.com']); 
        $fornecedor->save(); //O método save pode ser usado tanto para criar um novo fornecedor no banco como para atualizar um já existente
        */

        /*Atualizando um registro no banco (where e update)
        Fornecedor::where('nome', 'Fornecedor Teste')->update(['nome' => 'Aya Asagiri']);
        */
        
        /*Deletando um registro (delete e destroy)
        $fornecedores = Fornecedor::where('id','>=',5)->get(); //Pega todos os fornecedores com id maior ou igual a 5 na tabela
        if (!$fornecedores->isEmpty()) {
            foreach ($fornecedores as $f) {
                $f->delete();   
            }
        } else {
            echo "Não há registros na tabela fornecedores com id maior ou igual a 5";
        }*/
    }
}
