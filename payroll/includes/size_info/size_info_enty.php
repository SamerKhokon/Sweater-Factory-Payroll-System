<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$section_id	=trim($_POST['section_id']);
$style_id	=trim($_POST['style_id']);
$size_id	=trim($_POST['size_id']);
$rate		=trim($_POST['rate']);
$quantity	=trim($_POST['quantity']);
$sizeNM		=trim($_POST['size']);
$status		=trim($_POST['status']);
$rquantity	=trim($_POST['rquantity']);


$sql	="select ID from TBL_PAY_RATE_SETTING where COMPANY_ID='$company_id' and SECTION_ID=$section_id and STYLE_ID='$style_id' and SIZE_ID='$size_id'";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);            
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
{
	$sql1="update TBL_PAY_RATE_SETTING set QUANTITY='$rquantity' where STYLE_ID='$style_id' and SIZE_ID='$size_id'";
	$result1	=oci_parse($conn,$sql1);
	$success1=oci_execute($result1);
	
	$sql1	="update TBL_PAY_RATE_SETTING set RATE='".$rate."' where ID='".$row[0]."'";
	$result1	=oci_parse($conn,$sql1);
	$success1=oci_execute($result1);
	if($success1)
	{
		$msg	='Update Successfully';
	}
	else
	{
		$msg	='Sorry Try Again';
	}
}
else
	$msg	='Sorry Try Again';
echo $msg;

oci_free_statement($stid);
oci_free_statement($result1);
oci_close($conn);
?>