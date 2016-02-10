<?php
session_start();
require '../../../includes/db.php';
$sec_id		=trim($_POST['sec_id']);
$company_id	=$_SESSION["company_id"];
$i=0;
$sql	="select ID,BLOCK_NAME from TBL_PAY_SECTION_BLOCK where SECTION_ID='".$sec_id."' and COMPANY_ID='".$company_id."'";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);

while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
{
$i++;
	if($i==1)
	{
		echo '<option value="">ALL</option>';
	}
	
	echo '<option value='.$row[0].'>'.$row[1].'</option>';
}
if($i==0)
echo '<option value="">All</option>';
oci_free_statement($stid);
oci_close($conn);
?>