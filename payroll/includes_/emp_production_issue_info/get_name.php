<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION['company_id'];
$section_id	=$_POST['section_id'];
$card_no	=strtoupper($_POST['card_no']);
$block_id	='';
$sql	="select NAME,BLOCK_ID from TBL_PAY_EMP_PROFILE where upper(CARD_ID)='".$card_no."' and COMPANY_ID=$company_id  and SECTION_ID=$section_id";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
echo $name	=$row[0];
echo '!@#$';
echo $block_id=$row[1];
?>