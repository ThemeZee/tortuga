<?php
/***
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package Tortuga
 */

 
if ( ! function_exists( 'tortuga_site_logo' ) ): 
/**
 * Displays the site logo in the header area
 */
function tortuga_site_logo() {

	if ( function_exists( 'the_custom_logo' ) ) {
		
		the_custom_logo();
	
	} 
	
}
endif;


if ( ! function_exists( 'tortuga_site_title' ) ): 
/**
 * Displays the site title in the header area
 */
function tortuga_site_title() {
	
	// Get theme options from database
	$theme_options = tortuga_theme_options();	
	
	// Return early if site title is deactivated
	if( false == $theme_options['site_title'] ) {
		return;
	}
	
	if ( is_home() or is_page_template( 'template-magazine.php' )  ) : ?>
		
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	
	<?php else : ?>
		
		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
	
	<?php endif; 
	
}
endif;


if ( ! function_exists( 'tortuga_site_description' ) ): 
/**
 * Displays the site description in the header area
 */
function tortuga_site_description() {
	
	// Get theme options from database
	$theme_options = tortuga_theme_options();	
	
	// Return early if site title is deactivated
	if( false == $theme_options['site_description'] ) {
		return;
	}
	
	$description = get_bloginfo( 'description', 'display' ); /* WPCS: xss ok. */
	
	if ( $description || is_customize_preview() ) : ?>

		<p class="site-description"><?php echo $description; ?></p>
	
	<?php 
	endif;
	
}
endif;


if ( ! function_exists( 'tortuga_header_image' ) ):
/**
 * Displays the custom header image below the navigation menu
 */
function tortuga_header_image() {
	
	// Get theme options from database
	$theme_options = tortuga_theme_options();	
	
	// Display featured image as header image on static pages
	if( get_header_image() ) : 

		// Hide header image on front page
		if ( true == $theme_options['custom_header_hide'] and is_front_page() ) {
			return;
		}
		?>
		
		<div id="headimg" class="header-image">
			
			<?php // Check if custom header image is linked
			if( $theme_options['custom_header_link'] <> '' ) : ?>
			
				<a href="<?php echo esc_url( $theme_options['custom_header_link'] ); ?>">
					<img src="<?php echo get_header_image(); ?>" />
				</a>
				
			<?php else : ?>
			
				<img src="<?php echo get_header_image(); ?>" />
				
			<?php endif; ?>
			
		</div>
	
	<?php 
	endif;
}
endif;


if ( ! function_exists( 'tortuga_post_image_single' ) ):
/**
 * Displays the featured image on single posts
 */
function tortuga_post_image_single() {
	
	// Get Theme Options from Database
	$theme_options = tortuga_theme_options();
	
	// Display Post Thumbnail if activated
	if ( true == $theme_options['post_image_single'] ) :

		the_post_thumbnail();

	endif;

} // tortuga_post_image_single()
endif;


if ( ! function_exists( 'tortuga_entry_meta' ) ):	
/**
 * Displays the date, author and categories of a post
 */
function tortuga_entry_meta() {

	// Get Theme Options from Database
	$theme_options = tortuga_theme_options();
	
	$postmeta = '';
	
	// Display date unless user has deactivated it via settings
	if ( true == $theme_options['meta_date'] ) {
		
		$postmeta .= tortuga_meta_date();
		
	}

	// Display author unless user has deactivated it via settings
	if ( true == $theme_options['meta_author'] ) {
	
		$postmeta .= tortuga_meta_author();
	
	}
	
	// Display categories unless user has deactivated it via settings
	if ( true == $theme_options['meta_category'] ) {
	
		$postmeta .= tortuga_meta_category();
	
	}
	
	// Display categories unless user has deactivated it via settings
	if ( true == $theme_options['meta_comments'] ) {
	
		$postmeta .= tortuga_meta_comments();
	
	}
		
	if( $postmeta ) {
		
		echo '<div class="entry-meta">' . $postmeta . '</div>';
			
	}

} // tortuga_entry_meta()
endif;


if ( ! function_exists( 'tortuga_meta_date' ) ):
/**
 * Displays the post date
 */
function tortuga_meta_date() { 

	$time_string = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date published updated" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	return '<span class="meta-date">' . $time_string . '</span>';

}  // tortuga_meta_date()
endif;


if ( ! function_exists( 'tortuga_meta_author' ) ):
/**
 * Displays the post author
 */
function tortuga_meta_author() {  
	
	$author_string = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>', 
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( esc_html__( 'View all posts by %s', 'tortuga' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
	
	return '<span class="meta-author"> ' . $author_string . '</span>';

}  // tortuga_meta_author()
endif;


if ( ! function_exists( 'tortuga_meta_category' ) ):
/**
 * Displays the category of posts
 */	
function tortuga_meta_category() { 

	return '<span class="meta-category"> ' . get_the_category_list(', ') . '</span>';
	
} // tortuga_meta_category()
endif;


if ( ! function_exists( 'tortuga_meta_comments' ) ):
/**
 * Displays the post comments
 */	
function tortuga_meta_comments() { 

	// Start Output Buffering
	ob_start();
	
	// Display Comments
	comments_popup_link( esc_html__( 'Leave a comment', 'tortuga' ), esc_html__( 'One comment', 'tortuga' ), esc_html__( '% comments', 'tortuga' ) );
	$comments = ob_get_contents();
	
	// End Output Buffering
	ob_end_clean();
	
	return '<span class="meta-comments"> ' . $comments . '</span>';
	
} // tortuga_meta_comments()
endif;


if ( ! function_exists( 'tortuga_entry_tags' ) ):
/**
 * Displays the post tags on single post view
 */
function tortuga_entry_tags() {
	
	// Get Theme Options from Database
	$theme_options = tortuga_theme_options();
	
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

} // tortuga_entry_tags()
endif;


if ( ! function_exists( 'tortuga_more_link' ) ):
/**
 * Displays the more link on posts
 */
function tortuga_more_link() { ?>

	<a href="<?php echo esc_url( get_permalink() ) ?>" class="more-link"><?php esc_html_e( 'Continue reading &raquo;', 'tortuga' ); ?></a>

<?php
}
endif;


if ( ! function_exists( 'tortuga_post_navigation' ) ):
/**
 * Displays Single Post Navigation
 */	
function tortuga_post_navigation() { 
	
	// Get Theme Options from Database
	$theme_options = tortuga_theme_options();
	
	if ( true == $theme_options['post_navigation'] ) {

		the_post_navigation( array( 'prev_text' => '&laquo; %title', 'next_text' => '%title &raquo;' ) );
			
	}
	
}	
endif;


if ( ! function_exists( 'tortuga_breadcrumbs' ) ):
/**
 * Displays ThemeZee Breadcrumbs plugin
 */	
function tortuga_breadcrumbs() { 
	
	if ( function_exists( 'themezee_breadcrumbs' ) ) {

		themezee_breadcrumbs( array( 
			'before' => '<div class="breadcrumbs-container container clearfix">',
			'after' => '</div>'
		) );
		
	}
}	
endif;


if ( ! function_exists( 'tortuga_related_posts' ) ):
/**
 * Displays ThemeZee Related Posts plugin
 */	
function tortuga_related_posts() { 
	
	if ( function_exists( 'themezee_related_posts' ) ) {

		themezee_related_posts( array( 
			'class' => 'related-posts type-page clearfix',
			'before_title' => '<h2 class="page-title related-posts-title">',
			'after_title' => '</h2>'
		) );
		
	}
}	
endif;


if ( ! function_exists( 'tortuga_pagination' ) ):
/**
 * Displays pagination on archive pages
 */	
function tortuga_pagination() { 
	
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
	
} // tortuga_pagination()
endif;


/**
 * Displays credit link on footer line
 */	
function tortuga_footer_text() { ?>

	<span class="credit-link">
		<?php printf( esc_html__( 'Powered by %1$s and %2$s.', 'tortuga' ), 
			'<a href="http://wordpress.org" title="WordPress">WordPress</a>',
			'<a href="https://themezee.com/themes/tortuga/" title="Tortuga WordPress Theme">Tortuga</a>'
		); ?>
	</span>

<?php
}
add_action( 'tortuga_footer_text', 'tortuga_footer_text' );