<?php

namespace Emeka\Http\Services;

use SendGrid\Mail\Mail as Mailler;

class MailService
{
	protected $mail;
	protected $sendgrid;

	function __construct
	(
		Mailler $mail
	)
	{
		$this->mail = $mail;
	}

	public function send($receiver, $receiver_name, $subject, $body)
	{
		$this->mail->setFrom("test@example.com", "Example User");
		$this->mail->setSubject($subject);
		$this->mail->addTo($receiver, "Example User");
		$this->mail->addContent("text/html", $body);

		$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
		$response = $sendgrid->send($this->mail);
		// try {
		//     print $response->statusCode() . "\n";
		//     print_r($response->headers());
		//     print $response->body() . "\n";
		// } catch (Exception $e) {
		//     echo 'Caught exception: '. $e->getMessage() ."\n";
		// }
	}
}
