<?php
/**
 * Blog Settings
 *
 * Register Blog Settings section, settings and controls for Theme Customizer
 *
 * @package Tortuga
 */

/**
 * Adds blog settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function tortuga_customize_register_blog_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'tortuga_section_blog', array(
		'title'    => esc_html__( 'Blog Settings', 'tortuga' ),
		'priority' => 25,
		'panel'    => 'tortuga_options_panel',
	) );

	// Add Post Layout Settings for archive posts.
	$wp_customize->add_setting( 'tortuga_theme_options[post_layout]', array(
		'default'           => 'two-columns',
		'type'              => 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'tortuga_sanitize_select',
		)
	);
	$wp_customize->add_control( 'tortuga_theme_options[post_layout]', array(
		'label'    => esc_html__( 'Blog Layout', 'tortuga' ),
		'section'  => 'tortuga_section_blog',
		'settings' => 'tortuga_theme_options[post_layout]',
		'type'     => 'select',
		'priority' => 10,
		'choices'  => array(
			'one-column'    => esc_html__( 'One Column', 'tortuga' ),
			'two-columns'   => esc_html__( 'Two Columns', 'tortuga' ),
			'three-columns' => esc_html__( 'Three Columns without Sidebar', 'tortuga' ),
		),
	) );

	// Add Blog Title setting and control.
	$wp_customize->add_setting( 'tortuga_theme_options[blog_title]', array(
		'default'           => '',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'tortuga_theme_options[blog_title]', array(
		'label'    => esc_html__( 'Blog Title', 'tortuga' ),
		'section'  => 'tortuga_section_blog',
		'settings' => 'tortuga_theme_options[blog_title]',
		'type'     => 'text',
		'priority' => 20,
	) );

	$wp_customize->selective_refresh->add_partial( 'tortuga_theme_options[blog_title]', array(
		'selector'         => '.blog-header .blog-title',
		'render_callback'  => 'tortuga_customize_partial_blog_title',
		'fallback_refresh' => false,
	) );

	// Add Blog Description setting and control.
	$wp_customize->add_setting( 'tortuga_theme_options[blog_description]', array(
		'default'           => '',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'tortuga_theme_options[blog_description]', array(
		'label'    => esc_html__( 'Blog Description', 'tortuga' ),
		'section'  => 'tortuga_section_blog',
		'settings' => 'tortuga_theme_options[blog_description]',
		'type'     => 'textarea',
		'priority' => 30,
	) );

	$wp_customize->selective_refresh->add_partial( 'tortuga_theme_options[blog_description]', array(
		'selector'         => '.blog-header .blog-description',
		'render_callback'  => 'tortuga_customize_partial_blog_description',
		'fallback_refresh' => false,
	) );

	// Add Magazine Widgets Headline.
	$wp_customize->add_control( new Tortuga_Customize_Header_Control(
		$wp_customize, 'tortuga_theme_options[blog_magazine_widgets_title]', array(
			'label'    => esc_html__( 'Magazine Widgets', 'tortuga' ),
			'section'  => 'tortuga_section_blog',
			'settings' => array(),
			'priority' => 40,
		)
	) );

	// Add Setting and Control for Magazine widgets.
	$wp_customize->add_setting( 'tortuga_theme_options[blog_magazine_widgets]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'tortuga_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'tortuga_theme_options[blog_magazine_widgets]', array(
		'label'    => esc_html__( 'Display Magazine widgets on blog index', 'tortuga' ),
		'section'  => 'tortuga_section_blog',
		'settings' => 'tortuga_theme_options[blog_magazine_widgets]',
		'type'     => 'checkbox',
		'priority' => 50,
	) );
}
add_action( 'customize_register', 'tortuga_customize_register_blog_settings' );

/**
 * Render the blog title for the selective refresh partial.
 */
function tortuga_customize_partial_blog_title() {
	$theme_options = tortuga_theme_options();
	echo wp_kses_post( $theme_options['blog_title'] );
}

/**
 * Render the blog description for the selective refresh partial.
 */
function tortuga_customize_partial_blog_description() {
	$theme_options = tortuga_theme_options();
	echo wp_kses_post( $theme_options['blog_description'] );
}
