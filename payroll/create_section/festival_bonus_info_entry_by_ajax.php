<?php   session_start();
		require '../../includes/db.php';

		//'company_id='+company_id+'&section='+section+'&salary_from='+salary_from+'&salary_to='+salary_to+'&bonus_amount='+bonus_amount+'&salary_type='+salary_type;			
		
		
		$company_id   =$_POST['company_id'];
		$section      =$_POST['section'];
		$salary_from  =$_POST['salary_from'];
		$salary_to    =$_POST['salary_to'];
		$bonus_amount =$_POST['bonus_amount'];
		$salary_type  =$_POST['salary_type'];
		
		$add = "INSERT INTO TBL_PAY_FESTIVALBONUS_SETTING(SECTION_ID,COMPANY_ID,SALARY_FROM,SALARY_TO,BONUS_AMOUNT,SALARY_TYPE) VALUES($section,$company_id,$salary_from,$salary_to,'$bonus_amount','$salary_type')";
				
		$stm = mysqli_query($conn,$add);
		
		echo 'Data saved successfully!';
?>