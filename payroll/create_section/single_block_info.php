<?php	session_start();
		require '../../includes/db.php';
		
		$section_id      = $_POST['id'];		
		$str = "SELECT * FROM TBL_PAY_SECTION_BLOCK WHERE SECTION_ID=section_id";
		$stm = mysqli_query($conn,$str);
		
		
		while($res = mysqli_fetch_array($stm)) {
		   $id = $res['ID'];
		   $sec_id = $res['SECTION_ID'];
		   $com_id = $res['COMPANY_ID'];
		   $block_name = $res['BLOCK_NAME'];
		   $bng_block_name = $res['BNG_BLOCK_NAME'];
		}
    echo $id.'|'.$sec_id.'|'.$com_id.'|'.$block_name.'|'.$bng_block_name;
?>