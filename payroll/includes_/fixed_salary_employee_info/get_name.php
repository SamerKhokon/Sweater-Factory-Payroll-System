<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$card_no	=$_POST['card_no'];
$section_id	=$_POST['section_id'];

$sql	="select NAME from TBL_PAY_EMP_PROFILE where CARD_ID='$card_no'  and COMPANY_ID=$company_id and SECTION_ID=$section_id";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if(($row = oci_fetch_array($stid, OCI_BOTH)))
echo $row[0];
?>