<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Fornecedores</title>
    <!-- Incluindo o Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Arial', sans-serif;
            padding-top: 50px;
        }
        .card {
            max-width: 600px;
            margin: auto;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #eee;
            padding: 1.5rem 2rem;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.75rem;
            font-size: 1rem;
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 0.75rem;
            font-size: 1rem;
            border-radius: 8px;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .input-group-text {
            border-radius: 8px;
        }
        .card-body {
            background-color: #ffffff;
            padding: 2rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            Consulta de Fornecedores
        </div>
        <div class="card-body">
            <form action="{{ route('fornecedores.consulta-personalizada') }}" method="GET">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nome" placeholder="Digite o nome do fornecedor">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input class="form-control" name="email" placeholder="Digite o e-mail do fornecedor">
                </div>
                <div class="mb-3">
                    <label for="uf" class="form-label">UF</label>
                    <select class="form-select" name="uf">
                        <option value="">Selecione o estado</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="SP">São Paulo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="site" class="form-label">Site</label>
                    <input class="form-control" name="site" placeholder="Digite o site do fornecedor">
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>
    </div>
</div>

<!-- Incluindo o JS do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>