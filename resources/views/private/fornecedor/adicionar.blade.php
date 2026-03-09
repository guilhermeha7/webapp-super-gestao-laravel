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
                <h3 class="card-title text-center">Cadastro de Fornecedor</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('fornecedores.adicionar') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" placeholder="Digite o nome" value="{{ old('nome') }}">
                        <div class='text-danger'>{{ $errors->has('nome') ? $errors->first('nome') : '' }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email" placeholder="Digite o e-mail" value="{{ old('email') }}">
                        <div class='text-danger'>{{ $errors->has('email') ? $errors->first('email') : '' }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="uf" class="form-label">UF</label>
                        <select class="form-select" name="uf">
                            <option value="">Selecione o estado</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                        <div class='text-danger'>{{ $errors->has('uf') ? $errors->first('uf') : '' }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="site" class="form-label">Site</label>
                        <input class="form-control" name="site" placeholder="Digite o site do fornecedor" value="{{ old('site') }}">
                        <div class='text-danger'>{{ $errors->has('site') ? $errors->first('site') : '' }}</div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Cadastrar Fornecedor</button>
                </form>
            </div>
        </div>
    </div>

</html>
