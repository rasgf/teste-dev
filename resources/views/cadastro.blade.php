<<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Contato</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container mt-5">
        <h2>Registro de Novo Contato</h2>
        <form action="{{ url('api/contatos') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome:</label>
                <input name="name" type="text" class="form-control" placeholder="Nome" required autocomplete="name">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input name="telefone" type="text" class="form-control" placeholder="Telefone" required>
            </div>
            <div class="form-group">
                <label for="idade">Idade:</label>
                <input name="idade" type="number" class="form-control" placeholder="Idade" required>
            </div>
            <div class="form-group">
                <label for="cep">CEP:</label>
                <input name="cep" type="text" class="form-control" placeholder="CEP" required>
            </div>
            <div class="form-group">
                <label for="rua">Rua:</label>
                <input name="rua" type="text" class="form-control" placeholder="Rua" required>
            </div>
            <div class="form-group">
                <label for="numero">Número:</label>
                <input name="numero" type="text" class="form-control" placeholder="Número" required>
            </div>
            <div class="form-group">
                <label for="complemento">Complemento:</label>
                <input name="complemento" type="text" class="form-control" placeholder="Complemento">
            </div>
            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <input name="cidade" type="text" class="form-control" placeholder="Cidade" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <input name="estado" type="text" class="form-control" placeholder="Estado" required>
            </div>
            <button type="submit" class="btn btn-success">Registrar</button>
        </form>
        <br>
        <a href="{{ url('/') }}" class="btn btn-primary">Voltar à Lista de Contatos</a>
    </div>
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert('Contato cadastrado com sucesso!');
                        window.location.href = '/';
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = 'Ocorreram os seguintes erros:\n';
                        
                        for (let field in errors) {
                            errorMessage += errors[field].join('\n') + '\n';
                        }
                        
                        alert(errorMessage);
                    }
                });
            });
        });
        </script>
</body>
</html>
