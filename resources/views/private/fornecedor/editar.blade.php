<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Fornecedores</title>
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
                <h3 class="card-title text-center">Edição de Fornecedor</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('fornecedores.editar', $fornecedor->id) }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $fornecedor->id }}">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" placeholder="Digite o nome"
                            value="{{ old('nome') ?? $fornecedor->nome }}"> <!--O campo nome vai receber o nome do fornecedor atual ou o nome que o usuário tinha escrito na requisição anterior-->
                        <div class='text-danger'>{{ $errors->has('nome') ? $errors->first('nome') : '' }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email" placeholder="Digite o e-mail"
                            value="{{ old('email') ?? $fornecedor->email }}">
                        <div class='text-danger'>{{ $errors->has('email') ? $errors->first('email') : '' }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="uf" class="form-label">UF</label>
                        <select class="form-select" name="uf" value="{{ old('uf') ?? $fornecedor->uf }}">
                            <option value="">Selecione o estado</option>
                            <option value="AC" {{ $fornecedor->uf == 'AC' ? 'selected' : '' }}>Acre</option>
                            <option value="AL" {{ $fornecedor->uf == 'AL' ? 'selected' : '' }}>Alagoas</option>
                            <option value="AP" {{ $fornecedor->uf == 'AP' ? 'selected' : '' }}>Amapá</option>
                            <option value="AM" {{ $fornecedor->uf == 'AM' ? 'selected' : '' }}>Amazonas</option>
                            <option value="BA" {{ $fornecedor->uf == 'BA' ? 'selected' : '' }}>Bahia</option>
                            <option value="CE" {{ $fornecedor->uf == 'CE' ? 'selected' : '' }}>Ceará</option>
                            <option value="DF" {{ $fornecedor->uf == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                            <option value="ES" {{ $fornecedor->uf == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                            <option value="GO" {{ $fornecedor->uf == 'GO' ? 'selected' : '' }}>Goiás</option>
                            <option value="MA" {{ $fornecedor->uf == 'MA' ? 'selected' : '' }}>Maranhão</option>
                            <option value="MT" {{ $fornecedor->uf == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                            <option value="MS" {{ $fornecedor->uf == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                            <option value="MG" {{ $fornecedor->uf == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                            <option value="PA" {{ $fornecedor->uf == 'PA' ? 'selected' : '' }}>Pará</option>
                            <option value="PB" {{ $fornecedor->uf == 'PB' ? 'selected' : '' }}>Paraíba</option>
                            <option value="PR" {{ $fornecedor->uf == 'PR' ? 'selected' : '' }}>Paraná</option>
                            <option value="PE" {{ $fornecedor->uf == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                            <option value="PI" {{ $fornecedor->uf == 'PI' ? 'selected' : '' }}>Piauí</option>
                            <option value="RJ" {{ $fornecedor->uf == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                            <option value="RN" {{ $fornecedor->uf == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                            <option value="RS" {{ $fornecedor->uf == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                            <option value="RO" {{ $fornecedor->uf == 'RO' ? 'selected' : '' }}>Rondônia</option>
                            <option value="RR" {{ $fornecedor->uf == 'RR' ? 'selected' : '' }}>Roraima</option>
                            <option value="SC" {{ $fornecedor->uf == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                            <option value="SP" {{ $fornecedor->uf == 'SP' ? 'selected' : '' }}>São Paulo</option>
                            <option value="SE" {{ $fornecedor->uf == 'SE' ? 'selected' : '' }}>Sergipe</option>
                            <option value="TO" {{ $fornecedor->uf == 'TO' ? 'selected' : '' }}>Tocantins</option>
                        </select>
                        <div class='text-danger'>{{ $errors->has('uf') ? $errors->first('uf') : '' }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="site" class="form-label">Site</label>
                        <input class="form-control" name="site" placeholder="Digite o site do fornecedor"
                            value="{{ old('site') ?? $fornecedor->site }}">
                        <div class='text-danger'>{{ $errors->has('site') ? $errors->first('site') : '' }}</div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Atualizar</button>
                </form>
            </div>
        </div>
    </div>

</html>
