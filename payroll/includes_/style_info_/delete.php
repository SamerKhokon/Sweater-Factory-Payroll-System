<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$id			=trim($_POST['id']);
$delf=0;
$msg="";
$sql	="select  count(STYLE_ID) from TBL_PAY_EMP_PRODUCTION_ISSUE where STYLE_ID=$id and COMPANY_ID=$company_id";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
 while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
{
	$delf=$row[0];
}
if($delf==0)
{
	$sql	="delete from TBL_PAY_STYLE_INFO where id=$id and COMPANY_ID=$company_id";
	$stid	= oci_parse($conn, $sql);
	oci_execute($stid);
	$d_size=0;
	$sql="select ID from TBL_PAY_SIZE_SETTING where STYLE_ID=$id and COMPANY_ID=$company_id";
	$stid2	= oci_parse($conn, $sql);
	oci_execute($stid2);
	 while($row = oci_fetch_array($stid2, OCI_BOTH+OCI_RETURN_NULLS)) 
	{
		$size_id=$row[0];
		$sql	="delete from TBL_PAY_RATE_SETTING where STYLE_ID=$id and SIZE_ID=$size_id  and  COMPANY_ID=$company_id";
		$stid	= oci_parse($conn, $sql);
		oci_execute($stid);
		$d_size=1;
	}
	oci_free_statement($stid2);
	if($d_size==1)
	{	
		$sql	="delete from TBL_PAY_SIZE_SETTING where STYLE_ID=$id and COMPANY_ID=$company_id";
		$stid	= oci_parse($conn, $sql);
		oci_execute($stid);
	}
	
	$msg='Delete Style and Size Successfully!';
}
else
{
	$msg='Already Issued This Style';
}
echo $msg;
oci_free_statement($stid);
oci_close($conn);
?>