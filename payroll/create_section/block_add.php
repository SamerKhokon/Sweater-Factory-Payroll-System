<?php	
		session_start();
		require '../../includes/db.php';
 		$comid = trim($_SESSION['company_id']);
       
		$sec_id         = $_POST['section_id'];
		$block_name     = $_POST['block_name'];
		$bng_block_name = $_POST['bangla_block_name'];	
		
		$sql="insert into TBL_PAY_SECTION_BLOCK(COMPANY_ID,SECTION_ID,BLOCK_NAME,BNG_BLOCK_NAME) values($comid,$sec_id,$block_name,$bng_block_name)";	   
					
		$stm = mysqli_query($conn,$sql);			
		//oci_execute($stm);
?>