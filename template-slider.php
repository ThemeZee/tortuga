<?php
/**
 * Template Name: Post Slider
 *
 * Description: A custom page template which displays the post slider and page content
 *
 * @package Tortuga
 */

get_header();

// Display Slider.
if ( ! tortuga_is_amp() ) :

	get_template_part( 'template-parts/post-slider' );

endif;
?>

	<section id="primary" class="content-single content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				comments_template();

			endwhile; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
