<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoItemController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome'); // ← ESTA É A LINHA QUE FALTAVA

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rotas de Clientes
    Route::resource('clientes', ClienteController::class);
    
    // Rotas de Produtos
    Route::resource('produtos', ProdutoController::class);
    
    // Rotas de Categorias
    Route::resource('categorias', CategoriaController::class);
    
    // Rotas de Pedidos
    Route::resource('pedidos', PedidoController::class);
    
    // Rotas especiais de pedidos
    Route::post('pedidos/{pedido}/confirmar', [PedidoController::class, 'confirmar'])->name('pedidos.confirmar');
    Route::post('pedidos/{pedido}/cancelar', [PedidoController::class, 'cancelar'])->name('pedidos.cancelar');
    Route::post('pedidos/{pedido}/entregar', [PedidoController::class, 'entregar'])->name('pedidos.entregar');
    
    // Rotas AJAX para itens de pedidos
    Route::post('pedidos/{pedido}/itens', [PedidoItemController::class, 'store'])->name('pedido-itens.store');
    Route::put('pedido-itens/{item}', [PedidoItemController::class, 'update'])->name('pedido-itens.update');
    Route::delete('pedido-itens/{item}', [PedidoItemController::class, 'destroy'])->name('pedido-itens.destroy');
    Route::get('api/produtos/buscar', [PedidoItemController::class, 'buscarProdutos'])->name('api.produtos.buscar');
});

require __DIR__.'/auth.php';