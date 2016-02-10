<?php
session_start();
require '../../../includes/db.php';
$card_no	=$_POST['card_no'];
$sql	="select NAME from TBL_PAY_EMP_PROFILE where CARD_ID='".$card_no."'";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if(($row = oci_fetch_array($stid, OCI_BOTH)))
echo $row[0];
?>