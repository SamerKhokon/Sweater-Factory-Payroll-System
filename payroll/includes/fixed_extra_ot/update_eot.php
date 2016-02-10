<?php
session_start();
require '../../../includes/db.php';
$atn_ids	=trim($_POST['atn_ids']);
$eot		=trim($_POST['eot']);

if($atn_ids!='')
$atn_ids	=explode('|',$atn_ids);

if($eot!='')
$eot		=explode('|',$eot);
for($i=0;$i<count($atn_ids);$i++)
{
	$sql	="update TBL_PAY_EMP_ATTEN_INFO set EXTRA_OT='".$eot[$i]."' where ID='".$atn_ids[$i]."'";
	$result1	=oci_parse($conn,$sql);
	$success1=oci_execute($result1);
}
echo 'Data Update Successfull';
?>