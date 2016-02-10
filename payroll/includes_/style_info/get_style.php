<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$my_data = trim($_GET['q']);
$section_id=$_GET['section_id'];

$sql	="select STYLE_NAME,ID from TBL_PAY_STYLE_INFO where LOWER(STYLE_NAME) LIKE '$my_data%' and COMPANY_ID='".$company_id."'";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
{
			$cname =$row['STYLE_NAME'];
			$cid =$row['ID'];
			echo "$cname|$cid|$section_id\n";
}
?>