<?php

namespace App\Services;

use App\Models\Log;
use Illuminate\Http\Request;

class LogService
{
    public function registrar(Request $request, string $acao, ?string $tabela = null, ?int $registroId = null, ?string $descricao = null): void
    {
        Log::create([
            'usuario' => session('usuario_nome') ?? 'Sistema',
            'tipo' => session('usuario_tipo') ?? 'desconhecido',
            'acao' => $acao,
            'tabela' => $tabela,
            'registro_id' => $registroId,
            'ip' => $request->ip(),
            'descricao' => $descricao,
        ]);
    }
}
