<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$id			=trim($_POST['id']);
$delf=0;
$msg="";
$sql	="select  count(STYLE_ID) from TBL_PAY_EMP_PRODUCTION_ISSUE where STYLE_ID=$id and COMPANY_ID=$company_id";
$stid	= mysqli_query( $conn,$sql);

 while($row = mysqli_fetch_array($stid)) 
{
	$delf=$row[0];
}
if($delf==0)
{
	$sql	="delete from TBL_PAY_STYLE_INFO where id=$id and COMPANY_ID=$company_id";
	$stid	= mysqli_query( $conn,$sql);
	
	$d_size=0;
	$sql="select ID from TBL_PAY_SIZE_SETTING where STYLE_ID=$id and COMPANY_ID=$company_id";
	$stid2	= mysqli_query($conn,$sql);
	
	 while($row = mysqli_fetch_array($stid2)) 
	{
		$size_id=$row[0];
		$sql	="delete from TBL_PAY_RATE_SETTING where STYLE_ID=$id and SIZE_ID=$size_id  and  COMPANY_ID=$company_id";
		$stid	= mysqli_query($conn, $sql);
	
		$d_size=1;
	}
	
	if($d_size==1)
	{	
		$sql	="delete from TBL_PAY_SIZE_SETTING where STYLE_ID=$id and COMPANY_ID=$company_id";
		$stid	= mysqli_query($conn,$sql);
		
	}
	
	$msg='Delete Style and Size Successfully!';
}
else
{
	$msg='Already Issued This Style';
}
echo $msg;
?>