<?php
/**
 * @package WordPress
 * @subpackage GotCore
 */
global $post;
?>
<?php if ( ! have_posts() ) : ?>

		  <!-- post-blog -->
		  <div class="post-blog cf">
		  <h1>Not Found</h1>
			<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
			<?php get_search_form(); ?>
		  </div>
		  <!-- end post-blog -->
	
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); $post_image = get_featured_image_id($post->ID); ?>
		  <!-- post-blog -->
		  <div id="post-<?php the_ID(); ?>" class="post-blog cf">
		    <div class="date-post">
			  <span><?php the_time('d') ?></span>
			  <?php the_time('M Y') ?>
			</div>
			
			<div class="text-post">
	  <?php if (strlen($post_image)) { ?>
	        <div class="img-post"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_thumb($post_image, 570, 230, 1); ?>" alt=" " /></a></div>
	      <?php } else {?>	

		  <?php } ?>
			  
			  
			    <h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="meta-post cf">
				  <span class="autor">by <?php echo get_the_author(); ?></span>
				  <span class="categoryes"><?php the_category(', ') ?></span>
				  <span class="comments"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></span>
				</div>
				<?php the_excerpt(); ?>				
				<div class="bottom-post cf">
				  <a href="<?php the_permalink(); ?>" class="more">&rarr; Continue Reading</a>
				  <div class="share-post">
				    <ul>
					  <li><span class='st_email' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' ></span></li>
					  <li><span class='st_facebook' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' ></span></li>
					  <li><span class='st_twitter' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' ></span></li>
					  <li><span class='st_sharethis' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' > <span class="text">+ Share This</span> </span></li>
					</ul>
				  </div>
				</div>
			</div>
		  </div>
		  <!-- end post-blog -->
    <?php endwhile; ?>
<?php comments_template( '', true ); ?>

<div class="wp-pagenavi-blog cf">
<?php @wp_pagenavi(); ?>
</div>
