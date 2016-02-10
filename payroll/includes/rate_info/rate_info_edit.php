<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$id			=$_POST['id'];

$sql	="select TBL_PAY_RATE_SETTING.SECTION_ID,TBL_PAY_RATE_SETTING.STYLE_ID,TBL_PAY_RATE_SETTING.SIZE_ID,TBL_PAY_RATE_SETTING.RATE,TBL_PAY_STYLE_INFO.STYLE_NAME,TBL_PAY_SIZE_SETTING.SIZE_NAME,TBL_PAY_STYLE_INFO.QUENTITY from TBL_PAY_RATE_SETTING,TBL_PAY_STYLE_INFO,TBL_PAY_SIZE_SETTING where TBL_PAY_RATE_SETTING.STYLE_ID=TBL_PAY_STYLE_INFO.ID and  TBL_PAY_RATE_SETTING.SIZE_ID=TBL_PAY_SIZE_SETTING.ID and    TBL_PAY_RATE_SETTING.ID='$id'";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if(($row = oci_fetch_array($stid, OCI_BOTH)))
	{
		$section_id	=$row[0];
		$style_id	=$row[1];
		$size_id	=$row[2];
		$rate		=$row[3];
		$style_NM	=$row[4];
		$size_NM	=$row[5];
		$quantity	=$row[6];
	}
echo $section_id;
echo '!@#$';
echo $style_id;
echo '!@#$';
echo $size_id;
echo '!@#$';
echo $rate;
echo '!@#$';
echo $style_NM;
echo '!@#$';
echo $size_NM;
echo '!@#$';
echo $quantity;
/*oci_free_statement($result);
oci_close($conn);
*/
?>