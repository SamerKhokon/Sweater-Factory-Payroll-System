<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$cardno 	= trim($_POST['cardno']);
$sec_id 	= trim($_POST['sec_id']);
$style_id 	= trim($_POST['style_id']);
$size_id 	= trim($_POST['size_id']);

$quantity		=0;
$issue_quantity	=0;
$avable			=0;
$where='where 1=1 and ';

$where.=" COMPANY_ID=$company_id and SECTION_ID='$sec_id' and CARD_ID='$cardno' and  STYLE_ID='$style_id' and SIZE_ID='$size_id'";

$sql	="select sum(QUANTITY) from TBL_PAY_EMP_PRODUCTION $where";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
{
	
	$quantity	=$row[0];		
}
$sql	="select QUANTITY from TBL_PAY_EMP_PRODUCTION_ISSUE where COMPANY_ID=$company_id and SECTION_ID='$sec_id' and  STYLE_ID='$style_id' and SIZE_ID='$size_id' and CARD_ID='$cardno'";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
{
	$issue_quantity=$row[0];
}
echo $avable	=($issue_quantity-$quantity);
?>