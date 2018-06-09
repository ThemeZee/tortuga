<?php
/**
 * Implement theme options in the Customizer
 *
 * @package Tortuga
 */

// Load Customizer Helper Functions.
require( get_template_directory() . '/inc/customizer/functions/custom-controls.php' );
require( get_template_directory() . '/inc/customizer/functions/magazine-widget-area-control.php' );
require( get_template_directory() . '/inc/customizer/functions/sanitize-functions.php' );
require( get_template_directory() . '/inc/customizer/functions/callback-functions.php' );

// Load Customizer Section Files.
require( get_template_directory() . '/inc/customizer/sections/customizer-general.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-blog.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-post.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-magazine.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-slider.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-upgrade.php' );

/**
 * Registers Theme Options panel and sets up some WordPress core settings
 *
 * @param object $wp_customize / Customizer Object.
 */
function tortuga_customize_register_options( $wp_customize ) {

	// Add Theme Options Panel.
	$wp_customize->add_panel( 'tortuga_options_panel', array(
		'priority'       => 180,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'tortuga' ),
		'description'    => tortuga_customize_theme_links(),
	) );

	// Change default background section.
	$wp_customize->get_control( 'background_color' )->section   = 'background_image';
	$wp_customize->get_section( 'background_image' )->title     = esc_html__( 'Background', 'tortuga' );

	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Add selective refresh for site title and description.
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'        => '.site-title a',
		'render_callback' => 'tortuga_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'        => '.site-description',
		'render_callback' => 'tortuga_customize_partial_blogdescription',
	) );

	// Add Display Site Title Setting.
	$wp_customize->add_setting( 'tortuga_theme_options[site_title]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'tortuga_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'tortuga_theme_options[site_title]', array(
		'label'    => esc_html__( 'Display Site Title', 'tortuga' ),
		'section'  => 'title_tagline',
		'settings' => 'tortuga_theme_options[site_title]',
		'type'     => 'checkbox',
		'priority' => 10,
		)
	);

	// Add Display Tagline Setting.
	$wp_customize->add_setting( 'tortuga_theme_options[site_description]', array(
		'default'           => false,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'tortuga_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'tortuga_theme_options[site_description]', array(
		'label'    => esc_html__( 'Display Tagline', 'tortuga' ),
		'section'  => 'title_tagline',
		'settings' => 'tortuga_theme_options[site_description]',
		'type'     => 'checkbox',
		'priority' => 11,
		)
	);

	// Add Header Image Link.
	$wp_customize->add_setting( 'tortuga_theme_options[custom_header_link]', array(
		'default'           => '',
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_url',
		)
	);
	$wp_customize->add_control( 'tortuga_control_custom_header_link', array(
		'label'    => esc_html__( 'Header Image Link', 'tortuga' ),
		'section'  => 'header_image',
		'settings' => 'tortuga_theme_options[custom_header_link]',
		'type'     => 'url',
		'priority' => 10,
		)
	);

	// Add Custom Header Hide Checkbox.
	$wp_customize->add_setting( 'tortuga_theme_options[custom_header_hide]', array(
		'default'           => false,
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'tortuga_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'tortuga_control_custom_header_hide', array(
		'label'    => esc_html__( 'Hide header image on front page', 'tortuga' ),
		'section'  => 'header_image',
		'settings' => 'tortuga_theme_options[custom_header_hide]',
		'type'     => 'checkbox',
		'priority' => 15,
		)
	);

} // tortuga_customize_register_options()
add_action( 'customize_register', 'tortuga_customize_register_options' );


/**
 * Render the site title for the selective refresh partial.
 */
function tortuga_customize_partial_blogname() {
	bloginfo( 'name' );
}


/**
 * Render the site tagline for the selective refresh partial.
 */
function tortuga_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


/**
 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
 */
function tortuga_customize_preview_js() {
	wp_enqueue_script( 'tortuga-customizer-preview', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20180609', true );
}
add_action( 'customize_preview_init', 'tortuga_customize_preview_js' );


/**
 * Embed CSS styles for the theme options in the Customizer
 */
function tortuga_customize_preview_css() {
	wp_enqueue_style( 'tortuga-customizer-css', get_template_directory_uri() . '/assets/css/customizer.css', array(), '20180609' );
}
add_action( 'customize_controls_print_styles', 'tortuga_customize_preview_css' );

/**
 * Returns Theme Links
 */
function tortuga_customize_theme_links() {

	ob_start();
	?>

		<div class="theme-links">

			<span class="customize-control-title"><?php esc_html_e( 'Theme Links', 'tortuga' ); ?></span>

			<p>
				<a href="<?php echo esc_url( __( 'https://themezee.com/themes/tortuga/', 'tortuga' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=tortuga&utm_content=theme-page" target="_blank">
					<?php esc_html_e( 'Theme Page', 'tortuga' ); ?>
				</a>
			</p>

			<p>
				<a href="http://preview.themezee.com/?demo=tortuga&utm_source=customizer&utm_campaign=tortuga" target="_blank">
					<?php esc_html_e( 'Theme Demo', 'tortuga' ); ?>
				</a>
			</p>

			<p>
				<a href="<?php echo esc_url( __( 'https://themezee.com/docs/tortuga-documentation/', 'tortuga' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=tortuga&utm_content=documentation" target="_blank">
					<?php esc_html_e( 'Theme Documentation', 'tortuga' ); ?>
				</a>
			</p>

			<p>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/support/theme/tortuga/reviews/?filter=5', 'tortuga' ) ); ?>" target="_blank">
					<?php esc_html_e( 'Rate this theme', 'tortuga' ); ?>
				</a>
			</p>

		</div>

	<?php
	$theme_links = ob_get_contents();
	ob_end_clean();

	return $theme_links;
}
