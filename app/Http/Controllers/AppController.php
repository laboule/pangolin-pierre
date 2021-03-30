<?php

namespace App\Http\Controllers;

use App\Dream;
use Illuminate\Http\Request;
use \Carbon\Carbon;

class AppController extends Controller {
	/* GET: Homepage */
	public function welcome(Request $request, $access_id = null) {

		$initial_dream = null;
		$autoplay = (bool) $request->input('autoplay'); // query param ?autoplay=1
		$show_player = $autoplay; // show player on welcome page if autoplay is true
		if ($access_id) {
			// an access id is provided (from email link for instance)
			$initial_dream = Dream::where('access_id', $access_id)->where('dream_is_published', "1")->firstOrFail();
			$show_player = true; // show player
		} else {
			// Fetch a random dream
			$dreams = Dream::where('dream_is_published', '1')->get();
			if (!$dreams->isEmpty()) {
				$initial_dream = $dreams->random(1)->first();
			}
		}
		if ($initial_dream) {
			// Get dream url
			$initial_dream->url = $initial_dream->get_recording_file_url();
		}

		return view('welcome', [
			"dream" => $initial_dream,
			"autoplay" => $autoplay,
			"show_player" => $show_player,
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
