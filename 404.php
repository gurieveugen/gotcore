<?php
/**
 *
 * @package WordPress
 * @subpackage Base_Theme
 */
?>

<?php get_header(); ?>

	  <div class="page-post cf">
		<div class="left-page">
<?php get_sidebar(); ?>		
		</div>
		
		<div class="right-page">
    		  <div class="top-text">
    		    <h2>Not Found</h2>
    		  </div>
    		  <div class="entry-page">
					<p>Apologies, but the page you requested could not be found. Perhaps searching will help.</p>
					<?php get_search_form(); ?>
			</div>

		</div>
	  </div>
	
	<script type="text/javascript">
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>