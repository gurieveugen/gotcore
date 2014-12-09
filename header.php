<?php
/**
 * @package WordPress
 * @subpackage GotCore
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/jquery.lightbox-0.5.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?ver=2013-02-06" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php 
	if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); 
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
		wp_head(); ?>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.lightbox-0.5.min.js"></script>
    <script type="text/javascript">
        var $wp_img_url = '<?php bloginfo('template_url'); ?>/images/';
        jQuery(function($){
            $('a[rel^=lightbox]').lightBox({
            fixedNavigation:        false,
            imageLoading:           $wp_img_url + 'lightbox-ico-loading.gif',      // (string) Path and the name of the loading icon
            imageBtnPrev:           $wp_img_url + 'lightbox-btn-prev.gif',         // (string) Path and the name of the prev button image
            imageBtnNext:           $wp_img_url + 'lightbox-btn-next.gif',         // (string) Path and the name of the next button image
            imageBtnClose:          $wp_img_url + 'lightbox-btn-close.gif',        // (string) Path and the name of the close btn
            imageBlank:             $wp_img_url + 'lightbox-blank.gif',            // (string) Path and the name of a blank image (one pixel)
            });
        });
    </script>
<!--[if IE]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" type="text/css" media="screen" /><![endif]-->
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/css_browser_selector.js"></script>
<script type="text/javascript">
	function launchWS(winName) { 
		//window height and width
		myHeight = screen.height*.80;
		myWidth = 920;

		//widow height bounds
		if ( myHeight < 556 ) {
			myHeight = 556;
		} else if (myHeight>700) {
			myHeight = 700;
		}
	                  
		//get screen size, and cacl center screen positioning
		var height = screen.height;
		var width = screen.width;
		var leftpos = width / 2 - myWidth / 2;
		var toppos = (height / 2 - myHeight / 2) - 40;
		
		//open window
		msgWindow=window.open(winName,"ws_window","toolbar=no,location=no,directories=no,resizable=yes,menubar=no,scrollbars=no,status=yes,width=" 
							+ myWidth + ",height="+ myHeight + ", left=" 
							+ leftpos + ",top=" + toppos); 
															
		//focus window
		setTimeout('msgWindow.focus()',1);
		return false;
	}
</script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-53297928-1', 'auto');
ga('send', 'pageview');

</script>
</head>
<body <?php body_class(); ?>>
<div class="global-box">
  <div class="center-box">
    <!-- top-box -->
	<div class="top-box cf">
	  <div class="logo"><h1><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"><?php bloginfo('name'); ?></a></h1></div>
	  
	  <div class="left">
	    <ul class="facebook-buttons cf">
		  <li><iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fgotcore.com&amp;send=false&amp;layout=standard&amp;width=310&amp;show_faces=false&amp;action=recommend&amp;colorscheme=light&amp;font=arial&amp;height=45" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:310px; height:45px;" allowTransparency="true"></iframe></li>
		</ul>
	  
	    <p>1141 Robert Grissom Parkway, Myrtle Beach, SC 29577</p>
	  </div>
	  
	  <div class="right">
	    <ul class="social-list cf">
		  <li class="rss"><a href="/feed/">Rss</a></li>
		  <li class="facebook"><a href="http://www.facebook.com/MyrtleBeachCoreFitness" target="_blank">Facebook</a></li>
		  <li class="tweet"><a href="https://twitter.com/GotCore" target="_blank">Tweet</a></li>
		  <li class="in"><a href="http://www.linkedin.com/pub/bill-langfitt/1b/566/53a" target="_blank">in</a></li>
		</ul>
		
		<h4>843.839.2673</h4>
	  </div>
	  
	  <div class="blue-box">
	    <h3>free trial</h3>
		<h4>3 day pass</h4>
		<p>First time local residents only. Some restrictions apply. </p>
		<a href="/3-day-pass/?TB_iframe=true&height=670&width=562" class="plus thickbox">+</a>	  
		<div class="bgbottom-blue">&nbsp;</div>
	  </div>
	</div>
	<!-- end top-box -->
	
	<!-- menu-box -->
	<div class="menu-box cf">
	  <?php get_top_menu(); ?>
	</div>
	<!-- end menu-box -->
	
	<!-- content-box -->
	<div class="content-box cf">
	
	
