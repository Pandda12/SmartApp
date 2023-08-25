<?php

defined( 'ABSPATH' ) || exit;

function mailSend(){
	if (!isset($_POST['firstName'])
	    || !isset($_POST['lastName'])
	    || !isset($_POST['email'])
	    || !isset($_POST['subject'])
	    || !isset($_POST['message'])
	) {
		wp_send_json(['status' => 'Not full data']);
	}else{
		$firstName = htmlspecialchars(trim($_POST['firstName']));
		$lastName = htmlspecialchars(trim($_POST['lastName']));
		$email = htmlspecialchars(trim($_POST['email']));
		$subject = htmlspecialchars(trim($_POST['subject']));
		$message_text = htmlspecialchars(trim($_POST['message']));

		$message = "You have got new message from: $email."
		           . "Customer message subject:<br>$subject<br><br>.Customer message text:<br>$message_text";

		$customerMessage = "Dear $firstName $lastName<br>"
		."We have received your message and will reply soon";

		$headers = array(
			'MIME-Version: 1.0',
			'Content-type: text/html; charset="utf-8"',
			'Content-Transfer-Encoding: 8bit',
			"X-Mailer: PHP/".phpversion(),
			'From: '.'smart.app.custom.form@gmail.com',
			'Reply-To: '.'smart.app.custom.form@gmail.com',
		);

		$adminMail = wp_mail('smart.app.custom.form@gmail.com', 'You have got new message from WordPress', $message, $headers);
		$customerMail = wp_mail($email, 'Thanks for your message', $customerMessage, $headers);

		$user = array(
			"firstname" => $firstName,
			"lastname" => $lastName,
			"email" => $email
		);

		$createContact = HubSpotCreateContact($user);

		if ($adminMail && $customerMail && $createContact) {
			email_log('success', $email);
			wp_send_json(['status' => 'success']);
		} else {
			email_log('error', $email);
			wp_send_json(['status' => 'error']);
		}

	}
	wp_die();
}
add_action('wp_ajax_email_send', 'mailSend');
add_action('wp_ajax_nopriv_email_send', 'mailSend');
