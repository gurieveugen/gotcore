<?php
/**
 * @package WordPress
 * @subpackage Base_theme
 */
?>
        <?php 
            global $post;
            if ( is_page() && $post->post_parent ) :
        ?>
		  <div class="sub-menu-page">
			<ul>
			  <?php
			     global $post; 
				 if ( 13 == $post->post_parent ) {
			     	wp_list_pages(array( 'meta_key' => 'menu_show', 'meta_value' => 'yes', 'child_of' => 13, 'sort_column' => 'menu_order', 'title_li' => false ));
				 } else { 
			     	wp_list_pages(array( 'child_of' => $post->post_parent, 'sort_column' => 'menu_order', 'title_li' => false ));
				 } 
			  ?>
			</ul>
		  </div>
		<?php endif; ?>
		  
		  <?php dynamic_sidebar( 'Page Sidebar' ); ?>