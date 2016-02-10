<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$usr_id		=$_SESSION['usr_id'];
$msg="";

$style		=trim($_POST['style']);
$quantity	=trim($_POST['quantity']);
$datepicker	=trim($_POST['datepicker']);
//$sizeNMarr	=trim($_POST['sizeNMarr']);
$buyer_name	=trim($_POST['buyer_name']);
$merchend_name=trim($_POST['merchend_name']);
$gauge		=trim($_POST['gauge']);
$add_qty	=trim($_POST['add_qty']);
if($add_qty=='')
$add_qty	=$quantity;
$u_price	=trim($_POST['u_price']);
$mach_qty	=trim($_POST['mach_qty']);
$shipmentd	=trim($_POST['shipmentd']);
$bstyle_name=trim($_POST['bstyle_name']);
$shipment_st=trim($_POST['shipment_st']);
//$sizeNMarr	=explode(",",$sizeNMarr);
$sql	="select count(ID) from TBL_PAY_STYLE_INFO where STYLE_NAME='$style'";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);		
if($res1 = oci_fetch_array($stid,OCI_BOTH+OCI_RETURN_NULLS))
{
	$mids=$res1[0];
}
if($mids==0)
{
	$sql	="insert into TBL_PAY_STYLE_INFO(COMPANY_ID,STYLE_NAME,QUENTITY,BUYER_NAME,ORDER_QTY,UNIT_PRICE,MERCH_NAME,GAUGE,MACHINE_QTY,SHIPMENT_DATE,BUYER_ST_NAME,SHIP_STATUS,ENTRY_BY) values('".$company_id."','".$style."','".$add_qty."','".$buyer_name."','".$quantity."','".$u_price."','".$merchend_name."','".$gauge."','".$mach_qty."',to_date('$shipmentd','mm/dd/yyyy'),'".$bstyle_name."','".$shipment_st."','$usr_id')";
	$result	=oci_parse($conn,$sql);
	$success=oci_execute($result);
	if($success)
		{
			$msg	='Style Add Successfully';
		}
		else
		{
			$msg	='Sorry Try Again';
		}
	/*
	if($success)
	{
		$sql	="select max(ID) from TBL_PAY_STYLE_INFO";
		$stid	= oci_parse($conn, $sql);
		oci_execute($stid);            
		if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
		{
			for($i=0; $i<count($sizeNMarr);$i++)
			{
				$sql	="insert into TBL_PAY_SIZE_SETTING(COMPANY_ID,STYLE_ID,SIZE_NAME) values('".$company_id."','".$row[0]."','".$sizeNMarr[$i]."')";
				$result	=oci_parse($conn,$sql);
				$success=oci_execute($result);
				if($success)
				{
					$sql	="select max(ID) from TBL_PAY_SIZE_SETTING";
					$stid	= oci_parse($conn, $sql);
					oci_execute($stid);            
					if($row1 = oci_fetch_array($stid, OCI_BOTH))
					{
						$sql	="select TBL_PAY_SECTION_INFO.ID from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P'  order by TBL_PAY_SECTION_INFO.ID";
						$stid	= oci_parse($conn, $sql);
						oci_execute($stid);			
						while($res = oci_fetch_array($stid, OCI_BOTH))
						{
						$sql	="insert into TBL_PAY_RATE_SETTING(SECTION_ID,COMPANY_ID,STYLE_ID,SIZE_ID,RATE,ENTY_DATE) values('".$res[0]."','".$company_id."','".$row[0]."','".$row1[0]."',0,sysdate)";
						$result	=oci_parse($conn,$sql);
						$success=oci_execute($result);
						}
						
						$msg	='Style Add Successfully';
					}
				}
			}
		}	
	}
	else
	{
		$msg	='Sorry Try Again';
	}
	*/
}
else
{
	//update SIZE
	

	$sql	="select ID from TBL_PAY_STYLE_INFO where STYLE_NAME='$style'";
	$result	=oci_parse($conn,$sql);
	$success=oci_execute($result);
	if($row=oci_fetch_array($result, OCI_BOTH+OCI_RETURN_NULLS))
	{
		$style_id	=$row[0];
		$sql="update TBL_PAY_STYLE_INFO set QUENTITY='$add_qty',BUYER_NAME='$buyer_name',ORDER_QTY='$quantity',UNIT_PRICE='$u_price',MERCH_NAME='$merchend_name',GAUGE='$gauge',MACHINE_QTY='$mach_qty',SHIPMENT_DATE=to_date('$shipmentd','mm/dd/yyyy'),BUYER_ST_NAME='$bstyle_name' where ID=$style_id";
		$result	=oci_parse($conn,$sql);
		$success=oci_execute($result);
		if($success)
		{
			$msg	='Style Update Successfully';	
		}
		else
		{
			$msg	='Sorry Try Again';
		}
		
		
		/*
		for($i=0; $i<count($sizeNMarr);$i++)
		{
			$sql	="select count(ID) from TBL_PAY_SIZE_SETTING where STYLE_ID=$style_id and SIZE_NAME='".$sizeNMarr[$i]."'";
			$stid	= oci_parse($conn, $sql);
			oci_execute($stid);		
			if($res = oci_fetch_array($stid,OCI_BOTH+OCI_RETURN_NULLS))
			{
				$mid=$res[0];
			}
			if($mid==0)
			{
				 $sql	="insert into TBL_PAY_SIZE_SETTING(COMPANY_ID,STYLE_ID,SIZE_NAME) values('".$company_id."','".$style_id."','".$sizeNMarr[$i]."')";
				$result	=oci_parse($conn,$sql);
				$success=oci_execute($result);
				if($success)
				{
					$sql	="select max(ID) from TBL_PAY_SIZE_SETTING";
					$stid	= oci_parse($conn, $sql);
					oci_execute($stid);            
					if($row1 = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
					{
						$sql	="select TBL_PAY_SECTION_INFO.ID from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P'  order by TBL_PAY_SECTION_INFO.ID";
						$stid	= oci_parse($conn, $sql);
						oci_execute($stid);			
						while($res = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
						{
							$sql	="insert into TBL_PAY_RATE_SETTING(SECTION_ID,COMPANY_ID,STYLE_ID,SIZE_ID,RATE,ENTY_DATE) values('".$res[0]."','".$company_id."','".$style_id."','".$row1[0]."',0,sysdate)";
							$result	=oci_parse($conn,$sql);
							$success=oci_execute($result);
						}
						$msg	='Size Add Successfully';	
					}
				}

			}//check
		}
		*/
	}
}

echo $msg;
oci_free_statement($result);
oci_free_statement($stid);
oci_close($conn);
?>