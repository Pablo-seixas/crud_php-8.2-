<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'categoria_id',
        'nome',
        'codigo',
        'quantidade',
        'estoque_minimo',
        'localizacao',
        'observacoes',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function status()
    {
        return $this->quantidade <= $this->estoque_minimo ? 'Estoque baixo' : 'Normal';
    }
}
