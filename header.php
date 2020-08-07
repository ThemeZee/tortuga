<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Tortuga
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>

	<div id="page" class="hfeed site">

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'tortuga' ); ?></a>

		<?php do_action( 'tortuga_header_bar' ); ?>

		<header id="masthead" class="site-header clearfix" role="banner">

			<div class="header-main container clearfix">

				<div id="logo" class="site-branding clearfix">

					<?php tortuga_site_logo(); ?>
					<?php tortuga_site_title(); ?>
					<?php tortuga_site_description(); ?>

				</div><!-- .site-branding -->

				<div class="header-widgets clearfix">

					<?php // Display Header Widgets.
					if ( is_active_sidebar( 'header' ) ) :

						dynamic_sidebar( 'header' );

					endif; ?>

				</div><!-- .header-widgets -->

			</div><!-- .header-main -->

			<?php get_template_part( 'template-parts/header/site', 'navigation' ); ?>

		</header><!-- #masthead -->

		<?php tortuga_breadcrumbs(); ?>

		<?php tortuga_header_image(); ?>

		<div id="content" class="site-content container clearfix">
