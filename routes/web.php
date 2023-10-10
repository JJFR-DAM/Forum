<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
// use App\Http\Controllers\PruebaController;
// use App\Http\Controllers\Prueba2Controller;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/hola', function () {
//     return 'Hola mundo';
// });

// //Usar el punto para concatenar números o se sumarán.

// Route::get('/prueba', function () {
//     return 3 . 3;
// });

// //Pasamos parámetro y lo usamos. También le damos valor por defecto.

// Route::get('/prueba2/{nombre?}', function ($nombre = 'Juan') {
//     return 'Hola ' . $nombre;
// });

// //Ruta para el controllador de prueba. Importante importarlo.

// Route::controller(PruebaController::class)->group(function () {
//     Route::get('/prueba3/{name?}','index');
// });

// Route::resource("/prueba4",Prueba2Controller::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\ForumController::class, 'index'])->name('home');

Route::resource('forums', ForumController::class);

Route::resource('posts', PostController::class);

Route::resource('replies', ReplyController::class);
