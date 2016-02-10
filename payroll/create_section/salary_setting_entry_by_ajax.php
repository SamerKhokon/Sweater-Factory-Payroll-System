<?php	session_start();
		require '../../includes/db.php';
		
		$company_id    =$_SESSION['company_id'];		
		$section_id	   =$_POST['section'];
		$salary_from   =$_POST['salary_from'];
		$salary_to	   =$_POST['salary_to'];
		$grade		   =$_POST['grade'];
		$designation   =$_POST['designation'];
		$salary_type   =$_POST['salary_type'];
		
		$add = "INSERT INTO  TBL_PAY_SALARY_SETTING(COMPANY_ID,SALARY_FROM,SATARY_TO,GRADE,DESIGNATION,SALARY_TYPE,SECTION_ID) VALUES($company_id,$salary_from,$salary_to,'$grade','$designation','$salary_type',$section_id)";
		$stm = mysqli_query($conn,$add);
		
		echo 'Data saved successfully!';
?>