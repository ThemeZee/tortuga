<?php
/**
 * Post Slider Setup
 *
 * Enqueues scripts and styles for the slideshow
 * Sets slideshow excerpt length and slider animation parameter
 * 
 * The template for displaying the slideshow can be found under /template-parts/post-slider.php
 *
 * @package Tortuga
 */

 
/**
 * Enqueue slider scripts and styles.
 */
function tortuga_slider_scripts() {
	
	// Get Theme Options from Database
	$theme_options = tortuga_theme_options();
	
	// Register and Enqueue FlexSlider JS and CSS if necessary
	if ( true == $theme_options['slider_blog'] or true == $theme_options['slider_magazine'] or is_page_template('template-slider.php') ) :

		// FlexSlider CSS
		wp_enqueue_style( 'tortuga-flexslider', get_template_directory_uri() . '/css/flexslider.css' );

		// FlexSlider JS
		wp_enqueue_script( 'tortuga-flexslider', get_template_directory_uri() .'/js/jquery.flexslider-min.js', array('jquery'), '2.6.0' );

		// Register and enqueue slider.js
		wp_enqueue_script( 'tortuga-post-slider', get_template_directory_uri() .'/js/slider.js', array('tortuga-flexslider') );

	endif;
	
} // tortuga_slider_scripts
add_action( 'wp_enqueue_scripts', 'tortuga_slider_scripts' );


/**
 * Function to change excerpt length for post slider
 *
 * @param int $length Length of excerpt in number of words
 * @return int
 */
function tortuga_slider_excerpt_length($length) {
    return 25;
}


if ( ! function_exists( 'tortuga_slider_meta' ) ):	
/**
 * Displays the date and author on slider posts
 */
function tortuga_slider_meta() {

	$postmeta = tortuga_meta_date();
	$postmeta .= tortuga_meta_author();
		
	echo '<div class="entry-meta">' . $postmeta . '</div>';

} // tortuga_slider_meta()
endif;


/**
 * Sets slider animation effect
 *
 * Passes parameters from theme options to the javascript files (js/slider.js)
 */
function tortuga_slider_options() { 
	
	// Get Theme Options from Database
	$theme_options = tortuga_theme_options();
	
	// Set Parameters array
	$params = array();
	
	// Define Slider Animation
	$params['animation'] = $theme_options['slider_animation'];
	
	// Define Slider Speed
	$params['speed'] = $theme_options['slider_speed'];
	
	// Passing Parameters to Javascript
	wp_localize_script( 'tortuga-post-slider', 'tortuga_slider_params', $params );
	
} // tortuga_slider_options
add_action('wp_enqueue_scripts', 'tortuga_slider_options');