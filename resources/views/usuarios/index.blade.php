<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <h1>Usuarios</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('usuarios.create') }}" class="btn btn-success mb-3">Novo usuario</a>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">Voltar</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Setor</th>
                <th>Unidade</th>
                <th>Status</th>
                <th>Acoes</th>
            </tr>
        </thead>

        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                <td>
                    <span class="{{ $usuario->tipo === 'admin' ? 'text-danger fw-bold' : ($usuario->tipo === 'operador' ? 'text-primary fw-bold' : 'text-secondary fw-bold') }}">
                        {{ $usuario->perfil() }}
                    </span>
                </td>
                <td>{{ $usuario->setor ?? '-' }}</td>
                <td>{{ $usuario->unidade ?? '-' }}</td>
                <td class="{{ $usuario->ativo ? 'text-success fw-bold' : 'text-danger fw-bold' }}">
                    {{ $usuario->status() }}
                </td>
                <td>
                    <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form method="POST" action="{{ route('usuarios.resetar', $usuario) }}" class="d-inline">
                        @csrf
                        <button class="btn btn-info btn-sm">Resetar senha</button>
                    </form>

                    <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Excluir usuario?')">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>

</body>
</html>
