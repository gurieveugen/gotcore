<?php
/**
 *
 * @package WordPress
 * @subpackage GotCore
 */

the_post();
global $post;
if ( ! $post->post_parent ) {
    $rpost = get_pages( array( 'child_of' => $post->ID, 'number ' => 1, 'sort_column' => 'menu_order' ) );
    if ( ! empty($rpost[0]->ID) ) {
        wp_redirect( get_permalink($rpost[0]->ID), 301 );
        exit;
    }
}
get_header(); 
?>
	  <div class="page-post cf">
	    <h1><?php echo get_the_title( $post->post_parent ); ?></h1>
		<div class="left-page">
<?php get_sidebar(); ?>		
		</div>
		
		<div class="right-page">
    		<div id="post-<?php the_ID(); ?>">
    		  <div class="top-text">
    		    <h2><?php
    		    	$ttl = get_post_meta( get_the_ID(), 'title_override', true )
					and
					print( $ttl )
					or
    		    	print( strtoupper(get_the_title()));
    		   	?></h2>
    		    <?php echo wpautop( get_post_meta( $post->ID, 'subtitle_content', true ) ); ?>
    		  </div>
    		  <div class="entry-page">
   					<?php the_content(); ?>
   					<?php wp_link_pages( array( 'before' => '<div class="page-link">Pages:', 'after' => '</div>' ) ); ?>
    		  </div>
    		</div>
		</div>
	  </div>


<?php get_footer(); ?>
