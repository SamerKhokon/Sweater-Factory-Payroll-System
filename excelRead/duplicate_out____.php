<?php
$tns = "192.168.10.18/orcl"; 		  
$conn = oci_connect('lusine_pay', 'lusine_pay', $tns);
if (!$conn) {
$e = oci_error();
trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$sqls	="select * from TBL_PAY_SECTION_INFO";
$stids	= oci_parse($conn, $sqls);
oci_execute($stids);
while($row3 = oci_fetch_array($stids, OCI_BOTH+OCI_RETURN_NULLS)) 
{

	$section_id =$row3[0];
	
	$sql	="select card_id, count(*) from TBL_PAY_EMP_PROFILE where SECTION_ID='$section_id' group by card_id having count(*) > 1";
	$stid	= oci_parse($conn, $sql);
	oci_execute($stid);
	while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
	{
		$card_id	=$row[0];
		$num_row	=$row[1] -1;
		
		$sql	="delete from TBL_PAY_EMP_PROFILE where card_id='$card_id' and SECTION_ID='$section_id' and rownum<=$num_row";
		$result	=oci_parse($conn,$sql);
		$success=oci_execute($result);
		
	}
}
?>