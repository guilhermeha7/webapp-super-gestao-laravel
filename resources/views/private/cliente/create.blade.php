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
                <h3 class="card-title text-center">Cadastro de Cliente</h3>
            </div>
            <div class="card-body">
                <form method="POST" action=" {{ route('clientes.store') }} ">
                    @csrf
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" placeholder="Digite o nome"
                            value="{{ old('nome') }}">
                        <div class='text-danger'>{{ $errors->has('nome') ? $errors->first('nome') : '' }}</div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Cadastrar Cliente</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
