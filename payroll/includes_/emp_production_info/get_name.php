<?php
session_start();
require '../../../includes/db.php';
include('../function.php');
$company_id	=$_SESSION["company_id"];
$section_id	=$_POST['section_id'];
$card_no	=strtoupper($_POST['card_no']);
$block_name	=$_POST['block_id'];
$en_date	=$_POST['en_date'];
$block_id	="";

//$month_year=substr($_POST['en_date'],0,3).''.substr($_POST['en_date'],6,10);

$sql	="select NAME,BLOCK_ID from TBL_PAY_EMP_PROFILE where upper(CARD_ID)='".$card_no."'  and COMPANY_ID=$company_id and SECTION_ID=$section_id";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
echo $name	=$row[0];
echo '!@#$';
echo $block_id=$row[1]; 
// first time add allten\

//$month_year	=date('m/Y');
//$datepicker	=date('m/d/Y');

$month_year=substr($_POST['en_date'],0,3).''.substr($_POST['en_date'],6,10);
$datepicker     =$en_date ;


$sql	="select  count(CARD_ID) from TBL_PAY_EMP_ATTEN_INFO where SECTION_ID=$section_id and COMPANY_ID=$company_id and to_char(MONTH_YEAR,'mm/yyyy')='".$month_year."' and  CARD_ID='$card_no'";
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
	$sick		=0;
	$sql	="insert into TBL_PAY_EMP_ATTEN_INFO(SECTION_ID,COMPANY_ID,CARD_ID,BLOCK_ID,MONTH_YEAR,WORKS_DAY,TOTAL_ATTEND,LATE_PRESENT,LEAVE,OT,NO_WORK,HOLY_DAY,ADVANCE,LUNCH_OUT,CASUAL,ANUAL,SICK) values('".$section_id."','".$company_id."','".$card_no."','".$block_name."',to_date('".$datepicker."','mm-dd-yyyy'),'".$total_day_of_month."','".$atten."','".$l_present."','".$leave."','".$ot."','".$no_work."','".$friday."','".$advanced."','".$lunch_out."','".$casual."','".$annual."','".$sick."')";
	$result	=oci_parse($conn,$sql);
	$success=oci_execute($result);
	if($success)
		{
		$sql2	="insert into TBL_PAY_LEAVE_INFO(SECTION_ID,COMPANY_ID,EMP_ID,CARD_ID,TOTAL_LEAVE,CASUAL,ANUAL,SICK,MONTH_YEAR) values('".$section_id."','".$company_id."','0','".$card_no."','".$leave."','".$casual."','".$annual."','".$sick."',to_date('".$datepicker."','mm-dd-yyyy'))";
		$res	=oci_parse($conn,$sql2);
		$succ	=oci_execute($res);
		}
}
?>
