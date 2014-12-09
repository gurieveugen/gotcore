<?php
/**
 *
 * @package WordPress
 * @subpackage GotCore
 */
    /*
Template Name: Contact Page
*/
the_post();
global $post;
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
		    <div class="bg-top-textbox">
		          <?php echo wpautop( get_post_meta( $post->ID, 'subtitle_content', true ) ); ?>
			</div>
		  </div>
    		  <div class="entry-page">
   					<?php
   					    remove_filter( 'the_content', 'wpautop' ); 
   					    the_content(); 
   					?>
   					<?php wp_link_pages( array( 'before' => '<div class="page-link">Pages:', 'after' => '</div>' ) ); ?>
    		  </div>
    		</div>
		</div>
	  </div>


<?php get_footer(); ?>
