<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produtos ao Pedido</title>
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
    <div class="container d-flex flex-column align-items-center mb-4">
        <h4>Detalhes do Pedido</h4>
        <p>ID do Pedido: {{ $pedido->id }}</p>
        <p>Cliente: {{ $pedido->cliente->nome }}</p>
    </div>

     <div  class="container d-flex flex-column align-items-center text-center mb-4">
        <table border="1">
            <thead>
                <tr>
                    <th><h4>Produtos Adicionados ao Pedido</h4></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedido->produtos as $produto)
                    <tr>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->pivot->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form method="POST" action=" {{ route('pedidos-produtos.destroy', ['id' => $produto->pivot->id, 'pedido_id' => $pedido->id]) }} ">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>        
     </div>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-center">Adicionar Produtos ao Pedido</h3>
            </div>
            <div class="card-body">
                <form method="POST" action=" {{ route('pedidos-produtos.store', ['pedido_id' => $pedido->id]) }} ">
                    @csrf
                    <div class="mb-3">
                        <label for="produto_id" class="form-label">Produto</label>
                        <select class="form-select" name="produto_id">
                            <option value="">Selecione um produto</option>
                            @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}"
                                    {{ old('produto_id') == $produto->id ? 'selected' : '' }}>{{ $produto->nome }}
                                </option>
                            @endforeach
                        </select>
                        <div class='text-danger'>{{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" name="quantidade" value="{{ old('quantidade') }}">
                        <div class='text-danger'>{{ $errors->has('quantidade') ? $errors->first('quantidade') : '' }}</div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Adicionar Produtos</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
