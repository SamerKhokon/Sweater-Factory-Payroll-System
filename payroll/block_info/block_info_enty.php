<?php
session_start();
require '../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$section_id	=$_POST['section_id'];
$nameEN		=$_POST['nameEN'];
$nameBN		=$_POST['nameBN'];

$sql	="insert into TBL_PAY_SECTION_BLOCK(SECTION_ID,COMPANY_ID,BLOCK_NAME,BNG_BLOCK_NAME) values('".$section_id."','".$company_id."','".$nameEN."','".$nameBN."')";
$result	=mysqli_query($conn,$sql);
//$success=oci_execute($result);
if($result)
{
	$msg	='Block Add Successfully';
}
else
{
	$msg	='Sorry Try Again';
}
echo $msg;
?>