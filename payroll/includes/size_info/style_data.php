<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$section_id	=$_POST['section_id'];
$style_id	=$_POST['style_id'];
$size_id	=$_POST['size_id'];

$rate		="";
$quantity	="";
$sql	="select TBL_PAY_RATE_SETTING.RATE,TBL_PAY_STYLE_INFO.QUENTITY from TBL_PAY_RATE_SETTING,TBL_PAY_STYLE_INFO,TBL_PAY_SIZE_SETTING where TBL_PAY_RATE_SETTING.STYLE_ID=TBL_PAY_STYLE_INFO.ID and  TBL_PAY_RATE_SETTING.SIZE_ID=TBL_PAY_SIZE_SETTING.ID and  TBL_PAY_RATE_SETTING.SECTION_ID=$section_id and TBL_PAY_RATE_SETTING.STYLE_ID=$style_id  and TBL_PAY_RATE_SETTING.SIZE_ID=$size_id and TBL_PAY_RATE_SETTING.COMPANY_ID=$company_id";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH))
	{
		$rate		=$row[0];
		$quantity	=$row[1];
	}
echo $rate;
echo '!@#$';
echo $quantity;
/*oci_free_statement($result);
oci_close($conn);
*/
?>