<?php
session_start();
include('../function.php');
require '../../../includes/db.php';
$company_id		=$_SESSION["company_id"];
$section_id		=trim($_POST['section_id']);
$cardno			=strtoupper(trim($_POST['cardno']));
$empID			=trim($_POST['empID']);
$nameEN			=trim($_POST['nameEN']);
$basic			=trim($_POST['basic']);
$grade			=trim($_POST['grade']);
$datepicker		=trim($_POST['datepicker']);
$designation	=trim($_POST['designation']);
$nameBN			=trim($_POST['nameBN']);
$FatherName		=trim($_POST['FatherName']);
$MotherName		=trim($_POST['MotherName']);
$MobileNo1		=trim($_POST['MobileNo1']);
$nationalidNo	=trim($_POST['nationalidNo']);
$PresentAdd		=trim($_POST['PresentAdd']);
$ParmanentAdd	=trim($_POST['ParmanentAdd']);
$block_id		=trim($_POST['block_id']);
$birthcerNo		=trim($_POST['birthcerNo']);
$dateofbirth	=trim($_POST['date-picker2']);

$convence_head	=162292;
$amount_cv	=0;
$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=$convence_head and COMPANY_ID=$company_id and SECTION_ID=$section_id";
$qstr  = oci_parse($conn,$sql);
oci_execute($qstr);
if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
{
	$amount_cv 	= $row[0];
}

$house_rent     = fn_house_rent($section_id,$basic);
$medical       	= fn_medical($section_id,$basic);



$gross=$basic+$house_rent+$medical+$amount_cv+650;

$flag = true;
$sql	="select CARD_ID from TBL_PAY_EMP_PROFILE where upper(CARD_ID)='$cardno' and COMPANY_ID=$company_id and SECTION_ID=$section_id";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)){
	$msg	='Employee Already Exist';
	$flag = false;	
}
if($flag){
	$sql	="insert into TBL_PAY_EMP_PROFILE(COMPANY_ID,SECTION_ID,NAME,CARD_ID,EMP_ID,JOIN_DATE,BASIC,GRADE,DESIGNATION,STATUS,FATHER_NAME,MOTHER_NAME,MOBILE_NO1,NATIONAL_ID,PRESENT_ADDRESS,PARMANENT_ADDRESS,BIRTHCERTNO,GROSS,HOUSE_RENT,MEDICAL,BLOCK_ID,DATEOFBIRTH) values('".$company_id."','".$section_id."','".$nameEN."','".$cardno."','".$empID."',to_date('".$datepicker."','mm/dd/yyyy'),'".$basic."','".$grade."','".$designation."','1','".$FatherName."','".$MotherName."','".$MobileNo1."','".$nationalidNo."','".$PresentAdd."','".$ParmanentAdd."','".$birthcerNo."','".$gross."','".$house_rent."','".$medical."','".$block_id."',to_date('".$dateofbirth."','mm/dd/yyyy'))";
	
	$result	=oci_parse($conn,$sql);
	$success =oci_execute($result);
	
	if($success)
		$msg	='Successfully Add New Employee';
	else
		$msg	='Something Wrong Please Try Again';
	oci_free_statement($result);
}
oci_free_statement($stid);
oci_close($conn);
echo $msg;
?>