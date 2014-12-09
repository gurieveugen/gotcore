<?php
/**
 * @package WordPress
 * @subpackage GotCore
 * Template Name: 3 Day Pass
*/
$theme_url = get_bloginfo('template_url');
the_post();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>3 Day Pass</title>
    <link rel="stylesheet" media="screen" type="text/css" href="<?php echo $theme_url; ?>/style.css" />
    <!--[if IE]><link rel="stylesheet" href="<?php echo $theme_url; ?>/css/ie.css" type="text/css" media="screen" /><![endif]-->
    <?php 
        wp_dequeue_script('admin-bar'); 
        remove_action('wp_head', '_admin_bar_bump_cb' );    
        wp_head(); 
    ?>
    <script type="text/javascript" src="<?php echo $theme_url; ?>/js/css_browser_selector.js"></script>
</head>
<body style="overflow: hidden;">
    <div class="lightbox-global">
        <div class="lightbox-block">
            <div class="bg-lightbox">
                <div class="logo"><h1><a href="<?php bloginfo('url'); ?>" target="_parent" >Core</a></h1></div>
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
                <a onclick="window.parent.tb_remove(); return false;" href="#close" class="close-lightbox">Close</a>
            </div>
        </div>
    </div>
    <?php
    remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 );
    wp_footer(); 
    ?>
</body>
</html>