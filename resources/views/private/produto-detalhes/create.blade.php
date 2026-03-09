<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Detalhes do Produto</title>
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
                <h3 class="card-title text-center">Adicionar Detalhes do Produto</h3>
            </div>
            <div class="card-body">
                <form method="POST" action=" {{ route('produto-detalhes.store') }} ">
                    @csrf
                    <div class="mb-3">
                        <label for="produto_id" class="form-label">Produto ID</label>
                        <input type="number" class="form-control" name="produto_id" placeholder="Digite o ID do produto"
                            value="{{ old('produto_id') }}">
                        <div class='text-danger'>{{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="comprimento" class="form-label">Comprimento</label>
                        <input type="text" class="form-control" name="comprimento" placeholder="Digite o comprimento"
                            value="{{ old('comprimento') }}">
                        <div class='text-danger'>{{ $errors->has('comprimento') ? $errors->first('comprimento') : '' }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="largura" class="form-label">Largura</label>
                        <input type="text" class="form-control" name="largura" placeholder="Digite a largura"
                            value="{{ old('largura') }}">
                        <div class='text-danger'>{{ $errors->has('largura') ? $errors->first('largura') : '' }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="altura" class="form-label">Altura</label>
                        <input type="text" class="form-control" name="altura" placeholder="Digite a altura"
                            value="{{ old('altura') }}">
                        <div class='text-danger'>{{ $errors->has('altura') ? $errors->first('altura') : '' }}
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
                        <div class='text-danger'>{{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Cadastrar Produto</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
