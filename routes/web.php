<?php

use App\Http\Livewire\Home;
use App\Http\Livewire\Tax\Pph21\Pph21Index;
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

Route::get('/', Home::class)->name('home');

Route::prefix('calculator')->group(function () {
    Route::get('pph-21', Pph21Index::class)->name('pph-21.index');
});
