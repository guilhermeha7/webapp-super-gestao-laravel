<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <!-- Incluindo o Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }

        .card {
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-center">Cadastro de Produto</h3>
            </div>
            <div class="card-body">
                <form method="POST" action=" {{ route('produtos.store') }} ">
                    @csrf
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" placeholder="Digite o nome"
                            value="{{ old('nome') }}">
                        <div class='text-danger'>{{ $errors->has('nome') ? $errors->first('nome') : '' }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" name="descricao" placeholder="Digite a descrição"
                            value="{{ old('descricao') }}">
                        <div class='text-danger'>{{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="fornecedor" class="form-label">Fornecedor</label>
                        <select class="form-select" name="fornecedor_id">
                            <option value="">Selecione o fornecedor</option>
                            @foreach ($fornecedores as $fornecedor)
                                <option value="{{ $fornecedor->id }}"
                                    {{ old('fornecedor_id') == $fornecedor->id ? 'selected' : '' }}>
                                    {{ $fornecedor->nome }}
                                </option>
                            @endforeach
                        </select>
                        <div class='text-danger'>
                            {{ $errors->has('fornecedor_id') ? $errors->first('fornecedor_id') : '' }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="unidade" class="form-label">Unidade</label>
                        <select class="form-select" name="unidade_id">
                            <option value="">Selecione a unidade de medida</option>
                            @foreach ($unidades as $unidade)
                                <option value="{{ $unidade->id }}"
                                    {{ old('unidade_id') == $unidade->id ? 'selected' : '' }}>{{ $unidade->nome }}
                                </option>
                            @endforeach
                        </select>
                        <div class='text-danger'>
                            {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Cadastrar Produto</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
