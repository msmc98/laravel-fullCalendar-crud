<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');


//crud de usuarios

Route::get('/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios.users-table');
Route::get('/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store');
// Route::get('/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('usuarios.show');
// Route::get('/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('usuario.update');
Route::delete('/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('usuarios.destroy');


//eventos

Route::get('/home', [App\Http\Controllers\EventController::class, 'index'])->name('home');
Route::post('/eventos/create', [App\Http\Controllers\EventController::class, 'create'])->name('events.create');
// Route::post('/eventos', [App\Http\Controllers\EventController::class, 'store'])->name('events.store');
// Route::get('/eventos/{id}', [App\Http\Controllers\EventController::class, 'show'])->name('events.show');
// Route::get('/eventos/{id}/edit', [App\Http\Controllers\EventController::class, 'edit'])->name('events.edit');
Route::put('/eventos/{id}', [App\Http\Controllers\EventController::class, 'update'])->name('events.update');
Route::delete('/eventos/{id}', [App\Http\Controllers\EventController::class, 'destroy'])->name('events.destroy');


// event types

Route::get('/event-types', [App\Http\Controllers\EventTypeController::class, 'index'])->name('event-types.index');
Route::post('/event-types/create', [App\Http\Controllers\EventTypeController::class, 'create'])->name('event-types.create');
Route::post('/event-types', [App\Http\Controllers\EventTypeController::class, 'store'])->name('event-types.store');
// Route::get('/event-types/{id}', [App\Http\Controllers\EventTypeController::class, 'show'])->name('event-types.show');
// Route::get('/event-types/{id}/edit', [App\Http\Controllers\EventTypeController::class, 'edit'])->name('event-types.edit');
Route::put('/event-types/{id}', [App\Http\Controllers\EventTypeController::class, 'update'])->name('event-type.update');
Route::delete('/event-types/{id}', [App\Http\Controllers\EventTypeController::class, 'destroy'])->name('event-types.destroy');

