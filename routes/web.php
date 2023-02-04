<?php

use App\Http\Controllers\AuthController;
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



Route::controller(AuthController::class)
    ->prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/callback', 'callback')->name('callback');
    });

    Route::get('/', function () {
        return view('welcome');
    })->middleware('custom-auth');


    Route::get('/home', function () {
        return 'home';
    });

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'custom-auth']], function () {

        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
