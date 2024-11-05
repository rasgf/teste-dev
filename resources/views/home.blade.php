<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contatos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-inline' http://localhost:5173 https://ajax.googleapis.com https://cdnjs.cloudflare.com https://maxcdn.bootstrapcdn.com;">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/js/app.js')
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Contatos</h2>
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" id="search" class="form-control" placeholder="Buscar contato...">
            </div>
            <div class="col-md-2">
                <button id="searchBtn" class="btn btn-primary">Buscar</button>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ url('/cadastro') }}" class="btn btn-success" id="addContactBtn">Cadastrar Novo Contato</a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Sequencial</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Idade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="contacts-list">
                <!-- Conteúdo dinâmico será carregado aqui -->
            </tbody>
        </table>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center" id="pagination">
                <!-- Paginação será carregada aqui -->
            </ul>
        </nav>
    </div>

    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Editar Contato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone:</label>
                            <input name="telefone" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="idade">Idade:</label>
                            <input name="idade" type="number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cep">CEP:</label>
                            <input name="cep" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="rua">Rua:</label>
                            <input name="rua" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="numero">Número:</label>
                            <input name="numero" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="complemento">Complemento:</label>
                            <input name="complemento" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="cidade">Cidade:</label>
                            <input name="cidade" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <input name="estado" type="text" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

