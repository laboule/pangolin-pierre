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
						'Email' => "pierre.travacca@gmail.com",
						'Name' => "Admin",
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
		$dataEmail["templateId"] = (int) 2628418;
		$dataEmail["subject"] = "[REVES DU PANGOLIN] Ton rêve est en ligne !";
		$body = $this->constructBody($dataEmail);
		$response = $this->mj->post(Resources::$Email, ['body' => $body]);
		return $response->success();

	}
}
