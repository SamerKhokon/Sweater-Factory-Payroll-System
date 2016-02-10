<?php
session_start();
require '../../../includes/db.php';

$company_id			=$_SESSION["company_id"];
$section_id			=$_POST['section_id'];
$datepicker			=$_POST['datepicker'];
$total_day_of_month	=$_POST['total_day_of_month'];


$cardno				=$_POST['cardno'];
$block_name			=$_POST['block_name'];
$name				=$_POST['name'];
$eot				=$_POST['eot'];


$month_year			=substr($_POST['datepicker'],0,3).''.substr($_POST['datepicker'],6,10);

$msg='';
$sql	="select ID,TOTAL_ATTEND,LATE_PRESENT,OT,ADVANCE,LEAVE,LUNCH_OUT,GOVT_HOLI,EXTRA_OT from TBL_PAY_EMP_ATTEN_INFO where CARD_ID='$cardno' and SECTION_ID=$section_id	and COMPANY_ID=$company_id and to_char(MONTH_YEAR,'mm/yyyy')='$month_year'";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
{
	
	$sql	="update TBL_PAY_EMP_ATTEN_INFO set EXTRA_OT='$eot'  where ID='".$row[0]."'";
	$result	=oci_parse($conn,$sql);
	$success=oci_execute($result);
	$msg	='Extra OT Add Successfull';
}
else
{
	$msg	='Please Attendance Entry';
}
oci_free_statement($stid);
oci_close($conn);
echo $msg;
?>