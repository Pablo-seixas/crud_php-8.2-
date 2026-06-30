<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('name')->get();

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(UsuarioRequest $request)
    {
        $dados = $request->validated();

        User::create([
            'name' => $dados['name'],
            'email' => $dados['email'],
            'password' => Hash::make('15-15-15'),
            'tipo' => $dados['tipo'],
            'setor' => $dados['setor'] ?? null,
            'unidade' => $dados['unidade'] ?? null,
            'trocar_senha' => true,
            'ativo' => true,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario criado com senha temporaria.');
    }

    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(UsuarioRequest $request, User $usuario)
    {
        $usuario->update($request->validated());

        return redirect()->route('usuarios.index')->with('success', 'Usuario atualizado.');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario removido.');
    }

    public function resetarSenha(User $usuario)
    {
        $usuario->update([
            'password' => Hash::make('15-15-15'),
            'trocar_senha' => true,
        ]);

        return back()->with('success', 'Senha resetada para 15-15-15.');
    }
}
