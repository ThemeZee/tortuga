<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package zeePersonal
 */
 
// Get Theme Options from Database
$theme_options = zeepersonal_theme_options();
	
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

	<div id="page" class="hfeed site">
		
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'zeepersonal' ); ?></a>
		
		<header id="masthead" class="site-header clearfix" role="banner">
			
			<div class="header-main container clearfix">
						
				<div id="logo" class="site-branding clearfix">
				
					<?php do_action('zeepersonal_site_title'); ?>
				
				</div><!-- .site-branding -->
				
				<nav id="main-navigation" class="primary-navigation navigation clearfix" role="navigation">
					<?php 
						// Display Main Navigation
						wp_nav_menu( array(
							'theme_location' => 'primary', 
							'container' => false, 
							'menu_class' => 'main-navigation-menu', 
							'echo' => true, 
							'fallback_cb' => 'zeepersonal_default_menu')
						);
					?>
				</nav><!-- #main-navigation -->
			
			</div><!-- .header-main -->
		
		</header><!-- #masthead -->
		
		<?php // Display Custom Header Image
		zeepersonal_header_image(); ?>
		
		<div id="content" class="site-content container clearfix">
		