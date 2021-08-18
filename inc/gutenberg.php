<?php
/**
 * Add theme support for the Gutenberg Editor
 *
 * @package Tortuga
 */


/**
 * Registers support for various Gutenberg features.
 *
 * @return void
 */
function tortuga_gutenberg_support() {

	// Add theme support for wide and full images.
	#add_theme_support( 'align-wide' );

	// Define block color palette.
	$color_palette = apply_filters( 'tortuga_color_palette', array(
		'primary_color'    => '#dd5533',
		'secondary_color'  => '#c43c1a',
		'tertiary_color'   => '#aa2200',
		'accent_color'     => '#3355dd',
		'highlight_color'  => '#2bc41a',
		'light_gray_color' => '#f0f0f0',
		'gray_color'       => '#999999',
		'dark_gray_color'  => '#303030',
	) );

	// Add theme support for block color palette.
	add_theme_support( 'editor-color-palette', apply_filters( 'tortuga_editor_color_palette_args', array(
		array(
			'name'  => esc_html_x( 'Primary', 'block color', 'tortuga' ),
			'slug'  => 'primary',
			'color' => esc_html( $color_palette['primary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Secondary', 'block color', 'tortuga' ),
			'slug'  => 'secondary',
			'color' => esc_html( $color_palette['secondary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Tertiary', 'block color', 'tortuga' ),
			'slug'  => 'tertiary',
			'color' => esc_html( $color_palette['tertiary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Accent', 'block color', 'tortuga' ),
			'slug'  => 'accent',
			'color' => esc_html( $color_palette['accent_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Highlight', 'block color', 'tortuga' ),
			'slug'  => 'highlight',
			'color' => esc_html( $color_palette['highlight_color'] ),
		),
		array(
			'name'  => esc_html_x( 'White', 'block color', 'tortuga' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => esc_html_x( 'Light Gray', 'block color', 'tortuga' ),
			'slug'  => 'light-gray',
			'color' => esc_html( $color_palette['light_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Gray', 'block color', 'tortuga' ),
			'slug'  => 'gray',
			'color' => esc_html( $color_palette['gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Dark Gray', 'block color', 'tortuga' ),
			'slug'  => 'dark-gray',
			'color' => esc_html( $color_palette['dark_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Black', 'block color', 'tortuga' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
	) ) );
}
add_action( 'after_setup_theme', 'tortuga_gutenberg_support' );


/**
 * Enqueue block styles and scripts for Gutenberg Editor.
 */
function tortuga_block_editor_assets() {

	// Enqueue Editor Styling.
	wp_enqueue_style( 'tortuga-editor-styles', get_theme_file_uri( '/assets/css/editor-styles.css' ), array(), '20210306', 'all' );

	// Enqueue Page Template Switcher Editor plugin.
	#wp_enqueue_script( 'tortuga-page-template-switcher', get_theme_file_uri( '/assets/js/page-template-switcher.js' ), array( 'wp-blocks', 'wp-element', 'wp-edit-post' ), '20210306' );
}
add_action( 'enqueue_block_editor_assets', 'tortuga_block_editor_assets' );


/**
 * Add body classes in Gutenberg Editor.
 */
function tortuga_block_editor_body_classes( $classes ) {
	global $post;
	$current_screen = get_current_screen();

	// Return early if we are not in the Gutenberg Editor.
	if ( ! ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) ) {
		return $classes;
	}

	// Fullwidth Page Template?
	if ( 'templates/template-fullwidth.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' tortuga-fullwidth-page-layout ';
	}

	// No Title Page Template?
	if ( 'templates/template-no-title.php' === get_page_template_slug( $post->ID ) or
		'templates/template-sidebar-left-no-title.php' === get_page_template_slug( $post->ID ) or
		'templates/template-sidebar-right-no-title.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' tortuga-page-title-hidden ';
	}

	// Full-width / No Title Page Template?
	if ( 'templates/template-fullwidth-no-title.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' tortuga-fullwidth-page-layout tortuga-page-title-hidden ';
	}

	return $classes;
}
#add_filter( 'admin_body_class', 'tortuga_block_editor_body_classes' );
