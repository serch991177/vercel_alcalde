<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Operador\CategoriasController;
use App\Http\Controllers\Operador\EntrevistasController;
use App\Http\Controllers\Operador\NoticiasController;
use App\Http\Controllers\Operador\ImagenesController;
use App\Http\Controllers\Operador\ImagenController;
use App\Http\Controllers\Usuario\UsuarioController;
use App\Http\Controllers\Operador\PropuestasController;
use App\Mail\MyTestEmail;
use App\Http\Controllers\Usuario\EmailController;
use App\Http\Controllers\Operador\VideosController;
use App\Http\Controllers\Operador\DestacadosController;
use App\Http\Controllers\Operador\BiografiaController;
use App\Http\Controllers\Administrador\UsuariosController;
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

Route::get('/', [UsuarioController::class, 'home']);
Route::post('/guardar-propuesta',[UsuarioController::class,'propuesta'])->name('guardar-propuesta');
/**Ruta de los usuarios*/
Route::get('/biografia',[UsuarioController::class,'biografia']);
Route::get('/prensa',[UsuarioController::class,'prensa']);
Route::get('/galeria', [UsuarioController::class, 'galeria']);
Route::get('/contacto', function(){return view('usuario.contacto');});
Route::post('/recuperar-entrevista',[UsuarioController::class,'recuperar_entrevista'])->name('recuperar-entrevista');
Route::post('/recuperar-noticia',[UsuarioController::class,'recuperar_noticia'])->name('recuperar-noticia');
Route::post('/recuperar-seccion',[UsuarioController::class,'recpuerar_seccion'])->name('recuperar-seccion-info');
Route::post('/filtrar-categoria',[UsuarioController::class,'filtrar_categoria'])->name('filtrar-categoria');
Route::post('/busqueda-palabra',[UsuarioController::class,'busqueda'])->name('busqueda-palabra');
Route::post('/busqueda-galeria',[UsuarioController::class,'busquedagaleria'])->name('busqueda-galeria');
/**Rutas para el envio de gmail*/
Route::post('/enviar-mensaje',[EmailController::class,'GetMessage'])->name('enviar-mensaje');
/**Fin de ruta de los usuarios */


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');


    Route::get('/entrevista', [EntrevistasController::class, 'index']);
    Route::get('/entrevistas/ultimo_id', [EntrevistasController::class, 'obtenerUltimoIdEntrevistas']);
    Route::get('/categorias', [CategoriasController::class, 'index']);
    Route::get('/noticias', [NoticiasController::class, 'index']);
    Route::get('/noticias/ultimo_id', [NoticiasController::class, 'obtenerUltimoIdNoticias']);
    Route::get('/imagenes', [ImagenesController::class, 'index']);
    Route::get('/imagenes/ultimo_id', [ImagenesController::class, 'obtenerUltimoIdImagenes']);
    Route::post('/imagen/store', [ImagenController::class, 'store']);
    Route::post('/imagen/edit', [ImagenController::class, 'edit']);
    Route::delete('/imagen/destroy/{id}', [ImagenController::class, 'destroy']);
    Route::get('/propuestas', [PropuestasController::class, 'index']);
    Route::get('/videos', [VideosController::class, 'index']);
    Route::get('/destacados', [DestacadosController::class, 'index']);
    Route::get('/biografias', [BiografiaController::class, 'index']);
    Route::get('/usuarios', [UsuariosController::class, 'index']);
    //rutas del servicio de prensa
    Route::get('/noticias-prensa',[UsuarioController::class,'noticiasprensa'])->name('noticiasprensa');
    Route::post('/recuperar-noticia-prensa',[UsuarioController::class,'recuperarprensa'])->name('recuperar_noticia_prensa');
    Route::post('/prensa/guardar-noticia-prensa',[UsuarioController::class,'guardarnoticiaprensa'])->name('guardar_noticia_prensa');
    Route::post('/prensa/guardar-image-noticia-prensa',[UsuarioController::class,'guardarimagenprensa'])->name('guardar_imagen_prensa');
});

