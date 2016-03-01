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
	
	// Add Title for latest posts setting
	$wp_customize->add_setting( 'tortuga_theme_options[latest_posts_title]', array(
        'default'           => esc_html__( 'Latest Posts', 'tortuga' ),
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_html'
		)
	);
    $wp_customize->add_control( 'tortuga_theme_options[latest_posts_title]', array(
        'label'    => esc_html__( 'Title above Latest Posts', 'tortuga' ),
        'section'  => 'tortuga_section_post',
        'settings' => 'tortuga_theme_options[latest_posts_title]',
        'type'     => 'text',
		'priority' => 1
		)
	);

	// Add Settings and Controls for post content
	$wp_customize->add_setting( 'tortuga_theme_options[post_content]', array(
        'default'           => 'excerpt',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'tortuga_sanitize_select'
		)
	);
    $wp_customize->add_control( 'tortuga_theme_options[post_content]', array(
        'label'    => esc_html__( 'Post length on archives', 'tortuga' ),
        'section'  => 'tortuga_section_post',
        'settings' => 'tortuga_theme_options[post_content]',
        'type'     => 'radio',
		'priority' => 2,
        'choices'  => array(
            'index' => esc_html__( 'Show full posts', 'tortuga' ),
            'excerpt' => esc_html__( 'Show post excerpts', 'tortuga' )
			)
		)
	);
	
	// Add Setting and Control for Excerpt Length
	$wp_customize->add_setting( 'tortuga_theme_options[excerpt_length]', array(
        'default'           => 30,
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
		'active_callback' => 'tortuga_control_post_content_callback',
		'priority' => 3
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
            'priority' => 4
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
		'priority' => 5
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
		'priority' => 6
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
		'priority' => 7
		)
	);

	$wp_customize->add_setting( 'tortuga_theme_options[meta_tags]', array(
        'default'           => false,
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
		'priority' => 8
		)
	);
	
	// Add Post Footer Settings
	$wp_customize->add_setting( 'tortuga_theme_options[post_footer_headline]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Tortuga_Customize_Header_Control(
        $wp_customize, 'tortuga_theme_options[post_footer_headline]', array(
            'label' => esc_html__( 'Post Footer', 'tortuga' ),
            'section' => 'tortuga_section_post',
            'settings' => 'tortuga_theme_options[post_footer_headline]',
            'priority' => 9
            )
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
		'priority' => 10
		)
	);
	
}
add_action( 'customize_register', 'tortuga_customize_register_post_settings' );