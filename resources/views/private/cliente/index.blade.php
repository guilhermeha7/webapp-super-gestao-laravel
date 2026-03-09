@extends('private.layouts.layout_base')

@section('titulo', 'Clientes')

@section('conteudo')
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Navbar -->
    @include('private.layouts.partials.navbar')

    <!-- Header -->
    @component('private.layouts.components.header', [
        'title' => 'Clientes',
    ])
    @endcomponent

    <!-- Mensagem de Sucesso ou Erro -->
    <div class="text-center">{{ session('mensagem') ?? '' }} </div>

    <!-- Botões de Ação -->
    <div class="container py-5">
        <a href="{{ route('clientes.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus"></i> Add Cliente
        </a>
        <a href="" class="btn btn-primary" role="button">Consulta Avançada</a>
    </div>

    <!-- Tabela -->
    <div class="table-responsive">
        <table style="border-radius: 0.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.08);"
            class="table table-hover text-center table-responsive">
            <thead>
                <tr>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nome }}</td>
                        <td><a href="{{ route('clientes.edit', ['cliente' => $cliente->id]) }}">Editar</a></td>
                        <td>
                            <!-- Botão de Exclusão que abre o Modal -->
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                onclick="setDeleteUrl('{{ route('clientes.destroy', $cliente->id) }}')">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div style="display: flex; justify-content: center; margin-top: 100px;">
        {{ isset($request) ? $clientes->appends($request)->links('pagination::bootstrap-4') : $clientes->links('pagination::bootstrap-4') }}
    </div>
    <br>
    {{ $clientes->count() }} - Total de registros por página
    <br>
    {{ $clientes->total() }} - Total de registros da consulta
    <br>
    {{ $clientes->firstItem() }} - Número do primeiro registro da página
    <br>
    {{ $clientes->lastItem() }} - Número do último registro da página

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
                    <form id="deleteForm" action="#" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE') <!-- Especifica o método DELETE -->
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
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
</script>
