<?php
/**
 * The template for displaying search results pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Tortuga
 */

get_header();

// Get Theme Options from Database.
$theme_options = tortuga_theme_options();
?>

	<section id="primary" class="content-archive content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :  ?>

			<header class="page-header">

				<h1 class="archive-title"><?php printf( esc_html__( 'Search Results for: %s', 'tortuga' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
				<p><?php get_search_form(); ?></p>

			</header><!-- .page-header -->

			<div id="post-wrapper" class="post-wrapper clearfix">

				<?php while ( have_posts() ) : the_post();

					if ( 'post' === get_post_type() ) :

						get_template_part( 'template-parts/content' );

					else :

						get_template_part( 'template-parts/content', 'search' );

					endif;

				endwhile; ?>

			</div>

			<?php tortuga_pagination(); ?>

		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php // Do not display Sidebar on Three Column Post Layout.
	if ( 'three-columns' !== $theme_options['post_layout'] ) :

		get_sidebar();

	endif; ?>

<?php get_footer(); ?>
