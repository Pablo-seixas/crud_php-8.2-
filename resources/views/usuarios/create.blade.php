<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <h1>Novo Usuario</h1>

    <form method="POST" action="{{ route('usuarios.store') }}" class="card card-body">
        @csrf

        <label>Nome</label>
        <input name="name" class="form-control mb-3" required>

        <label>Email</label>
        <input type="email" name="email" class="form-control mb-3" required>

        <label>Perfil</label>
        <select name="tipo" class="form-control mb-3">
            <option value="operador">Operador</option>
            <option value="consulta">Consulta</option>
            <option value="admin">Administrador</option>
        </select>

        <label>Setor</label>
        <input name="setor" class="form-control mb-3">

        <label>Unidade</label>
        <input name="unidade" class="form-control mb-3">

        <button class="btn btn-success">Salvar</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary mt-2">Voltar</a>
    </form>

</div>

</body>
</html>
