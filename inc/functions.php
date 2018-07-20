<?php
/**
 * LearnPress Fill In Blank Functions
 *
 * Define common functions for both front-end and back-end
 *
 * @author   ThimPress
 * @package  LearnPress/Fill-In-Blank/Functions
 * @version  3.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'learn_press_fib_admin_view' ) ) {

	/**
	 * Get admin view file.
	 *
	 * @param $view
	 * @param string $args
	 */
	function learn_press_fib_admin_view( $view, $args = '' ) {
		learn_press_admin_view( $view, wp_parse_args( $args, array( 'plugin_file' => LP_ADDON_FILL_IN_BLANK_FILE ) ) );
	}
}

if ( ! function_exists( 'learn_press_fib_get_template' ) ) {
	/**
	 * Get template.
	 *
	 * @param $template_name
	 * @param array $args
	 */
	function learn_press_fib_get_template( $template_name, $args = array() ) {
		learn_press_get_template( $template_name, $args, learn_press_template_path() . '/addons/fill-in-blank/', LP_ADDON_FILL_IN_BLANK_PATH . '/templates/' );
	}
}