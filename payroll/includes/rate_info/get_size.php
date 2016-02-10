<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$my_data = trim($_GET['q']);
$style_id	=trim($_GET['style_id2']);
$where='where 1=1 and ';
$where.="LOWER(SIZE_NAME) LIKE '$my_data%' and COMPANY_ID=$company_id and STYLE_ID='$style_id'";

$sql	="select SIZE_NAME,ID from TBL_PAY_SIZE_SETTING $where";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
while(($row = oci_fetch_array($stid, OCI_BOTH))) 
{
			 $cid=$row['ID'];
			 $cname=$row['SIZE_NAME'];
			//echo $row['SIZE_NAME']."|".$row['ID']."\n";
			echo "$cname|$cid\n";
}
?>