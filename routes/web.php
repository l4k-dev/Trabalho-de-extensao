<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// 1. Rota Pública
Route::get('/', function () {
    return view('welcome');
});

// 2. Grupo Protegido (Exige Login)
Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Gestão de Estoque e Dashboard
    |--------------------------------------------------------------------------
    */
    // Listagem principal (PDV)
    Route::get('/dashboard', [ProdutoController::class, 'index'])->name('dashboard');

    // Cadastro de novos espetinhos
    Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');

    // Remoção de itens
    Route::delete('/produtos/{produto}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');

    // Botão de Venda Rápida (-1 no estoque)
    Route::patch('/produtos/{produto}/vender', [ProdutoController::class, 'vender'])->name('produtos.vender');

    /*
    |--------------------------------------------------------------------------
    | Relatórios (Financeiro e Inventário)
    |--------------------------------------------------------------------------
    */
    // Relatório de Vendas (Histórico e Faturamento)
    // ESTA É A ROTA ÚNICA QUE RESOLVE O ERRO DO $faturamentoTotal
    Route::get('/relatorio-vendas', [ProdutoController::class, 'relatorioVendas'])->name('vendas.relatorio');

    // Relatório de Estoque (Patrimônio parado)
    Route::get('/relatorio', [ProdutoController::class, 'relatorio'])->name('relatorio.index');

    /*
    |--------------------------------------------------------------------------
    | Gestão de Operadores (Funcionários)
    |--------------------------------------------------------------------------
    */
    Route::get('/usuarios/novo', [RegisteredUserController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios/novo', [RegisteredUserController::class, 'store'])->name('usuarios.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
