<?php   
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION['company_id'];
$usr_id		=$_SESSION['usr_id'];
$section_id	=$_POST['section_id'];
$style		=trim(strtoupper($_POST['style']));
$size		=trim(strtoupper($_POST['size']));
$quantity	=$_POST['quantity'];
$rate		=$_POST['rate'];
if($rate=='')
	$rate	=0;
if($quantity=='')
	$quantity	=0;

$mflag=0;

$sql	="select ID from TBL_PAY_STYLE_INFO where upper(STYLE_NAME)='$style' and COMPANY_ID=$company_id";
$result	=oci_parse($conn,$sql);
$success=oci_execute($result);
if($row=oci_fetch_array($result, OCI_BOTH+OCI_RETURN_NULLS))
{
	$style_id	=$row[0];	
}

$sql	="select ID from TBL_PAY_SIZE_SETTING where STYLE_ID=$style_id and upper(SIZE_NAME)='$size' and COMPANY_ID=$company_id and SECTION_ID=$section_id";
$result	=oci_parse($conn,$sql);
$success=oci_execute($result);
if($row=oci_fetch_array($result, OCI_BOTH+OCI_RETURN_NULLS))
{
	//update
	$sql	="update TBL_PAY_SIZE_SETTING set SIZE_NAME='".$size."' where ID='".$row[0]."'";
	
	$result	=oci_parse($conn,$sql);
	$success=oci_execute($result);
	
	$sql1	="update TBL_PAY_RATE_SETTING set RATE='$rate' ,QUANTITY='$quantity' where STYLE_ID='".$style_id."' and SIZE_ID='".$row[0]."' and SECTION_ID=$section_id and COMPANY_ID=$company_id";
	$result2	=oci_parse($conn,$sql1);
	$success=oci_execute($result2);	
	
}
else
{
	
	if($size!='')
	{
		$sql	="insert into TBL_PAY_SIZE_SETTING(COMPANY_ID,STYLE_ID,SIZE_NAME,SECTION_ID) values($company_id,$style_id,'".$size."',$section_id)";
		$result	=oci_parse($conn,$sql);
		$success=oci_execute($result);
		
		
		$sql	="select max(ID) from TBL_PAY_SIZE_SETTING";
		$stid	= oci_parse($conn, $sql);
		oci_execute($stid);            
		if($row1 = oci_fetch_array($stid, OCI_BOTH))
		{
			$size_id=$row1[0];
		}
		
		
		$sql	="insert into TBL_PAY_RATE_SETTING(COMPANY_ID,STYLE_ID,SIZE_ID,SECTION_ID,RATE,QUANTITY,ENTRY_BY,ENTY_DATE) values($company_id,$style_id,'$size_id',$section_id,$rate,$quantity,$usr_id,sysdate)";
		$result	=oci_parse($conn,$sql);
		$success=oci_execute($result);
	}
	
}
?>