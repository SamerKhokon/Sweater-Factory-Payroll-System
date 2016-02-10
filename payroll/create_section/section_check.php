<?php   session_start();
		require '../../includes/db.php';
		$sec_name  = trim($_POST['section_name']);
		$sql	="select count(*) from TBL_PAY_SECTION_INFO where SEC_NAME='$sec_name'";
		$stid	= mysqli_query($conn,$sql);

	
		while($row = mysqli_fetch_array($stid)) {
				$count = $row[0];
		}	
		echo $count;		
?>