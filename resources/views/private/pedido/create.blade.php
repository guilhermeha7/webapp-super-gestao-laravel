<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pedidos</title>
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
                <h3 class="card-title text-center">Cadastro de Pedido</h3>
            </div>
            <div class="card-body">
                <form method="POST" action=" {{ route('pedidos.store') }} ">
                    @csrf
                    <div class="mb-3">
                        <label for="cliente_id" class="form-label">Cliente</label>
                        <select class="form-select" name="cliente_id">
                            <option value="">Selecione um cliente</option>
                            @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nome }}</option>
                            @endforeach
                        </select>
                        <div class='text-danger'>{{ $errors->has('cliente_id') ? $errors->first('cliente_id') : '' }}</div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Cadastrar Pedido</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>