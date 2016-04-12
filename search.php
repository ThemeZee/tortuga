<?php
/**
 * The template for displaying search results pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Tortuga
 */
 
get_header(); 

// Get Theme Options from Database
$theme_options = tortuga_theme_options();
?>

	<section id="primary" class="content-archive content-area">
		<main id="main" class="site-main" role="main">
					
			<header class="page-header">
				
				<h1 class="archive-title"><?php printf( esc_html__( 'Search Results for: %s', 'tortuga' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<p><?php get_search_form(); ?></p>
				
			</header><!-- .page-header -->
			
		<?php if ( have_posts() ) :  ?>
		
			<div id="homepage-posts" class="post-wrapper clearfix">
					
				<?php while (have_posts()) : the_post();
			
					if ( 'post' == get_post_type() ) :
		
						get_template_part( 'template-parts/content' );
				
					else :
					
						get_template_part( 'template-parts/content', 'search' );
						
					endif;
			
				endwhile; ?>
			
			</div>
		
			<?php tortuga_pagination(); ?>

		<?php else : ?>

			<div class="no-matches type-page">
				
				<header class="entry-header">
		
					<h2 class="page-title"><?php esc_html_e( 'No matches', 'tortuga' ); ?></h2>
					
				</header><!-- .entry-header -->
				
				<div class="entry-content">
					
					<p><?php esc_html_e( 'Please try again, or use the navigation menus to find what you search for.', 'tortuga' ); ?></p>
				
				</div>
				
			</div>

		<?php endif; ?>
			
		</main><!-- #main -->
	</section><!-- #primary -->
	
	<?php get_sidebar(); ?>
	
<?php get_footer(); ?>