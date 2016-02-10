<?php
require '../../../includes/db.php';

$sql	="select CARD_ID from TBL_PAY_EMP_PRODUCTION   where  COMPANY_ID=2 and to_char(PRO_DATE,'mm/yyyy')='04/2013' and SECTION_ID=90704 group by CARD_ID";
$qstr  = oci_parse($conn,$sql);
oci_execute($qstr);
while($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
{

	$card_no	= $row[0];
	
	$sql	="select  count(CARD_ID) from TBL_PAY_EMP_ATTEN_INFO where SECTION_ID=90704 and COMPANY_ID=2 and to_char(MONTH_YEAR,'mm/yyyy')='04/2013' and  CARD_ID='$card_no'";
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	
	if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
	{
		$atten	=$row[0];
	}

	if($atten==0)
	{
	
	 echo $card_no.'<br>';
	 
	/*
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
	*/
	}
}
?>