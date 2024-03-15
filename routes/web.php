<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\DesenvolvedorController;

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
    return view('index');
});
Route::get('/niveis', [NivelController::class, 'view']);
Route::get('/desenvolvedores', [DesenvolvedorController::class, 'view']);