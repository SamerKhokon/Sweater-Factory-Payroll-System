<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$id			=trim($_POST['id']);
$delf=0;
$msg="";
$sql="select SECTION_ID,CARD_ID,to_char(MONTH_YEAR,'mm/yyyy') from TBL_PAY_EMP_ATTEN_INFO where ID='$id'";
$stm = oci_parse($conn,$sql);
oci_execute($stm);
if($res = oci_fetch_array($stm,OCI_BOTH+OCI_RETURN_NULLS))
{
	$sql1="delete from TBL_PAY_LEAVE_INFO where SECTION_ID='$res[0]' and CARD_ID='$res[1]' and to_char(MONTH_YEAR,'mm/yyyy')='$res[2]'";
	
	$stid	= oci_parse($conn, $sql1);
	oci_execute($stid);
	
	$sql1="delete from TBL_PAY_EMP_ATTEN_INFO where ID='$id'";
	$stid	= oci_parse($conn, $sql1);
	oci_execute($stid);
	$msg='Delete Successfully';
	
}
else
$msg='Try Again';
echo $msg;
?>