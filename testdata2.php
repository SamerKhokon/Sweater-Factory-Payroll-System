<?php
require 'includes/db.php';
$i=0;
$j=0;
$company_id=1;
$sizeQty =0;
$usr_id	=23;
$sql	="select ID,SECTION_ID,STYLE_ID from TBL_PAY_SIZE_SETTING where SECTION_ID is not null";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
{
	$style=$row[2];
	$size=$row[0];
	$section=$row[1];
	echo $sql2	="select * from TBL_PAY_RATE_SETTING where STYLE_ID=$style and SIZE_ID=$size and SECTION_ID=$section";
	echo "<br>";
	$stid2	= oci_parse($conn, $sql2);
	oci_execute($stid2);
	if($row1 = oci_fetch_array($stid2, OCI_BOTH+OCI_RETURN_NULLS)) 
	{
			echo '';
			$j++;
	}
	else
	{
	//echo $style.'-'.$size.'-'.$section.'<br>';
	
		echo $sql1	="insert into TBL_PAY_RATE_SETTING(SECTION_ID,COMPANY_ID,STYLE_ID,SIZE_ID,QUANTITY,RATE,ENTY_DATE,ENTRY_BY) values('".$section."','".$company_id."','".$style."','".$size."','".$sizeQty."',0,sysdate,'$usr_id')";
						//$result1	=oci_parse($conn,$sql1);
						//$success=oci_execute($result1);
	$i++;
	}
	//echo 'test';
	
}
echo 'i='.$i.'j='.$j;

?>