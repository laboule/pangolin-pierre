<?php

namespace App\Http\Controllers;

use App\Dream;

class ApiController extends Controller {
	public function getDream() {
		$dream = Dream::get_one_random();
		$dream->url = $dream->get_recording_file_url();
		return response()->json($dream);
	}

}
