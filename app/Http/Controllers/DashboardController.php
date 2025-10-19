<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Estatísticas gerais
        $totalClientes = Cliente::count();
        $clientesAtivos = Cliente::where('status', 'ativo')->count();
        $totalProdutos = Produto::count();
        $produtosAtivos = Produto::where('status', 'ativo')->count();
        $totalCategorias = Categoria::count();

        // Produtos com estoque baixo (<=5)
        $produtosEstoqueBaixo = Produto::where('estoque', '>', 0)
                                     ->where('estoque', '<=', 5)
                                     ->count();

        // Produtos sem estoque
        $produtosSemEstoque = Produto::where('estoque', '<=', 0)->count();

        // Valor total do estoque
        $valorTotalEstoque = Produto::where('status', 'ativo')
                                  ->sum(DB::raw('preco * estoque'));

        // Últimos clientes cadastrados
        $ultimosClientes = Cliente::latest()
                                ->take(5)
                                ->get();

        // Últimos produtos cadastrados
        $ultimosProdutos = Produto::with('categoria')
                                ->latest()
                                ->take(5)
                                ->get();

        // Produtos por categoria
        $produtosPorCategoria = Categoria::withCount('produtos')
                                       ->orderBy('produtos_count', 'desc')
                                       ->get();

        // Clientes cadastrados nos últimos 7 dias
        $clientesUltimos7Dias = Cliente::where('created_at', '>=', now()->subDays(7))
                                     ->selectRaw('DATE(created_at) as data, COUNT(*) as total')
                                     ->groupBy('data')
                                     ->orderBy('data')
                                     ->get();

        // Produtos cadastrados nos últimos 7 dias
        $produtosUltimos7Dias = Produto::where('created_at', '>=', now()->subDays(7))
                                     ->selectRaw('DATE(created_at) as data, COUNT(*) as total')
                                     ->groupBy('data')
                                     ->orderBy('data')
                                     ->get();

        return view('dashboard', compact(
            'totalClientes',
            'clientesAtivos',
            'totalProdutos',
            'produtosAtivos',
            'totalCategorias',
            'produtosEstoqueBaixo',
            'produtosSemEstoque',
            'valorTotalEstoque',
            'ultimosClientes',
            'ultimosProdutos',
            'produtosPorCategoria',
            'clientesUltimos7Dias',
            'produtosUltimos7Dias'
        ));
    }
}