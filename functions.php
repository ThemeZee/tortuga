<?php
/**
 * zeePersonal functions and definitions
 *
 * @package zeePersonal
 */

/**
 * zeePersonal only works in WordPress 4.2 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.2', '<' ) ) :
	require get_template_directory() . '/inc/back-compat.php';
endif;


if ( ! function_exists( 'zeepersonal_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function zeepersonal_setup() {

	// Make theme available for translation. Translations can be filed in the /languages/ directory.
	load_theme_textdomain( 'zeepersonal', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	
	// Set detfault Post Thumbnail size
	set_post_thumbnail_size( 900, 400, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Main Navigation', 'zeepersonal' ),
		'footer' => esc_html__( 'Footer Navigation', 'zeepersonal' )
	) );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'zeepersonal_custom_background_args', array('default-color' => 'e5e5e5') ) );
	
	// Set up the WordPress core custom header feature.
	add_theme_support('custom-header', apply_filters( 'zeepersonal_custom_header_args', array(
		'header-text' => false,
		'width'	=> 2500,
		'height' => 250,
		'flex-height' => true
	) ) );
	
}
endif; // zeepersonal_setup
add_action( 'after_setup_theme', 'zeepersonal_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zeepersonal_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'zeepersonal_content_width', 810 );
}
add_action( 'after_setup_theme', 'zeepersonal_content_width', 0 );


/**
 * Register widget areas and custom widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function zeepersonal_widgets_init() {
	
	register_sidebar( array(
		'name' => esc_html__( 'Sidebar', 'zeepersonal' ),
		'id' => 'sidebar',
		'description' => esc_html__( 'Appears on posts and pages except Magazine Homepage and Fullwidth template.', 'zeepersonal' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-header"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));
	
	register_sidebar( array(
		'name' => esc_html__( 'Header', 'zeepersonal' ),
		'id' => 'header',
		'description' => esc_html__( 'Appears on header area. You can use a search or ad widget here.', 'zeepersonal' ),
		'before_widget' => '<aside id="%1$s" class="header-widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="header-widget-title">',
		'after_title' => '</h4>',
	));
	
} // zeepersonal_widgets_init
add_action( 'widgets_init', 'zeepersonal_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function zeepersonal_scripts() {
	global $wp_scripts;
	
	// Register and Enqueue Stylesheet
	wp_enqueue_style( 'zeepersonal-stylesheet', get_stylesheet_uri() );
	
	// Register Genericons
	wp_enqueue_style( 'zeepersonal-genericons', get_template_directory_uri() . '/css/genericons/genericons.css' );
	
	// Register and Enqueue HTML5shiv to support HTML5 elements in older IE versions
	wp_enqueue_script( 'zeepersonal-html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js', array(), '3.7.2', false );
	$wp_scripts->add_data( 'zeepersonal-html5shiv', 'conditional', 'lt IE 9' );

	// Register and enqueue navigation.js
	wp_enqueue_script( 'zeepersonal-jquery-navigation', get_template_directory_uri() .'/js/navigation.js', array('jquery') );
	
	// Register and enqueue sidebar.js
	wp_enqueue_script( 'zeepersonal-jquery-sidebar', get_template_directory_uri() .'/js/sidebar.js', array('jquery') );
	
	// Register and Enqueue Google Fonts
	wp_enqueue_style( 'zeepersonal-default-fonts', zeepersonal_google_fonts_url(), array(), null );

	// Register Comment Reply Script for Threaded Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
} // zeepersonal_scripts
add_action( 'wp_enqueue_scripts', 'zeepersonal_scripts' );


/**
 * Retrieve Font URL to register default Google Fonts
 */
function zeepersonal_google_fonts_url() {
    
	// Set default Fonts
	$font_families = array( 'Open Sans', 'Merriweather' );

	// Build Fonts URL
	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);
	$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return apply_filters( 'zeepersonal_google_fonts_url', $fonts_url );
}


/**
 * Include Files
 */
 
// include Theme Customizer Options
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/default-options.php';

// Include Extra Functions
require get_template_directory() . '/inc/extras.php';

// include Template Functions
require get_template_directory() . '/inc/template-tags.php';