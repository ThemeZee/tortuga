<?php
/**
 * The template for displaying small posts in Magazine Post widgets
 *
 * @package Tortuga
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'small-post clearfix' ); ?>>

	<?php tortuga_post_image( 'tortuga-thumbnail-small' ); ?>

	<div class="post-content clearfix">

		<header class="entry-header">

			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php tortuga_magazine_entry_date(); ?>

		</header><!-- .entry-header -->

	</div>

</article>
