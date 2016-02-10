<?php  require '../../includes/db.php';		
	   session_start();

		
	$serialno    = trim($_POST['serialno']);
	$section_id  = trim($_POST['section_id']);
	$company_id  = trim($_POST['company_id']);
	$salary_from = trim($_POST['salary_from']);
	$salary_to   = trim($_POST['salary_to']);
	$designation = trim($_POST['designation']);
	$salary_type = trim($_POST['salary_type']);	   
	   
    $update = "UPDATE TBL_PAY_SALARY_SETTING SET SALARY_FROM=$salary_from,SATARY_TO=$salary_to,DESIGNATION='$designation',SALARY_TYPE='$salary_type' WHERE SECTION_ID=$section_id AND COMPANY_ID=$company_id AND ID=$serialno";
		
	$stm = mysqli_query($conn,$update); 
?>