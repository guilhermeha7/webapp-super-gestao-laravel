<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutoController;
use App\Http\Middleware\AutenticacaoMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoDetalheController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoProdutoController;

//Route::método($caminho, '$Controller@ação'); Quando o caminho for acessado, a ação do Controller será executada

//Página que não exigem autenticação
Route::get('/', [PrincipalController::class, 'index'])->name('principal');
Route::get('/sobre-nos', [SobreNosController::class, 'index'])->name('sobre-nos');
Route::get('/contato', [ContatoController::class, 'index'])->name('contato');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'autenticar'])->name('login');
Route::post('/contato', [ContatoController::class, 'sendForm'])->name('contato'); //É possivél ter a mesma rota para diferentes métodos HTTP. Neste caso, esta rota existe para receber requisições do tipo POST enviadas pelo formulário de contato

//Páginas que exigem autenticação
Route::middleware(AutenticacaoMiddleware::class . ':padrao')->prefix('/private')->group(function () { //:padrao é um valor que será passado para o middleware. Neste caso, o valor 'padrao' será recebido pelo parâmetro $metodo_autenticacao do método handle do middleware AutenticacaoMiddleware
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');
    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos');

    Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('fornecedores');
    Route::get('/fornecedores/adicionar', [FornecedorController::class, 'adicionar'])->name('fornecedores.adicionar');
    Route::post('/fornecedores/adicionar', [FornecedorController::class, 'adicionar'])->name('fornecedores.adicionar');
    Route::get('/fornecedores/editar/{id}', [FornecedorController::class, 'editar'])->name('fornecedores.editar');
    Route::post('/fornecedores/editar/{id}', [FornecedorController::class, 'editar'])->name('fornecedores.editar');
    //Route::get('/fornecedores/excluir/{id}', [FornecedorController::class, 'excluir'])->name('fornecedores.excluir');
    Route::get('/fornecedores/consultar', [FornecedorController::class, 'consultar'])->name('fornecedores.consultar');
    Route::get('/fornecedores/consulta-personalizada', [FornecedorController::class, 'consultaPersonalizada'])->name('fornecedores.consulta-personalizada');
    Route::delete('/fornecedores/excluir/{id}', [FornecedorController::class, 'excluir'])->name('fornecedores.excluir');

    Route::resource('produtos', ProdutoController::class); //Cria automaticamente as rotas para as ações do CRUD (index, create, store, show, edit, update, destroy) do ProdutoController
    Route::resource('produto-detalhes', ProdutoDetalheController::class); //Cria automaticamente as rotas para as ações do CRUD (index, create, store, show, edit, update, destroy) do ProdutoDetalheController
    Route::resource('clientes', ClienteController::class); //Cria automaticamente as rotas para as ações do CRUD (index, create, store, show, edit, update, destroy) do ClienteController
    Route::resource('pedidos', PedidoController::class);
    
    Route::get('/pedidos-produtos/create/{pedido_id}', [PedidoProdutoController::class, 'create'])->name('pedidos-produtos.create');
    Route::post('/pedidos-produtos/store/{pedido_id}', [PedidoProdutoController::class, 'store'])->name('pedidos-produtos.store');
    Route::delete('/pedidos-produtos/destroy/{id}/{pedido_id}', [PedidoProdutoController::class, 'destroy'])->name('pedidos-produtos.destroy');
    });

//Aula: Redirecionamento de rotas
Route::get('/rota1', function () {
    echo 'Rota 1';
});
Route::get('/rota2', function () {
    echo 'Rota 2';
});
Route::redirect('/rota1', '/rota2'); //Ao acessar a rota1, o usuário será redirecionado para a rota2


//Aula: Rota de fallback
Route::fallback(function () { //Ao acessar uma rota inexistente, o usuário verá a mensagem abaixo
    echo 'A rota acessada não existe. <a href="/">Clique aqui</a> para ir para a página inicial.';
});


//Aula: Enviando valores pela URL
//{mensagem?}: o ? indica que o parâmetro é opcional
Route::get('/contato/{nome}/{categoria}/{categoria_id}/{mensagem?}', function (string $nome, string $categoria, int $categoria_id, string $mensagem = 'Valor padrão para mensagem') {
    echo "O nome é: {$nome}.<br>";
    echo "A categoria é: {$categoria}.<br>";
    echo "A categoria id é: {$categoria_id}.<br>";
    echo "A mensagem é: {$mensagem}.<br>";
})->where('categoria_id', '[0-9]+'); //categoria_id deve ser um número (com pelo menos um dígito), caso contrário, a rota não será encontrada (será retornado 404 not found)


//Aula: Encaminhando parâmetros da rota para o controlador
Route::get('/soma/{n1}/{n2}', [\App\Http\Controllers\SomaController::class, 'soma'])->where('n1', '[0-9]+')->where('n2', '[0-9]+');
