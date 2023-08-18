<?php
/**
 *  Plugin Name: SmartApp Test
 *  Description: Плагин для тестового задния доя комании SmartApp
 *  Version: 1.0
 *  Author: Pandda
 *  Text Domain: smart-app-test
 *  Requires at least: 5.9
 *  Requires PHP: 7.2
 */
defined( 'ABSPATH' ) || exit;

add_action( 'phpmailer_init', 'my_smtp_phpemailer' );
function my_smtp_phpemailer( $phpmailer ) {
	$phpmailer->isSMTP();
	$phpmailer->Host       = 'smtp.gmail.com';
	$phpmailer->SMTPAuth   = true;
	$phpmailer->Port       = 587;
	$phpmailer->Username   = 'smart.app.custom.form@gmail.com';
	$phpmailer->Password   = 'wjydgnohfrdhuobw';
	$phpmailer->SMTPSecure = 'tls';
	$phpmailer->From       = 'smart.app.custom.form@gmail.com';
	$phpmailer->FromName   = 'Vladimir Lobko';
}

require_once 'requests/ajax/send-email.php';

/*
 * Load custom template and add it to admin
 */
add_filter( 'page_template', 'wpa3396_page_template' );
add_filter( 'theme_page_templates', 'wpse_288589_add_template_to_select', 10, 4 );
function wpa3396_page_template( $page_template ){

	if ( get_page_template_slug() == 'templates/form-page-template.php' ) {
		$page_template = dirname( __FILE__ ) . '/templates/form-page-template.php';
	}
	return $page_template;
}
function wpse_288589_add_template_to_select( $post_templates, $wp_theme, $post, $post_type ) {

	$post_templates['templates/form-page-template.php'] = __('Configurator');

	return $post_templates;
}

/**
 * Global CSS
 */
function smart_app_css(){
	wp_enqueue_style( 'ai-global-styles', plugins_url( '/css/smart-app.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'smart_app_css' );

function email_log($status, $email){

	$log_file = __DIR__.'/log/email_log.txt';

	date_default_timezone_set('Europe/Minsk');
	$today = date("d-m-Y H:i:s");

	$data = file_get_contents($log_file);
	$data .= '[' . $today . '] email status - ' . $status . ' customer email (' . $email . ")\n";
	file_put_contents($log_file, $data);

}