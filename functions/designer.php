<?php

function designer_optionspanel_name() {
	$type = 'plugin_options';
	return $type;
}

function designer_optionspanel_array() {

	$array = array(
	
	'Head' => 	
		array(
			array( // subsection
				array(
					'label' => 'Page Title',
					'type' => 'text',
					'class' => 'le-threecol',
					'option_name' => 'page_title',
					'desc' => 'This is the title that\'ll appear on the web browser.',
					'subtype' => '',
				),
			),
			array( // subsection
				array(
					'label' => 'Meta Description',
					'type' => 'textarea',
					'class' => 'le-threecol',
					'option_name' => 'bkt_metadesc',
					'desc' => 'A short sentence should do.',
					'subtype' => '',
				),
			),
			array( // subsection
				array(
					'label' => 'Meta Keywords',
					'type' => 'textarea',
					'class' => 'le-threecol',
					'option_name' => 'bkt_metakey',
					'desc' => 'Separate keywords with a comma.',
					'subtype' => '',
				),
			),
			array( // subsection
				array( 
					'label' => 'Upload Favicon',
					'type' => 'image',
					'option_name' => 'bkt_favicon',
					'option_disable' => 'bkt_favdisable',
					'desc' => 'Favicon should not exceed 16 x 16 pixels.  Check the box to disable the favicon.  Your favicon will not be deleted.',
					'class' => 'le-threecol le-favicon',
					'subtype' => '',
				)
			),
			array( // subsection
				array( 
					'label' => 'Upload Site Thumbnail',
					'type' => 'image',
					'option_name' => 'bkt_thumb',
					'option_disable' => 'bkt_thumbdisable',
					'desc' => 'Small image to automatically accompany social media posts.  Image must be at least 50 x 50 pixels. Square images work best.',
					'class' => 'le-threecol',
					'subtype' => '',
				)
			),
			array( // subsection
				array(
					'label' => 'Typekit ID',
					'type' => 'text',
					'option_name' => 'lefx_typekit',
					'class' => 'le-threecol',
					'desc' => 'Assign your Typekit fonts to the following selectors:<br /><strong>h1</strong> (title)<br /><strong>h2</strong> (subheading)<br /><strong>label</strong> (label)<br /><strong>p</strong> (body text)<br /><br />Typekit will override all Google Webfonts selections.',
					'subtype' => '',
				)
			),
			array( // subsection
				array(
					'label' => 'Monotype ID',
					'type' => 'text',
					'option_name' => 'lefx_monotype',
					'class' => 'le-threecol',
					'desc' => 'Assign your Monotype fonts to the following selectors:<br /><strong>h1</strong> (title)<br /><strong>h2</strong> (subheading)<br /><strong>label</strong> (label)<br /><strong>p</strong> (body text)<br /><br />You can find your ID by going into your project and clicking on the "Publish" tab, then selecting the long code after ".../jsapi/" and before the ".js" within the script embed textarea.<br /><br />Monotype will override all Google Webfonts selections.',
					'subtype' => '',
				)
			),
/*
			array( // subsection
				array(
					'label' => 'Site Credits',
					'type' => 'textarea',
					'option_name' => 'lefx_credits',
					'class' => 'le-threecol',
					'desc' => 'This text will appear in the small black tab at the lower right-hand corner of the site.  You can use it to credit a photographer, for example, or for something like copyright information.',
					'subtype' => '',
				)
			),
			array( // subsection
				array(
					'label' => 'Date Picker',
					'type' => 'datepicker',
					'option_name' => 'lefx_startdate',
					'class' => 'le-threecol',
					'desc' => '',
					'subtype' => '',
				)
			),
*/
		),
		
	'Page' => 
		array(
			array( // subsection
				array( 
					'label' => 'Background Color',
					'type' => 'color',
					'option_name' => 'page_background_color',
					'default' => '',
					'class' => 'le-color',
					'subtype' => '',
					'desc' => ''
				),
			),
			array( // subsection
				array( 
					'label' => 'Background Image',
					'type' => 'image',
					'option_name' => 'supersize',
					'option_disable' => 'supersize_disable',
					'desc' => 'For best results, choose an image that is large but keep the image size under 200KB.',
					'class' => 'le-threecol',
					'subtype' => '',
				)
			),
		),
	
	'Container' => 
		array(
			array( // subsection
				array( 
					'label' => 'Size',
					'type' => 'select',
					'option_name' => 'container_width',
					'selectarray' => array('small','medium','large'),
					'class' => 'le-select_small',
					'subtype' => '',
					'desc' => ''
				),
				array( 
					'label' => 'Position',
					'type' => 'select',
					'option_name' => 'container_position',
					'selectarray' => array('center','left','right'),
					'class' => 'le-select_small',
					'subtype' => '',
					'desc' => ''
				),
				array( 
					'label' => 'Background Color',
					'type' => 'color',
					'option_name' => 'container_background_color',
					'default' => '',
					'class' => 'le-color',
					'subtype' => '',
					'desc' => ''
				),
				array(
					'label' => 'Border Width',
					'type' => 'select',
					'option_name' => 'container_border_width',
					'selectarray' => array('0px', '1px', '2px', '3px', '4px', '5px', '6px', '8px', '10px', '12px', '14px', '16px', '18px', '20px'),
					'class' => 'le-select_small',
					'subtype' => '',
					'desc' => ''
				),
				array( 
					'label' => 'Border Color',
					'type' => 'color',
					'option_name' => 'container_border_color',
					'default' => '',
					'class' => 'le-color',
					'subtype' => '',
					'desc' => ''
				),
				array( 
					'label' => 'Effects',
					'type' => 'select',
					'option_name' => 'container_effects',
					'selectarray' => array('dropshadow', 'glow', 'none'),
					'class' => 'le-select_small',
					'subtype' => '',
					'desc' => ''
				),
			),
			array( // subsection
				array( 
					'label' => 'Logo Image',
					'type' => 'image',
					'option_name' => 'bkt_logo',
					'option_disable' => 'bkt_logodisable',
					'option_disable2' => 'bkt_logotitledisable',
					'subtype' => 'logo',
					'desc' => 'Check the box to disable the custom image.  Your image will not be deleted.',
					'class' => 'le-threecol'
				)
			),
			array( // subsection
				array( 
					'label' => 'Video Embed Code (Vimeo/YouTube)',
					'type' => 'textarea',
					'option_name' => 'video_embed',
					'desc' => 'Paste the video\'s <strong>embed</strong> code here.<br />Be sure to adjust the width of the video according to the container size you chose:<br /><strong>Small</strong> 320<br /><strong>Medium</strong> 510<br /><strong>Large</strong> 700<br /><br />Information about embedding and resizing can be found here:<br /><a href="#" class="modal-trigger" id="modal-youtube-info">YouTube</a><br /><a href="#" class="modal-trigger" id="modal-vimeo-info">Vimeo</a>',
					'subtype' => '',
					'class' => ''
				)
			),
			array( // subsection
				array( 
					'label' => 'Background Image',
					'type' => 'image',
					'option_name' => 'background',
					'option_disable' => 'background_disable',
					'desc' => 'For best results, choose an image that is tile-able.',
					'class' => 'le-threecol',
					'subtype' => '',
				)
			),
			array( // subsection
				array(
					'label' => 'Facebook Icon URL',
					'type' => 'text',
					'option_name' => 'lefx_description_fbpage',
					'desc' => 'Link to your Facebook page.  This icon appears in the bottom left corner of the container.',
					'subtype' => '',
					'class' => ''
				)
			),
			array( // subsection
				array(
					'label' => 'Twitter Icon URL',
					'type' => 'text',
					'option_name' => 'lefx_description_twitpage',
					'desc' => 'Link to your Twitter page. This icon appears in the bottom left corner of the container.',
					'subtype' => '',
					'class' => ''
				)
			),
			array( // subsection
				array(
					'label' => 'Link URL',
					'type' => 'text',
					'option_name' => 'description_linkurl',
					'desc' => 'Link to your blog or a related website',
					'subtype' => '',
					'class' => ''
				),
				array(
					'label' => 'Link Text',
					'type' => 'text',
					'option_name' => 'description_linktext',
					'desc' => 'This visible text will appear on the bottom right corner of the container.',
					'subtype' => '',
					'class' => ''
				),
			),
		),
	
	'Title' => 	
		array(
			array( // subsection
				array(
					'label' => 'Heading Text',
					'type' => 'text',
					'option_name' => 'heading_content',
					'desc' => 'Your company/product name or a fancy title goes here.',
					'subtype' => '',
					'class' => ''
				),
			),
			array( // subsection
				array(
					'label' => 'Color',
					'type' => 'color',
					'option_name' => 'heading_color',
					'default' => '',
					'class' => 'le-color',
					'subtype' => '',
					'desc' => ''
				),
				array(
					'label' => 'Size',
					'type' => 'select',
					'option_name' => 'heading_size',
					'selectarray' => array('2.4', '2.6', '2.8', '3.0', '3.2', '3.4', '3.6', '3.8', '4.0', '4.2', '4.4', '4.6', '5.0'),
					'class' => 'le-select_small',
					'subtype' => '',
					'desc' => ''
				),
				array(
					'label' => 'Style',
					'type' => 'select',
					'option_name' => 'heading_style',
					'selectarray' => array('normal', 'bold', 'italic', 'bold italic'),
					'class' => 'le-select_small',
					'subtype' => '',
					'desc' => ''
				),
				array(
					'label' => 'Effects',
					'type' => 'select',
					'option_name' => 'heading_effects',
					'selectarray' => array('none','letterpress','shadow'),
					'class' => 'le-select_small',
					'subtype' => '',
					'desc' => ''
				),
			),
			array( // subsection
				array(
					'label' => 'Font: Google WebFonts',
					'type' => 'select',
					'subtype' => 'webfont',
					'option_name' => 'heading_font_goog',
					'class' => 'le-select_large le-select_webfont',
					'selectarray' => array('','Abel','Allerta Stencil','Anton','Architects Daughter','Arvo','Bangers','Bevan','Bowlby One SC','Cabin Sketch:700','Cardo','Chewy','Corben:700','Dancing Script','Delius Swash Caps','Didact Gothic','Forum','Francois One','Geo','Gravitas One','Gruppo','Hammersmith One','IM Fell Double Pica SC','Josefin Sans','Kameron','League Script','Leckerli One','Loved by the King','Maiden Orange','Maven Pro','Muli','Nixie One','Old Standard TT','Oswald','Ovo','Pacifico','Permanent Marker','Playfair Display','Podkova','Pompiere','Raleway:100','Rokkitt','Six Caps','Sniglet:800','Syncopate','Terminal Dosis Light','Ultra','Unna','Varela Round','Yanone Kaffeesatz'),
					'desc' => 'Select your Google Webfont from this list.'
				),
			),
			array( // subsection
				array(
					'label' => 'Font: Basic Sets',
					'type' => 'select',
					'option_name' => 'heading_font',
					'class' => 'le-select_large',
					'selectarray' => array('Arial, "Helvetica Neue", Helvetica, sans-serif', 'Baskerville, Times, "Times New Roman", serif', 'Cambria, Georgia, Times, "Times New Roman", serif', '"Century Gothic", "Apple Gothic", sans-serif', 'Consolas, "Lucida Console", Monaco, monospace', '"Copperplate Light", "Copperplate Gothic Light", serif', '"Courier New", Courier, monospace', '"Franklin Gothic Medium", "Arial Narrow Bold", Arial, sans-serif', 'Futura, "Century Gothic", AppleGothic, sans-serif', 'Garamond, "Hoefler Text", Palatino, "Palatino Linotype", serif', 'Geneva, Verdana, "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif', 'Georgia, Times, "Times New Roman", serif', '"Gill Sans", "Trebuchet MS", Calibri, sans-serif', 'Helvetica, "Helvetica Neue", Arial, sans-serif', 'Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif', '"Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif', 'Palatino, "Palatino Linotype", "Hoefler Text", Times, "Times New Roman", serif', 'Tahoma, Verdana, Geneva', 'Times, "Times New Roman", Georgia, serif', '"Trebuchet MS", Tahoma, Arial, sans-serif', 'Verdana, Tahoma, Geneva, sans-serif'),
					'desc' => 'Select from this list if you\'d prefer to use a basic font set instead of Google WebFonts.',
					'subtype' => '',
				)
			),
		),
		
	'Sub-Heading' => 	
		array(
			array( // subsection
				array(
					'label' => 'Sub-Heading Text',
					'type' => 'text',
					'option_name' => 'subheading_content',
					'desc' => 'This text goes under the Heading and is usually a very brief description.',
					'subtype' => '',
					'class' => ''
				),
			),
			array( // subsection
				array(
					'label' => 'Sub-Heading Text, after Submit',
					'type' => 'text',
					'option_name' => 'subheading_content2',
					'desc' => '<strong>Suggested Text:</strong> THANKS! WANT TO IMPROVE YOUR CHANCES OF [gaining incentive]?',
					'subtype' => '',
					'class' => ''
				),
			),
			array( // subsection
				array(
					'label' => 'Color',
					'type' => 'color',
					'option_name' => 'subheading_color',
					'default' => '',
					'class' => 'le-color',
					'subtype' => '',
					'desc' => ''
				),
				array(
					'label' => 'Size',
					'type' => 'select',
					'option_name' => 'subheading_size',
					'selectarray' => array('0.8', '1.0', '1.2', '1.4', '1.6', '1.8', '2.0'),
					'class' => 'le-select_small',
					'subtype' => '',
					'desc' => ''
				),
				array(
					'label' => 'Style',
					'type' => 'select',
					'option_name' => 'subheading_style',
					'selectarray' => array('normal', 'bold', 'italic', 'bold italic'),
					'class' => 'le-select_small',
					'subtype' => '',
					'desc' => ''
				),
				array(
					'label' => 'Effects',
					'type' => 'select',
					'option_name' => 'subheading_effects',
					'selectarray' => array('none','letterpress','shadow'),
					'class' => 'le-select_small',
					'subtype' => '',
					'desc' => ''
				),
			),
			array( // subsection
				array(
					'label' => 'Font: Google WebFonts',
					'type' => 'select',
					'subtype' => 'webfont',
					'option_name' => 'subheading_font_goog',
					'class' => 'le-select_large le-select_webfont',
					'selectarray' => array('','Abel','Allerta Stencil','Anton','Architects Daughter','Arvo','Bangers','Bevan','Bowlby One SC','Cabin Sketch:700','Cardo','Chewy','Corben:700','Dancing Script','Delius Swash Caps','Didact Gothic','Forum','Francois One','Geo','Gravitas One','Gruppo','Hammersmith One','IM Fell Double Pica SC','Josefin Sans','Kameron','League Script','Leckerli One','Loved by the King','Maiden Orange','Maven Pro','Muli','Nixie One','Old Standard TT','Oswald','Ovo','Pacifico','Permanent Marker','Playfair Display','Podkova','Pompiere','Raleway:100','Rokkitt','Six Caps','Sniglet:800','Syncopate','Terminal Dosis Light','Ultra','Unna','Varela Round','Yanone Kaffeesatz'),
					'desc' => 'Select your Google Webfont from this list.',
					'subtype' => 'webfont',
				),
			),
			array( // subsection
				array(
					'label' => 'Font: Basic Sets',
					'type' => 'select',
					'option_name' => 'subheading_font',
					'class' => 'le-select_large',
					'selectarray' => array('Arial, "Helvetica Neue", Helvetica, sans-serif', 'Baskerville, "Times New Roman", Times, serif', 'Cambria, Georgia, Times, "Times New Roman", serif', '"Century Gothic", "Apple Gothic", sans-serif', 'Consolas, "Lucida Console", Monaco, monospace', '"Copperplate Light", "Copperplate Gothic Light", serif', '"Courier New", Courier, monospace', '"Franklin Gothic Medium", "Arial Narrow Bold", Arial, sans-serif', 'Futura, "Century Gothic", AppleGothic, sans-serif', 'Garamond, "Hoefler Text", Times New Roman, Times, serif', 'Geneva, "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", Verdana, sans-serif', 'Georgia, Palatino," Palatino Linotype", Times, "Times New Roman", serif', '"Gill Sans", Calibri, "Trebuchet MS", sans-serif', '"Helvetica Neue", Arial, Helvetica, sans-serif', 'Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif', '"Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif', 'Palatino, "Palatino Linotype", Georgia, Times, "Times New Roman", serif', 'Tahoma, Geneva, Verdana', 'Times, "Times New Roman", Georgia, serif', '"Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande"," Lucida Sans", Arial, sans-serif', 'Verdana, Geneva, Tahoma, sans-serif'),
					'desc' => 'Select from this list if you\'d prefer to use a basic font set instead of Google WebFonts.',
					'subtype' => '',
				)
			),
		),
		
	'Body Text' => 	
		array(
			array( // subsection
				array(
					'label' => 'Description Text',
					'type' => 'textarea',
					'option_name' => 'description_content',
					'desc' => 'Write a short description about your company/product and if you want, offer an incentive for signing up and sharing (discount, early access, etc.)',
					'subtype' => '',
					'class' => ''
				),
			),
			array( // subsection
				array(
					'label' => 'Description Text, after Submit',
					'type' => 'textarea',
					'option_name' => 'description_content2',
					'desc' => 'You can repeat the description or write more about how to achieve the incentive. (e.g. "Invite friends using the link below. The more friends you invite, the better your chances!")',
					'subtype' => '',
					'class' => ''
				),
			),
			array( // subsection
				array(
					'label' => 'Text Color',
					'type' => 'color',
					'option_name' => 'description_color',
					'default' => '',
					'class' => 'le-color',
					'subtype' => '',
					'desc' => ''
				),
				array(
					'label' => 'Link Color',
					'type' => 'color',
					'option_name' => 'description_link_color',
					'default' => '',
					'class' => 'le-color',
					'subtype' => '',
					'desc' => ''
				),
				array(
					'label' => 'Size',
					'type' => 'select',
					'option_name' => 'description_size',
					'selectarray' => array('0.6', '0.8', '1.0', '1.2', '1.4', '1.6', '1.8', '2.0'),
					'class' => 'le-select_small',
					'subtype' => '',
					'desc' => ''
				)
			),
			array( // subsection
				array(
					'label' => 'Font: Google WebFonts',
					'type' => 'select',
					'subtype' => 'webfont',
					'option_name' => 'description_font_goog',
					'class' => 'le-select_large le-select_webfont',
					'selectarray' => array('','Abel','Allerta Stencil','Anton','Architects Daughter','Arvo','Bangers','Bevan','Bowlby One SC','Cabin Sketch:700','Cardo','Chewy','Corben:700','Dancing Script','Delius Swash Caps','Didact Gothic','Forum','Francois One','Geo','Gravitas One','Gruppo','Hammersmith One','IM Fell Double Pica SC','Josefin Sans','Kameron','League Script','Leckerli One','Loved by the King','Maiden Orange','Maven Pro','Muli','Nixie One','Old Standard TT','Oswald','Ovo','Pacifico','Permanent Marker','Playfair Display','Podkova','Pompiere','Raleway:100','Rokkitt','Six Caps','Sniglet:800','Syncopate','Terminal Dosis Light','Ultra','Unna','Varela Round','Yanone Kaffeesatz'),
					'desc' => 'Select your Google Webfont from this list.'
				),
			),
			array( // subsection
				array(
					'label' => 'Font: Basic Sets',
					'type' => 'select',
					'option_name' => 'description_font',
					'class' => 'le-select_large',
					'selectarray' => array('Arial, "Helvetica Neue", Helvetica, sans-serif', 'Baskerville, "Times New Roman", Times, serif', 'Cambria, Georgia, Times, "Times New Roman", serif', '"Century Gothic", "Apple Gothic", sans-serif', 'Consolas, "Lucida Console", Monaco, monospace', '"Copperplate Light", "Copperplate Gothic Light", serif', '"Courier New", Courier, monospace', '"Franklin Gothic Medium", "Arial Narrow Bold", Arial, sans-serif', 'Futura, "Century Gothic", AppleGothic, sans-serif', 'Garamond, "Hoefler Text", Times New Roman, Times, serif', 'Geneva, "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", Verdana, sans-serif', 'Georgia, Palatino," Palatino Linotype", Times, "Times New Roman", serif', '"Gill Sans", Calibri, "Trebuchet MS", sans-serif', '"Helvetica Neue", Arial, Helvetica, sans-serif', 'Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif', '"Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif', 'Palatino, "Palatino Linotype", Georgia, Times, "Times New Roman", serif', 'Tahoma, Geneva, Verdana', 'Times, "Times New Roman", Georgia, serif', '"Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande"," Lucida Sans", Arial, sans-serif', 'Verdana, Geneva, Tahoma, sans-serif'),
					'desc' => 'Select from this list if you\'d prefer to use a basic font set instead of Google WebFonts.',
					'subtype' => '',
				)
			),
		),
		
	'Signup Settings' => 	
		array(
			array( // subsection
				array(
					'label' => 'Label Text',
					'type' => 'text',
					'option_name' => 'label_content',
					'desc' => '<strong>Suggested Text:</strong> ENTER YOUR EMAIL ADDRESS',
					'subtype' => '',
					'class' => ''
				),
			),
			array( // subsection
				array(
					'label' => 'Social Media Label Text',
					'type' => 'text',
					'option_name' => 'label_social',
					'desc' => 'Only appears after submit.<br /><strong>Suggested Text:</strong> TO SHARE WITH FRIENDS:',
					'subtype' => '',
					'class' => ''
				),
				array( 
					'label' => 'Disable Entire Share Section',
					'type' => 'check',
					'option_name' => 'disable_social_media',
					'class' => 'le-check',
					'subtype' => '',
					'desc' => ''
				),
				array( 
					'label' => 'Disable Twitter',
					'type' => 'check',
					'option_name' => 'lefx_disable_twitter',
					'class' => 'le-check',
					'subtype' => '',
					'desc' => ''
				),
				array( 
					'label' => 'Disable Facebook',
					'type' => 'check',
					'option_name' => 'lefx_disable_facebook',
					'class' => 'le-check',
					'subtype' => '',
					'desc' => ''
				),
				array( 
					'label' => 'Disable Google +1',
					'type' => 'check',
					'option_name' => 'lefx_disable_plusone',
					'class' => 'le-check',
					'subtype' => '',
					'desc' => ''
				),
				array( 
					'label' => 'Disable Tumblr',
					'type' => 'check',
					'option_name' => 'lefx_disable_tumblr',
					'class' => 'le-check'
				),
				array( 
					'label' => 'Disable LinkedIn',
					'type' => 'check',
					'option_name' => 'lefx_disable_linkedin',
					'class' => 'le-check'
				),
			),
			array( // subsection
				array(
					'label' => 'Unique URL Label Text',
					'type' => 'text',
					'option_name' => 'label_success_content',
					'desc' => 'Only appears after submit.<br /><strong>Suggested Text:</strong> OR, COPY AND PASTE THE THE LINK BELOW:',
					'subtype' => '',
					'class' => ''
				),
				array( 
					'label' => 'Disable Unique URL Generator',
					'type' => 'check',
					'option_name' => 'disable_unique_link',
					'class' => 'le-check',
					'subtype' => '',
					'desc' => ''
				),
			),
			array( // subsection
				array(
					'label' => 'Color',
					'type' => 'color',
					'option_name' => 'label_color',
					'default' => '',
					'class' => 'le-color',
					'desc' => 'Note: Button will take on same color as label.',
					'subtype' => '',
				),
				array(
					'label' => 'Size',
					'type' => 'select',
					'option_name' => 'label_size',
					'selectarray' => array('0.8', '1.0', '1.2', '1.4', '1.6', '1.8', '2.0'),
					'class' => 'le-select_small',
					'subtype' => '',
					'desc' => ''
				),
				array(
					'label' => 'Style',
					'type' => 'select',
					'option_name' => 'label_style',
					'selectarray' => array('normal', 'bold', 'italic', 'bold italic'),
					'class' => 'le-select_small',
					'subtype' => '',
					'desc' => ''
				),
				array(
					'label' => 'Effects',
					'type' => 'select',
					'option_name' => 'label_effects',
					'selectarray' => array('none', 'letterpress','shadow'),
					'class' => 'le-select_small',
					'subtype' => '',
					'desc' => ''
				),
			),
			array( // subsection
				array(
					'label' => 'Font: Google WebFonts',
					'type' => 'select',
					'subtype' => 'webfont',
					'option_name' => 'label_font_goog',
					'class' => 'le-select_large le-select_webfont',
					'selectarray' => array('','Abel','Allerta Stencil','Anton','Architects Daughter','Arvo','Bangers','Bevan','Bowlby One SC','Cabin Sketch:700','Cardo','Chewy','Corben:700','Dancing Script','Delius Swash Caps','Didact Gothic','Forum','Francois One','Geo','Gravitas One','Gruppo','Hammersmith One','IM Fell Double Pica SC','Josefin Sans','Kameron','League Script','Leckerli One','Loved by the King','Maiden Orange','Maven Pro','Muli','Nixie One','Old Standard TT','Oswald','Ovo','Pacifico','Permanent Marker','Playfair Display','Podkova','Pompiere','Raleway:100','Rokkitt','Six Caps','Sniglet:800','Syncopate','Terminal Dosis Light','Ultra','Unna','Varela Round','Yanone Kaffeesatz'),
					'desc' => 'Select your Google Webfont from this list.'
				),
			),
			array( // subsection
				array(
					'label' => 'Font: Basic Sets',
					'type' => 'select',
					'option_name' => 'label_font',
					'class' => 'le-select_large',
					'selectarray' => array('Arial, "Helvetica Neue", Helvetica, sans-serif', 'Baskerville, "Times New Roman", Times, serif', 'Cambria, Georgia, Times, "Times New Roman", serif', '"Century Gothic", "Apple Gothic", sans-serif', 'Consolas, "Lucida Console", Monaco, monospace', '"Copperplate Light", "Copperplate Gothic Light", serif', '"Courier New", Courier, monospace', '"Franklin Gothic Medium", "Arial Narrow Bold", Arial, sans-serif', 'Futura, "Century Gothic", AppleGothic, sans-serif', 'Garamond, "Hoefler Text", Times New Roman, Times, serif', 'Geneva, "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", Verdana, sans-serif', 'Georgia, Palatino," Palatino Linotype", Times, "Times New Roman", serif', '"Gill Sans", Calibri, "Trebuchet MS", sans-serif', '"Helvetica Neue", Arial, Helvetica, sans-serif', 'Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif', '"Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif', 'Palatino, "Palatino Linotype", Georgia, Times, "Times New Roman", serif', 'Tahoma, Geneva, Verdana', 'Times, "Times New Roman", Georgia, serif', '"Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande"," Lucida Sans", Arial, sans-serif', 'Verdana, Geneva, Tahoma, sans-serif'),
					'desc' => 'Select from this list if you\'d prefer to use a basic font set instead of Google WebFonts.',
					'subtype' => '',
				)
			),
			array( // subsection
				array( 
					'label' => 'Enable Privacy Policy',
					'type' => 'check',
					'option_name' => 'lefx_enable_privacy_policy',
					'class' => 'le-check',
					'subtype' => '',
					'desc' => ''
				),
				array(
					'label' => 'Privacy Policy Label',
					'type' => 'text',
					'class' => 'le-threecol',
					'option_name' => 'lefx_privacy_policy_label',
					'desc' => 'If privacy policy is enabled, this is the text that will appear directly below the email signup field.  The text for the link to the privacy policy itself is determined by what is filled out below for the Privacy Policy Name.<br /><br /><strong>Suggestion: </strong>By submitting this email, I understand the',
					'subtype' => '',
				),	
				array(
					'label' => 'Privacy Policy Name',
					'type' => 'text',
					'class' => 'le-threecol',
					'option_name' => 'lefx_privacy_policy_heading',
					'desc' => '<strong>Suggestion: </strong>privacy policy',
					'subtype' => '',
				),	
				array(
					'label' => 'Privacy Policy Text',
					'type' => 'textarea',
					'class' => 'le-threecol',
					'option_name' => 'lefx_privacy_policy',
					'desc' => 'This is the information that opens in a popup window.',
					'subtype' => '',
				),		
			),
		),
		
	'Returning Visitors Screen' => 	
		array(
			array( // subsection
				array(
					'label' => 'Greeting Subheading',
					'type' => 'text',
					'option_name' => 'returning_subheading',
					'desc' => '<strong>Suggested Text:</strong> HELLO!',
					'subtype' => '',
					'class' => ''
				),
			),
			array( // subsection
				array(
					'label' => '"Welcome back" [visitor\'s name]',
					'type' => 'text',
					'option_name' => 'returning_text',
					'desc' => '<strong>Suggested Text:</strong> Welcome back',
					'subtype' => '',
					'class' => ''
				),
			),
			array( // subsection
				array(
					'label' => '[number] "clicked your link so far."',
					'type' => 'text',
					'option_name' => 'returning_clicks',
					'desc' => '<strong>Suggested Text:</strong> clicked your link so far.',
					'subtype' => '',
					'class' => ''
				),
			),
			array( // subsection
				array(
					'label' => '[number] "signed up."',
					'type' => 'text',
					'option_name' => 'returning_signups',
					'desc' => '<strong>Suggested Text:</strong> signed up.',
					'subtype' => '',
					'class' => ''
				),
			)
		),
	'Google Analytics' => 	
		array(
			array( // subsection
				array(
					'label' => 'Embed Code',
					'type' => 'textarea',
					'class' => 'le-threecol',
					'option_name' => 'bkt_google',
					'desc' => 'Simply paste your analytics code here. <strong>Important:</strong> Do not include opening and closing script tags!',
					'subtype' => '',
				),
			)
		),
	'Initiate' => 	
		array(
			array( // subsection
				array(
					'label' => 'Initiated?',
					'type' => 'initiate',
					'class' => 'le-threecol',
					'option_name' => 'le_initiate',
					'desc' => '',
					'subtype' => '',
				),
			)
		),
	);
	
	return $array;
}


function build_le_designer_page() {
?>

<div class="wrap le-wrapper">
	
	<?php
	
		lefx_tabs(designer_optionspanel_name());
		lefx_exploder_message();
		lefx_form(designer_optionspanel_name(), designer_optionspanel_array()); 
	
	?>
	
</div>

<div id="youtube-info" class="jqmWindow"><img src="<?php echo get_bloginfo('template_url'); ?>/functions/im/youtube-info.jpg" /></div>
<div id="vimeo-info" class="jqmWindow"><img src="<?php echo get_bloginfo('template_url'); ?>/functions/im/vimeo-info.jpg" /></div>

<?php

}


add_action( 'admin_init', 'register_designer_fields');
 
function register_designer_fields() {
	do_action('register_fields_hook', designer_optionspanel_array(), designer_optionspanel_name());
}

?>