<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::resource('cidades',App\Http\Controllers\CidadeController::class);
Route::resource('campanhas',App\Http\Controllers\CampanhaController::class);
Route::resource('grupos',App\Http\Controllers\GrupoController::class);
Route::resource('produtos',App\Http\Controllers\ProdutoController::class);
Route::resource('descontos',App\Http\Controllers\DescontoController::class);
Route::resource('campanha-produtos',App\Http\Controllers\CampanhaProdutoController::class);
Route::resource('cidade-grupos',App\Http\Controllers\CidadeGrupoController::class);