<?php

use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\Arquivos2Controller;
use App\Http\Controllers\GeralController;
use App\Http\Controllers\ItemSugestaoController;
use App\Http\Controllers\previsaoController;
use App\Http\Controllers\Previsoes2Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProvinciaController;
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

Route::get('/',[GeralController::class,'index'])->name('home');
Route::get('/arquivos/lista',[GeralController::class,'lista'])->name('arquivos.lista');
Route::get('/arquivo2/{arquivo}/show',[GeralController::class,'show'])->name('arquivo2.show');


Route::get('/create_user',[UsuarioController::class,'create_user'] )->middleware('guest')->name('create_user');



Route::middleware(['auth'])->group(function() {
    //api

    Route::patch('/arquivos/{arquivo}/status', [Arquivos2Controller::class, 'updateStatus'])->name('arquivos2.updateStatus');
});
Route::middleware('auth')->group(function () {


//dashboard
Route::get('/dashboard1',[UsuarioController::class,'index'] )->middleware(['auth', 'verified'])->name('dashboard1');



    Route::middleware('roles:admin,prestador')->group(function(){
        Route::get('arquivos/{arquivo}/download', [ArquivoController::class, 'download'])->name('arquivos.download');
     Route::resource('arquivos2', Arquivos2Controller::class)->parameters(['arquivos2' => 'arquivo' ]);
     Route::resource('arquivos', ArquivoController::class);
    });
     

    Route::middleware('roles:admin,gestor')->group(function (){


        Route::resource('previsoes2', Previsoes2Controller::class);
    Route::resource('previsoes', previsaoController::class);

    Route::delete('usuario/deletar/{user}',[UsuarioController::class,'destroy'])->name('usuarios.destroy');
    Route::resource('provincias', ProvinciaController::class)->except(['show', 'create', 'edit']);
// Resource padrão para sugestões
    Route::resource('sugestaos', SugestaoController::class);


       Route::get('provincias/{provincia}/usuarios', [UsuarioController::class, 'usuarios'])
        ->name('provincias.usuario');
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

    });

    

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
