<?php   session_start();
	require '../../includes/db.php';	
		
	$ID  = $_POST['id'];	   
    $sql	= "SELECT * FROM TBL_PAY_SALARY_SETTING WHERE ID=$ID";
	$stid	= mysqli_query($conn, $sql);
		
	while($res = mysqli_fetch_array($stid)) {
	           $SID          = $res['ID']; 
			   $company_id   = $res['COMPANY_ID'];
			   $salary_from  = $res['SALARY_FROM'];
			   $salary_to    = $res['SATARY_TO'];
			   $grade        = $res['GRADE'];
			   $designation  = $res['DESIGNATION'];
			   $salary_type  = $res['SALARY_TYPE'];
			   $section_id   = $res['SECTION_ID'];		   
	}
	echo $SID.'|'.$company_id.'|'.$salary_from.'|'.$salary_to.'|'.$grade.'|'.$designation.'|'.$salary_type.'|'.$section_id;	
 ?>