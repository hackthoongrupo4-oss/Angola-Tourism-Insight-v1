<?php

use App\Http\Controllers\ItemSugestaoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SugestaoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('app.index');
});

Route::get('/dashboard1',[UsuarioController::class,'index'] )->middleware(['auth', 'verified'])->name('dashboard1');

Route::middleware('auth')->group(function () {

// Resource padrão para sugestões
    Route::resource('sugestaos', SugestaoController::class);

    // Rotas dos itens de sugestão:
    // index aninhado (lista itens de uma sugestão específica)
    Route::get('sugestaos/{sugestao}/itens', [ItemSugestaoController::class, 'index'])
        ->name('itens_sugestao.index');

    // store, update, destroy para itens (nomes usados nas views)
    Route::post('itens_sugestao', [ItemSugestaoController::class, 'store'])
        ->name('itens_sugestao.store');

    Route::put('itens_sugestao/{item}', [ItemSugestaoController::class, 'update'])
        ->name('itens_sugestao.update');

    Route::delete('itens_sugestao/{item}', [ItemSugestaoController::class, 'destroy'])
        ->name('itens_sugestao.destroy');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
