<?php
session_start();
require '../../../includes/db.php';

$company_id		=$_SESSION["company_id"];
$gross			=trim($_POST['basic']);
$sec_id			=$_POST['section_id'];
$head_house_rnt	=166;
$head_medical	=165;
$house_rent		=0;
$medical		=0;
$convence_head	=162292;
$amount_cv		=0;

if($gross!='' && $gross!=0)
{
	
	//convence

	$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=$convence_head and COMPANY_ID=$company_id and SECTION_ID=$sec_id";
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
	{
		$amount_cv 	= $row[0];
	}
	
	$gross	=$gross-$amount_cv-650;	
	
	$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=$head_house_rnt and COMPANY_ID='".$company_id."' and SECTION_ID='$sec_id'";
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
	{
		$basic_h =$row[0];
	}
	$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=$head_medical and COMPANY_ID='".$company_id."' and SECTION_ID='$sec_id'";
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
	{
		$basic_m =$row[0];
	}
	
		
	$basic_hp		= strpos($basic_h, "%");
	if(strlen($basic_hp)>0)
	{
		$kflagb		=1;
		$basicham	=substr($basic_h,0,(strlen($basic_h)-1));
	}
	else
	{
		$kflagb		=0;
		$basicham	=$basic_h;
	}
	
	$basic_mp		= strpos($basic_m, "%");
	if(strlen($basic_mp)>0)
	{
		$kflagm		=1;
		$basicmam	=substr($basic_m,0,(strlen($basic_m)-1));
	}
	else
	{
		$kflagm		=0;
		$basicmam	=$basic_m;
	}
	//echo 'hr='.$basicham.'medi='.$basicmam.'<br>';
	
	if($kflagb==1 && $kflagm==1)
	{
		$mflag=1;
		$divby	=100+$basicham+$basicmam;
		$basic	=($gross * 100)/$divby;
	}
	if($kflagb==1 && $kflagm==0)
	{
		$mflag=2;
		$divby	=100+$basicham;
		$basic	=($gross - $basicmam)*100/$divby;
	}
	if($kflagb==0 && $kflagm==1)
	{
		$mflag=3;
		$divby	=100+$basicmam;
		//echo 'g='.$gross.'bhr='.$basicham.'div='.$divby.'bbb='.$basicmam;
		$basic	=(($gross - $basicham)*100)/$divby;
	}
	if($kflagb==0 && $kflagm==0)
	{
		$mflag=4;
		$basic	=$gross-$basicham-$basicmam;  //basicham=houserent and  basicmam=medical
	}
	
	echo round($basic);
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
	
	$sql	="select GRADE,DESIGNATION from TBL_PAY_SALARY_SETTING where SECTION_ID=$sec_id and COMPANY_ID=$company_id and  '".$eff_basic_gross."' between SALARY_FROM and SATARY_TO";
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