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

Route::get('/', 'AppController@welcome')->name('welcome');
Route::get('/record_dream', 'AppController@record_dream')->name('record_dream');
Route::post('/record_dream', 'AppController@store_dream')->name('store_dream');
Route::get('/record_dream_success', 'AppController@record_dream_success')->name('record_dream_success');
