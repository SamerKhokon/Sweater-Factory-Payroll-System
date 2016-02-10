<?php
session_start();
require '../../../includes/db.php';

$company_id	=$_SESSION["company_id"];
$section_id	=$_POST['section_id'];
$datepicker	=$_POST['datepicker'];
$block_name	=$_POST['block_name'];
$cardno		=$_POST['cardno'];
$name		=$_POST['name'];
$size_id	=$_POST['size_id'];
$style_id	=$_POST['style_id'];

$quantity2	=$_POST['quantity'];

$style 	= trim(strtoupper($_POST['style']));
$size 	= trim(strtoupper($_POST['size']));
$avable1=trim($_POST['avable']);


$style_id	="";
$size_id="";

$sql="select ID from  TBL_PAY_STYLE_INFO where upper(STYLE_NAME)='$style'";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
{
	
	$style_id	=$row[0];		
}

$sql="select ID from  TBL_PAY_SIZE_SETTING where STYLE_ID='$style_id' and  upper(SIZE_NAME)='$size' and SECTION_ID=$section_id";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
{
	
	$size_id	=$row[0];		
}


$quantity		=0;
$issue_quantity	=0;
$avable			=0;
$where='where 1=1 and ';

$where.=" COMPANY_ID=$company_id and SECTION_ID='$section_id' and CARD_ID='$cardno' and  STYLE_ID='$style_id' and SIZE_ID='$size_id'";
 $sql	="select sum(QUANTITY) from TBL_PAY_EMP_PRODUCTION $where";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
{
	
	$quantity	=$row[0];		
}
$sql	="select QUANTITY from TBL_PAY_EMP_PRODUCTION_ISSUE where COMPANY_ID=$company_id and SECTION_ID='$section_id' and  STYLE_ID='$style_id' and SIZE_ID='$size_id' and CARD_ID='$cardno'";
$stid	= oci_parse($conn, $sql);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
{
	$issue_quantity=$row[0];
}
$avable	=($issue_quantity-$quantity);




/*if($avable==$avable1)
{
*/

$sql	="insert into TBL_PAY_EMP_PRODUCTION(CARD_ID,COMPANY_ID,SECTION_ID,BLOCK_ID,STYLE_ID,SIZE_ID,QUANTITY,PRO_DATE) values('".$cardno."','".$company_id."','".$section_id."','".$block_name."','".$style_id."','".$size_id."','".$quantity2."',to_date('".$datepicker."','mm/dd/yyyy'))";
$result	=oci_parse($conn,$sql);
$success=oci_execute($result);
if($success)
{
	$msg	='Success';
}
else
{
	$msg	='Fail';
}
/*}
else
$msg	='Fail2';
*/
//echo $avable.'-'.$avable1
?>
