<?php
/**
 * Post Settings
 *
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 * @package Tortuga
 */


/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object
 */
function tortuga_customize_register_post_settings( $wp_customize ) {

	// Add Sections for Post Settings
	$wp_customize->add_section( 'tortuga_section_post', array(
        'title'    => esc_html__( 'Post Settings', 'tortuga' ),
        'priority' => 30,
		'panel' => 'tortuga_options_panel' 
		)
	);
	
	// Add Post Layout Settings for archive posts
	$wp_customize->add_setting( 'tortuga_theme_options[post_layout]', array(
        'default'           => 'two-columns',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'tortuga_sanitize_select'
		)
	);
    $wp_customize->add_control( 'tortuga_theme_options[post_layout]', array(
        'label'    => esc_html__( 'Post Layout (archive pages)', 'tortuga' ),
        'section'  => 'tortuga_section_post',
        'settings' => 'tortuga_theme_options[post_layout]',
        'type'     => 'select',
		'priority' => 1,
        'choices'  => array(
            'one-column' => esc_html__( 'One Column', 'tortuga' ),
            'two-columns' => esc_html__( 'Two Columns', 'tortuga' ),
			'three-columns' => esc_html__( 'Three Columns without Sidebar', 'tortuga' )
			)
		)
	);

	// Add Setting and Control for Excerpt Length
	$wp_customize->add_setting( 'tortuga_theme_options[excerpt_length]', array(
        'default'           => 20,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint'
		)
	);
    $wp_customize->add_control( 'tortuga_theme_options[excerpt_length]', array(
        'label'    => esc_html__( 'Excerpt Length', 'tortuga' ),
        'section'  => 'tortuga_section_post',
        'settings' => 'tortuga_theme_options[excerpt_length]',
        'type'     => 'text',
		'priority' => 2
		)
	);
	
	// Add Post Meta Settings
	$wp_customize->add_setting( 'tortuga_theme_options[postmeta_headline]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Tortuga_Customize_Header_Control(
        $wp_customize, 'tortuga_theme_options[postmeta_headline]', array(
            'label' => esc_html__( 'Post Meta', 'tortuga' ),
            'section' => 'tortuga_section_post',
            'settings' => 'tortuga_theme_options[postmeta_headline]',
            'priority' => 3
            )
        )
    );
	
	$wp_customize->add_setting( 'tortuga_theme_options[meta_date]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'tortuga_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'tortuga_theme_options[meta_date]', array(
        'label'    => esc_html__( 'Display post date', 'tortuga' ),
        'section'  => 'tortuga_section_post',
        'settings' => 'tortuga_theme_options[meta_date]',
        'type'     => 'checkbox',
		'priority' => 4
		)
	);
	
	$wp_customize->add_setting( 'tortuga_theme_options[meta_author]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'tortuga_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'tortuga_theme_options[meta_author]', array(
        'label'    => esc_html__( 'Display post author', 'tortuga' ),
        'section'  => 'tortuga_section_post',
        'settings' => 'tortuga_theme_options[meta_author]',
        'type'     => 'checkbox',
		'priority' => 5
		)
	);
	
	$wp_customize->add_setting( 'tortuga_theme_options[meta_category]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'tortuga_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'tortuga_theme_options[meta_category]', array(
        'label'    => esc_html__( 'Display post categories', 'tortuga' ),
        'section'  => 'tortuga_section_post',
        'settings' => 'tortuga_theme_options[meta_category]',
        'type'     => 'checkbox',
		'priority' => 6
		)
	);
	
	$wp_customize->add_setting( 'tortuga_theme_options[meta_comments]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'tortuga_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'tortuga_theme_options[meta_comments]', array(
        'label'    => esc_html__( 'Display post comments', 'tortuga' ),
        'section'  => 'tortuga_section_post',
        'settings' => 'tortuga_theme_options[meta_comments]',
        'type'     => 'checkbox',
		'priority' => 7
		)
	);
	
	// Add Single Post Settings
	$wp_customize->add_setting( 'tortuga_theme_options[single_post_headline]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Tortuga_Customize_Header_Control(
        $wp_customize, 'tortuga_theme_options[single_post_headline]', array(
            'label' => esc_html__( 'Single Posts', 'tortuga' ),
            'section' => 'tortuga_section_post',
            'settings' => 'tortuga_theme_options[single_post_headline]',
            'priority' => 8
            )
        )
    );
	
	// Featured Image Setting
	$wp_customize->add_setting( 'tortuga_theme_options[post_image_single]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'tortuga_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'tortuga_theme_options[post_image_single]', array(
        'label'    => esc_html__( 'Display featured image on single posts', 'tortuga' ),
        'section'  => 'tortuga_section_post',
        'settings' => 'tortuga_theme_options[post_image_single]',
        'type'     => 'checkbox',
		'priority' => 9
		)
	);
	
	$wp_customize->add_setting( 'tortuga_theme_options[meta_tags]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'tortuga_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'tortuga_theme_options[meta_tags]', array(
        'label'    => esc_html__( 'Display post tags on single posts', 'tortuga' ),
        'section'  => 'tortuga_section_post',
        'settings' => 'tortuga_theme_options[meta_tags]',
        'type'     => 'checkbox',
		'priority' => 10
		)
	);
	
	$wp_customize->add_setting( 'tortuga_theme_options[post_navigation]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'tortuga_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'tortuga_theme_options[post_navigation]', array(
        'label'    => esc_html__( 'Display post navigation on single posts', 'tortuga' ),
        'section'  => 'tortuga_section_post',
        'settings' => 'tortuga_theme_options[post_navigation]',
        'type'     => 'checkbox',
		'priority' => 11
		)
	);
	
}
add_action( 'customize_register', 'tortuga_customize_register_post_settings' );