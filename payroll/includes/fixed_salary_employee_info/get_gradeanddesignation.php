<?php
session_start();
require '../../../includes/db.php';

$company_id		=$_SESSION["company_id"];
$basic			=trim($_POST['basic']);
$sec_id			=$_POST['section_id'];
$head_house_rnt	=166;
$head_medical	=165;
$convence_head	=162292;

$house_rent	=0;
$medical	=0;
$amount_cv	=0;

if($basic!='' && $basic!=0)
{
$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=$head_house_rnt and COMPANY_ID='".$company_id."' and SECTION_ID='$sec_id'";
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
	{
		$type 		= $row[1];
		$amount_tp 	= $row[0];
		$amtype		= strpos($amount_tp, "%");
		if(strlen($amtype)>0)
		{
			$amount	=substr($amount_tp,0,strlen(($amount_tp)-1));
			$house_rent =(($basic * $amount)/100);
		}
		else
			$house_rent =$amount_tp;
		
		$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=$head_medical and COMPANY_ID='".$company_id."' and SECTION_ID='$sec_id'";
		$qstr  = oci_parse($conn,$sql);
		oci_execute($qstr);
		if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
		{
			$type1 		= $row[1];
			$amount_tp1 	= $row[0];
			$amtype1		= strpos($amount_tp1, "%");
			if(strlen($amtype1)>0)
			{
				$amount1	=substr($amount_tp1,0,strlen($amount_tp1)-1);
				$medical =(($basic * $amount1)/100);
			}
			else
				$medical =$amount_tp1;
			
		}
		
		//convence

		$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=$convence_head and COMPANY_ID=$company_id and SECTION_ID=$sec_id";
		$qstr  = oci_parse($conn,$sql);
		oci_execute($qstr);
		if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
		{
			$amount_cv 	= $row[0];
		}
		
			
		$gross= $basic+$house_rent+$medical+$amount_cv+650;
	}
echo round($gross);
echo '!@#$';

$stype =0;
$sql	= "SELECT SALARY_TYPE FROM TBL_PAY_SALARY_SETTING WHERE COMPANY_ID=$company_id and SECTION_ID=$sec_id";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);	
if($res = oci_fetch_array($stid,OCI_BOTH+OCI_RETURN_NULLS)){
	$stype=$res[0];  
}
if($stype==1)
	$eff_basic_gross	=round($basic);
else if($stype==2)
	$eff_basic_gross	=round($gross);
else
	$eff_basic_gross	=$basic;
	
	$sql	="select GRADE,DESIGNATION from TBL_PAY_SALARY_SETTING where COMPANY_ID=$company_id and SECTION_ID=$sec_id and   '".$eff_basic_gross."' between SALARY_FROM and SATARY_TO";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
	{
	echo $row[0];
	echo '!@#$';
	echo $row[1];
	}
}
?>