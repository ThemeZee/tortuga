<?php
/**
 * Main Navigation
 *
 * @version 1.0
 * @package Tortuga
 */
?>

<?php if ( has_nav_menu( 'primary' ) ) : ?>

	<div id="main-navigation-wrap" class="primary-navigation-wrap">

		<div class="primary-navigation-container container">

			<?php do_action( 'tortuga_header_search' ); ?>

			<button class="primary-menu-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<?php
				echo tortuga_get_svg( 'menu' );
				echo tortuga_get_svg( 'close' );
				?>
				<span class="menu-toggle-text screen-reader-text"><?php esc_html_e( 'Menu', 'tortuga' ); ?></span>
			</button>

			<div class="primary-navigation">

				<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'tortuga' ); ?>">

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'container'      => false,
						)
					);
					?>
				</nav><!-- #site-navigation -->

			</div><!-- .primary-navigation -->

		</div>

	</div>

<?php endif; ?>

<?php do_action( 'tortuga_after_navigation' ); ?>
