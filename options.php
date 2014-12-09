<style type="text/css">

	<?php 
	
	// EFFECTS			
	$textShadow = '0px 2px 1px #333';
	$letterPress = '0px 1px 1px #' . lighter('container_background_color');
	$dropShadow = '-webkit-box-shadow: 0px 0px 10px #111; -moz-box-shadow: 0px 0px 10px #111; box-shadow: 0px 0px 10px #111;';
	$glow = '-webkit-box-shadow: 0px 0px 10px #FFF;	-moz-box-shadow: 0px 0px 10px #FFF; box-shadow: 0px 0px 10px #FFF;';
	$noShadow = '-webkit-box-shadow: 0px 0px 0px #FFF; -moz-box-shadow: 0px 0px 0px #FFF; box-shadow: 0px 0px 0px #FFF;';
	
	?>
	
	h1 {
		font-family:<?php legogl('heading_font_goog', 'heading_font'); ?>;
		font-size:<?php echo ler('heading_size') . 'em'; ?>;
		font-weight:<?php lewt('heading_style'); ?>;
		font-style:<?php lestyle('heading_style'); ?>;
		color:<?php echo '#'; le('heading_color','333'); ?>;
		text-shadow: <?php if(get_option('heading_effects') == 'letterpress') { echo $letterPress; } elseif(get_option('heading_effects') == 'shadow') {echo $textShadow;} else {echo 'none'; } ?>;
	}
	
	h2 {
		font-family:<?php legogl('subheading_font_goog', 'subheading_font'); ?>;
		font-size:<?php echo ler('subheading_size') . 'em'; ?>;
		font-weight:<?php lewt('subheading_style'); ?>;
		font-style:<?php lestyle('subheading_style'); ?>;
		color:<?php echo '#'; le('subheading_color','333'); ?>;
		text-shadow: <?php if(get_option('subheading_effects') == 'letterpress') { echo $letterPress; } elseif(get_option('subheading_effects') == 'shadow') {echo $textShadow;} else {echo 'none'; } ?>;
	}
	
	
	h2.social-heading, label {
		font-family:<?php legogl('label_font_goog', 'label_font'); ?>;
		font-size:<?php echo ler('label_size') . 'em'; ?>;
		font-weight:<?php lewt('label_style') ?>;
		font-style:<?php lestyle('label_style') ?>;
		color:<?php echo '#'; le('label_color','333'); ?>;
		text-shadow: <?php if(get_option('label_effects') == 'letterpress') { echo $letterPress; } elseif(get_option('label_effects') == 'shadow') {echo $textShadow;} else {echo 'none'; } ?>;
	}
	
	p, ul#inner-footer li a {
		font-size:<?php echo ler('description_size') . 'em'; ?>;
		font-family:<?php legogl('description_font_goog', 'description_font'); ?>;
	}

	p, span.privacy-policy {
		color:<?php echo '#'; le('description_color','333'); ?>;
	}
	
	p a, ul#inner-footer li a, span.privacy-policy a {
		color:<?php echo '#'; le('description_link_color','333'); ?> !important;
	}
	
	input#submit-button {
		background-color:<?php echo '#'; le('label_color','333'); ?>;
	}
	
	span#submit-button-border {
		border-color:<?php echo '#' . darker('label_color'); ?>;
	}
	
	input#submit-button:hover {
		background-color:<?php echo '#' . darker('label_color'); ?>;
	}
	
	#inner-container {
		width:<?php if(get_option('container_width') == 'small') { echo '320px'; } elseif(get_option('container_width') == 'medium') {echo '510px';} elseif(get_option('container_width') == 'large') {echo '700px';} else {echo '320px'; } ?>;		
		
		<?php if(get_option('container_position') == 'left') { echo 'float:left; margin-left:30px; margin-right:0;'; } elseif(get_option('container_position') == 'center') {echo 'margin-left:auto; margin-right:auto;';} elseif(get_option('container_position') == 'right') {echo 'float:right; margin-right:30px; margin-left:0;';} else {echo 'margin-left:auto; margin-right:auto;'; } ?>
		
<?php if(leimg('background','background_disable')) { ?>
		background-image:url('<?php echo leimg('background','background_disable'); ?>'); 
		background-color:transparent;
		<?php } else { ?><?php if(ler('container_background_color')) { ?>
		background-color: <?php echo '#' . ler('container_background_color'); ?>; <?php } ?><?php } ?>
		
		border-width:<?php echo ler('container_border_width'); ?>;
		border-color:<?php echo '#'; le('container_border_color','fff'); ?>;
		border-style:solid;
		<?php if(get_option('container_effects') == 'dropshadow') { echo $dropShadow; } elseif(get_option('container_effects') == 'glow') { echo $glow; } else { echo $noShadow; } ?>
	
	}
	
<?php if(get_option('container_width') == 'medium') { ?>

	.feature {
		width:510px;
	}
	
	.social-container {
		width:492px;
	}

<?php } elseif(get_option('container_width') == 'large') { ?>

	.content-block-left {
		float:left;
		width:360px;
		margin-right:20px;
	}
	
	.content-block-right {
		float:left;
		width:320px;
	}
	
	.feature {
		width:700px;
	}

<?php }
?>

	input,
	textarea,
	input#submit-button {
		-webkit-appearance: none !important;
	}

</style>