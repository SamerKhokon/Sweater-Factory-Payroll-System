<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$section_id	=$_POST['section_id'];
$usr_id			=$_SESSION['usr_id'];
$msg="";

$style		=strtoupper(trim($_POST['style']));
$r_id		=trim($_POST['r_id']);

$datepicker	=trim($_POST['datepicker']);
$size_name	=strtoupper(trim($_POST['size_name']));
$quantity	=trim($_POST['quantity']);

if($r_id=='')
{
	$sql	="select ID from TBL_PAY_STYLE_INFO where upper(STYLE_NAME)='$style'";
	$result	=oci_parse($conn,$sql);
	$success=oci_execute($result);
	if($row=oci_fetch_array($result, OCI_BOTH+OCI_RETURN_NULLS))
	{
			$style_id	=$row[0];
		
			$sql	="select count(ID) from TBL_PAY_SIZE_SETTING where STYLE_ID=$style_id and upper(SIZE_NAME)='".$size_name."' and SECTION_ID='$section_id'";
			$stid	= oci_parse($conn, $sql);
			oci_execute($stid);		
			if($res = oci_fetch_array($stid,OCI_BOTH+OCI_RETURN_NULLS))
			{
				$mid=$res[0];
			}
			if($mid==0)
			{
				 $sql	="insert into TBL_PAY_SIZE_SETTING(COMPANY_ID,STYLE_ID,SIZE_NAME,SECTION_ID) values('".$company_id."','".$style_id."','".$size_name."','".$section_id."')";
				
				$result	=oci_parse($conn,$sql);
				$success=oci_execute($result);
				if($success)
				{
					$sql	="select max(ID) from TBL_PAY_SIZE_SETTING";
					$stid	= oci_parse($conn, $sql);
					oci_execute($stid);            
					if($row1 = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
					{
						
						$sql	="insert into TBL_PAY_RATE_SETTING(SECTION_ID,COMPANY_ID,STYLE_ID,SIZE_ID,QUANTITY,RATE,ENTY_DATE) values('".$section_id."','".$company_id."','".$style_id."','".$row1[0]."','$quantity',0,sysdate)";
						$result	=oci_parse($conn,$sql);
						$success=oci_execute($result);
					}
				}
				
				$msg='Size Add successfully';
			}//check
			else
			{
				$msg='Size already Exist';
			}
	}
}
else
{
	$sql="select SIZE_ID from TBL_PAY_RATE_SETTING where ID='$r_id'";
	$result	= oci_parse($conn, $sql);
	oci_execute($result);            
	if($row1 = oci_fetch_array($result, OCI_BOTH+OCI_RETURN_NULLS))
	{
		$s_id=$row1[0];
		$sql="update TBL_PAY_SIZE_SETTING set SIZE_NAME='$size_name' where ID='$s_id'";
		$stm = oci_parse($conn,$sql);		
		oci_execute($stm);
		
		$sql="update TBL_PAY_RATE_SETTING set QUANTITY='$quantity' where ID='$r_id'";
		$stm = oci_parse($conn,$sql);		
		oci_execute($stm);
		
		$msg='Data Edit Successfull';	
	}
	
}

echo $msg;
oci_free_statement($result);
oci_close($conn);
?>