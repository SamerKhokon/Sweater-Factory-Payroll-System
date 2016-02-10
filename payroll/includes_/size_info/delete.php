<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$id			=trim($_POST['id']);
$delf=0;
$msg="";
$sql="select STYLE_ID,SIZE_ID,SECTION_ID from TBL_PAY_RATE_SETTING where ID='$id'";
$stm = oci_parse($conn,$sql);
oci_execute($stm);
if($res = oci_fetch_array($stm,OCI_BOTH+OCI_RETURN_NULLS))
{
	/*$sql="select count(SIZE_ID) from TBL_PAY_EMP_PRODUCTION_ISSUE where SECTION_ID='$res[2]' and SIZE_ID='$res[1]'";
	*/
	$sql="select count(SIZE_ID) from TBL_PAY_EMP_PRODUCTION where SECTION_ID='$res[2]' and SIZE_ID='$res[1]'";
	
	$stm = oci_parse($conn,$sql);
	oci_execute($stm);
	if($row = oci_fetch_array($stm,OCI_BOTH+OCI_RETURN_NULLS))
	{
		$mid=$row[0];
	}
	if($mid==0)
	{
		$sql1="delete from TBL_PAY_SIZE_SETTING where ID='$res[1]'";
		$stid	= oci_parse($conn, $sql1);
		oci_execute($stid);
		
		
		$sql2="delete from TBL_PAY_RATE_SETTING where ID='$id'";
		$stid	= oci_parse($conn, $sql2);
		oci_execute($stid);
		$msg='Size Delete Successfully';
		
	}
	else
	{
		$msg='Please Delete from Production';
	}
	
}
echo $msg;
?>