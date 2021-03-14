<?php

namespace App\Http\Controllers;

use App\Dream;
use Illuminate\Http\Request;

class AppController extends Controller {
	/* GET: Homepage */
	public function welcome(Request $request, $access_id = null) {

		// If a dream ID is present in the URL, load it.
		$initial_dream = null;
		if ($access_id) {
			$initial_dream = Dream::where('access_id', $access_id)->where('dream_is_published', "1")->firstOrFail();
			$initial_dream->url = $initial_dream->get_recording_file_url();
		}

		return view('welcome', [
			"dream" => $initial_dream,
		]);
	}

	/* GET: Record dream */
	public function record_dream() {
		return view('record_dream');
	}
}
