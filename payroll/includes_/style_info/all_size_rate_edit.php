<?php
session_start();
require '../../../includes/db.php';
if(isset($_POST['user_ids']))
{
	$user_ids = explode('|',trim($_POST['user_ids']));
	$rate = explode('|',trim($_POST['rate']));
	$len = count($user_ids);
	for($i=0; $i<$len; $i++)
	{
		$sql_up ="update TBL_PAY_RATE_SETTING set RATE='".$rate[$i]."' where ID=".$user_ids[$i]."";
		$res_up	= oci_parse($conn, $sql_up);
		oci_execute($res_up);
		$commit = oci_commit($conn);
		
	}
	echo 'Rate Edited successfully';
}
?>