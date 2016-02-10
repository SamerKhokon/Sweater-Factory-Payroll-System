<?php	session_start();
		require '../../includes/db.php';
        $section_id = $_POST['section_id'];
		$company_id = $_POST['company_id'];
		$block_name = $_POST['block_name'];
		$bng_block_name = $_POST['bng_block_name'];
				
		$parse = explode(",",$block_name);
		
		for($i=0;$i<count($parse);$i++) {		
		echo	$str="INSERT INTO TBL_PAY_SECTION_BLOCK(SECTION_ID,COMPANY_ID,BLOCK_NAME,BNG_BLOCK_NAME) VALUES($section_id,$company_id,'".$parse[$i]."','$bng_block_name')";
		}
        
?>