<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
$my_data = trim($_GET['q']);
$section_id=$_GET['sec_id'];
$sql="SELECT CARD_ID FROM TBL_PAY_EMP_PROFILE WHERE SECTION_ID='$section_id' and STATUS='1' and LOWER(CARD_ID) LIKE '$my_data%' ORDER BY CARD_ID asc";
$stid	= mysqli_query($conn, $sql);

while(($row = mysqli_fetch_array($stid))) 
{
echo $row['CARD_ID']."\n";
}
?>

