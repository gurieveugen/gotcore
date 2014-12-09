<?php

add_action( 'register_fields_hook', 'register_fields', 10, 2);

function register_fields($optionspanel_array, $optionspanel_name) {
	register_setting($optionspanel_name, $optionspanel_name, 'validate_setting');
	foreach ($optionspanel_array as $key => $value) {
		foreach ($value as $subsection) {
			foreach ($subsection as $op) {
				register_setting($optionspanel_name, $op['option_name']);
				if($op['type'] == 'image') {
					register_setting($optionspanel_name, $op['option_disable']);
					if($op['subtype'] == 'logo') {
						register_setting($optionspanel_name, $op['option_disable2']);
					}
				}
			}
		}
	}
}

// Image Upload Validator... 
// This part is a little bit of poor coding methinks.

$options = get_option('plugin_options');
function validate_setting($array) {
	$keys = array_keys($_FILES);
	$i = 0;

	foreach ( $_FILES as $image ) {

		if ($image['size']) {
			$override = array('test_form' => false);
			$file = wp_handle_upload( $image, $override );
			$array[$keys[$i]] = $file['url'];
		}
		else {
			$options = get_option('plugin_options');
			$array[$keys[$i]] = $options[$keys[$i]];
		}
		$i++;
	}
	return $array;
}

////////////////////


function lefx_exploder_message() { ?>

	<div id="le-iexploder">
		<h3>You're using a really old version of Internet Explorer.</h3>
		<p>This theme options panel has been optimized for <strong>Internet Explorer 8 and 9</strong> and most widely used versions of <strong>Safari, Firefox and Chrome</strong>. If you are using an earlier version of Internet Explorer, you may experience performance issues within this area of the site.</p>
		<p>Additionally, using an outdated browser makes your computer <strong>unsafe</strong>. For the best WordPress experience, please update your browser.</p>
		<p><a href="http://www.microsoft.com/windows/internet-explorer/">Update Internet Explorer</a></p>
	</div>

<?php
}


function lefx_form($theme_options, $theme_options_array) { 

	$option = get_option('le_initiate');  if ($option == 'initiated') {  ?>
	
		<p>You can use the controls on this page to change the look & feel of your Launch Effect page. If you're having any issues, please feel free to contact us at our <a href="http://launcheffect.tenderapp.com" target="_blank">support forums</a>.</p>
		
		<?php lefx_fields($theme_options, $theme_options_array); 
	
	} else { ?>
		
		<div id="le-initiater">
		
			<h3>Welcome!</h3>
			
			<p>Thank you for downloading the Launch Effect theme!  Click "Get Started" to begin customizing the look and feel of your page.  If you're having any issues, please feel free to contact us at our <a href="http://launcheffect.tenderapp.com" target="_blank">support forums</a>.</p>
					
			<form method="post" action="options.php" enctype="multipart/form-data">
				
				<?php settings_fields($theme_options); ?>
			
				<input name="le_initiate" type='hidden' value="initiated" />
				<span class="submit initiate"><input name="Submit" type="submit" value="<?php esc_attr_e('Get Started &rarr;'); ?>" /></span>
	
			</form>
			
		</div>
	
	<?php } 
	
}


function lefx_fields($theme_options, $theme_options_array) { ?>		
	
	<form method="post" action="options.php" enctype="multipart/form-data">
	
		<?php settings_fields($theme_options); ?>
		
		<a href="#" id="collapse-all">Collapse All</a>
		
		<?php foreach ($theme_options_array as $key => $value): ?>
		
			<div class="le-section<?php if ($key == 'Initiate') { echo ' le-initiatehidden'; } ?>">
			
				<div class="le-title">
					<h3><?php echo $key; ?></h3>
					<span class="expand" id="<?php echo str_replace(' ', '', $key); ?>">+</span>
					<span class="submit"><input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" /></span>
					<div class="clearfix"></div>
				</div>
			
				<?php foreach ($value as $subsection): ?>
				
					<div class="le-sub_section">
				
					<?php foreach ($subsection as $op): ?>

						<div class="le-input<?php echo ' ' . $op['class']; ?>">
							<label><?php echo $op['label']; ?></label>
					
						<?php 
							
							// COLORS //////////////////////////////
							if($op['type'] == 'color'): ?>
							
							<input name="<?php echo $op['option_name']; ?>" type='text' value="<?php if (get_option($op['option_name']) != "") { echo stripslashes(get_option($op['option_name'])); } else { echo $op['default']; } ?>" class="colorpicker" />
							<small><?php echo $op['desc']; ?></small>
							
						<?php endif; ?>

						<?php 
							
							// SELECT BOX //////////////////////////////
							if($op['type'] == 'select'): ?>
							
							<small><?php echo $op['desc']; ?></small>
							
							<?php
							 $options = get_option($theme_options);
							 $optionname = $op['option_name'];
							 
							 $selectarray = $op['selectarray'];

							echo '<select name="' . $optionname . '">';
							
							foreach ($selectarray as $option) { 
								
								$firstfive = substr($option, 0, 5);
								$nospace = str_replace(' ','',$firstfive);
								echo '<option class="' . $nospace . '" ';								
								if ( get_option($op['option_name']) == $option) { 
									echo ' selected="selected"'; 
								}
								echo '>' . $option . '</option>';
							
							}
							
							echo '</select>';
								
								// SUBTYPE: SELECTBOX: WEBFONTS //////////////////////////////
								if($op['subtype'] == 'webfont'): 
									
									$selectarray = $op['selectarray']; 
									echo '<ul>';
									
									foreach($selectarray as $selectarray) 
									{
										if($selectarray != '') {
										
										$firstfive = substr($selectarray, 0, 5);
										$nospace = str_replace(' ','',$firstfive);
										echo '<li class="' . $nospace . '"><img src="' . get_bloginfo('template_url') . '/functions/im/' . $nospace . '.png" alt="" /></li>';
										
										}
										
									}
									echo '</ul>';
									
								endif; ?>
							
						<?php endif; ?>
						
						<?php 
						
							// CHIMP API KEY //////////////////////////////
							if($op['type'] == 'chimpkey'): ?>
								
								<div class="le-apply">
									<input name="<?php echo $op['option_name']; ?>" type='text' value="<?php echo get_option($op['option_name']); ?>" />
									<span class="submit apply"><input name="Submit" type="submit" value="<?php esc_attr_e('Apply'); ?>" /></span>
								</div>
								<small>You can generate your API key by following these <a href="http://kb.mailchimp.com/article/where-can-i-find-my-api-key/" target="_blank">instructions</a> or by logging into MailChimp and navigating to Account &raquo; API Keys &amp; Authorized Apps.</small>
						
							<?php endif; ?>

						<?php 
						
							// CHIMP LIST //////////////////////////////
							if($op['type'] == 'chimplist'):

								if(get_option('lefx_mcapikey') != '') {
									
									$chimpkey = get_option('lefx_mcapikey');
									$api = new MCAPI($chimpkey);
									$chimplists = $api->lists(array(),0,100);
									$chimplists = $chimplists['data'];
									$optionname = $op['option_name'];
									
									//echo '<pre>'; print_r($chimplists); echo '</pre>';
									
									echo '<select name="' . $optionname . '">';
									foreach($chimplists as $list) {
										echo '<option value="' . $list['id'] . '"';
										
										if ( get_option($op['option_name']) == $list['id']) { 
											echo ' selected="selected"'; 
										}
										
										echo '>' . $list['name'] . '</option>';
									}
									echo '</select>'; ?>
									
									<small>Select the subscriber list you'd like your Launch Effect signups to be added to.</small>
								
								<?php } else { ?>
									
									
									<select disabled="disabled">
										<option>(API Key Undefined)</option>
									</select>
									
									<small>Enter your API key above and hit "Apply" in order for all of your subscriber lists to appear in the dropdown.</small>
									
								<?php }
								
								?>
						
							<?php endif; ?>
						
						<?php 
						
							// TEXT //////////////////////////////
							if($op['type'] == 'text'): ?>

							<input name="<?php echo $op['option_name']; ?>" type='text' value="<?php echo get_option($op['option_name']); ?>" />
							<small><?php echo $op['desc']; ?></small>

						<?php endif; ?>
						
						<?php 
						
							// INITIATE //////////////////////////////
							if($op['type'] == 'initiate'): ?>

						<?php endif; ?>
						
						<?php 
							
							// TEXTAREA //////////////////////////////
							if($op['type'] == 'textarea'): ?>

							<?php $descriptionText = get_option($op['option_name']); ?>
							<textarea name="<?php echo $op['option_name']; ?>" type='text' value="<?php echo htmlentities($descriptionText); ?>" /><?php echo ($descriptionText); ?></textarea>
							<small><?php echo $op['desc']; ?></small>

						<?php endif; ?>
						
						<?php 
						
							// IMAGE //////////////////////////////
							if($op['type'] == 'image'): 
								$options = get_option($theme_options);
						?>
							<input type="file" name="<?php echo $op['option_name']; ?>" size="20"/>
							
							<small><?php echo $op['desc']; ?></small> 
							
							<?php if(get_option($op['option_disable']) == true ){ $checked = "checked=\"checked\""; } else { $checked = "";} ?>
							<div class="le-check-delete"><input type="checkbox" name="<?php echo $op['option_disable']; ?>" value="true" <?php echo $checked; ?>/><p>Check to disable <?php echo $op['label']; ?>.</p></div>
							
								<?php 
								
									// SUBTYPE: IMAGE: LOGO	 //////////////////////////////
									if($op['subtype'] == 'logo'): 

									if(get_option($op['option_disable2']) == true) { $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
									<div class="le-check-delete"><input type="checkbox" name="<?php echo $op['option_disable2']; ?>" value="true" <?php echo $checked; ?>/><p>Check to disable Text Title.</p></div>
								
								<?php endif; ?>
							
							<br /><?php if($logopreview = "{$options[$op['option_name']]}") { echo "<div class=\"le-preview\"><img src='$logopreview' class=\"le-logopreview\" /></div>"; } ?>
							<div class="clearfix"></div>  

						<?php endif; ?>
						
						<?php 
						
							// CHECK //////////////////////////////
							if($op['type'] == 'check'): 
						?>
							
							<?php if(get_option($op['option_name']) == true) { $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
							<input type="checkbox" name="<?php echo $op['option_name']; ?>" value="true" <?php echo $checked; ?>/>
							<small><?php echo $op['desc']; ?></small>
							
						<?php endif; ?>
						
						<?php 
						
							// DATEPICKER //////////////////////////////
							if($op['type'] == 'datepicker'): 
						?>

							<input name="<?php echo $op['option_name']; ?>" type="text" class="datepicker" value="<?php if (get_option($op['option_name']) != "") { echo stripslashes(get_option($op['option_name'])); } else { echo date('m/d/Y'); } ?>">

						<?php endif; ?>
						
						</div>
						
					<?php endforeach; ?>
					
					</div>
					
				<?php endforeach; ?>
			
			</div>
			
			<br />
		
		<?php endforeach; ?>
		
		<input name="le_initiate" type='hidden' value="initiated" />	
		
	</form>

<?php
			
}

?>