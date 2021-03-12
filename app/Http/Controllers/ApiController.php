<?php

namespace App\Http\Controllers;

use App\Dream;
use App\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller {
	public function getDream(Request $request) {
		$notId = $request->query('not', '');
		$dream = Dream::all()->filter(function ($value, $key) use ($notId) {
			return $value->id != $notId;
		})->random(1)->first();
		// && $value->dream_is_published
		$dream->url = $dream->get_recording_file_url();
		unset($dream->access_id);
		return response()->json($dream);
	}

	/* POST: Store dream */
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
		$dream->dream_date = $request->dream_date ?? \Carbon\Carbon::now()->toDateTimeString();
		$dream->dream_language = $request->dream_language;
		$dream->dream_is_nsfw = isset($request->dream_is_nsfw);
		$dream->user_city = $request->user_city ?? "inconnue";
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

		// Die if dream can't be recorded for any reason
		$dream->delete();
		return response()->json(["status" => "error", "message" => "Impossible to add dream"]);
	}

	public function validateDream(Request $req, $accessId, Mailer $mailer) {
		$dream = Dream::where("access_id", $accessId)->first();
		if (isset($dream) && !$dream->dream_is_published) {
			$dream->dream_is_published = true;
			$dream->save();
			$res = $mailer->sendDreamValidated(["email" => $dream->user_email, "name" => $dream->user_name, "url" => env("APP_URL") . "/" . $dream->access_id]);
			return "L'email a été envoyé !";
			// return response()->json(["success" => $res]);
		}

		return "Le rêve n'existe pas ou il est déjà publié";
		// return response()->json(["error" => "Le rêve n'existe pas ou il est déjà publié"]);
	}

}
