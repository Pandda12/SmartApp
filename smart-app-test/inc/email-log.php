<?php

defined( 'ABSPATH' ) || exit;

function email_log($status, $email): void {

	$log_file = plugin_dir_path(__DIR__) . 'log/email_log.txt';

	date_default_timezone_set('Europe/Minsk');
	$today = date("d-m-Y H:i:s");

	$log_entry = '[' . $today . '] email status - ' . $status . ' customer email (' . $email . ")\n";

	file_put_contents($log_file, $log_entry, FILE_APPEND);

}