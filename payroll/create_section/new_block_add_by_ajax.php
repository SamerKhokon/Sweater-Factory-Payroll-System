<?php  
    require '../../includes/db.php';		
	session_start();
	
    $section_id        = $_POST['section_id'];
	$company_id        = $_POST['company_id'];
	$block_name        = $_POST['block_name'];
	$bangla_block_name = $_POST['bangla_block_name'];
	
	
	
   $add = "INSERT INTO TBL_PAY_SECTION_BLOCK(SECTION_ID,COMPANY_ID,BLOCK_NAME,BNG_BLOCK_NAME) VALUES($section_id,$company_id,'$block_name','$bangla_block_name')";
   
   $stm = mysqli_query($conn,$add);
   
?>