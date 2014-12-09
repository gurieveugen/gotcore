<?php
/**
 *
 * @package WordPress
 * @subpackage GotCore
 * Template Name: Event Calendar
*/
global $post;
the_post();
get_header(); 
?>
      <div class="page-schedule cf">
        <h1>Class Schedules</h1>
        
            <div id="post-<?php the_ID(); ?>">
              <div class="entry-page">
                    <?php include( tribe_get_current_template() ); ?>
              </div>
            </div>
      </div>
<?php get_footer(); ?>
