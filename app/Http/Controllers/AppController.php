<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
	/* Homepage */
    public function welcome() {
    	return view('welcome');
    }

    /* Record dream */
    public function record_dream() {
    	return view('record_dream');
    }
}
