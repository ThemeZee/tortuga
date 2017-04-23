<?php
/**
 * The template for displaying articles in the slideshow loop
 *
 * @package Tortuga
 */

?>

<li id="slide-<?php the_ID(); ?>" class="zeeslide clearfix">

	<?php tortuga_slider_image( 'tortuga-slider-image', array( 'class' => 'slide-image' ) ); ?>

	<div class="slide-content clearfix">

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php tortuga_slider_meta(); ?>

		<div class="entry-content clearfix">

			<?php the_excerpt(); ?>

		</div><!-- .entry-content -->

		<div class="read-more"><?php tortuga_more_link(); ?></div>

	</div>

</li>
