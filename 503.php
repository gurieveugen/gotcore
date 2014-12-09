<?php
//require_once( dirname(__FILE__).'/../../../index.php');
//require_once( dirname(__FILE__).'/../../../wp-blog-header.php');
//require_once('functions.php');
//include_once('../../../wp-includes/wp-db.php');

session_start();

header('HTTP/1.1 200 OK'); 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en"> 

<head profile="http://gmpg.org/xfn/11">

	<title><?php le('page_title', 'Launch Effect'); ?></title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta name="description" content="<?php le('bkt_metadesc', ''); ?>"  /> 
	<meta name="keywords" content="<?php le('bkt_metakey', ''); ?>"  /> 
	
	<meta property="og:title" content="<?php le('page_title', 'Launch Effect'); ?>"/> 
	<meta property="og:image" content="<?php echo leimg('bkt_thumb', 'bkt_thumbdisable'); ?>"/>

<?php if(leimg('bkt_favicon', 'bkt_favdisable')) { ?>
	<link rel="shortcut icon" href="<?php echo leimg('bkt_favicon', 'bkt_favdisable'); ?>" type="image/x-icon" />
<?php } ?>

<?php 
	$lefx_webfonts_dups = array(ler('heading_font_goog'), ler('subheading_font_goog'), ler('label_font_goog'), ler('description_font_goog'));
	$lefx_webfonts_unique = array_filter(array_unique($lefx_webfonts_dups));
	$lefx_webfonts = implode("', '", str_replace(' ','+',$lefx_webfonts_unique));
?>

<?php if($lefx_webfonts || ler('lefx_typekit') || ler('lefx_monotype')) { ?>

    <script type="text/javascript">
		WebFontConfig = {
			<?php
			if($lefx_webfonts) { ?>google: { families: [ '<?php echo $lefx_webfonts; ?>' ] }<?php }
			if(ler('lefx_typekit')) { if($lefx_webfonts) { echo ', '; } ?>typekit: { id: '<?php le('lefx_typekit', ''); ?>' }<?php }
			if(ler('lefx_monotype')) { if(ler('lefx_typekit') || $lefx_webfonts) { echo ', '; } ?>monotype: { projectId: '<?php le('lefx_monotype', ''); ?>'}<?php } ?>
		};
    </script>

<?php } ?>
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style_launch.css" />
	
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
	      {"parsetags": "explicit"}
	</script>

	<?php include('options.php'); ?>
		
	<?php wp_head(); ?>
		
<?php if(ler('bkt_google')) { ?>
	<script type="text/javascript"> 
		<?php echo ler('bkt_google'); ?>
	</script>
<?php } ?>


	<!--[if lt IE 8]>
	<style type="text/css">
		#outer-container{display:block}
		#container{top:50%;display:block}
		#inner-container{top:-50%;position:relative}
	</style>
	<![endif]--> 
	
	<!--[if IE 7]>
	<style type="text/css">
		#outer-container{
		position:relative;
		overflow:hidden;
		}
	</style>
	<![endif]--> 

</head>

<body> 
<?php
// STORE REFERRED BY CODE
$_SESSION['referredBy'] = $referralindex;

// LOG VISITS AND CONVERSIONS
logVisits($referralindex, $stats_table);
?>

	<div id="outer-container"> 
	
		<div id="container"> 
	
			<div id="inner-container"> 
				
				<!-- LOGO -->
				
				<?php if(leimg('bkt_logo', 'bkt_logodisable')) { ?>
					<div class="feature">
						<img src="<?php echo leimg('bkt_logo', 'bkt_logodisable'); ?>" alt="" />
					</div>					
				<?php } ?>
				
					
				<!-- YOUTUBE / VIMEO EMBED -->
				
				<?php if(le('video_embed', '')) { ?>
					<div class="feature video">
						<?php le('video_embed',''); ?>
					</div>
				<?php } ?>
				
				
				<!-- H2 SUBHEADING / P DESCRIPTION (PRESIGNUP) -->
				<div id="content-blocks-wrapper">
					<div id="presignup-content" class="content-block-left">
						<h2><?php le('subheading_content', 'SUB-HEADING'); ?></h2>
						<p><?php le('description_content', 'Welcome to LaunchEffect!  To get started, head over to the Launch Effect menu in your WordPress admin and start getting colorful!'); ?></p>
					</div>
					
					
					<!-- H2 SUBHEADING / P DESCRIPTION (SUCCESS) -->
				
					<div id="success-content">
						<h2><?php le('subheading_content2', 'SUB-HEADING (ON SUCCESS)'); ?></h2>
						<p><?php le('description_content2', 'Eureka! It works!'); ?></p>
					</div>
										
					
					<!-- STORE BASE URL FOR AJAX USE -->
					
					<span class="dirname"><?php bloginfo('url'); ?></span>					
					
					
					<!-- FORM (PRE-SIGNUP) -->
					<form id="form" action="" class="content-block-right">
						<fieldset>
							<input type="hidden" name="code" id="code" value="<?php codeCheck(); ?>" />
							<label for="email"><?php le('label_content', 'ENTER YOUR EMAIL ADDRESS:'); ?></label>
							<input type="text" id="email" name="email" />
							<span id="submit-button-border"><input type="submit" name="submit" value="Go" id="submit-button" /></span>
							<div class="clear"></div>
						<?php if(get_option('lefx_enable_privacy_policy') == 'true') { ?>
							<span class="privacy-policy"><?php le('lefx_privacy_policy_label', 'By submitting my email, I understand the');?> <a href="#" id="modal-privacy" class="modal-trigger"><?php le('lefx_privacy_policy_heading', 'privacy policy'); ?></a>.</span>
						<?php } ?>
							<div id="error"></div>
						</fieldset>
					</form>
					
					<!-- FORM (POST-SIGNUP) -->
					<form id="success" action="">
						<fieldset>
						
						<div class="content-block-left<?php if(get_option('disable_social_media') == 'true') { echo ' disable'; } ?>">
							<h2 class="social-heading"><?php le('label_social', 'TO SHARE WITH FRIENDS:'); ?></h2>
							<div class="social-container">
								<div class="social">
									<div id="tweetblock" <?php if(get_option('lefx_disable_twitter') == 'true') { echo 'class="disable"'; } ?>></div>	
									<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1" type="text/javascript"></script>
									<div id="fblikeblock" <?php if(get_option('lefx_disable_facebook') == 'true') { echo 'class="disable"'; } ?>></div>
									<div id="plusoneblock" <?php if(get_option('lefx_disable_plusone') == 'true') { echo 'class="disable"'; } ?>></div>
									<script type="text/javascript">
										var tumblr_link_name = "<?php le('page_title', 'Launch Effect'); ?>";
										var tumblr_link_description = "<?php le('bkt_metadesc', ''); ?>";
									</script>
									<div id="tumblrblock" <?php if(get_option('lefx_disable_tumblr') == 'true') { echo 'class="disable"'; } ?>></div>
									<div id="linkinblock" <?php if(get_option('lefx_disable_linkedin') == 'true') { echo 'class="disable"'; } ?>></div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="clear"></div>
						</div>
						
						<div class="content-block-right<?php if(get_option('disable_unique_link') == 'true') { echo ' disable'; } ?>">
							<label for="email"><?php le('label_success_content', 'OR, COPY AND PASTE THE THE LINK BELOW:'); ?></label>
							<input type="text" id="successcode" value="" onclick="SelectAll('successcode');"/>	
						</div>
						
						</fieldset>
					</form>
					
					
					<!-- FORM (RETURNING USER) -->
	
					<form id="returning" action="">
						<fieldset>
							<h2><?php le('returning_subheading', 'HELLO!'); ?></h2>
							<p><?php le('returning_text', 'Welcome back'); ?> <span class="user"> </span>.<br />
					
							<span <?php if(get_option('disable_unique_link') == 'true') { echo ' class="disable"'; } ?>>
								<span class="clicks"> </span> <?php le('returning_clicks', 'clicked your link so far.'); ?><br />
							</span>
							<span <?php if(get_option('disable_unique_link') == 'true') { echo ' class="disable"'; } ?>>
								<span class="conversions"> </span> <?php le('returning_signups', 'signed up.'); ?>
							</span><br /><br /></p>
					
						<div class="content-block-left<?php if(get_option('disable_social_media') == 'true') { echo ' disable'; } ?>">
							<h2 class="social-heading"><?php le('label_social', 'TO SHARE WITH FRIENDS:'); ?></h2>
							<div class="social-container">
								<div class="social">
									<div id="tweetblock-return" <?php if(get_option('lefx_disable_twitter') == 'true') { echo 'class="disable"'; } ?>></div>
									<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1" type="text/javascript"></script>
									<div id="fblikeblock-return" <?php if(get_option('lefx_disable_facebook') =='true') { echo 'class="disable"'; } ?>></div>
									<div id="plusoneblock-return" <?php if(get_option('lefx_disable_plusone') == 'true') { echo 'class="disable"'; } ?>></div>
									<script type="text/javascript">
										var tumblr_link_name = "<?php le('page_title', 'Launch Effect'); ?>";
										var tumblr_link_description = "<?php le('bkt_metadesc', ''); ?>";
									</script>
									<div id="tumblrblock-return" <?php if(get_option('lefx_disable_tumblr') == 'true') { echo 'class="disable"'; } ?>></div>
									<div id="linkinblock-return" <?php if(get_option('lefx_disable_linkedin') == 'true') { echo 'class="disable"'; } ?>></div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="clear"></div>
						</div>
						
						<div class="content-block-right<?php if(get_option('disable_unique_link') == 'true') { echo ' disable'; } ?>">
							<label><?php le('label_success_content', 'OR, COPY AND PASTE THE THE LINK BELOW:'); ?></label>
							<input type="text" id="returningcode" value="" onclick="SelectAll('returningcode');"/>
						</div>
						
						</fieldset>
					</form>
			
				</div><!-- end #content-blocks-wrapper -->
			
				<div class="clear"></div>
				
				
				<!-- LINK TO BLOG/OTHER WEBSITES -->
					
					<?php if(ler('lefx_description_twitpage') || ler('description_linkurl') || ler('lefx_description_fbpage')) { ?>
					<ul id="inner-footer">
						<?php if(ler('description_linkurl')) { ?>
						<li><a href="<?php le('description_linkurl', '#'); ?>" target="_blank"><?php le('description_linktext', 'Link Text'); ?></a></li>
						<?php } ?>
						<?php if(ler('lefx_description_fbpage')) { ?>
						<li class="inner-footer_icon facebook"><a href="<?php le('lefx_description_fbpage','#'); ?>" target="_blank">Facebook Page</a></li>
						<?php } ?>
						<?php //if(get_option('lefx_disable_description_twitpage') != 'true') { 
							if(ler('lefx_description_twitpage')) {
						?>
						<li class="inner-footer_icon twitter"><a href="<?php le('lefx_description_twitpage','#'); ?>" target="_blank">Follow Me</a></li>
						<?php } ?>
					</ul>
					<?php } ?>

			</div> 
	
		</div> 
	
	</div> 
	
	<div id="privacy-policy" class="jqmWindow"><h2><?php le('lefx_privacy_policy_heading', 'privacy policy'); ?></h2><?php le('lefx_privacy_policy', ''); ?></div>

<?php wp_footer(); ?> 

	<?php if(leimg('supersize', 'supersize_disable')) { ?> 

		<script type="text/javascript">
			var $ = jQuery.noConflict();
			$(function($){
				$.supersized({slides : [ { image : '<?php echo leimg('supersize', 'supersize_disable'); ?>' } ]}); 
			});
		</script>
		
	<?php } else { ?>

		<style type="text/css">
			body {background:<?php echo '#'; le('page_background_color', 'eee'); ?>;}
		</style>
	
	<?php } ?>
				
</body>
</html>
	
