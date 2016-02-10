<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$card_no	=strtoupper(trim($_POST['card_no']));
$section_id	=$_POST['section_id'];

$block_id		="";
$govt_holi		="";
$id				="";
$eot			="";
$month_year	=substr($_POST['month_year'],0,3).''.substr($_POST['month_year'],6,10);

$sql	="select NAME,BLOCK_ID from TBL_PAY_EMP_PROFILE where upper(CARD_ID)='$card_no' and SECTION_ID=$section_id and COMPANY_ID=$company_id";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
{
$block_id=$row[1];
echo $row[0];
}
echo '!@#$';
$sql2	="select EXTRA_OT,ID from TBL_PAY_EMP_ATTEN_INFO where CARD_ID='$card_no' and SECTION_ID=$section_id	and COMPANY_ID=$company_id and to_char(MONTH_YEAR,'mm/yyyy')='$month_year'";
$stid	= oci_parse($conn, $sql2);
oci_execute($stid);
if($row1 = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
{
	$eot	=$row1[0];
	$id		=$row1[1];
}
echo $eot;
echo '!@#$';
echo $id;
echo '!@#$';
echo $block_id;
oci_free_statement($stid);
oci_close($conn);
?>