<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\MotivoDeContato;

class ContatoController extends Controller
{
    public function index()
    {
        $motivos = MotivoDeContato::all();

        return view('public.contato', compact('motivos')); //compact() é uma função do PHP que cria um array associativo a partir de variáveis. Neste caso, ela cria um array com a chave 'motivos' e o valor da variável $motivos, que contém todos os motivos de contato disponíveis no banco de dados. Esse array é passado para a view 'site.contato', permitindo que a view acesse os motivos de contato para exibi-los no formulário
    }

    public function sendForm(Request $request) //Recebe os dados enviados pelo formulário de contato através do objeto Request
    {
        //VALIDAÇÃO NO SERVIDOR
        //$request->validate(regras, mensagens customizadas) é um método do Laravel que valida os dados enviados pelo formulário de acordo com as regras especificadas. Se a validação falhar, ele redireciona o usuário de volta para a página do formulário, disponibilizando os erros de validação (pela variável $errors) e os dados antigos preenchidos (pela função old());
        $request->validate([
            'nome' => 'required|max:100', //O campo 'nome' é obrigatório e deve ter no máximo 100 caracteres
            'email' => 'required|email|max:100|unique:contact_messages,email', //O campo 'email' é obrigatório, deve ser um email válido e ter no máximo 100 caracteres
            //'telefone' => 'nullable|max:20', //O campo 'telefone' é opcional (nullable) e deve ter no máximo 20 caracteres
            'telefone' => 'required|max:20', //O campo 'telefone' é obrigatório e deve ter no máximo 20 caracteres
            'motivo_id' => 'required', //O campo 'motivo_id' é obrigatório
            'mensagem' => 'required', //O campo 'mensagem' é obrigatório
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'nome.max' => 'O campo nome deve ter no máximo 100 caracteres.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.max' => 'O campo email deve ter no máximo 100 caracteres.',
            'email.unique' => 'Este email já foi utilizado para enviar uma mensagem.',
            'motivo_id.required' => 'É obrigatório preencher um motivo de contato.',
        ]);

        //ENVIO DOS DADOS
        //dd($request->all()); //dd() é uma função do Laravel que exibe o conteúdo de uma variável e interrompe a execução do script. Neste caso, ela exibe todos os dados enviados pelo formulário de contato

        /*Método de criação de registro 1 (rebuscado)
        $contactMessage = new ContactMessage();
        $contactMessage->nome = $request->input('nome'); //input() é um método do objeto Request que permite acessar os dados enviados pelo formulário. Neste caso, ele acessa o valor do campo de nome 'nome'
        $contactMessage->email = $request->input('email');
        $contactMessage->telefone = $request->input('telefone');
        $contactMessage->motivo_id = $request->input('motivo_id');
        $contactMessage->mensagem = $request->input('mensagem');

        $contactMessage->save(); //Cria o registro da mensagem no banco de dados
        */

        /* Método de criação de registro 2 (mais conciso, mas ainda mais longo que o abaixo)
        ContactMessage::create([ //O método create() é uma forma mais concisa de criar um registro no banco de dados. Ele recebe um array associativo onde as chaves são os nomes das colunas e os valores são os valores a serem inseridos. Para usar o método create(), é necessário que o modelo tenha a propriedade $fillable ou $guarded configurada para permitir a atribuição em massa dos campos.
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'telefone' => $request->input('telefone'),
            'motivo_id' => $request->input('motivo_id'),
            'mensagem' => $request->input('mensagem'),
        ]);*/

        ContactMessage::create($request->all()); //Outra forma de criar um registro no banco de dados usando o método create() e passando todos os dados do formulário. Para isso, é necessário que o modelo tenha a propriedade $fillable configurada para permitir a atribuição em massa dos campos
        return redirect()->route('contato')->with('success', 'Mensagem enviada com sucesso!'); //Redireciona o usuário de volta para a view contato, passando a variável de sessão 'success' com a mensagem de sucesso para ser exibida
    }
}
