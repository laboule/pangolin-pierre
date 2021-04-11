<?php

namespace App\Http\Controllers;

use App\Dream;
use App\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Carbon\Carbon;

class ApiController extends Controller {
	/**
	 * Get a random dream
	 * @param  Request $request http request
	 * @return Symfony\Component\HttpFoundation\Response  http response
	 */
	public function getDream(Request $request) {
		$excludeIds = $request->exclude ?? [];
		// find a new dream which id is not in the excludeIds array (prevent repeating
		// the same dream)
		$dream = Dream::all()->filter(function ($dream, $key) use ($excludeIds) {
			return !in_array($dream->id, $excludeIds) && $dream->dream_is_published;
		})->random(1)->first();

		// if no dream was found fetch a random one, even if it means repeating
		// the same dream
		if (!$dream) {
			$dream = Dream::all()->random(1)->first();
		}
		// && $value->dream_is_published
		$dream->url = $dream->get_recording_file_url();
		unset($dream->access_id);
		return response()->json($dream);
	}

	/**
	 * Store a dream
	 * @param  Request $request http request
	 * @return Symfony\Component\HttpFoundation\Response  http response
	 */
	public function storeDream(Request $request) {

		$validated_data = $request->validate([
			'user_name' => 'max:100',
			'user_country' => 'max:100',
			'user_city' => 'max:100',
			'user_email' => 'required|max:255',
			'dream_language' => 'required',
			'form_audio_data' => 'required',
		]);

		$dream = new Dream();

		$dream->user_name = $request->user_name ?? "anonyme";
		$dream->user_country = $request->user_country ?? "inconnu";
		$dream->user_email = $request->user_email;
		$dream->user_email_optin = isset($request->user_email_optin);
		$dream->dream_date = $request->dream_date ? Carbon::createFromFormat('d/m/Y', $request->dream_date)
			->format('Y-m-d') : Carbon::now()->toDateTimeString();

		$dream->dream_language = $request->dream_language;
		$dream->dream_is_nsfw = isset($request->dream_is_nsfw);
		$dream->user_city = $request->user_city ?? "terre";
		$dream->access_id = uniqid();
		$dream->save();
		$recording_filename = $dream->get_recording_filename();

		// Handle form_audio_data
		if (preg_match('/^data:audio\/(\w+);base64,/', $request->form_audio_data)) {
			$data = substr($request->form_audio_data, strpos($request->form_audio_data, ',') + 1);
			$data = base64_decode($data);

			if (Storage::disk('public')->put($recording_filename, $data)) {
				return response()->json(["status" => "success"]);
			}
		}

		// delete dream if storage failed
		$dream->delete();
		return response()->json(["status" => "error", "message" => "Impossible to add dream"]);
	}

	/**
	 * Validate/publish a dream
	 * Send a mail to the dream's owner with a link
	 * @param  Request $req      http request
	 * @param  String  $accessId dream's access id
	 * @param  Mailer  $mailer   Mail instance
	 * @return Symfony\Component\HttpFoundation\Response  http response
	 */
	public function validateDream(Request $req, $accessId, Mailer $mailer) {
		$dream = Dream::where("access_id", $accessId)->first();
		if (isset($dream) && !$dream->dream_is_published) {
			$dream->dream_is_published = true;
			$dream->save();
			$res = $mailer->sendDreamValidated(["email" => $dream->user_email, "name" => $dream->user_name, "url" => env("APP_URL") . "/" . $dream->access_id]);
			return response()->json(["success" => $res]);
		}

		return response()->json(["error" => "Le rêve n'existe pas ou il est déjà publié"]);
	}

}
