<?php

use Illuminate\Support\Facades\Route;

Route::get('/dream', 'ApiController@getDream');

Route::post('/record_dream', 'ApiController@storeDream');
