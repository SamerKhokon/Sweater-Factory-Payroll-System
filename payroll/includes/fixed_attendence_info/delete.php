<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$id			=trim($_POST['id']);
$delf=0;
$msg="";
$sql="select SECTION_ID,CARD_ID,to_char(MONTH_YEAR,'mm/yyyy') from TBL_PAY_EMP_ATTEN_INFO where ID='$id'";
$stm = mysqli_query($conn,$sql);

if($res = mysqli_fetch_array($stm))
{
	$sql1="delete from TBL_PAY_LEAVE_INFO where SECTION_ID='$res[0]' and CARD_ID='$res[1]' and to_char(MONTH_YEAR,'mm/yyyy')='$res[2]'";
	
	$stid	= mysqli_query($conn, $sql1);
	
	
	$sql1="delete from TBL_PAY_EMP_ATTEN_INFO where ID='$id'";
	$stid	= mysqli_query($conn, $sql1);
	
	$msg='Delete Successfully';
	
}
else
$msg='Try Again';
echo $msg;
?>