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
require_once 'requests/rest-api/hubspot.php';
require_once 'inc/email-log.php';
require_once 'inc/hubspot-log.php';

/*
 * Load custom template and add it to admin
 */
add_filter( 'page_template', 'custom_page_template' );
add_filter( 'theme_page_templates', 'custom_page_template_admin', 10, 4 );
function custom_page_template( $page_template ){

	if ( get_page_template_slug() == 'templates/form-page-template.php' ) {
		$page_template = dirname( __FILE__ ) . '/templates/form-page-template.php';
	}
	return $page_template;
}
function custom_page_template_admin( $post_templates, $wp_theme, $post, $post_type ) {

	$post_templates['templates/form-page-template.php'] = __('SmartApp Form');

	return $post_templates;
}

/**
 * Load CSS and JS only on page template
 */
function form_css_and_js(){
	if ( is_page_template('templates/form-page-template.php') ) {
		wp_enqueue_style( 'form-css', plugins_url( '/css/smart-app.css', __FILE__ ) );
		wp_enqueue_script('form-script', plugins_url( '/js/form.js', __FILE__ ), array('jquery'), '1.0', true);
	}
}
add_action( 'wp_enqueue_scripts', 'form_css_and_js' );

/**
 * Fix jQuery in Twenty Twenty-One WordPress theme
 */
add_action('wp_enqueue_scripts', function (){
	wp_enqueue_script('jquery');
});
