<?php 

if(isset($_POST['submit'])) {

	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Length: " . strlen($_POST['csvexport']));
	header("Content-type: text/x-csv");
	header("Content-Disposition: attachment; filename=export.csv");

echo $_POST['csvexport'];

}

?>