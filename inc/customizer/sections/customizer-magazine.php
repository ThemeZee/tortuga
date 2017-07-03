<?php
/**
 * Magazine Widget Area
 *
 * Enhances the Magazine widget area with custom Magazine Widget Control.
 *
 * @package Tortuga
 */

/**
 * Add custom Magazine Widget Area Control to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function tortuga_customize_register_magazine_widget_area_control( $wp_customize ) {

	// Set Magazine Homepage widget variables.
	$magazine_sidebar_id = 'magazine-homepage';
	$magazine_section_id = sprintf( 'sidebar-widgets-%s', $magazine_sidebar_id );
	$magazine_setting_id = sprintf( 'sidebars_widgets[%s]', $magazine_sidebar_id );

	// Remove Default Control.
	$wp_customize->remove_control( $magazine_setting_id );

	// Create New Control.
	$magazine_control = new Tortuga_Magazine_Widget_Area_Customize_Control( $wp_customize, $magazine_setting_id, array(
		'section'    => $magazine_section_id,
		'sidebar_id' => $magazine_sidebar_id,
		'priority'   => 999,
	) );

	// Add new Control.
	$wp_customize->add_control( $magazine_control );

	// Add Partial for Magazine Placeholder.
	$wp_customize->selective_refresh->add_partial( $magazine_setting_id, array(
		'selector'            => '#magazine-placeholder',
		'render_callback'     => 'tortuga_customize_magazine_placeholder',
		'container_inclusive' => true,
	) );
}
add_action( 'customize_register', 'tortuga_customize_register_magazine_widget_area_control' );


/**
 * Displays a Placeholder for adding Magazine widgets.
 */
function tortuga_customize_magazine_placeholder() {
	// Show Magazine Widget Placeholder only in Customizer preview.
	if ( is_customize_preview() ) {
		echo '<div id="magazine-placeholder" class="magazine-widgets-placeholder type-post"><span class="magazine-widgets-placeholder-title">' . esc_html__( 'Add Magazine Widget', 'tortuga' ) . '</span></div>';
	}
}
