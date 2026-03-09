@extends('private.layouts.layout_base')

@section('titulo', 'Produtos')

@section('conteudo')
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Navbar -->
    @include('private.layouts.partials.navbar')

    <!-- Header -->
    @component('private.layouts.components.header', [
        'title' => 'Fornecedores',
    ])
    @endcomponent

    <!-- Mensagem de Sucesso ou Erro -->
    <div class="text-center">{{ session('mensagem') ?? '' }} </div>

    <!-- Botões de Ação -->
    <div class="container py-5">
        <a href="{{ route('fornecedores.adicionar') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus"></i> Add Fornecedor
        </a>
        <a href=" {{ route('fornecedores.consultar') }}" class="btn btn-primary" role="button">Consulta Avançada</a>
    </div>

    <!-- Tabela -->
    <div class="table-responsive">
        <table style="border-radius: 0.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.08);"
            class="table table-hover text-center table-responsive">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Site</th>
                    <th>UF</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fornecedores as $fornecedor)
                    <tr>
                        <td>{{ $fornecedor->nome }}</td>
                        <td>{{ $fornecedor->email }}</td>
                        <td>{{ $fornecedor->site }}</td>
                        <td>{{ $fornecedor->uf }}</td>
                        <td>
                            <!-- Passando o ID do fornecedor para abrir o modal de produtos -->
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#produtosModal"
                               onclick="showProdutos({{ $fornecedor->id }})">Produtos</a>
                        </td>
                        <td><a href="{{ route('fornecedores.editar', $fornecedor->id) }}">Editar</a></td>
                        <td>
                            <!-- Botão de Exclusão que abre o Modal -->
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                               onclick="setDeleteUrl('{{ route('fornecedores.excluir', $fornecedor->id) }}')">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div style="display: flex; justify-content: center; margin-top: 100px;">
        {{ isset($request) ? $fornecedores->appends($request)->links('pagination::bootstrap-4') : $fornecedores->links('pagination::bootstrap-4') }} <!-- Faz a paginação respeitar os parâmetros de busca, se existirem -->
    </div>
    <br>
    {{ $fornecedores->count() }} - Total de registros por página
    <br>
    {{ $fornecedores->total() }} - Total de registros da consulta
    <br>
    {{ $fornecedores->firstItem() }} - Número do primeiro registro da página
    <br>
    {{ $fornecedores->lastItem() }} - Número do último registro da página

    <!-- Modal de Confirmação -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Você tem certeza que deseja excluir este registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <!-- Formulário de Exclusão -->
                    <form id="deleteForm" action="#" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE') <!-- Especifica o método DELETE -->
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Produtos -->
    <div class="modal fade" id="produtosModal" tabindex="-1" aria-labelledby="produtosModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="produtosModalLabel">Produtos do Fornecedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                        <tbody id="produtosTableBody">
                            <!-- Os produtos serão carregados aqui via JavaScript -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

<!-- JS do Bootstrap (com dependências) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    // Função para configurar a URL no formulário de exclusão
    function setDeleteUrl(url) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = url; // Define a URL do formulário de exclusão
    }

    // Passar os produtos de todos os fornecedores para o JavaScript
    const fornecedoresProdutos = @json($fornecedores->mapWithKeys(function ($fornecedor) {
        return [$fornecedor->id => $fornecedor->produtos->map(function ($produto) {
            return [
                'nome' => $produto->nome,
                'descricao' => $produto->descricao
            ];
        })];
    }));

    // Função para mostrar produtos de um fornecedor
    function showProdutos(id) {
        // Limpar a tabela de produtos
        const tableBody = document.getElementById('produtosTableBody');
        tableBody.innerHTML = '';

        // Verificar se o fornecedor tem produtos e preenchê-los na tabela
        const produtos = fornecedoresProdutos[id];
        if (produtos) {
            produtos.forEach(produto => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${produto.nome}</td><td>${produto.descricao}</td>`;
                tableBody.appendChild(row);
            });
        } else {
            const row = document.createElement('tr');
            row.innerHTML = '<td colspan="2">Nenhum produto encontrado para este fornecedor.</td>';
            tableBody.appendChild(row);
        }
    }
</script>