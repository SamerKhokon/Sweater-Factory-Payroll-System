<?php
session_start();
require '../../../includes/db.php';

$company_id			=$_SESSION["company_id"];
$section_id			=$_POST['section_id'];
$date_condition		=$_POST['date_condition'];
$datepicker			=$_POST['datepicker'];
$total_day_of_month	=$_POST['total_day_of_month'];


$cardno				=$_POST['cardno'];
$block_name			=$_POST['block_name'];
$name				=$_POST['name'];
$atten				=$_POST['atten'];
$leave				=$_POST['leave'];
$lunch_out			=$_POST['lunch_out'];
$l_present			=$_POST['l_present'];
$friday				=$_POST['friday'];
$ot					=$_POST['ot'];
$other_amnt			=$_POST['other_amnt'];
$advanced			=$_POST['advanced'];


$sick				=$_POST['sick'];
$casual				=$_POST['casual'];
$annual				=$_POST['annual'];
$govt_holi			=$_POST['govt_holi'];

if($leave=='' || $leave==0)
{
	$sick	=0;
	$casual	=0;
	$annual	=0;
	$leave	=0;
}

$month_year			=substr($_POST['datepicker'],0,3).''.substr($_POST['datepicker'],6,10);

$msg='';
$sql	="select ID,TOTAL_ATTEND,LATE_PRESENT,OT,ADVANCE,LEAVE,LUNCH_OUT,GOVT_HOLI,OTHER_AMNT from TBL_PAY_EMP_ATTEN_INFO where CARD_ID='$cardno' and SECTION_ID=$section_id	and COMPANY_ID=$company_id and to_char(MONTH_YEAR,'mm/yyyy')='$month_year'";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
{
	
	$sql	="update TBL_PAY_EMP_ATTEN_INFO set TOTAL_ATTEND='$atten',LATE_PRESENT='$l_present',LEAVE='$leave',OT='$ot',ADVANCE='$advanced',LUNCH_OUT='$lunch_out',CASUAL='$casual',ANUAL='$annual',SICK='$sick',GOVT_HOLI='$govt_holi',OTHER_AMNT='$other_amnt',HOLY_DAY='$friday'   where ID='".$row[0]."'";
	$result	=oci_parse($conn,$sql);
	$success=oci_execute($result);
	if($success)
	{
		$sql2	="select * from TBL_PAY_LEAVE_INFO where CARD_ID='$cardno' and COMPANY_ID=$company_id and to_char(MONTH_YEAR,'mm/yyyy')='$month_year'";
		$stid	= oci_parse($conn, $sql2);
		oci_execute($stid);
		if($row1 = oci_fetch_array($stid, OCI_BOTH)) 
		{
			$sql	="update TBL_PAY_LEAVE_INFO set CASUAL='$casual',ANUAL='$annual',SICK='$sick',TOTAL_LEAVE='$leave' where ID='".$row1[0]."'";
			$result	=oci_parse($conn,$sql);
			$succe=oci_execute($result);
			if($succe)
				$msg	='Update Successfull';
			else
				$msg	='Sorry Try Again';
		}
		else
		{
			$sql2	="insert into TBL_PAY_LEAVE_INFO(SECTION_ID,COMPANY_ID,EMP_ID,CARD_ID,TOTAL_LEAVE,CASUAL,ANUAL,SICK,MONTH_YEAR) values('".$section_id."','".$company_id."','0','".$cardno."','".$leave."','".$casual."','".$annual."','".$sick."',to_date('".$datepicker."','mm-dd-yyyy'))";
			$stid	=oci_parse($conn,$sql2);
			$succ	=oci_execute($stid);
			if($succ)
				{
				$msg	='Update Successfull';
				}
		
		}

	}
	else
	{
		$msg	='Sorry Try Again';
	}

}
else
{

	$sql	="insert into TBL_PAY_EMP_ATTEN_INFO(SECTION_ID,COMPANY_ID,CARD_ID,BLOCK_ID,MONTH_YEAR,WORKS_DAY,TOTAL_ATTEND,LATE_PRESENT,LEAVE,HOLY_DAY,ADVANCE,LUNCH_OUT,OT,CASUAL,ANUAL,SICK,GOVT_HOLI,OTHER_AMNT) values('".$section_id."','".$company_id."','".$cardno."','".$block_name."',to_date('".$datepicker."','mm-dd-yyyy'),'".$total_day_of_month."','".$atten."','".$l_present."','".$leave."','".$friday."','".$advanced."','".$lunch_out."','".$ot."','".$casual."','".$annual."','".$sick."','".$govt_holi."','".$other_amnt."')";
	$result	=oci_parse($conn,$sql);
	$success=oci_execute($result);
	if($success)
		{
		$sql2	="insert into TBL_PAY_LEAVE_INFO(SECTION_ID,COMPANY_ID,EMP_ID,CARD_ID,TOTAL_LEAVE,CASUAL,ANUAL,SICK,MONTH_YEAR) values('".$section_id."','".$company_id."','0','".$cardno."','".$leave."','".$casual."','".$annual."','".$sick."',to_date('".$datepicker."','mm-dd-yyyy'))";
		$stid	=oci_parse($conn,$sql2);
		$succ	=oci_execute($stid);
		if($succ)
			{
			$msg	='Info Add Successfully';
			}
		}
	else
		{
		$msg	='Some thing Wrong, Please Try Again';
		}
}

oci_free_statement($stid);
oci_free_statement($result);
oci_close($conn);
echo $msg;
?>