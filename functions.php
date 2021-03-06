<?php
/**
 * Tortuga functions and definitions
 *
 * @package Tortuga
 */

/**
 * Tortuga only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}


if ( ! function_exists( 'tortuga_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tortuga_setup() {

		// Make theme available for translation. Translations can be filed in the /languages/ directory.
		load_theme_textdomain( 'tortuga', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Set detfault Post Thumbnail size.
		set_post_thumbnail_size( 900, 400, true );

		// Register Navigation Menu.
		register_nav_menu( 'primary', esc_html__( 'Main Navigation', 'tortuga' ) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'tortuga_custom_background_args', array( 'default-color' => 'dddddd' ) ) );

		// Set up the WordPress core custom logo feature.
		add_theme_support( 'custom-logo', apply_filters( 'tortuga_custom_logo_args', array(
			'height'      => 50,
			'width'       => 250,
			'flex-height' => true,
			'flex-width'  => true,
		) ) );

		// Set up the WordPress core custom header feature.
		add_theme_support( 'custom-header', apply_filters( 'tortuga_custom_header_args', array(
			'header-text' => false,
			'width'       => 1920,
			'height'      => 480,
			'flex-height' => true,
		) ) );

		// Add Theme Support for wooCommerce.
		add_theme_support( 'woocommerce' );

		// Add extra theme styling to the visual editor.
		add_editor_style( array( 'assets/css/editor-style.css' ) );

		// Add Theme Support for Selective Refresh in Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for responsive embed blocks.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'tortuga_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tortuga_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tortuga_content_width', 840 );
}
add_action( 'after_setup_theme', 'tortuga_content_width', 0 );


/**
 * Register widget areas and custom widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function tortuga_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'tortuga' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Appears on posts and pages except the full width template.', 'tortuga' ),
		'before_widget' => '<div class="widget-wrap"><aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<div class="widget-header"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header', 'tortuga' ),
		'id'            => 'header',
		'description'   => esc_html__( 'Appears on header area. You can use a search or ad widget here.', 'tortuga' ),
		'before_widget' => '<aside id="%1$s" class="header-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="header-widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Magazine Homepage', 'tortuga' ),
		'id'            => 'magazine-homepage',
		'description'   => esc_html__( 'Appears on blog index and Magazine Homepage template. You can use the Magazine widgets here.', 'tortuga' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-header"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );
}
add_action( 'widgets_init', 'tortuga_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function tortuga_scripts() {

	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Register and Enqueue Stylesheet.
	wp_enqueue_style( 'tortuga-stylesheet', get_stylesheet_uri(), array(), $theme_version );

	// Register and Enqueue Safari Flexbox CSS fixes.
	wp_enqueue_style( 'tortuga-safari-flexbox-fixes', get_template_directory_uri() . '/assets/css/safari-flexbox-fixes.css', array(), '20200420' );

	// Register Genericons.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/assets/genericons/genericons.css', array(), '3.4.1' );

	// Register and Enqueue HTML5shiv to support HTML5 elements in older IE versions.
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/assets/js/html5shiv.min.js', array(), '3.7.3' );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	// Register and enqueue navigation.min.js.
	if ( ( has_nav_menu( 'primary' ) || has_nav_menu( 'secondary' ) ) && ! tortuga_is_amp() ) {
		wp_enqueue_script( 'tortuga-navigation', get_theme_file_uri( '/assets/js/navigation.min.js' ), array( 'jquery' ), '20200822', true );
		$tortuga_l10n = array(
			'expand'   => esc_html__( 'Expand child menu', 'tortuga' ),
			'collapse' => esc_html__( 'Collapse child menu', 'tortuga' ),
			'icon'     => tortuga_get_svg( 'expand' ),
		);
		wp_localize_script( 'tortuga-navigation', 'tortugaScreenReaderText', $tortuga_l10n );
	}

	// Enqueue svgxuse to support external SVG Sprites in Internet Explorer.
	if ( ! tortuga_is_amp() ) {
		wp_enqueue_script( 'svgxuse', get_theme_file_uri( '/assets/js/svgxuse.min.js' ), array(), '1.2.6' );
	}

	// Register Comment Reply Script for Threaded Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tortuga_scripts' );


/**
* Enqueue theme fonts.
*/
function tortuga_theme_fonts() {
	$fonts_url = tortuga_get_fonts_url();

	// Load Fonts if necessary.
	if ( $fonts_url ) {
		require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
		wp_enqueue_style( 'tortuga-theme-fonts', wptt_get_webfont_url( $fonts_url ), array(), '20201110' );
	}
}
add_action( 'wp_enqueue_scripts', 'tortuga_theme_fonts', 1 );
add_action( 'enqueue_block_editor_assets', 'tortuga_theme_fonts', 1 );


/**
 * Retrieve webfont URL to load fonts locally.
 */
function tortuga_get_fonts_url() {
	$font_families = array(
		'Open Sans:400,400italic,700,700italic',
		'Titillium Web:400,400italic,700,700italic',
	);

	$query_args = array(
		'family'  => urlencode( implode( '|', $font_families ) ),
		'subset'  => urlencode( 'latin,latin-ext' ),
		'display' => urlencode( 'swap' ),
	);

	return apply_filters( 'tortuga_get_fonts_url', add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) );
}


/**
 * Add custom sizes for featured images
 */
function tortuga_add_image_sizes() {

	// Add Slider Image Size.
	add_image_size( 'tortuga-slider-image', 780, 420, true );

	// Add different thumbnail sizes for Magazine Posts widgets.
	add_image_size( 'tortuga-thumbnail-small', 120, 80, true );
	add_image_size( 'tortuga-thumbnail-medium', 360, 200, true );
	add_image_size( 'tortuga-thumbnail-large', 600, 330, true );
}
add_action( 'after_setup_theme', 'tortuga_add_image_sizes' );


/**
 * Make custom image sizes available in Gutenberg.
 */
function tortuga_add_image_size_names( $sizes ) {
	return array_merge( $sizes, array(
		'post-thumbnail'          => esc_html__( 'Tortuga Single Post', 'tortuga' ),
		'tortuga-thumbnail-large' => esc_html__( 'Tortuga Magazine Post', 'tortuga' ),
		'tortuga-thumbnail-small' => esc_html__( 'Tortuga Thumbnail', 'tortuga' ),
	) );
}
add_filter( 'image_size_names_choose', 'tortuga_add_image_size_names' );


/**
 * Include Files
 */

// Include Theme Info page.
require get_template_directory() . '/inc/theme-info.php';

// Include Theme Customizer Options.
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/default-options.php';

// Include SVG Icon Functions.
require get_template_directory() . '/inc/icons.php';

// Include Extra Functions.
require get_template_directory() . '/inc/extras.php';

// Include Template Functions.
require get_template_directory() . '/inc/template-tags.php';

// Include Gutenberg Features.
require get_template_directory() . '/inc/gutenberg.php';

// Include support functions for Theme Addons.
require get_template_directory() . '/inc/addons.php';

// Include Post Slider Setup.
require get_template_directory() . '/inc/slider.php';

// Include Magazine Functions.
require get_template_directory() . '/inc/magazine.php';

// Include Widget Files.
require get_template_directory() . '/inc/widgets/widget-magazine-posts-columns.php';
require get_template_directory() . '/inc/widgets/widget-magazine-posts-grid.php';
require get_template_directory() . '/inc/widgets/widget-magazine-posts-horizontal-box.php';
require get_template_directory() . '/inc/widgets/widget-magazine-posts-vertical-box.php';
