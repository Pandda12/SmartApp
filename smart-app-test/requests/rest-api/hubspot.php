<?php

defined( 'ABSPATH' ) || exit;

function HubSpotCreateContact($user): bool {
	$url = 'https://api.hubapi.com/crm/v3/objects/contacts  ';
	$params = array(
		'headers' => array(
			'Content-Type' => 'application/json',
			'Authorization' => 'Bearer pat-eu1-ff861e36-237e-46b4-b67b-0c4ad717dff0'
		),
		'body' => json_encode(array(
			"properties" => array(
				"company" => "Startup",
				"email" => $user['email'],
				"firstname" => $user['firstname'],
				"lastname" => $user['lastname']
			),
			"associations" => array(
				array(
					"to" => array(
						"id" => "101",
						"type" => "COMPANY"
					)
				)
			)
		))
	);

	$response = wp_remote_post($url, $params);

	if (is_wp_error($response)) {
		hubspot_log($response->get_error_message());
		return false;
	} else {
		$body = wp_remote_retrieve_body($response);
		$data = json_decode($body);

		if ($data) {
			return true;
		} else {
			hubspot_log('Something went wrong.');
			return false;
		}
	}
}
