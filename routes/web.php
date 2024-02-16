<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\customerentry;
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
// Route::get('/landlord',[App\Http\Controllers\Backend\FormControllerr::class,'landregister'])->name('landlord');
Route::get('/User/{id?}', [App\Http\Controllers\Backend\FormController::class, 'customregister'])->name('User');
Route::post('/customer',[App\Http\Controllers\Backend\FormController::class,'customerentry'])->name('customerregister');
Route::get('/customerRoom',[App\Http\Controllers\Backend\FormController::class,'AddRoom'])->name('rooms');
Route::post('/customerRoom',[App\Http\Controllers\Backend\FormController::class,'enterRoom'])->name('enterRoom');
Route::get('/Userdisplay', [App\Http\Controllers\Backend\FormController::class, 'index'])->name('Userdisplay');
Route::get('/Roomdisplay', [App\Http\Controllers\Backend\FormController::class, 'Display'])->name('viewRoom');
Route::get('/view/{id}', [App\Http\Controllers\Backend\FormController::class, 'view'])->name('record.view');
Route::get('/room/{id}', [App\Http\Controllers\frontend\UserController::class, 'roomDetail'])
    ->middleware('auth')
    ->name('roomDetail');

Route::get('/gharbeti', [App\Http\Controllers\Frontend\UserController::class, 'gharbeti'])->name('gharbeti');
Route::get('/viewUser', [App\Http\Controllers\Frontend\UserController::class, 'user'])->middleware('auth')->name('user');
Route::get('/createRoom/{id?}',[App\Http\Controllers\frontend\UserController::class,'AddRoom'])->middleware('auth')->name('createRoom');
Route::get('/customer/{id}',[App\Http\Controllers\frontend\UserController::class,'customregister'])->middleware('auth')->name('customer');
Route::post('/Book/{id}/{rid}',[App\Http\Controllers\frontend\UserController::class,'roomBook'])->middleware('auth')->name('Book');
Route::get('/Book/{id}/{rid}',[App\Http\Controllers\frontend\UserController::class,'booking'])->middleware('auth')->name('booking');
Route::get('/yourStat/{id}',[App\Http\Controllers\frontend\UserController::class,'YourStat'])->middleware('auth')->name('yourStat');
Route::get('/EditRoom/{id}',[App\Http\Controllers\frontend\UserController::class,'EditRoom'])->middleware('auth')->name('EditRoom');
Route::put('/rooms/{id}/edit',[App\Http\Controllers\frontend\UserController::class,'update'])->name('rooms.update');
Route::delete('/delete/{photo}',[App\Http\Controllers\frontend\UserController::class,'deletephoto'])->name('photo.delete');









