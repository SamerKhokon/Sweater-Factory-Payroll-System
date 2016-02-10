<?php   
session_start();	
require '../../includes/db.php';
$comid  = trim($_SESSION['company_id']);	   
$section_id = trim($_POST['section_id']);
$stype =0;
$sql	= "SELECT SALARY_TYPE FROM TBL_PAY_SALARY_SETTING WHERE COMPANY_ID=$comid and SECTION_ID=$section_id";
$stid	= mysqli_query($conn, $sql);
	
if($res = mysqli_fetch_array($stid)){
	$stype=$res[0];  
}
echo $stype;
?>