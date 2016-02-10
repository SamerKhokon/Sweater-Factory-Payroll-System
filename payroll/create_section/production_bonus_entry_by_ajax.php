<?php	
session_start();
require '../../includes/db.php';

$company_id    = trim($_SESSION['company_id']);
$section       = trim($_POST['section']);
$amount_from   = trim($_POST['amount_from']);
$amount_to     = trim($_POST['amount_to']);
$bonus_amount  = trim($_POST['bonus_amount']);

$sql = "INSERT INTO TBL_PAY_PRODUCTIONBONUS_SET";
$sql .= "(PRODUC_AMNT_FROM,PRODUC_AMNT_TO,BONUS_AMNT,COMPANY_ID,SECTION_ID,";
$sql .= "ENTRY_DATE) VALUES($amount_from,$amount_to,'$bonus_amount',$company_id,$section,SYSDATE)"; 
  $stm = mysqli_query($conn,$sql);
  
  echo 'Data saved successfully!';  
?>