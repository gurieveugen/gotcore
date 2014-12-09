<?php
/**
 *
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php get_header(); ?>

	  <div class="page-blog cf">
		<h1>
				<?php global $post;
					  if ( is_day() ) : 
						echo 'Daily Archives: <span>'.get_the_date().'</span>';
					  elseif ( is_month() ) : 
					  	echo 'Monthly Archives: <span>'.get_the_date('F Y').'</span>';
					  elseif ( is_year() ) :  
					  	echo 'Yearly Archives: <span>'.get_the_date('Y').'</span>';
					  elseif ( is_tag() ) :  
					  	echo 'Tag Archives: <span>'.single_tag_title().'</span>';
					  else : 
					  	echo 'Blog Archives';
					  endif; 
					 ?>
		</h1>
		<div class="left-blog">
				<?php include("loop.php"); ?>
		</div>
		
		<div class="right-blog">		
<?php get_sidebar('blog'); ?>		
		</div>
		    
	  </div>
<?php get_footer(); ?>
