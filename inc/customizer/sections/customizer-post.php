<?php
/**
 * Post Settings
 *
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 * @package zeePersonal
 */


/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object
 */
function zeepersonal_customize_register_post_settings( $wp_customize ) {

	// Add Sections for Post Settings
	$wp_customize->add_section( 'zeepersonal_section_post', array(
        'title'    => esc_html__( 'Post Settings', 'zeepersonal' ),
        'priority' => 30,
		'panel' => 'zeepersonal_options_panel' 
		)
	);
	
	// Add Settings and Controls for post content
	$wp_customize->add_setting( 'zeepersonal_theme_options[post_content]', array(
        'default'           => 'excerpt',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zeepersonal_sanitize_post_content'
		)
	);
    $wp_customize->add_control( 'zeepersonal_control_post_content', array(
        'label'    => esc_html__( 'Post length on archives', 'zeepersonal' ),
        'section'  => 'zeepersonal_section_post',
        'settings' => 'zeepersonal_theme_options[post_content]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'index' => esc_html__( 'Show full posts', 'zeepersonal' ),
            'excerpt' => esc_html__( 'Show post excerpts', 'zeepersonal' )
			)
		)
	);
	
	// Add Setting and Control for Excerpt Length
	$wp_customize->add_setting( 'zeepersonal_theme_options[excerpt_length]', array(
        'default'           => 30,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint'
		)
	);
    $wp_customize->add_control( 'zeepersonal_control_excerpt_length', array(
        'label'    => esc_html__( 'Excerpt Length', 'zeepersonal' ),
        'section'  => 'zeepersonal_section_post',
        'settings' => 'zeepersonal_theme_options[excerpt_length]',
        'type'     => 'text',
		'active_callback' => 'zeepersonal_control_post_content_callback',
		'priority' => 2
		)
	);
	
	// Add Post Images Settings
	$wp_customize->add_setting( 'zeepersonal_theme_options[post_images_headline]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new zeePersonal_Customize_Header_Control(
        $wp_customize, 'zeepersonal_control_post_images_headline', array(
            'label' => esc_html__( 'Post Images', 'zeepersonal' ),
            'section' => 'zeepersonal_section_post',
            'settings' => 'zeepersonal_theme_options[post_images_headline]',
            'priority' => 3
            )
        )
    );
	$wp_customize->add_setting( 'zeepersonal_theme_options[post_thumbnail_archives]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zeepersonal_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'zeepersonal_control_post_thumbnail_archive', array(
        'label'    => esc_html__( 'Display featured images on archives', 'zeepersonal' ),
        'section'  => 'zeepersonal_section_post',
        'settings' => 'zeepersonal_theme_options[post_thumbnail_archives]',
        'type'     => 'checkbox',
		'priority' => 4
		)
	);
	$wp_customize->add_setting( 'zeepersonal_theme_options[post_thumbnail_single]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zeepersonal_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'zeepersonal_control_post_thumbnail_single', array(
        'label'    => esc_html__( 'Display featured images on single posts', 'zeepersonal' ),
        'section'  => 'zeepersonal_section_post',
        'settings' => 'zeepersonal_theme_options[post_thumbnail_single]',
        'type'     => 'checkbox',
		'priority' => 5
		)
	);
	
	// Add Post Meta Settings
	$wp_customize->add_setting( 'zeepersonal_theme_options[post_meta_headline]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new zeePersonal_Customize_Header_Control(
        $wp_customize, 'zeepersonal_control_post_meta_headline', array(
            'label' => esc_html__( 'Post Meta', 'zeepersonal' ),
            'section' => 'zeepersonal_section_post',
            'settings' => 'zeepersonal_theme_options[post_meta_headline]',
            'priority' => 6
            )
        )
    );
	$wp_customize->add_setting( 'zeepersonal_theme_options[meta_date]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zeepersonal_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'zeepersonal_control_meta_date', array(
        'label'    => esc_html__( 'Display post date', 'zeepersonal' ),
        'section'  => 'zeepersonal_section_post',
        'settings' => 'zeepersonal_theme_options[meta_date]',
        'type'     => 'checkbox',
		'priority' => 7
		)
	);
	$wp_customize->add_setting( 'zeepersonal_theme_options[meta_author]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zeepersonal_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'zeepersonal_control_meta_author', array(
        'label'    => esc_html__( 'Display post author', 'zeepersonal' ),
        'section'  => 'zeepersonal_section_post',
        'settings' => 'zeepersonal_theme_options[meta_author]',
        'type'     => 'checkbox',
		'priority' => 8
		)
	);
	$wp_customize->add_setting( 'zeepersonal_theme_options[meta_category]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zeepersonal_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'zeepersonal_control_meta_category', array(
        'label'    => esc_html__( 'Display post categories', 'zeepersonal' ),
        'section'  => 'zeepersonal_section_post',
        'settings' => 'zeepersonal_theme_options[meta_category]',
        'type'     => 'checkbox',
		'priority' => 9
		)
	);
	$wp_customize->add_setting( 'zeepersonal_theme_options[meta_comments]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zeepersonal_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'zeepersonal_control_meta_comments', array(
        'label'    => esc_html__( 'Display post comments', 'zeepersonal' ),
        'section'  => 'zeepersonal_section_post',
        'settings' => 'zeepersonal_theme_options[meta_comments]',
        'type'     => 'checkbox',
		'priority' => 10
		)
	);
		$wp_customize->add_setting( 'zeepersonal_theme_options[meta_tags]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zeepersonal_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'zeepersonal_control_meta_tags', array(
        'label'    => esc_html__( 'Display post tags', 'zeepersonal' ),
        'section'  => 'zeepersonal_section_post',
        'settings' => 'zeepersonal_theme_options[meta_tags]',
        'type'     => 'checkbox',
		'priority' => 11
		)
	);
	
}
add_action( 'customize_register', 'zeepersonal_customize_register_post_settings' );