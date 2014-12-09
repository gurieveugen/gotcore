<?php
/**
 *
 * @package WordPress
 * @subpackage GotCore
 */

get_header(); ?>

  <div class="page-blog cf">
	<h1>Category Archives: <span><?php echo single_cat_title( '', false ) ?></span></h1>
	<div class="left-blog">
		<?php include('loop.php');	?>
	</div>
	
	<div class="right-blog">		
		<?php get_sidebar('blog'); ?>		
	</div>
	    
  </div>
<?php get_footer(); ?>
