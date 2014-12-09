<?php
/**
 * @package WordPress
 * @subpackage adility
 */
?>
<?php get_header(); ?>
	  <div class="page-blog cf">
		<h1>Our Blog</h1>
		<div class="left-blog">
		<?php include("loop.php"); ?>
		</div>
		
		<div class="right-blog">
            <?php get_sidebar('blog'); ?>		
		</div>
		  
		  
	  </div>
<?php get_footer(); ?>
