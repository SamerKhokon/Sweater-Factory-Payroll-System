<?php
//festival_bonus_row_fetching_by_ajax.php
	session_start();
	require '../../includes/db.php';
		
    $id  = $_POST['id'];	   
    $sql	= "SELECT * FROM TBL_PAY_FESTIVALBONUS_SETTING WHERE ID=$id";
	$stid	= mysqli_query($conn,$sql);
	
    while($res = mysqli_fetch_array($stid)) {  
			   $slno         = $res['ID'];
			   $section_id   = $res['SECTION_ID'];  
			   $company_id   = $res['COMPANY_ID'];
			   $salary_from  = $res['SALARY_FROM'];
			   $salary_to    = $res['SALARY_TO'];			   
			   $bonus_amount = $res['BONUS_AMOUNT'];
			   $salary_type  = $res['SALARY_TYPE'];	
	}
	echo $slno.'|'.$section_id.'|'.$company_id.'|'.$salary_from.'|'.$salary_to.'|'.$bonus_amount.'|'.$salary_type;
?>