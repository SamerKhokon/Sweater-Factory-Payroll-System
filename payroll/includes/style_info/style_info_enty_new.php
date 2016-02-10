<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$usr_id			=$_SESSION['usr_id'];
$msg="";

$style		=trim(strtoupper($_POST['style']));

$datepicker	=trim($_POST['datepicker']);
$sizeNMarr	=trim($_POST['sizeNMarr']);
$sizeQty	=trim($_POST['sizeQty']);
$section_id	=trim($_POST['section_id']);
$sizeNMarr	=explode(",",$sizeNMarr);
$sizeQty	=explode(",",$sizeQty);

	//update SIZE

$sql	="select ID from TBL_PAY_STYLE_INFO where upper(STYLE_NAME)='$style'";
$result	=oci_parse($conn,$sql);
$success=oci_execute($result);
if($row=oci_fetch_array($result, OCI_BOTH+OCI_RETURN_NULLS))
{
	$style_id	=$row[0];		
	for($i=0; $i<count($sizeNMarr);$i++)
	{
		$sql	="select count(ID) from TBL_PAY_SIZE_SETTING where STYLE_ID=$style_id and upper(SIZE_NAME)='".strtoupper($sizeNMarr[$i])."' and SECTION_ID='$section_id'";
		$stid	= oci_parse($conn, $sql);
		oci_execute($stid);		
		if($res = oci_fetch_array($stid,OCI_BOTH+OCI_RETURN_NULLS))
		{
			$mid=$res[0];
		}
		if($mid==0)
		{
			 $sql	="insert into TBL_PAY_SIZE_SETTING(COMPANY_ID,STYLE_ID,SIZE_NAME,SECTION_ID) values('".$company_id."','".$style_id."','".strtoupper($sizeNMarr[$i])."','$section_id')";
			$result	=oci_parse($conn,$sql);
			$success=oci_execute($result);
			if($success)
			{
				$sql	="select max(ID) from TBL_PAY_SIZE_SETTING";
				$stid	= oci_parse($conn, $sql);
				oci_execute($stid);            
				if($row1 = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
				{
					
						$sql	="insert into TBL_PAY_RATE_SETTING(SECTION_ID,COMPANY_ID,STYLE_ID,SIZE_ID,QUANTITY,RATE,ENTY_DATE,ENTRY_BY) values('".$section_id."','".$company_id."','".$style_id."','".$row1[0]."','".$sizeQty[$i]."',0,sysdate,'$usr_id')";
						$result	=oci_parse($conn,$sql);
						$success=oci_execute($result);
						$msg	='Size Add Successfully';	
				}
			}

		}//check
	}
}

echo $msg;
oci_free_statement($result);
oci_free_statement($stid);
oci_close($conn);
?>