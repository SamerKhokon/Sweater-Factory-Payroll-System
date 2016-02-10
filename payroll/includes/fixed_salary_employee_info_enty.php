<?php
session_start();
//include_once("../opSessionCheck2.inc");
include('../function.php');
require '../../../includes/db.php';

$company_id		=trim($_SESSION["company_id"]);
$section_id		=trim($_POST['section_id']);
$cardno			=trim($_POST['cardno']);
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
$nationalidNo		=trim($_POST['nationalidNo']);
$PresentAdd		=trim($_POST['PresentAdd']);
$ParmanentAdd	=trim($_POST['ParmanentAdd']);
$block_id		=$_POST['block_id'];
$birthcerNo			=trim($_POST['birthcerNo']);

$house_rent       	= fn_house_rent($section_id,$basic);
$medical       	= fn_medical($section_id,$basic);
$gross=$basic+$house_rent+$medical;

$flag = true;

$sql	="select CARD_ID from TBL_PAY_EMP_PROFILE where CARD_ID='$cardno' and COMPANY_ID=$company_id and SECTION_ID=$section_id";
$stid	= mysqli_query($conn, $sql);

if($row = mysqli_fetch_array($stid)) 
{
	$msg	='Employee Already Exist';
	$flag = false;	
}

if($flag){
	$sql	="insert into TBL_PAY_EMP_PROFILE(COMPANY_ID,SECTION_ID,NAME,CARD_ID,EMP_ID,JOIN_DATE,BASIC,GRADE,DESIGNATION,STATUS,FATHER_NAME,MOTHER_NAME,MOBILE_NO1,NATIONAL_ID,PRESENT_ADDRESS,PARMANENT_ADDRESS,BIRTHCERTNO,GROSS,HOUSE_RENT,MEDICAL,BLOCK_ID) values('".$company_id."','".$section_id."','".$nameEN."','".$cardno."','".$empID."',to_date('".$datepicker."','mm/dd/yyyy'),'".$basic."','".$grade."','".$designation."','1','".$FatherName."','".$MotherName."','".$MobileNo1."','".$nationalidNo."','".$PresentAdd."','".$ParmanentAdd."','".$birthcerNo."','".$gross."','".$house_rent."','".$medical."','".$block_id."')";
	$result	=mysqli_query($sql);
	
	if($result)
		$msg	='Successfully Add New Employee';
	else
		$msg	='Something Wrong Please Try Again';
}
echo $msg;
?>