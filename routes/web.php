<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\TareasController;
use Illuminate\Support\Facades\Route;

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

//  T A R E A S

Route::get('/', function () {
    /* function(){
    return view('tareas.index');    //Agregar con NameCarpeta/NameArchivo
} */
    return view('welcome');
});

//Obtener Tareas
Route::get('/tareas', [TareasController::class, 'index'])->name('tareas');

//Agregar Tarea
Route::post('/tareas', [TareasController::class, 'store'])->name('tareas');

//Editar y actualizar tarea
Route::get('/tareas/{id}', [TareasController::class, 'show'])->name('tarea-show');
Route::patch('/tareas/{id}', [TareasController::class, 'update'])->name('tarea-update');

//Eliminar tarea
Route::delete('/tareas/{id}', [TareasController::class, 'destroy'])->name('tarea-destroy');


// C A T E G O R I A S 

Route::resource('categorias', CategoriasController::class);
