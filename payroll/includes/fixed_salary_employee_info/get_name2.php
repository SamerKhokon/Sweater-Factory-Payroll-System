<?php
session_start();
require '../../../includes/db.php';
include('../function.php');
$company_id	=$_SESSION["company_id"];
$card_no	=$_POST['card_no'];
$section_id	=$_POST['section_id'];

$sql	="select NAME,BASIC,GRADE,DESIGNATION,EMP_ID,BNG_NAME,MOBILE_NO1,NATIONAL_ID,PRESENT_ADDRESS,PARMANENT_ADDRESS,FATHER_NAME,MOTHER_NAME,to_char(JOIN_DATE,'mm/dd/yyyy') as jdate,BIRTHCERTNO,DATEOFBIRTH from TBL_PAY_EMP_PROFILE where CARD_ID='$card_no'  and COMPANY_ID=$company_id and SECTION_ID=$section_id";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
echo $row['NAME'];
echo '!@#$';
echo $row['BASIC'];
echo '!@#$';
echo $row['GRADE'];
echo '!@#$';
echo $row['DESIGNATION'];
echo '!@#$';
echo $row['EMP_ID'];
echo '!@#$';
echo gross_salary($section_id, $row['BASIC']);
echo '!@#$';
echo $row['BNG_NAME'];
echo '!@#$';
echo $row['MOBILE_NO1'];
echo '!@#$';
echo $row['NATIONAL_ID'];
echo '!@#$';
echo $row['PRESENT_ADDRESS'];
echo '!@#$';
echo $row['PARMANENT_ADDRESS'];
echo '!@#$';
echo $row['FATHER_NAME'];
echo '!@#$';
echo $row['MOTHER_NAME'];
echo '!@#$';
echo $row[12];
echo '!@#$';
echo $row['BIRTHCERTNO'];
echo '!@#$';
echo $row['DATEOFBIRTH'];
?>