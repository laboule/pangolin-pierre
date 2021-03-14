<?php

namespace App\Http\Controllers;

use App\Dream;
use Illuminate\Http\Request;
use \Carbon\Carbon;

class AppController extends Controller {
	/* GET: Homepage */
	public function welcome(Request $request, $access_id = null) {

		// If a dream ID is present in the URL, load it.
		$initial_dream = null;
		$autoplay;
		if ($access_id) {
			$initial_dream = Dream::where('access_id', $access_id)->where('dream_is_published', "1")->firstOrFail();
			$autoplay = true;
		} else {
			$initial_dream = Dream::where('dream_is_published', '1')->get()->random(1)->first();
			$autoplay = false;
		}

		$initial_dream->url = $initial_dream->get_recording_file_url();

		return view('welcome', [
			"dream" => $initial_dream,
			"autoplay" => $autoplay,
		]);
	}

	/* GET: Record dream */
	public function record_dream() {
		return view('record_dream');
	}

	/* Admin view */
	public function admin() {
		$dreams = Dream::where('dream_is_published', '0')->get()->map(function ($dream) {
			$dream->url = $dream->get_recording_file_url();
			$dream->date = Carbon::parse($dream->dream_date)->format("d/m/Y");
			return $dream;
		});
		return view('admin', ["dreams" => $dreams]);
	}
}
