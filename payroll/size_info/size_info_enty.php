<?php
session_start();
require '../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$section_id	=$_POST['section_id'];
$style_id	=$_POST['style_id'];
$size_id	=$_POST['size_id'];
$rate		=$_POST['rate'];
$quantity	=$_POST['quantity'];


$sql	="insert into TBL_PAY_RATE_SETTING(SECTION_ID,COMPANY_ID,STYLE_ID,SIZE_ID,RATE) 
values('".$section_id."','".$company_id."','".$style_id."','".$size_id."','".$rate."')";
$result	=mysqli_query($conn,$sql);
//$success=oci_execute($result);
if($result)
{
	$msg	='Size Add Successfully';
}
else
{
	$msg	='Sorry Try Again';
}
echo $msg;

?>