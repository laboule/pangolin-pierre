<?php

use Illuminate\Support\Facades\Route;

/** ADMIN VIEW */
Route::get('/admin', 'AppController@admin')->middleware('auth.basic');

/** RECORD DREAM PAGE */
Route::get('/record_dream', 'AppController@record_dream')
	->name('record_dream');

/** HOME PAGE */
Route::get('/{access_id?}', 'AppController@welcome')
	->name('welcome');
