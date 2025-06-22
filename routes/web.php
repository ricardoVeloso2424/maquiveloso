<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui definimos as rotas da aplicação.
|
*/

// Página inicial
Route::get('/', function () {
    return view('inicial');
})->name('inicial');

// Catálogo de máquinas (com search bar)
Route::get('/venda', [VendaController::class, 'index'])
     ->name('venda');
