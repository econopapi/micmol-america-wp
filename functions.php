<?php
/**
 * MicMol América Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MicMol América
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_MICMOL_AMERICA_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {
	// Google Fonts (Manrope) used by MicMol hero block
	wp_enqueue_style( 'micmol-google-fonts', 'https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600;800;900&display=swap', array(), null );

	wp_enqueue_style( 'micmol-america-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_MICMOL_AMERICA_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

/*
 * Load theme includes (blocks, helpers, etc.)
 */
if ( file_exists( get_stylesheet_directory() . '/includes/blocks.php' ) ) {
	require_once get_stylesheet_directory() . '/includes/blocks.php';
}