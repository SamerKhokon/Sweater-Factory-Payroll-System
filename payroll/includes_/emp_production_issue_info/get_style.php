<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$my_data = trim($_GET['q']);
$year	=$_GET['year'];
$year	=explode("/",$year);

$sql	="select STYLE_NAME,ID from TBL_PAY_STYLE_INFO where LOWER(STYLE_NAME) LIKE '$my_data%' and COMPANY_ID='".$company_id."' and to_char(ORDER_DATE,'YYYY')='$year[2]'";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH))
{
	$cname =$row['STYLE_NAME'];
	$cid =$row['ID'];
	echo "$cname|$cid\n";
}
?>