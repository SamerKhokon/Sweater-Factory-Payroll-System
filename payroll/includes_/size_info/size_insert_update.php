<?php   
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION['company_id'];
$section_id	=$_POST['section_id'];
$style		=$_POST['style'];
$oldsizeN	=substr($_POST['oldsizeN'], 0, -1);
$oldsizeId	=substr($_POST['oldsizeId'], 0, -1);
$newsize	=substr($_POST['newsize'], 0, -1);
$mflag=0;

$sql	="select ID from TBL_PAY_STYLE_INFO where upper(STYLE_NAME)='$style'";
$result	=oci_parse($conn,$sql);
$success=oci_execute($result);
if($row=oci_fetch_array($result, OCI_BOTH+OCI_RETURN_NULLS))
{
	$style_id	=$row[0];	
}

if($oldsizeN!='')
	{
		$oldsizeN	=explode(',',$oldsizeN);
		$mflag=1;
	}
if($oldsizeId!='')
	{
		$oldsizeId	=explode(',',$oldsizeId);
		$mflag=1;
	}
if($mflag==1)
{	
	for($i=0;$i<count($oldsizeN);$i++)
	{
		$sql	="update TBL_PAY_SIZE_SETTING set SIZE_NAME='".$oldsizeN[$i]."' where ID='".$oldsizeId[$i]."'";
		$result1	=oci_parse($conn,$sql);
		$success1=oci_execute($result1);
		
	}
}
if($newsize!='')
{
	$newsize	=explode(',',$newsize);
	for($i=0;$i<count($newsize);$i++)
	{
		$sql	="insert into TBL_PAY_SIZE_SETTING(COMPANY_ID,STYLE_ID,SIZE_NAME,SECTION_ID) values($company_id,$style_id,'".$newsize[$i]."',$section_id)";
		$result	=oci_parse($conn,$sql);
		$success=oci_execute($result);
	}
}


?>