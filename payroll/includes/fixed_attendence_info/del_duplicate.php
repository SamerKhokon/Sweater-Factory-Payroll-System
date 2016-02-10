<?php
require '../../../includes/db.php';
$sql	="select card_id, count(*) from TBL_PAY_EMP_ATTEN_INFO where to_char(MONTH_YEAR,'mm/yyyy')='07/2013' group by card_id having count(*) > 1";
$stid	= mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($stid)) 
{
	$card_id	=$row[0];
	$num_row	=$row[1] -1;	
	echo $sql	="delete from TBL_PAY_EMP_ATTEN_INFO where card_id='$card_id' and to_char(MONTH_YEAR,'mm/yyyy')='07/2013' and rownum<=$num_row";
	$result	=mysqli_query($conn,$sql);	
}
?>