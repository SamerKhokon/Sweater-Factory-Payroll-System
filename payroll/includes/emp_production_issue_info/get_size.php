<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$my_data 	=trim(strtolower($_GET['q']));
$style_id2	=trim($_GET['sid']);
$section_id	=trim($_GET['section_id']);
$where='where 1=1 and ';
$where.="LOWER(SIZE_NAME) LIKE '$my_data%' and COMPANY_ID=$company_id and STYLE_ID='".$style_id2."' and SECTION_ID=$section_id";

$sql	="select SIZE_NAME,ID from TBL_PAY_SIZE_SETTING $where";
$stid	= mysqli_query($conn, $sql);

while(($row = mysqli_fetch_array($stid))) 
{
			 $cid=$row['ID'];
			 $cname=$row['SIZE_NAME'];
			//echo $row['SIZE_NAME']."|".$row['ID']."\n";
			echo "$cname|$cid\n";
}
?>