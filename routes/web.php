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

Route::get('/record_dream', 'AppController@record_dream')
	->name('record_dream');

Route::get('/admin', 'AppController@admin')->middleware('auth.basic');

Route::get('/{access_id?}', 'AppController@welcome')
	->name('welcome');
