<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// 1. Rota Pública
Route::get('/', function () {
    return view('welcome');
});

// 2. ÚNICO Grupo Protegido (Tudo que exige login fica aqui)
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard e Estoque
    Route::get('/dashboard', [ProdutoController::class, 'index'])->name('dashboard');
    Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
    Route::delete('/produtos/{produto}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
    Route::patch('/produtos/{produto}/vender', [ProdutoController::class, 'vender'])->name('produtos.vender');

    // Gestão de Operadores (Cadastro Administrativo)
    Route::get('/usuarios/novo', [RegisteredUserController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios/novo', [RegisteredUserController::class, 'store'])->name('usuarios.store');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
