<?php   session_start();
		require '../../includes/db.php';
		
		$serialno        =$_POST['serialno'];
		$company_id_e    =$_POST['company_id_e'];		   	
		$section_e       =$_POST['section_e'];
		$salary_from_e   =$_POST['salary_from_e'];
		$salary_to_e     =$_POST['salary_to_e'];
		$bonus_amount_e  =$_POST['bonus_amount_e'];
		$salary_type_e   =$_POST['salary_type_e'];
		
		$update = "UPDATE TBL_PAY_FESTIVALBONUS_SETTING SET SECTION_ID=$section_e,SALARY_FROM=$salary_from_e,SALARY_TO=$salary_to_e,BONUS_AMOUNT='$bonus_amount_e',SALARY_TYPE='$salary_type_e' WHERE ID=$serialno AND COMPANY_ID=$company_id_e";
		
		$stm = mysqli_query($conn,$update);
		echo 'Data updated successfully!';
?>