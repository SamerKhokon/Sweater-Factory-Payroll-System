<?php 
session_start();
$company_id	=$_SESSION["company_id"];
require '../../../includes/db.php';
$rate_id   = trim($_POST['rate_id']);
$sql	="select a.ID,a.SECTION_ID,(select STYLE_NAME from TBL_PAY_STYLE_INFO where ID=a.STYLE_ID ) as STYLE_NAME,(select SIZE_NAME from TBL_PAY_SIZE_SETTING where ID=a.SIZE_ID ) as SIZE_NAME,a.RATE,a.QUANTITY from TBL_PAY_RATE_SETTING a where ID='$rate_id'";
$stm = oci_parse($conn,$sql);
oci_execute($stm);
while($res = oci_fetch_array($stm,OCI_BOTH+OCI_RETURN_NULLS))
{
	$id    = $res[0];
	$style_name	=$res[2];
	$size_name=$res[3];
	$rate=$res[4];
	$quantity=$res[5];
	$section_id=$res[1];
}
echo $id;
echo '!@#$';
echo $style_name;
echo '!@#$';
echo $size_name;
echo '!@#$';
echo $rate;
echo '!@#$';
echo $quantity;
echo '!@#$';
echo $section_id;
?>