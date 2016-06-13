<?php
/**
 * Pro Version Upgrade Section
 *
 * Registers Upgrade Section for the Pro Version of the theme
 *
 * @package Tortuga
 */

/**
 * Adds pro version description and CTA button
 *
 * @param object $wp_customize / Customizer Object.
 */
function tortuga_customize_register_upgrade_settings( $wp_customize ) {

	// Add Upgrade / More Features Section.
	$wp_customize->add_section( 'tortuga_section_upgrade', array(
		'title'    => esc_html__( 'More Features', 'tortuga' ),
		'priority' => 70,
		'panel' => 'tortuga_options_panel',
		)
	);

	// Add custom Upgrade Content control.
	$wp_customize->add_setting( 'tortuga_theme_options[upgrade]', array(
		'default'           => '',
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control( new Tortuga_Customize_Upgrade_Control(
		$wp_customize, 'tortuga_theme_options[upgrade]', array(
		'section' => 'tortuga_section_upgrade',
		'settings' => 'tortuga_theme_options[upgrade]',
		'priority' => 1,
		)
	) );

}
add_action( 'customize_register', 'tortuga_customize_register_upgrade_settings' );
