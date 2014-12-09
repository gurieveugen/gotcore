<?php
/**
 *
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php get_header(); ?>

	  <div class="page-blog cf">
		<h1><?php the_title(); ?></h1>
		<div class="left-blog">

<?php if ( have_posts() ) : the_post(); $post_image = get_featured_image_id($post->ID); ?>

		<div id="post-<?php the_ID(); ?>" class="post-blog cf">
		    <div class="date-post">
			  <span><?php the_date('d') ?></span>
			  <?php the_time('M Y') ?>
			</div>
			
			<div class="text-post">
	  <?php if (strlen($post_image)) { ?>
	        <div class="img-post"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_thumb($post_image, 570, 230, 1); ?>" alt=" " /></a></div>
	      <?php } else {?>	

		  <?php } ?>
			  
			  
			    <h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="meta-post cf">
				  <span class="autor">by <?php the_author() ?></span>
				  <span class="categoryes"><?php the_category(', ') ?></span>
				  <span class="comments"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></span>
				</div>
				<div class="single-post cf">
				<?php the_content(); ?>		
				</div>
				<div class="bottom-post cf">
				  <div class="share-post">
				    <ul>
					  <li><span class='st_email' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' ></span></li>
					  <li><span class='st_facebook' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' ></span></li>
					  <li><span class='st_twitter' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' ></span></li>
					  <li><span class='st_sharethis' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' > <span class="text">+ Share This</span> </span></li>
					</ul>
				  </div>
				</div>


				<?php if ( get_the_author_meta( 'description' ) ) : ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ),  60  ); ?>
						</div>
						<div id="author-description">
							<h2>About <?php the_author() ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									View all posts by <?php the_author() ?> <span class="meta-nav">&rarr;</span>
								</a>
							</div>
						</div>
					</div>
				<?php endif; ?>


				<?php comments_template( '', true ); ?>
			</div>
		  </div>
		  <!-- end post-blog -->
<?php endif; ?>

		</div>
		
		<div class="right-blog">		
<?php get_sidebar('blog'); ?>		
		</div>
		    
	  </div>
<?php get_footer(); ?>