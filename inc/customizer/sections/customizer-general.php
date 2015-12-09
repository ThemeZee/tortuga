<?php
/**
 * General Settings
 *
 * Register General section, settings and controls for Theme Customizer
 *
 * @package zeePersonal
 */


/**
 * Adds all general settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object
 */
function zeepersonal_customize_register_general_settings( $wp_customize ) {

	// Add Section for Theme Options
	$wp_customize->add_section( 'zeepersonal_section_general', array(
        'title'    => esc_html__( 'General Settings', 'zeepersonal' ),
        'priority' => 10,
		'panel' => 'zeepersonal_options_panel' 
		)
	);
	
	// Add Settings and Controls for Layout
	$wp_customize->add_setting( 'zeepersonal_theme_options[layout]', array(
        'default'           => 'right-sidebar',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'zeepersonal_sanitize_layout'
		)
	);
    $wp_customize->add_control( 'zeepersonal_control_layout', array(
        'label'    => esc_html__( 'Theme Layout', 'zeepersonal' ),
        'section'  => 'zeepersonal_section_general',
        'settings' => 'zeepersonal_theme_options[layout]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'left-sidebar' => esc_html__( 'Left Sidebar', 'zeepersonal' ),
            'right-sidebar' => esc_html__( 'Right Sidebar', 'zeepersonal' )
			)
		)
	);
	
}
add_action( 'customize_register', 'zeepersonal_customize_register_general_settings' );