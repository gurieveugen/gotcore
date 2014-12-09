<?php
/**
 *
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php get_header(); ?>

	  <div class="page-blog cf">
		<h1>Search Results for: <span> <?php echo get_search_query() ?></span></h1>
		<div class="left-blog">

			<?php if ( have_posts() ) : ?>
				<?php include('loop.php');	?>
			<?php else : ?>
				<div id="post-0" class="entry-page">
					<h2>Nothing Found</h2>
						<p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
						<?php get_search_form(); ?>
				</div>
			<?php endif; ?>
		</div>
		
		<div class="right-blog">		
<?php get_sidebar('blog'); ?>		
		</div>
		    
	  </div>
<?php get_footer(); ?>
