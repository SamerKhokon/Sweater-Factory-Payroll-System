<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$section_id	=$_POST['section_id'];
$style_id	=$_POST['style_id'];
$size_id	=$_POST['size_id'];

$quantity	=0;
$assign_qty	=0;
$sql	="select sum(QUANTITY) from TBL_PAY_EMP_PRODUCTION_ISSUE where COMPANY_ID=$company_id and SECTION_ID=$section_id and STYLE_ID=$style_id and SIZE_ID=$size_id";
$result	=oci_parse($conn,$sql);
$success=oci_execute($result);
if($row	=oci_fetch_array($result, OCI_BOTH+OCI_RETURN_NULLS))
	$assign_qty	=$row[0];
/*
$sql	="select TBL_PAY_STYLE_INFO.QUENTITY from TBL_PAY_STYLE_INFO where TBL_PAY_STYLE_INFO.ID=$style_id and TBL_PAY_STYLE_INFO.COMPANY_ID=$company_id";
*/
$sql="select QUANTITY from TBL_PAY_RATE_SETTING where STYLE_ID=$style_id and SIZE_ID=$size_id and SECTION_ID=$section_id and COMPANY_ID=$company_id";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
	{
		$quantity	=$row[0];
	}

echo ($quantity-$assign_qty);

oci_free_statement($result);
oci_free_statement($stid);
oci_close($conn);
?>