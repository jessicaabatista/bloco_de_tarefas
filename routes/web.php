<?php

use App\Http\Controllers\AnotacaoController;
use App\Http\Controllers\anotacaoSelecionada;
use App\Http\Controllers\ListasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\usuarioController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// ------ ## GET ## -----------------------------------------

Route::get('/', function () {
    return redirect('/home');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/editarAnotacoes', function () {
        return redirect('/editarAnotacoes');
    });

    Route::get(
        '/listaAnotacoes',
        [AnotacaoController::class, 'index']
    )->name('listaAnotacoes.index');

    Route::get(
        '/cadastroAnotacao',
        [ListasController::class, 'index']
    )->name('cadastroAnotacao');

    Route::get(
        '/anotacaoSelecionada/{id}',
        [anotacaoSelecionada::class, 'index']
    )->name('anotacaoSelecionada');

    Route::get(
        '/home',
        [HomeController::class, 'buscaInfos']
    )->name('home.buscaInfos');

    Route::get(
        '/usuario',
        [usuarioController::class, 'index']
    )->name('usuario.index');

    // ------ ## POST ## -----------------------------------------
    Route::post(
        '/cadastroAnotacao',
        [AnotacaoController::class, 'insere']
    );

    Route::post(
        '/anotacaoSelecionada/{id}',
        [anotacaoSelecionada::class, 'update']
    )->name('anotacaoSelecionada.update');

    Route::post(
        '/deletarAnotacao/{id}',
        [anotacaoSelecionada::class, 'delete']
    )->name('anotacaoSelecionada.delete');

    Route::post(
        '/usuario',
        [usuarioController::class, 'store']
    )->name('usuario.store');
});
