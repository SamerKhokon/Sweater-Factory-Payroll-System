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


	$sqlst	="select * from TBL_PAY_STYLE_INFO";
	$stidst	= oci_parse($conn, $sqlst);
	oci_execute($stidst);
	while($row31 = oci_fetch_array($stidst, OCI_BOTH+OCI_RETURN_NULLS)) 
	{
		$style_id=$row31[0];
		
		$sql	="select size_name,count(size_name) from TBL_PAY_SIZE_SETTING where SECTION_ID='$section_id' and STYLE_ID='$style_id'  having count(size_name)>1 group by size_name";
		$stid	= oci_parse($conn, $sql);
		oci_execute($stid);
		while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
		{
			$card_id	=$row[0];
			$num_row	=$row[1] -1;
			
			echo $sql22	="delete from TBL_PAY_SIZE_SETTING where SIZE_NAME='$card_id' and SECTION_ID='$section_id' and STYLE_ID='$style_id' and rownum<=$num_row";
			
			
			$result	=oci_parse($conn,$sql22);
			$success=oci_execute($result);	
			
		}
	}
}
?>