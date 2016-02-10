<?php
require '../../../includes/db.php';

$sql	="select card_id, count(*) from TBL_PAY_EMP_ATTEN_INFO where to_char(MONTH_YEAR,'mm/yyyy')='07/2013' group by card_id having count(*) > 1";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
{
	$card_id	=$row[0];
	$num_row	=$row[1] -1;
	
	echo $sql	="delete from TBL_PAY_EMP_ATTEN_INFO where card_id='$card_id' and to_char(MONTH_YEAR,'mm/yyyy')='07/2013' and rownum<=$num_row";
	$result	=oci_parse($conn,$sql);
	$success=oci_execute($result);
	
}


?>