<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/parcels', [App\Http\Controllers\parcelController::class, 'allparcels'])->name('parcel.all');
Route::get('/parcels/pdf', [App\Http\Controllers\parcelController::class, 'createPDF'])->name('parcels.pdf');
Route::get('/parcel/new', [App\Http\Controllers\parcelController::class, 'newparcel'])->name('parcel.new');
Route::get('/parcelinfo/{percel_no}', [App\Http\Controllers\parcelController::class, 'parceldetails'])->name('getparceldetails');
Route::post('/parcel/new', [App\Http\Controllers\parcelController::class, 'postnewparcel'])->name('newparcel');
Route::post('/parcel/action', [App\Http\Controllers\parcelController::class, 'actiononparcel'])->name('actiononparcel');
Route::post('/parcel/search', [App\Http\Controllers\parcelController::class, 'searchparcel'])->name('parcel.search');
