<?php
/**
 * Theme Links Control for the Customizer
 *
 * @package Tortuga
 */

/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays the theme links in the Customizer.
	 */
	class Tortuga_Customize_Links_Control extends WP_Customize_Control {
		/**
		 * Render Control
		 */
		public function render_content() {
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
					<a href="<?php echo esc_url( __( 'https://themezee.com/changelogs/?action=themezee-changelog&type=theme&slug=tortuga/', 'tortuga' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Theme Changelog', 'tortuga' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://wordpress.org/support/theme/tortuga/reviews/', 'tortuga' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Rate this theme', 'tortuga' ); ?>
					</a>
				</p>

			</div>

			<?php
		}
	}

endif;
