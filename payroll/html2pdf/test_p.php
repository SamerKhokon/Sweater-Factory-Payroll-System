<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="1">
	<tr>
    	<td>card</td>
        <td>sec</td>
        <td>block</td>
        <td>qty</td>
        <td>date</td>
    </tr>
<?php
include_once("../includes/db.php");

/*

$sql	="select * from TBL_PAY_EMP_PRODUCTION
 where SECTION_ID='3407' and BLOCK_ID=3413";

*/
$sql	="update TBL_PAY_EMP_PROFILE  set GROSS=BASIC+HOUSE_RENT+MEDICAL+850  where  SECTION_ID='3429'";
 
$stid	= oci_parse($conn, $sql);
oci_execute($stid);

/*
while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
{
	$card_id	=$row['CARD_ID'];
	$SECTION_ID	=$row['SECTION_ID'];
	
	$BLOCK_ID	=$row['BLOCK_ID'];
	$QUANTITY	=$row['QUANTITY'];
	
	$PRO_DATE	=$row['PRO_DATE'];
	echo '<tr><td>'.$card_id.'</td><td>'.$SECTION_ID.'</td><td>'.$BLOCK_ID.'</td><td>'.$QUANTITY.'</td><td>'.$PRO_DATE.'</td></tr>';
}
*/
?>
</table>


</body>
</html>
