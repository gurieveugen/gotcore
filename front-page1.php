<?php
/**
 * @package WordPress
 * @subpackage GotCore
 */
?>
<?php get_header(); ?>
    <div id="content" role="main">
        <?php include("loop.php"); ?>
    </div>
    <div>
        <?php dynamic_sidebar( 'homepage' ); ?>
    </div>
<?php get_footer(); ?>
