<?php
session_start();
require '../../../includes/db.php';
include('../function.php');
$company_id	=$_SESSION["company_id"];
$section_id	=$_POST['section_id'];
$datepicker	=$_POST['datepicker'];
$block_name	=$_POST['block_name'];
$cardno		=$_POST['cardno'];
$name		=$_POST['name'];
$size_id	=$_POST['size_id'];
$style_id	=$_POST['style_id'];
$quantity	=$_POST['quantity'];

$month_year=substr($_POST['datepicker'],0,3).''.substr($_POST['datepicker'],6,10);

$sql	="insert into TBL_PAY_EMP_PRODUCTION_ISSUE(CARD_ID,COMPANY_ID,SECTION_ID,BLOCK_ID,STYLE_ID,SIZE_ID,QUANTITY,PRO_DATE) values('".$cardno."','".$company_id."','".$section_id."','".$block_name."','".$style_id."','".$size_id."','".$quantity."',to_date('".$datepicker."','mm/dd/yyyy'))";


$result	=oci_parse($conn,$sql);
$success=oci_execute($result);
if($success){
	$msg	='Success';
}else{
	$msg	='Fail';
}
/*
$sql	="select  count(CARD_ID) from TBL_PAY_EMP_ATTEN_INFO where SECTION_ID=$section_id and COMPANY_ID=$company_id and to_char(MONTH_YEAR,'mm/yyyy')='".$month_year."' and  CARD_ID=$cardno";
$qstr  = oci_parse($conn,$sql);
oci_execute($qstr);

if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
{
	$atten	=$row[0];
}
if($atten==0)
{


	$date_str = trim(PREG_REPLACE("/[\/,\s-]/i", ',', $datepicker));
	$date_str=explode(",",$date_str);
	
	$num_daysval	= getDayName2($date_str[0],$date_str[1],$date_str[2]);
	$num_daysval	=explode("-",$num_daysval);
	$year=$num_daysval[2];
	$month=$num_daysval[1];
	$day="Fri";

	$atten=0;
	$l_present=0;
	$leave=0;
	$ot=0;
	$no_work=0;
	$friday =num_days ($day, $month, $year);
	
	//$friday =4;
	$advanced=0;
	$lunch_out = 0;
	$total_day_of_month=cal_days_in_month(CAL_GREGORIAN, (int)$date_str[0], (int)$date_str[2]);
	$casual	=0;
	$annual	=0;
	$sick	=0;
	$sql	="insert into TBL_PAY_EMP_ATTEN_INFO(SECTION_ID,COMPANY_ID,CARD_ID,BLOCK_ID,MONTH_YEAR,WORKS_DAY,TOTAL_ATTEND,LATE_PRESENT,LEAVE,OT,NO_WORK,HOLY_DAY,ADVANCE,LUNCH_OUT) values('".$section_id."','".$company_id."','".$cardno."','".$block_name."',to_date('".$datepicker."','mm-dd-yyyy'),'".$total_day_of_month."','".$atten."','".$l_present."','".$leave."','".$ot."','".$no_work."','".$friday."','".$advanced."','".$lunch_out."')";
	$result	=oci_parse($conn,$sql);
	$success=oci_execute($result);
	if($success)
		{
		$sql2	="insert into TBL_PAY_LEAVE_INFO(SECTION_ID,COMPANY_ID,EMP_ID,CARD_ID,TOTAL_LEAVE,CASUAL,ANUAL,SICK,MONTH_YEAR) values('".$section_id."','".$company_id."','0','".$cardno."','".$leave."','".$casual."','".$annual."','".$sick."',to_date('".$datepicker."','mm-dd-yyyy'))";
		$res	=oci_parse($conn,$sql2);
		$succ	=oci_execute($res);
		}
}
*/
oci_free_statement($result);
oci_close($conn);
?>