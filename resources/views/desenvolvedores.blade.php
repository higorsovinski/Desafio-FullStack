<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Desenvolvedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body, html {
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            padding: 0;
        }

        h1 {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1>CRUD de Desenvolvedores
        <button class="btn btn-secondary" onclick="location.href='/'">Voltar</button>
    </h1>
    <hr/>
    <form id="form-novo-desenvolvedor">
        <input type="hidden" id="desenvolvedor_id" name="desenvolvedor_id">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome">
            </div>
            <div class="col-md-6">
                <label for="sexo" class="form-label">Sexo:</label>
                <select class="form-select" id="sexo" name="sexo">
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="datanascimento" class="form-label">Data de Nascimento:</label>
                <input type="date" class="form-control" id="datanascimento" name="datanascimento">
            </div>
            <div class="col-md-6">
                <label for="hobby" class="form-label">Hobby:</label>
                <input type="text" class="form-control" id="hobby" name="hobby">
            </div>
            <div class="col-md-6">
                <label for="nivel_id" class="form-label">Nível:</label>
                <select class="form-select" id="nivel_id" name="nivel_id">
                </select>
            </div>
        </div>
        <div class="mt-3 d-flex align-items-center">
            <button type="submit" id="submit-btn" class="btn btn-primary me-2">Adicionar</button>
            <button type="button" id="alterar-btn" class="btn btn-success d-none">Alterar</button>
            <button type="button" id="cancel-btn" class="btn btn-secondary d-none ms-2">Cancelar</button>
        </div>
    </form>

    <div id="alert" class="alert" style="display: none; margin-top: 20px"></div>

    <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loadingModalLabel">Aguarde</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Aguarde</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Sexo</th>
            <th scope="col">Data de Nascimento</th>
            <th scope="col">Hobby</th>
            <th scope="col">Nível</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody id="lista-desenvolvedores">
        </tbody>
    </table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('js/desenvolvedores.js') }}"></script>
</body>
</html>