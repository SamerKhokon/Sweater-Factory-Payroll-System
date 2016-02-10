<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$section_id	=$_POST['section_id'];
$style_id	=$_POST['style_id'];
$size_id	=$_POST['size_id'];
$rate		=$_POST['rate'];
$quantity	=$_POST['quantity'];
$sizeNM		=$_POST['size'];
$status		=$_POST['status'];

if($status=='')
{
	$sql	="insert into TBL_PAY_RATE_SETTING(SECTION_ID,COMPANY_ID,STYLE_ID,SIZE_ID,RATE) values('".$section_id."','".$company_id."','".$style_id."','".$size_id."','".$rate."')";
	$result	=oci_parse($conn,$sql);
	$success=oci_execute($result);
	if($success)
	{
		$msg	='Rate Add Successfully';
	}
	else
	{
		$msg	='Sorry Try Again';
	}
}
else
{

	$sql	="select ID from TBL_PAY_RATE_SETTING where COMPANY_ID='$company_id' and STYLE_ID='$style_id' and SIZE_ID='$size_id'";
	$stid	= oci_parse($conn, $sql);
    oci_execute($stid);            
    if($row = oci_fetch_array($stid, OCI_BOTH))
	{
		$sql1	="update TBL_PAY_RATE_SETTING set RATE='".$rate."' where ID='".$row[0]."'";
		$result1	=oci_parse($conn,$sql1);
		$success1=oci_execute($result1);
		if($success1)
		{
			
			$sql2	="update TBL_PAY_STYLE_INFO set QUENTITY='".$quantity."' where ID='$style_id'";
			$result2	=oci_parse($conn,$sql2);
			$success2=oci_execute($result2);
			if($success2)
			{
				$msg	='Update Successfull';
			}	
		}
		else
		{
			$msg	='Sorry Try Again';
		}
	}
}
echo $msg;

/*oci_free_statement($result);
oci_close($conn);
*/
?>