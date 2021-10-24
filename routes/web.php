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

// Auth
Route::get('login', 'AuthController@index')->name('login');
Route::post('login', 'AuthController@login')->name('login.post');

Route::group(['middleware' => ['auth:siswa']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    // Ujian
    Route::group(['prefix' => 'ujian'], function () {
        Route::get('/', 'UjianController@index')->name('ujian');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');


    // logout
    Route::match(['get', 'post'], 'logout', 'AuthController@logout')->name('logout');
});

// require __DIR__.'/auth.php';
