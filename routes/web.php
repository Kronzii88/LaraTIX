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

//ini digunakan untuk login, registrasi, reset (bawaan dari laravel auth)
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
//middleware('auth') digunakan untuk autentifikasi apakah sudah login, jika belum maka tidak bisa mengakses url dan dipindahkan ke halaman login. middleware bisa diinput dalam controller maupun ke routing. di routing kamu juga bisa melakukan grouping untuk halaman yang harus masuk autentifikasi ataupun tidak
Route::middleware('auth')->group(function() {
    
    Route::get('/dashboard', 'Dashboard\DashboardController@index') -> name('dashboard');
    Route::get('/dashboard/theaters', 'Dashboard\TheatersController@index') -> name('dashboard.theaters');
    Route::get('/dashboard/tickets', 'Dashboard\TicketsController@index') -> name('dashboard.tickets');
    
    //movies
    Route::get('/dashboard/movies', 'Dashboard\MoviesController@index') -> name('dashboard.movies');
    Route::get('/dashboard/movies/create', 'Dashboard\MoviesController@create') -> name('dashboard.movies.create');
    Route::post('/dashboard/movies', 'Dashboard\MoviesController@store') -> name('dashboard.movies.store');
    Route::get('/dashboard/movies/{movie}', 'Dashboard\MoviesController@edit') -> name('dashboard.movies.edit');
    Route::put('/dashboard/movies/{movie}', 'Dashboard\MoviesController@update') -> name('dashboard.movies.update');
    Route::delete('/dashboard/movies', 'Dashboard\MoviesController@destroy') -> name('dashboard.movies.delete');

    
    // users
    Route::get('/dashboard/users', 'Dashboard\UserController@index') -> name('dashboard.users');
    Route::get('/dashboard/users/{id}', 'Dashboard\UserController@edit') -> name('dashboard.user.edit');
    Route::patch('/dashboard/users/{id}', 'Dashboard\UserController@update') -> name('dashboard.user.update');
    Route::delete('/dashboard/users/{id}', 'Dashboard\UserController@destroy') -> name('dashboard.user.delete');

});