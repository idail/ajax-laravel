<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PessoaController;
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

Route::get('/', HomeController::class)->name("home");
Route::post('geral', [UsuarioController::class, 'login'])->name('usuarios.login');
Route::get("painel",[PessoaController::class,"inicio"])->name("pagina_inicial");
Route::get("pessoas",[PessoaController::class,"pessoas"])->name("listagem_pessoas");
Route::get("edicao_pessoa/{item}",[PessoaController::class,"buscar_pessoa"])->name("buscar_pessoa");
Route::post("edita_pessoa",[PessoaController::class,"editar_pessoa"])->name("edita_pessoa");
Route::delete("delecao/{item}",[PessoaController::class,"excluir_pessoa"])->name("excluir");
Route::get("cadastrar_pessoa",[PessoaController::class,"exibir_cadastro"])->name("exibir_cadastro");
Route::post("cadastrado",[PessoaController::class,"cadastramento"])->name("cadastrando");