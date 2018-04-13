<?php
/**
 * Add Support for Theme Addons
 *
 * @package Tortuga
 */

/**
 * Register support for Jetpack and theme addons
 */
function tortuga_theme_addons_setup() {

	// Add theme support for Anderson Pro plugin.
	add_theme_support( 'tortuga-pro' );

	// Add theme support for ThemeZee Plugins.
	add_theme_support( 'themezee-breadcrumbs' );
	add_theme_support( 'themezee-mega-menu', array( 'primary', 'secondary' ) );

	// Add theme support for Widget Bundle.
	add_theme_support( 'themezee-widget-bundle', array(
		'thumbnail_size' => array( 90, 65 ),
	) );

	// Add theme support for Related Posts.
	add_theme_support( 'themezee-related-posts', array(
		'thumbnail_size' => array( 480, 320 ),
	) );

	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'post-wrapper',
		'footer_widgets' => array( 'footer-left', 'footer-center-left', 'footer-center-right', 'footer-right' ),
		'wrapper'        => false,
		'render'         => 'tortuga_infinite_scroll_render',
		'posts_per_page' => 6,
	) );

}
add_action( 'after_setup_theme', 'tortuga_theme_addons_setup' );


/**
 * Load custom stylesheets for theme addons
 */
function tortuga_theme_addons_scripts() {

	// Load widget bundle styles if widgets are active.
	if ( is_active_widget( 'TZWB_Facebook_Likebox_Widget', false, 'tzwb-facebook-likebox' )
		or is_active_widget( 'TZWB_Recent_Comments_Widget', false, 'tzwb-recent-comments' )
		or is_active_widget( 'TZWB_Recent_Posts_Widget', false, 'tzwb-recent-posts' )
		or is_active_widget( 'TZWB_Social_Icons_Widget', false, 'tzwb-social-icons' )
		or is_active_widget( 'TZWB_Tabbed_Content_Widget', false, 'tzwb-tabbed-content' )
	) {

		// Enqueue Widget Bundle stylesheet.
		wp_enqueue_style( 'themezee-widget-bundle', get_template_directory_uri() . '/assets/css/themezee-widget-bundle.css', array(), '20160421' );

	}

	// Load Related Posts stylesheet only on single posts.
	if ( is_singular( 'post' ) ) {

		// Enqueue Related Post stylesheet.
		wp_enqueue_style( 'themezee-related-posts', get_template_directory_uri() . '/assets/css/themezee-related-posts.css', array(), '20160421' );

	}

}
add_action( 'wp_enqueue_scripts', 'tortuga_theme_addons_scripts' );


/**
 * Custom render function for Infinite Scroll.
 */
function tortuga_infinite_scroll_render() {

	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content' );
	}

}
