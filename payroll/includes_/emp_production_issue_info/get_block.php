<?php
session_start();
require '../../../includes/db.php';
$sec_id		=$_POST['sec_id'];
$company_id	=$_SESSION["company_id"];

?>
<select id="block_name" name="block_name" style="width:150px;">
<?php
$i=0;
$sql	="select ID,BLOCK_NAME from TBL_PAY_SECTION_BLOCK where SECTION_ID='".$sec_id."' and COMPANY_ID='".$company_id."'";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);

while($row = oci_fetch_array($stid, OCI_BOTH))
{
$i++;
	echo '<option value='.$row[0].'>'.$row[1].'</option>';
}
if($i==0)
	echo '<option value="">None</option>';
?>
</select>
<?php
echo '!@#$';
echo $sec_id; 
?>
