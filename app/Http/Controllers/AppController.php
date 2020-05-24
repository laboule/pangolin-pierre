<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Dream;

class AppController extends Controller
{
	/* GET: Homepage */
    public function welcome(Request $request, $dream_id = null) {

    	if( $dream_id ) {
    		$initial_dream = Dream::findOrFail($dream_id);
    	} else {
    		$initial_dream = Dream::get_one_random();
    	}

    	return view('welcome', [
    		"dream" => $initial_dream
    	]);
    }

    /* GET: Record dream */
    public function record_dream() {
    	return view('record_dream');
    }

    /* POST: Store dream */
    public function store_dream(Request $request) {
    	/*
    	$table->string('user_name', 100);
        $table->tinyInteger('user_age');
        $table->string('user_country', 100);
        $table->string('user_email', 255)->nullable();
        $table->boolean('user_email_optin')->default(false);

        $table->date('dream_date')->nullable();
        $table->string('dream_language');
        $table->boolean('dream_is_nsfw')->default(false);
        $table->boolean('dream_is_published')->default(false);
        $table->string('user_city', 100);

        form_audio_data
        */
    	$validated_data = $request->validate([
	        'user_name' => 'required|max:100',
	        'user_age' => 'required|max:3',
	        'user_country' => 'required|max:100',
	        'user_city' => 'required',
	        'user_email' => 'max:255',
	        'dream_language' => 'required',
	        'form_audio_data' => 'required'
	    ]);

	    $dream = new Dream();

	    $dream->user_name = $request->user_name;
	    $dream->user_age = $request->user_age;
	    $dream->user_country = $request->user_country;
	    $dream->user_email = isset($request->user_email) ? $request->user_email : null;
	    $dream->user_email_optin = isset($request->user_email_optin) ? true : false;
	    $dream->dream_date = isset($request->dream_date) ? $request->dream_date : null;
	    $dream->dream_language = $request->dream_language;
	    $dream->dream_is_nsfw = isset($request->dream_is_nsfw) ? true : false;
	    $dream->user_city = $request->user_city;

	    $dream->save();

	    $recording_filename = $dream->get_recording_filename('mp3');

	    // Handle form_audio_data
	    if (preg_match('/^data:audio\/(\w+);base64,/', $request->form_audio_data)) {
		    $data = substr($request->form_audio_data, strpos($request->form_audio_data, ',') + 1);
		    $data = base64_decode($data);

		    if( Storage::disk('public')->put($recording_filename, $data) ) {
		    	return redirect()->route('record_dream_success', ['dream_id' => $dream->id]);
		    }
		}

		// Die if dream can't be recorded for any reason
		$dream->delete();
	    dd('error');
    }

    /* GET: Dream record / saving success */
    public function record_dream_success($dream_id) {
    	$dream = Dream::findOrFail($dream_id);

    	return view('record_dream_success', [
    		'dream' => $dream
    	]);
    }
}
