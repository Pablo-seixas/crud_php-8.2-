<?php

namespace App\Services;

use App\Models\Produto;
use App\Models\Saida;

class DashboardService
{
    public function dados(): array
    {
        $totalProdutos = Produto::count();

        $totalEstoque = Produto::sum('quantidade');

        $estoqueBaixo = Produto::whereColumn('quantidade', '<=', 'estoque_minimo')->count();

        $saidasHoje = Saida::whereDate('created_at', now()->toDateString())->sum('quantidade');

        $ultimasSaidas = Saida::with('produto')->latest()->limit(5)->get();

        return [
            'totalProdutos' => $totalProdutos,
            'totalEstoque' => $totalEstoque,
            'estoqueBaixo' => $estoqueBaixo,
            'saidasHoje' => $saidasHoje,
            'ultimasSaidas' => $ultimasSaidas,
            'statusEstoque' => $estoqueBaixo > 0 ? 'Atenção' : 'Normal',
            'classeEstoque' => $estoqueBaixo > 0 ? 'text-danger' : 'text-success',
        ];
    }
}
