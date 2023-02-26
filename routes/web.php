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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post('/createNote', [App\Http\Controllers\NoteController::class, 'create']);
Route::post('/deleteNote', [App\Http\Controllers\NoteController::class, 'delete']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
