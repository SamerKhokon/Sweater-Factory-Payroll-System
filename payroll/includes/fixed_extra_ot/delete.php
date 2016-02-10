<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$id			=trim($_POST['id']);
$delf=0;
$msg="";
$sql="update TBL_PAY_EMP_ATTEN_INFO set EXTRA_OT=0 where ID='$id'";
$result	=oci_parse($conn,$sql);
$success=oci_execute($result);
$msg	='Delete Successfull';
	
echo $msg;
?>