<?php
/**
 *
 * @package WordPress
 * @subpackage GotCore
 * Template Name: Group Excercise Page
*/

the_post();
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
    		    <h2><?php echo strtoupper(get_the_title()); ?></h2>
    		    <?php echo wpautop( get_post_meta( $post->ID, 'subtitle_content', true ) ); ?>
    		  </div>
    		  <div class="entry-page">
    		        <?php the_content(); ?>
   					<?php /*
   					<ul class="group-excercise-list">
   					  <?php foreach( get_pages( array( 'child_of'=> 13, 'exclude' => '196, 198' ) ) as $tpage ) :  ?>
					  <li class="cf">
					    <div class="text">
						  <h3><?php echo $tpage->post_title; ?></h3>
						  <p>
						      <?php echo short_content( $tpage->post_content ); ?>
						  </p>
						</div>
						
						<div class="button">
						  <span class="more"><a href="#">Schedule</a></span>
						</div>
					  </li>
					  <?php endforeach; ?>
					</ul>
					 * 
					 */
					 ?>
    		  </div>
    		</div>
		</div>
	  </div>


<?php get_footer(); ?>
