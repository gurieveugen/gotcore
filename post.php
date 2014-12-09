<?php 

// INCLUDE WORDPRESS STUFF
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');

require_once('inc/MCAPI.class.php');
// grab an API Key from http://admin.mailchimp.com/account/api/
$chimpkey = get_option('lefx_mcapikey');
$api = new MCAPI($chimpkey);

// grab your List's Unique Id by going to http://admin.mailchimp.com/lists/
// Click the "settings" link for the list - the Unique Id is at the bottom of that page. 
$list_id = get_option('lefx_mclistid');

if(get_option('lefx_mcdouble') == true) {
	$opt_in = false;
} else {
	$opt_in = true;
}

session_start();

$referralpost = $_SESSION['referredBy'];

// POST FORM WITH AJAX
$email_check = '';
$reuser = '';
$clicks = '';
$conversions = '';
$return_arr = array();

if(isset($_POST['email'])){ 

if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

	$email_check = 'valid';
	
	$postEmail = $_POST['email'];
	
	$count = countCheck($stats_table, 'email', $postEmail);

	if ($count > 0) {
		
		$reuser = 'true';
		
		$stats = getDetail($stats_table, 'email', $_POST['email']);
		
		foreach ($stats as $stat) {
			$clicks = $stat->visits;
			$conversions = $stat->conversions;
			$returncode = $stat->code;
		}
		
	} else {
		
		$reuser = 'false';
		postData($stats_table, $referralpost);
		
		if(get_option('lefx_mcapikey')) {
			$api->listSubscribe($list_id, $_POST['email'],$merge_vars,'html',$opt_in );
		}

	}
		
} else {

    $email_check = 'invalid';

}
	$return_arr["email_check"] = $email_check;
	$return_arr["reuser"] = $reuser;
	$return_arr["clicks"] = $clicks;
	$return_arr["conversions"] = $conversions;
	$return_arr["returncode"] = $returncode;
	$return_arr["email"] = $_POST['email'];
	$return_arr["code"] = $_POST['code'];

} else if(!isset($_POST)){ 

	echo "hmmm..."; 

}  

echo json_encode($return_arr);

?>