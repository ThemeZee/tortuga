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

	// Add theme support for dimension controls.
	add_theme_support( 'custom-spacing' );

	// Add theme support for custom line heights.
	add_theme_support( 'custom-line-height' );

	// Define block color palette.
	$color_palette = apply_filters(
		'tortuga_color_palette',
		array(
			'primary_color'    => '#dd5533',
			'secondary_color'  => '#c43c1a',
			'tertiary_color'   => '#aa2200',
			'accent_color'     => '#3355dd',
			'highlight_color'  => '#2bc41a',
			'light_gray_color' => '#f0f0f0',
			'gray_color'       => '#999999',
			'dark_gray_color'  => '#303030',
		)
	);

	// Add theme support for block color palette.
	add_theme_support(
		'editor-color-palette',
		apply_filters(
			'tortuga_editor_color_palette_args',
			array(
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
			)
		)
	);

	// Check if block style functions are available.
	if ( function_exists( 'register_block_style' ) ) {

		// Register Widget Title Block style.
		register_block_style(
			'core/heading',
			array(
				'name'         => 'widget-title',
				'label'        => esc_html__( 'Widget Title', 'tortuga' ),
				'style_handle' => 'tortuga-stylesheet',
			)
		);
	}
}
add_action( 'after_setup_theme', 'tortuga_gutenberg_support' );


/**
 * Enqueue block styles and scripts for Gutenberg Editor.
 */
function tortuga_block_editor_assets() {

	// Enqueue Editor Styling.
	wp_enqueue_style( 'tortuga-editor-styles', get_theme_file_uri( '/assets/css/editor-styles.css' ), array(), '20210306', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'tortuga_block_editor_assets' );
