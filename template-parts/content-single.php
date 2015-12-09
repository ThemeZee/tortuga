<?php
/**
 * The template for displaying single posts
 *
 * @package zeePersonal
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<header class="entry-header">
			
			<?php zeepersonal_post_image_single(); ?>

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		</header><!-- .entry-header -->

		<div class="entry-content clearfix">
			
			<?php the_content(); ?>
			<!-- <?php trackback_rdf(); ?> -->
			
			<div class="page-links"><?php wp_link_pages(); ?></div>
			
			<?php zeepersonal_entry_tags(); ?>
			
		</div><!-- .entry-content -->
		
		<footer class="entry-footer">
			
			<?php zeepersonal_entry_meta(); ?>
			
		</footer><!-- .entry-footer -->

	</article>