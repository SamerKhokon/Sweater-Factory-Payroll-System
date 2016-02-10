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

$sql="select ID from  TBL_PAY_STYLE_INFO where upper(STYLE_NAME)='$style' and COMPANY_ID=$company_id";
$stid	= mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($stid )) 
{
	
	$style_id	=$row[0];		
}

$sql="select ID from  TBL_PAY_SIZE_SETTING where STYLE_ID='$style_id' and  upper(SIZE_NAME)='$size' and SECTION_ID=$section_id";
$stid	= mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($stid )) 
{
	
	$size_id	=$row[0];		
}


$quantity		=0;
$issue_quantity	=0;
$avable			=0;
$where='where 1=1 and ';

$where.=" COMPANY_ID=$company_id and SECTION_ID='$section_id' and CARD_ID='$cardno' and  STYLE_ID='$style_id' and SIZE_ID='$size_id'";
 $sql	="select sum(QUANTITY) from TBL_PAY_EMP_PRODUCTION $where";
$stid	= mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($stid)) 
{
	
	$quantity	=$row[0];		
}
$sql	="select QUANTITY from TBL_PAY_EMP_PRODUCTION_ISSUE where COMPANY_ID=$company_id and SECTION_ID='$section_id' and  STYLE_ID='$style_id' and SIZE_ID='$size_id' and CARD_ID='$cardno'";
$stid	= mysqli_query($conn, $sql);

if($row = mysqli_fetch_array($stid))
{
	$issue_quantity=$row[0];
}
$avable	=($issue_quantity-$quantity);




/*if($avable==$avable1)
{
*/

$sql	="insert into TBL_PAY_EMP_PRODUCTION(CARD_ID,COMPANY_ID,SECTION_ID,BLOCK_ID,STYLE_ID,SIZE_ID,QUANTITY,PRO_DATE) values('".$cardno."','".$company_id."','".$section_id."','".$block_name."','".$style_id."','".$size_id."','".$quantity2."',to_date('".$datepicker."','mm/dd/yyyy'))";
$result	=mysqli_query($conn,$sql);

if($result)
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
