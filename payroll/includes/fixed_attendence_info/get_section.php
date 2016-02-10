<?php
session_start();
require '../../../includes/db.php';
$type_id		=$_POST['type_id'];
$company_id	=$_SESSION["company_id"];

$sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='$type_id' and TBL_PAY_SECTION_INFO.COMPANY_ID=$company_id  order by TBL_PAY_SECTION_INFO.ID";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
$i=0;
echo '<option value="">NONE</option>';
while(($row = oci_fetch_array($stid, OCI_BOTH))) 
{
$i=1;
	echo '<option value='.$row[0].'>'.$row[1].'</option>';
}
?>