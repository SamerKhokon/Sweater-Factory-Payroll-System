<?php
session_start();
require '../../../includes/db.php';

$company_id			=$_SESSION["company_id"];
$section_id			=$_POST['section_id'];
$datepicker			=$_POST['datepicker'];
$total_day_of_month	=$_POST['total_day_of_month'];

$block_name			=$_POST['block_name'];

$atten				=$_POST['atten'];

$friday				=$_POST['friday'];
$ot					=$_POST['ot'];
$advanced			=$_POST['advanced'];

$govt_holi			=$_POST['govt_holi'];



$month_year			=substr($_POST['datepicker'],0,3).''.substr($_POST['datepicker'],6,10);
$xsql	="";
if($block_name!='')
	$xsql	=" and BLOCK_ID=$block_name";

$msg='Something Wrong, Please Trry Again';
$i=0;
$sql	="select CARD_ID from TBL_PAY_EMP_PROFILE where COMPANY_ID=$company_id and SECTION_ID=$section_id and STATUS=1 ".$xsql."";
$res	= oci_parse($conn, $sql);
oci_execute($res);
while(($row = oci_fetch_array($res, OCI_BOTH+OCI_RETURN_NULLS))) 
    {
	
		$cardno	=$row[0];
		
		$sql	="select ID,TOTAL_ATTEND,LATE_PRESENT,OT,ADVANCE,LEAVE,LUNCH_OUT,GOVT_HOLI from TBL_PAY_EMP_ATTEN_INFO where CARD_ID='$cardno' and SECTION_ID=$section_id	and COMPANY_ID=$company_id and to_char(MONTH_YEAR,'mm/yyyy')='$month_year'";
		$stid	= oci_parse($conn, $sql);
		oci_execute($stid);
		if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
		{
			$sql1="delete from TBL_PAY_LEAVE_INFO where SECTION_ID=$section_id and CARD_ID='$cardno' and to_char(MONTH_YEAR,'mm/yyyy')='$month_year'";
			$stid	= oci_parse($conn, $sql1);
			oci_execute($stid);
		
			$sql	="delete from TBL_PAY_EMP_ATTEN_INFO where ID='".$row[0]."'";
			$stid	= oci_parse($conn, $sql1);
			oci_execute($stid);
		}
		
		$sql	="insert into TBL_PAY_EMP_ATTEN_INFO(SECTION_ID,COMPANY_ID,CARD_ID,BLOCK_ID,MONTH_YEAR,WORKS_DAY,TOTAL_ATTEND,HOLY_DAY,ADVANCE,OT,GOVT_HOLI) values('".$section_id."','".$company_id."','".$cardno."','".$block_name."',to_date('".$datepicker."','mm-dd-yyyy'),'".$total_day_of_month."','".$atten."','".$friday."','".$advanced."','".$ot."','".$govt_holi."')";
		$result	=oci_parse($conn,$sql);
		$success=oci_execute($result);
		$i++;
	}
if($i>0)
$msg='Data Update Successfully';
echo $msg;
oci_free_statement($res);
oci_close($conn);
?>