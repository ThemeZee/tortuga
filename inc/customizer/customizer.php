<?php
/**
 * Implement theme options in the Customizer
 *
 * @package zeePersonal
 */

 
// Load Customizer Helper Functions
require( get_template_directory() . '/inc/customizer/functions/custom-controls.php' );
require( get_template_directory() . '/inc/customizer/functions/sanitize-functions.php' );
require( get_template_directory() . '/inc/customizer/functions/callback-functions.php' );

// Load Customizer Section Files
require( get_template_directory() . '/inc/customizer/sections/customizer-general.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-post.php' );


/**
 * Registers Theme Options panel and sets up some WordPress core settings
 *
 */
function zeepersonal_customize_register_options( $wp_customize ) {

	// Add Theme Options Panel
	$wp_customize->add_panel( 'zeepersonal_options_panel', array(
		'priority'       => 180,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'zeepersonal' ),
		'description'    => '',
	) );
	
	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
} // zeepersonal_customize_register_options()
add_action( 'customize_register', 'zeepersonal_customize_register_options' );


/**
 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
 *
 */
function zeepersonal_customize_preview_js() {
	wp_enqueue_script( 'zeepersonal-customizer-js', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20150723', true );
}
add_action( 'customize_preview_init', 'zeepersonal_customize_preview_js' );


/**
 * Embed CSS styles for the theme options in the Customizer
 *
 */
function zeepersonal_customize_preview_css() {
	wp_enqueue_style( 'zeepersonal-customizer-css', get_template_directory_uri() . '/css/customizer.css', array(), '20150723' );
}
add_action( 'customize_controls_print_styles', 'zeepersonal_customize_preview_css' );