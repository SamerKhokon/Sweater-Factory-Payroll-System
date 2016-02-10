<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$section_id	=$_POST['section_id'];
$style_id	=$_POST['style_id'];
$size_id	=$_POST['size_id'];

$quantity	="";
$sql	="select TBL_PAY_STYLE_INFO.QUENTITY from TBL_PAY_STYLE_INFO where TBL_PAY_STYLE_INFO.ID=$style_id and TBL_PAY_STYLE_INFO.COMPANY_ID=$company_id";
$stid	= mysqli_query($conn, $sql);

if($row = mysqli_fetch_array($stid))
	{
		$quantity	=$row[1];
	}
echo $quantity;
?>