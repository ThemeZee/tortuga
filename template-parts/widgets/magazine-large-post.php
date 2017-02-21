<?php
/**
 * The template for displaying large posts in Magazine Post widgets
 *
 * @package Tortuga
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'large-post clearfix' ); ?>>

	<?php tortuga_post_image( 'tortuga-thumbnail-large' ); ?>

	<header class="entry-header">

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php tortuga_magazine_entry_meta(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_excerpt(); ?>
		<?php tortuga_more_link(); ?>

	</div><!-- .entry-content -->

</article>
