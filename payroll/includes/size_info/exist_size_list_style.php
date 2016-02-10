<?php   
session_start();
require '../../../includes/db.php';
$company_id	=trim($_SESSION["company_id"]);		
$id   =trim($_POST['id']);

$str = "select QUANTITY,RATE,SIZE_NAME from TBL_PAY_RATE_SETTING a,TBL_PAY_SIZE_SETTING b where a.SIZE_ID=b.ID and a.ID=$id";
$stm = oci_parse($conn,$str);
oci_execute($stm);
while($res = oci_fetch_array($stm,OCI_BOTH+OCI_RETURN_NULLS)) {
	$size	=$res[2];
	$quantity=$res[0];
	$rate=$res[1];
	
}
echo '!@#$';
echo $size;
echo '!@#$';
echo $quantity;
echo '!@#$';
echo $rate;

oci_free_statement($stm);
oci_close($conn);
?>