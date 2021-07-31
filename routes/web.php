<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelWebController;

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

Route::get('/', [HotelWebController::class, 'index'])->name('home');
Route::get('hotel', [HotelWebController::class, 'create'])->name('hotel');
Route::post('hotel', [HotelWebController::class, 'store'])->name('post.hotel');
Route::get('hotel/{id}', [HotelWebController::class, 'edit'])->name('edit.hotel');
Route::put('hotel/{id}', [HotelWebController::class, 'update'])->name('update.hotel');
Route::delete('hotel/{id}', [HotelWebController::class, 'destroy'])->name('delete.hotel');
