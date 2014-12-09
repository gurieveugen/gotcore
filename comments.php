<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>

<div id="comments">

<?php if ( post_password_required() ) : ?>
		<p class="nopassword">This post is password protected. Enter the password to view any comments.</p>
</div>
<?php return; endif; ?>

<?php if ( have_comments() && comments_open()) : ?>
	<h3 id="comments-title">
		<?php comments_number('No Comments', 'One Comment', '% Comments') ?>
	</h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link('<span class="meta-nav">&larr;</span> Older Comments'); ?></div>
				<div class="nav-next"><?php next_comments_link('Newer Comments <span class="meta-nav">&rarr;</span>'); ?></div>
			</div> 
	<?php endif; ?>
	<ol class="commentlist">
<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link('<span class="meta-nav">&larr;</span> Older Comments'); ?></div>
				<div class="nav-next"><?php next_comments_link('Newer Comments <span class="meta-nav">&rarr;</span>'); ?></div>
			</div>
	<?php endif; ?>

<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<h3 id="respond">Leave a comment</h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>

<?php else : ?>

<p>
<span class="text"><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" /></span>
<label for="author">Name<sup><?php if ($req) echo "*"; ?></sup></label>
</p>

<p>
<span class="text"><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" /></span>
<label for="email">Email<sup><?php if ($req) echo "*"; ?></sup></label>
</p>

<p>
<span class="text"><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /></span>
<label for="url">Website</label>
</p>

<?php do_action('comment_form', $post->ID); ?>
<?php endif; ?>

<?php do_action( 'comment_form_after_fields' ); ?>

<p><span class="textarea"><textarea name="comment" id="comment" cols="60" rows="10" tabindex="4"></textarea></span></p>

<p class="submit-box"><span class="submit"><input name="submit" type="submit" id="submit" tabindex="5" value="Post Comment" /></span>
<input type="hidden" name="comment_post_ID" id="comment_post_ID" value="<?php echo $id; ?>" />
</p>



</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
</div>