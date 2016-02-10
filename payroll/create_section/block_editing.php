<?php	session_start();
		require '../../includes/db.php';
 
        $id             = $_POST['serialno'];
		$sec_id         = $_POST['section_id'];
		$com_id         = $_POST['company_id'];
		$block_name     = $_POST['block_name'];
		$bng_block_name = $_POST['bangla_block_name'];	

        $update = "update TBL_PAY_SECTION_BLOCK set
					BLOCK_NAME='$block_name' ,BNG_BLOCK_NAME='$bng_block_name'
					where COMPANY_ID=$com_id and  SECTION_ID=$sec_id and ID=$id";  		   
					
		$stm = mysqli_query($conn,$update);			

?>