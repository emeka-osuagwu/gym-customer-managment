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
		$this->mail->setFrom("test@virtuagym.com", getenv('APP_NAME'));
		$this->mail->setSubject($subject);
		$this->mail->addTo($receiver, $receiver_name);
		$this->mail->addContent("text/html", $body);

		$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
		$response = $sendgrid->send($this->mail);
	}
}
