<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Níveis</title>
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
    <h1>CRUD de Níveis
        <button class="btn btn-secondary" onclick="location.href='/'">Voltar</button>
    </h1>
    <hr/>
    <form id="form-novo-nivel">
        <input type="hidden" id="nivel_id" name="nivel_id">
        <label for="nivel" class="form-label">Novo Nível:</label>
        <input type="text" class="form-control" id="nivel" name="nivel">
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
            <th scope="col">ID</th>
            <th scope="col">Nível</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody id="lista-niveis">
        </tbody>
    </table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('js/niveis.js') }}"></script>
</body>
</html>
