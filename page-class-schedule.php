<?php
/**
 *
 * @package WordPress
 * @subpackage GotCore
 * Template Name: Class Schedule Page
*/
global $post;
the_post();
get_header(); 
?>
	  <div class="page-schedule cf">
	    <h1><?php echo get_the_title( $post->post_parent ); ?></h1>
		
    		<div id="post-<?php the_ID(); ?>">
    		  <div class="entry-page">
   					<?php the_content(); ?>
					<script type="text/javascript">
					  // Healcode Schedule Widget for Core Fitness Club of Myrtle Beach : 
					  healcode_widget_id = "fp3767ka8g";
					  healcode_widget_name = "schedules";
					  document.write(unescape("%3Cscript src='https://www.healcode.com/javascripts/hc_widget.js' type='text/javascript'%3E%3C/script%3E"));
					</script>
						
    		  </div>
    		</div>
	  </div>


<?php get_footer(); ?>
