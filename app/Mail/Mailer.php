<?php

namespace App\Mail;
use \Mailjet\Client;
use \Mailjet\Resources;

class Mailer {
	private $mj;

	/**
	 *
	 */
	public function __construct() {
		$this->mj = new Client(env('MJ_APIKEY_PUBLIC'), env('MJ_APIKEY_PRIVATE'), true, ['version' => 'v3.1']);
	}

	/**
	 * Send a mail
	 */
	public function constructBody($data) {
		$body = [
			'Messages' => [
				[
					'From' => [
						'Email' => config("app.mailjet.from.email"),
						'Name' => config("app.mailjet.from.name"),
					],
					'To' => [
						[
							'Email' => $data["email"],
							'Name' => $data["name"],
						],
					],
					'TemplateID' => $data["templateId"],
					'TemplateLanguage' => true,
					'Subject' => $data["subject"],
					'Variables' => [
						'url' => $data["url"] ?? "",
					]],
			]];
		return $body;
	}

	/**
	 * Send a mail
	 */
	public function sendDreamValidated($data) {
		$dataEmail = $data;
		$dataEmail["templateId"] = (int) config('app.mailjet.templates.published');
		$dataEmail["subject"] = "Ton rêve est en ligne !";
		$body = $this->constructBody($dataEmail);
		$response = $this->mj->post(Resources::$Email, ['body' => $body]);
		return $response->success();

	}
}
