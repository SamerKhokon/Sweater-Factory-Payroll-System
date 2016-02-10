<?php
session_start();
if(!isset($_SESSION['usr_id']))
{
	header("Location: ../index.php");
	return;
}

require '../includes/db.php';

$total_sms	=$_POST['total_sms'];
$pay_m		=$_POST['pay_m'];
$c_num		=$_POST['c_num'];
$amount		=$_POST['amount'];


$sql="insert into SMS_REQ(REQ_TO,REQ_FROM,AMOUNT,ENTRY_DATE,FLAG) values('".$_SESSION['reseller_id']."','".$_SESSION['usr_id']."','".$total_sms."',sysdate,'R')";
$stid1	= oci_parse($conn, $sql);
if(oci_execute($stid1))
{
	oci_commit($conn);
	echo 'Request Successfully Submit';
}
else
	echo 'Something Wrong Try Again';
?>
