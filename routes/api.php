<?php

use Illuminate\Support\Facades\Route;

/** GET A RANDOM DREAM */
Route::get('/dream', 'ApiController@getDream');
/** STORE A NEW DREAM */
Route::post('/record_dream', 'ApiController@storeDream');
/** PUBLISH A DREAM */
Route::get('/publish_dream/{accessId}', 'ApiController@validateDream');