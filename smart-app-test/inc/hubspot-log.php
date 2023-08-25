<?php

defined( 'ABSPATH' ) || exit;

function hubspot_log($error): void {

	$log_file = plugin_dir_path(__DIR__) . 'log/hubspot_log.txt';

	date_default_timezone_set('Europe/Minsk');
	$today = date("d-m-Y H:i:s");

	$log_entry = '[' . $today . '] HubSpot Error: ' . $error . "\n";

	file_put_contents($log_file, $log_entry, FILE_APPEND);

}