<?php	session_start();
		require '../../includes/db.php';				
		
		$serialno       = $_POST['serialno_e'];
		$company_id_e   = $_POST['company_id_e'];	        		
		$salary_from_e  = $_POST['amount_from_e'];
		$salary_to_e    = $_POST['amount_to_e'];
		$bonus_amount_e = $_POST['bonus_amount_e'];
		$section_e      = $_POST['section_e'];
		$entry_date_e   = $_POST['entry_date_e'];
		
		
		$update ="UPDATE TBL_PAY_PRODUCTIONBONUS_SET SET PRODUC_AMNT_FROM=$salary_from_e,PRODUC_AMNT_TO=$salary_to_e ,BONUS_AMNT='$bonus_amount_e',ENTRY_DATE='$entry_date_e' WHERE ID=$serialno AND SECTION_ID=$section_e AND COMPANY_ID=$company_id_e";
		$stm = mysqli_query($conn,$update);
		
		echo 'Data updated successfully!';
?>