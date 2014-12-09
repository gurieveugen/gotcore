<?php

function integrations_optionspanel_name() {
	$type = 'integrations_options';
	return $type;
}

function integrations_optionspanel_array() {

	$array = array(
	'MailChimp' => 	
		array(
			array( // subsection
				array(
					'label' => 'API Key',
					'type' => 'chimpkey',
					'class' => 'le-twocol',
					'option_name' => 'lefx_mcapikey',
					'desc' => '',
					'subtype' => '',
				),
			),
			array( // subsection
				array(
					'label' => 'Select a List',
					'type' => 'chimplist',
					'class' => 'le-twocol',
					'option_name' => 'lefx_mclistid',
					'desc' => '',
					'subtype' => '',
				),
			),
			array( // subsection
				array(
					'label' => 'Disable Double Opt-In',
					'type' => 'check',
					'class' => 'le-twocol',
					'option_name' => 'lefx_mcdouble',
					'desc' => "MailChimp and Launch Effect <strong>do not</strong> recommend disabling double opt-in!<br />Here's a <a href=\"http://blog.mailchimp.com/prankster-pollutes-obama%E2%80%99s-e-mail-list/\" target=\"_blank\">great example</a> of why and <a href=\"http://kb.mailchimp.com/article/how-does-confirmed-optin-or-double-optin-work/\" target=\"_blank\">details about how double opt-in works and why we recommend it over other methods</a>.<br /><br /><strong>Please Note:</strong> If you disable double opt-in, users will not receive signup confirmation/welcome emails from MailChimp and you will not receive notification that new users have signed up.<br />",
					'subtype' => '',
				),
			)
		),
	);
	
	return $array;
}


function build_le_integrations_page() {
?>

<div class="wrap le-wrapper">
	
	<?php 
		lefx_tabs(integrations_optionspanel_name()); 
		lefx_exploder_message();
	?>
		
	<p>You can use the controls on this page to configure other apps you might want to use in conjunction with Launch Effect (for now, just MailChimp but more coming soon!). If you're having any issues, please feel free to contact us at our <a href="http://launcheffect.tenderapp.com" target="_blank">support forums</a>.</p>
		
	<?php lefx_fields(integrations_optionspanel_name(), integrations_optionspanel_array()); ?>

</div>

<?php

}

add_action( 'admin_init', 'register_integrations_fields');
 
function register_integrations_fields() {
	do_action('register_fields_hook', integrations_optionspanel_array(), integrations_optionspanel_name());
}

?>