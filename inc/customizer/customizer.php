<?php
/**
 * Implement theme options in the Customizer
 *
 * @package Tortuga
 */

 
// Load Customizer Helper Functions
require( get_template_directory() . '/inc/customizer/functions/custom-controls.php' );
require( get_template_directory() . '/inc/customizer/functions/sanitize-functions.php' );
require( get_template_directory() . '/inc/customizer/functions/callback-functions.php' );

// Load Customizer Section Files
require( get_template_directory() . '/inc/customizer/sections/customizer-general.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-post.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-slider.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-upgrade.php' );


/**
 * Registers Theme Options panel and sets up some WordPress core settings
 *
 */
function tortuga_customize_register_options( $wp_customize ) {

	// Add Theme Options Panel
	$wp_customize->add_panel( 'tortuga_options_panel', array(
		'priority'       => 180,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'tortuga' ),
		'description'    => '',
	) );
	
	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	// Change default background section
	$wp_customize->get_control( 'background_color'  )->section   = 'background_image';
	$wp_customize->get_section( 'background_image'  )->title     = esc_html__( 'Background', 'tortuga' );
	
	// Add Display Site Title Setting
	$wp_customize->add_setting( 'tortuga_theme_options[site_title]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'tortuga_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'tortuga_theme_options[site_title]', array(
        'label'    => esc_html__( 'Display Site Title', 'tortuga' ),
        'section'  => 'title_tagline',
        'settings' => 'tortuga_theme_options[site_title]',
        'type'     => 'checkbox',
		'priority' => 10
		)
	);
	
	// Add Display Tagline Setting
	$wp_customize->add_setting( 'tortuga_theme_options[site_description]', array(
        'default'           => false,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'tortuga_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'tortuga_theme_options[site_description]', array(
        'label'    => esc_html__( 'Display Tagline', 'tortuga' ),
        'section'  => 'title_tagline',
        'settings' => 'tortuga_theme_options[site_description]',
        'type'     => 'checkbox',
		'priority' => 11
		)
	);
	
	// Add Header Image Link
	$wp_customize->add_setting( 'tortuga_theme_options[custom_header_link]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_url'
		)
	);
    $wp_customize->add_control( 'tortuga_control_custom_header_link', array(
        'label'    => esc_html__( 'Header Image Link', 'tortuga' ),
        'section'  => 'header_image',
        'settings' => 'tortuga_theme_options[custom_header_link]',
        'type'     => 'url',
		'priority' => 10
		)
	);
	
	// Add Custom Header Hide Checkbox
	$wp_customize->add_setting( 'tortuga_theme_options[custom_header_hide]', array(
        'default'           => false,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'tortuga_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'tortuga_control_custom_header_hide', array(
        'label'    => esc_html__( 'Hide header image on front page', 'tortuga' ),
        'section'  => 'header_image',
        'settings' => 'tortuga_theme_options[custom_header_hide]',
        'type'     => 'checkbox',
		'priority' => 15
		)
	);
	
} // tortuga_customize_register_options()
add_action( 'customize_register', 'tortuga_customize_register_options' );


/**
 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
 *
 */
function tortuga_customize_preview_js() {
	wp_enqueue_script( 'tortuga-customizer-preview', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151202', true );
}
add_action( 'customize_preview_init', 'tortuga_customize_preview_js' );


/**
 * Embed JS file for Customizer Controls
 *
 */
function tortuga_customize_controls_js() {
	
	wp_enqueue_script( 'tortuga-customizer-controls', get_template_directory_uri() . '/js/customizer-controls.js', array(), '20151202', true );
	
	// Localize the script
	wp_localize_script( 'tortuga-customizer-controls', 'tortuga_theme_links', array(
		'title'	=> esc_html__( 'Theme Links', 'tortuga' ),
		'themeURL'	=> esc_url( __( 'https://themezee.com/themes/tortuga/', 'tortuga' ) . '?utm_source=customizer&utm_medium=textlink&utm_campaign=tortuga&utm_content=theme-page' ),
		'themeLabel'	=> esc_html__( 'Theme Page', 'tortuga' ),
		'docuURL'	=> esc_url( __( 'https://themezee.com/docs/tortuga-documentation/', 'tortuga' ) . '?utm_source=customizer&utm_medium=textlink&utm_campaign=tortuga&utm_content=documentation' ),
		'docuLabel'	=>  esc_html__( 'Theme Documentation', 'tortuga' ),
		'rateURL'	=> esc_url( 'http://wordpress.org/support/view/theme-reviews/tortuga?filter=5' ),
		'rateLabel'	=> esc_html__( 'Rate this theme', 'tortuga' ),
		)
	);

}
add_action( 'customize_controls_enqueue_scripts', 'tortuga_customize_controls_js' );


/**
 * Embed CSS styles for the theme options in the Customizer
 *
 */
function tortuga_customize_preview_css() {
	wp_enqueue_style( 'tortuga-customizer-css', get_template_directory_uri() . '/css/customizer.css', array(), '20151202' );
}
add_action( 'customize_controls_print_styles', 'tortuga_customize_preview_css' );