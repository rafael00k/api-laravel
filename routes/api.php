<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Usuario;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Rotas de Usuários
Route::get('usuarios', 'UsuarioController@index');
Route::get('usuarios/{id}', 'UsuarioController@show');
Route::get('usuarios/usuariosOrdenados', 'UsuarioController@usuariosOrdenados');
Route::post('usuarios', 'UsuarioController@store');
Route::put('usuarios/{id}', 'UsuarioController@update');
Route::delete('usuarios/{id}', 'UsuarioController@delete');

//Rotas de Compras
Route::get('compras', 'CompraController@index');
Route::get('compras/{id}', 'CompraController@show');
Route::get('compras/somatorioComprasMes/{mes}', 'CompraController@somatorioComprasMes');
Route::post('compras', 'CompraController@store');
Route::put('compras/{id}', 'CompraController@update');
Route::delete('compras/{id}', 'CompraController@delete');

//Rotas de Relatório
Route::get('relatorios/somatorioPorEmail','CustomController@emailESoma');
