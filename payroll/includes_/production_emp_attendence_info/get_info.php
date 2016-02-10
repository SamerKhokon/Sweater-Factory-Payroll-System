<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$card_no	=strtoupper($_POST['card_no']);
$section_id	=$_POST['section_id'];

$total_atten	="";
$late_pre		="";
$no_work		="";
$ot				="";
$leave			="";
$advanced		="";
$lunch_out		="";
$block_id		="";
$govt_holi		="";
$casual			=0;
$anual			=0;
$sick			=0;
$id				="";
$other_amnt		="";

$month_year	=substr($_POST['month_year'],0,3).''.substr($_POST['month_year'],6,10);

$sql	="select NAME,BLOCK_ID from TBL_PAY_EMP_PROFILE where upper(CARD_ID)='$card_no' and SECTION_ID=$section_id	and COMPANY_ID=$company_id";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
{
$block_id=$row[1];
echo $row[0];
}
echo '!@#$';
$sql	="select TOTAL_ATTEND,LATE_PRESENT,NO_WORK,OT,ADVANCE,LEAVE,LUNCH_OUT,GOVT_HOLI,CASUAL,ANUAL,SICK,ID,OTHER_AMNT  from TBL_PAY_EMP_ATTEN_INFO where CARD_ID='$card_no' and SECTION_ID=$section_id	and COMPANY_ID=$company_id and to_char(MONTH_YEAR,'mm/yyyy')='$month_year'";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
{
	$total_atten	=$row[0];
	$late_pre		=$row[1];
	$no_work		=$row[2];
	$ot				=$row[3];
	$advanced		=$row[4];
	$leave			=$row[5];
	$lunch_out		=$row[6];
	$govt_holi		=$row[7];
	$casual			=$row[8];
	$anual			=$row[9];
	$sick			=$row[10];
	$id				=$row[11];
	$other_amnt		=$row[12];
}
echo $total_atten;
echo '!@#$';
echo $late_pre;
echo '!@#$';
echo $no_work;
echo '!@#$';
echo $ot;
echo '!@#$';
echo $advanced;
echo '!@#$';
echo $leave;
echo '!@#$';
echo $lunch_out;
echo '!@#$';
echo $block_id;
echo '!@#$';
echo $govt_holi;
echo '!@#$';
echo $casual;
echo '!@#$';
echo $anual;
echo '!@#$';
echo $sick;
echo '!@#$';
echo $id;
echo '!@#$';
echo $other_amnt;

oci_free_statement($stid);
oci_close($conn);
?>