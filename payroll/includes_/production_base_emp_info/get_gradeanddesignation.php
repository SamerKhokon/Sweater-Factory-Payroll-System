<?php
session_start();
require '../../../includes/db.php';
$id	=$_POST['id'];
$sql	="select ID,SATARY_TO,SALARY_FROM,GRADE,DESIGNATION from TBL_PAY_SALARY_SETTING where ID='".$id."'";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if(($row = oci_fetch_array($stid, OCI_BOTH)))
echo $row[3];
echo '!@#$';
echo $row[4];
?>
