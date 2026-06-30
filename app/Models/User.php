<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo',
        'setor',
        'unidade',
        'trocar_senha',
        'ativo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function ehAdmin(): bool
    {
        return $this->tipo === 'admin';
    }

    public function ehOperador(): bool
    {
        return $this->tipo === 'operador';
    }

    public function ehConsulta(): bool
    {
        return $this->tipo === 'consulta';
    }

    public function status(): string
    {
        return $this->ativo ? 'Ativo' : 'Bloqueado';
    }

    public function perfil(): string
    {
        return match ($this->tipo) {
            'admin' => 'Administrador',
            'operador' => 'Operador',
            'consulta' => 'Consulta',
            default => 'Usuario',
        };
    }
}
