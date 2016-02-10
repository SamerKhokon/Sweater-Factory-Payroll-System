<?php
session_start();
require '../../includes/db.php';

$section_name	=$_POST['section_name'];
$company_id		=$_POST['company_id'];
$section_type_id=$_POST['section_type_id'];
$sql	="insert into TBL_PAY_SECTION_INFO(SEC_NAME,COMPANY_ID,SEC_TYPE_ID) values('".$section_name."','".$company_id."','".$section_type_id."')";
$result	=mysqli_query($conn,$sql);

if($result)
{
	$msg	='Success';
}
else
{
	$msg	='Fail';
}
echo $msg;
?>