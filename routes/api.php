<?php

use Illuminate\Support\Facades\Route;

Route::get('/dream', 'ApiController@getDream');
Route::post('/record_dream', 'ApiController@storeDream');
Route::get('/publish_dream/{accessId}', 'ApiController@validateDream');