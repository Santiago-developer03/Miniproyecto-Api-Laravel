<?php

use App\Http\Controllers\Auth\UsuarioController;
use App\Http\Controllers\TwControllers\ContactosCorporativosController;
use App\Http\Controllers\TwControllers\ContratosCorporativosController;
use App\Http\Controllers\TwControllers\CorporativosController;
use App\Http\Controllers\TwControllers\DocumentosController;
use App\Http\Controllers\TwControllers\DocumentosCorporativosController;
use App\Http\Controllers\TwControllers\EmpresasCorporativosController;
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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [UsuarioController::class, 'login']);
    Route::post('register', [UsuarioController::class, 'register']);

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::apiResource('corporativa', CorporativosController::class);
        Route::apiResource('empresa', EmpresasCorporativosController::class);
        Route::apiResource('contacto', ContactosCorporativosController::class);
        Route::apiResource('contrato', ContratosCorporativosController::class);
        Route::apiResource('documento', DocumentosController::class);
        Route::apiResource('documentos_corporativos', DocumentosCorporativosController::class);
        Route::get('logout', [UsuarioController::class, 'logout']);
        Route::get('user', [UsuarioController::class, 'user']);
    });
});
