<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$id			=trim($_POST['id']);
$sql="delete from TBL_PAY_EMP_PRODUCTION_ISSUE where ID=$id";
$result	=mysqli_query($conn,$sql);

if($result)
{
	$msg='Delete Issue Successfully!';
}
else
{
	$msg='Try Again..';
}
echo $msg;


?>