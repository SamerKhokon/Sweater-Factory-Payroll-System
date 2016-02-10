<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$id			=trim($_POST['id']);
$sql="delete from TBL_PAY_EMP_PRODUCTION where ID=$id";
$result	=oci_parse($conn,$sql);
$success =oci_execute($result);
if($success)
{
	$msg='Delete Issue Successfully!';
}
else
{
	$msg='Try Again..';
}
echo $msg;
oci_free_statement($result);
oci_close($conn);
?>