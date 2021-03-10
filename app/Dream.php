<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dream extends Model {
	/**
	 * Default data
	 **/

	// Format to use to encode dream audio recording
	const DREAM_AUDIO_FORMAT = "mp3";

	// Max duration of a dream recording in seconds
	const DREAM_AUDIO_MAX_DURATION = 60 * 30; // 30 minutes

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'dream_date' => 'date',
	];

	/**
	 * Get one random dream
	 * @return Dream|null a random dream or null if none exists
	 */
	static public function get_one_random() {
		$dreams = self::all();
		return !$dreams->isEmpty() ? $dreams->random(1)->first() : null;
	}

	/* Static Generic helpers */
	static public function get_human_readable_max_recording_duration() {
		return \Carbon\CarbonInterval::seconds(self::DREAM_AUDIO_MAX_DURATION)->cascade()->forHumans();
	}

	/* Instances helpers */
	public function get_recording_filename() {
		return 'dream_' . $this->id . '.' . self::DREAM_AUDIO_FORMAT;
	}

	public function get_recording_file_url() {
		$filename = $this->get_recording_filename();

		return '/storage/' . $filename;
	}

	public function get_public_url() {
		return route('welcome', ['access_id' => $this->access_id]);
	}
}
