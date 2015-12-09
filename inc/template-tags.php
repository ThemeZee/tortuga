<?php
/***
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package zeePersonal
 */
	
/**
 * Displays the site title in the header area
 */
function zeepersonal_site_title() { ?>

	<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		<h1 class="site-title"><?php bloginfo('name'); ?></h1>
	</a>

<?php
}
add_action( 'zeepersonal_site_title', 'zeepersonal_site_title' );


if ( ! function_exists( 'zeepersonal_header_image' ) ):
/**
 * Displays the custom header image below the navigation menu
 */
function zeepersonal_header_image() {
		
	// Check if there is a custom header image
	if( get_header_image() ) : ?>
		
		<div id="headimg" class="header-image">
			<img src="<?php echo get_header_image(); ?>" />
		</div>
<?php 
	endif;

}
endif;


if ( ! function_exists( 'zeepersonal_post_image_archives' ) ):
/**
 * Displays the featured image on archive pages
 */
function zeepersonal_post_image_archives() {
		
	// Get Theme Options from Database
	$theme_options = zeepersonal_theme_options();
	
	// Display Postmeta
	if ( true == $theme_options['post_thumbnail_archives'] ) : ?>
		
		<div class="entry-thumbnail">
			<a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
<?php 
	endif;

} // zeepersonal_post_image_archives()
endif;


if ( ! function_exists( 'zeepersonal_post_image_single' ) ):
/**
 * Displays the featured image on single posts
 */
function zeepersonal_post_image_single() {
		
	// Get Theme Options from Database
	$theme_options = zeepersonal_theme_options();
	
	// Display Postmeta
	if ( true == $theme_options['post_thumbnail_single'] ) : ?>
		
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
<?php 
	endif;

} // zeepersonal_post_image_single()
endif;


if ( ! function_exists( 'zeepersonal_entry_meta' ) ):	
/**
 * Displays the date and author of posts
 */
function zeepersonal_entry_meta() {

	// Get Theme Options from Database
	$theme_options = zeepersonal_theme_options();
	
	// Display Postmeta
	if ( true == $theme_options['meta_date'] or true == $theme_options['meta_author'] ) :
	
		echo '<div class="entry-meta">';
		
		// Display Date unless user has deactivated it via settings
		if ( true == $theme_options['meta_date'] ) :
		
			zeepersonal_meta_date();
		
		endif; 

		// Display Author unless user has deactivated it via settings
		if ( true == $theme_options['meta_author'] ) :
		
			zeepersonal_meta_author();
		
		endif; 
		
		// Display Categories unless user has deactivated it via settings
		if ( true == $theme_options['meta_category'] ) :
		
			zeepersonal_meta_category();
		
		endif; 
		
		// Display Author unless user has deactivated it via settings
		if ( true == $theme_options['meta_comments'] and comments_open() ) :
		
			zeepersonal_meta_comments();
		
		endif; 

		echo '</div>';
		
	endif;

} // zeepersonal_entry_meta()
endif;


if ( ! function_exists( 'zeepersonal_meta_date' ) ):
/**
 * Displays the post date
 */
function zeepersonal_meta_date() { 

	$time_string = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date published updated" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	
	echo '<span class="meta-date">' . $time_string . '</span>';

}  // zeepersonal_meta_date()
endif;


if ( ! function_exists( 'zeepersonal_meta_author' ) ):
/**
 * Displays the post author
 */
function zeepersonal_meta_author() {  
	
	$author_string = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>', 
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( esc_html__( 'View all posts by %s', 'zeepersonal' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
	
	echo '<span class="meta-author"> ' . $author_string . '</span>';

}  // zeepersonal_meta_author()
endif;


if ( ! function_exists( 'zeepersonal_meta_category' ) ):
/**
 * Displays the post categories
 */
function zeepersonal_meta_category() {  
	
	echo '<span class="meta-category"> ' . get_the_category_list(' / '). '</span>';

}  // zeepersonal_meta_category()
endif;


if ( ! function_exists( 'zeepersonal_meta_comments' ) ):
/**
 * Displays the post comments
 */
function zeepersonal_meta_comments() {  
	
	echo '<span class="meta-comments">';
	
	comments_popup_link( 
		esc_html__( 'Leave a comment', 'zeepersonal' ),
		esc_html__( 'One comment', 'zeepersonal' ), 
		esc_html__( '% comments', 'zeepersonal' ) );
	
	echo '</span>';

}  // zeepersonal_meta_comments()
endif;


if ( ! function_exists( 'zeepersonal_entry_tags' ) ):
/**
 * Displays the post tags on single post view
 */
function zeepersonal_entry_tags() {
	
	// Get Theme Options from Database
	$theme_options = zeepersonal_theme_options();
	
	// Get Tags
	$tag_list = get_the_tag_list('', '');
	
	// Display Tags
	if ( $tag_list && $theme_options['meta_tags'] ) : ?>
	
		<div class="entry-tags clearfix">
			<span class="meta-tags">
				<?php echo $tag_list; ?>
			</span>
		</div><!-- .entry-tags -->
<?php 
	endif;

} // zeepersonal_entry_tags()
endif;


if ( ! function_exists( 'zeepersonal_more_link' ) ):
/**
 * Displays the more link on posts
 */
function zeepersonal_more_link() { ?>

	<a href="<?php echo esc_url( get_permalink() ) ?>" class="more-link"><?php esc_html_e( 'Continue reading &raquo;', 'zeepersonal' ); ?></a>

<?php
}
endif;


if ( ! function_exists( 'zeepersonal_pagination' ) ):
/**
 * Displays pagination on archive pages
 */	
function zeepersonal_pagination() { 
	
	global $wp_query;

	$big = 999999999; // need an unlikely integer
	
	 $paginate_links = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',				
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total' => $wp_query->max_num_pages,
			'next_text' => '&raquo;',
			'prev_text' => '&laquo',
			'add_args' => false
		) );

	// Display the pagination if more than one page is found
	if ( $paginate_links ) : ?>
			
		<div class="post-pagination clearfix">
			<?php echo $paginate_links; ?>
		</div>
	
	<?php
	endif;
	
} // zeepersonal_pagination()
endif;


/**
 * Displays credit link on footer line
 */	
function zeepersonal_footer_text() { ?>

	<span class="credit-link">
		<?php printf( esc_html__( 'Powered by %1$s and %2$s.', 'zeepersonal' ), 
			'<a href="http://wordpress.org" title="WordPress">WordPress</a>',
			'<a href="http://themezee.com/themes/zeepersonal/" title="zeePersonal WordPress Theme">zeePersonal</a>'
		); ?>
	</span>

<?php
}
add_action( 'zeepersonal_footer_text', 'zeepersonal_footer_text' );