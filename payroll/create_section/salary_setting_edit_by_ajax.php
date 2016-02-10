<?php   session_start();
	    require '../../includes/db.php';	
		
		
		$serialno       =$_POST['serialno'];
		$section_e      =$_POST['section_e'];
		$salary_from_e  =$_POST['salary_from_e'];
		$salary_to_e    =$_POST['salary_to_e'];
		$grade_e        =$_POST['grade_e'];
		$designation_e  =$_POST['designation_e'];
		$salary_type_e  =$_POST['salary_type_e']; 
				
	   $update = "UPDATE TBL_PAY_SALARY_SETTING SET
		SALARY_FROM=$salary_from_e,SATARY_TO=$salary_to_e,
		GRADE='$grade_e',DESIGNATION='$designation_e',SALARY_TYPE='$salary_type_e' 
		WHERE ID=$serialno AND SECTION_ID=$section_e";

		$stm = mysqli_query($conn,$update);
		
		echo 'Data updated successfully!';
?>