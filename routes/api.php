<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrador\UsuariosController;
use App\Http\Controllers\Operador\CategoriasController;
use App\Http\Controllers\Operador\DestacadosController;
use App\Http\Controllers\Operador\EntrevistasController;
use App\Http\Controllers\Operador\ImagenesController;
use App\Http\Controllers\Operador\NoticiasController;
use App\Http\Controllers\Operador\PropuestasController;
use App\Http\Controllers\Operador\TipoDestacadosController;
use App\Http\Controllers\Operador\VideosController;
use App\Http\Controllers\Operador\BiografiaController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/usuarios')->group(function(){
    Route::get('/', [UsuariosController::class, 'get']);
    Route::post('/', [UsuariosController::class, 'create']);
    Route::get('/{id}', [UsuariosController::class, 'getById']);
    Route::put('/{id}', [UsuariosController::class, 'update']);
    Route::delete('/{id}', [UsuariosController::class, 'delete']);

});

Route::prefix('v1/categorias')->group(function(){
    Route::get('/', [CategoriasController::class, 'get']);
    Route::post('/', [CategoriasController::class, 'create']);
    Route::get('/{id}', [CategoriasController::class, 'getById']);
    Route::put('/{id}', [CategoriasController::class, 'update']);
    Route::delete('/{id}', [CategoriasController::class, 'delete']);

});

Route::prefix('v1/destacados')->group(function(){
    Route::get('/', [DestacadosController::class, 'get']);
    Route::post('/', [DestacadosController::class, 'create']);
    Route::get('/{id}', [DestacadosController::class, 'getById']);
    Route::put('/{id}', [DestacadosController::class, 'update']);
    Route::delete('/{id}', [DestacadosController::class, 'delete']);

});

Route::prefix('v1/entrevistas')->group(function(){
    Route::get('/', [EntrevistasController::class, 'get']); 
    Route::post('/', [EntrevistasController::class, 'create']);
    Route::get('/{id}', [EntrevistasController::class, 'getById']);
    Route::put('/{id}', [EntrevistasController::class, 'update']);
    Route::delete('/{id}', [EntrevistasController::class, 'delete']);

});

Route::prefix('v1/imagenes')->group(function(){
    Route::get('/', [ImagenesController::class, 'get']);
    Route::post('/', [ImagenesController::class, 'create']);
    Route::get('/{id}', [ImagenesController::class, 'getById']);
    Route::put('/{id}', [ImagenesController::class, 'update']);
    Route::delete('/{id}', [ImagenesController::class, 'delete']);

});

Route::prefix('v1/noticias')->group(function(){
    Route::get('/', [NoticiasController::class, 'get']);
    Route::post('/', [NoticiasController::class, 'create']);
    Route::get('/{id}', [NoticiasController::class, 'getById']);
    Route::put('/{id}', [NoticiasController::class, 'update']);
    Route::delete('/{id}', [NoticiasController::class, 'delete']);

});

Route::prefix('v1/propuesta')->group(function(){
    Route::get('/', [PropuestasController::class, 'get']);
    Route::post('/', [PropuestasController::class, 'create']);
    Route::get('/{id}', [PropuestasController::class, 'getById']);
    Route::put('/{id}', [PropuestasController::class, 'update']);
    Route::delete('/{id}', [PropuestasController::class, 'delete']);

});

Route::prefix('v1/tipodestacados')->group(function(){
    Route::get('/', [TipoDestacadosController::class, 'get']);
    Route::post('/', [TipoDestacadosController::class, 'create']);
    Route::get('/{id}', [TipoDestacadosController::class, 'getById']);
    Route::put('/{id}', [TipoDestacadosController::class, 'update']);
    Route::delete('/{id}', [TipoDestacadosController::class, 'delete']);

});

Route::prefix('v1/videos')->group(function(){
    Route::get('/', [VideosController::class, 'get']);
    Route::post('/', [VideosController::class, 'create']);
    Route::get('/{id}', [VideosController::class, 'getById']);
    Route::put('/{id}', [VideosController::class, 'update']);
    Route::delete('/{id}', [VideosController::class, 'delete']);

});

Route::prefix('v1/biografia')->group(function(){
    Route::get('/', [BiografiaController::class, 'get']);
    Route::post('/', [BiografiaController::class, 'create']);
    Route::get('/{id}', [BiografiaController::class, 'getById']);
    Route::put('/{id}', [BiografiaController::class, 'update']);
    Route::delete('/{id}', [BiografiaController::class, 'delete']);

});
