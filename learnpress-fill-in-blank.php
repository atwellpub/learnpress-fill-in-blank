<?php
/*
Plugin Name: LearnPress - Fill In Blank Question
Plugin URI: http://thimpress.com/learnpress
Description: Supports type of question Fill In Blank lets user fill out the text into one ( or more than one ) space.
Author: ThimPress
Version: 3.0.3
Author URI: http://thimpress.com
Tags: learnpress, lms, add-on, fill-in-blank
Text Domain: learnpress-fill-in-blank
Domain Path: /languages/
*/

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

define( 'LP_ADDON_FILL_IN_BLANK_FILE', __FILE__ );
define( 'LP_ADDON_FILL_IN_BLANK_VER', '3.0.3' );
define( 'LP_ADDON_FILL_IN_BLANK_REQUIRE_VER', '3.0.0' );
define( 'LP_QUESTION_FILL_IN_BLANK_VER', '3.0.3' );

/**
 * Class LP_Addon_Fill_In_Blank_Preload
 */
class LP_Addon_Fill_In_Blank_Preload {

	/**
	 * LP_Addon_Fill_In_Blank_Preload constructor.
	 */
	public function __construct() {
		add_action( 'learn-press/ready', array( $this, 'load' ) );
	}

	/**
	 * Load addon
	 */
	public function load() {
		LP_Addon::load( 'LP_Addon_Fill_In_Blank', 'inc/load.php', __FILE__ );
	}

}

new LP_Addon_Fill_In_Blank_Preload();