<?php	
		session_start();
		require '../../includes/db.php';
 		$company_id  =trim($_SESSION['company_id']);
       
		$stamp       =$_POST['stamp'];
		$section_id  =$_POST['section'];
		$sql	="select ID from TBL_PAY_SECTION_STAMP where SECTION_ID=$section_id and COMPANY_ID=$company_id";
		$stm = mysqli_query($conn,$sql);
    	
		if($res = mysqli_fetch_array($stm)) {
			$id	=$res[0];
			$sql	="update TBL_PAY_SECTION_STAMP set STAMP_AMNT=$stamp where ID=$id";
			$stm = mysqli_query($conn,$sql);			
			
		}
		else
		{
			$sql="insert into TBL_PAY_SECTION_STAMP(COMPANY_ID,SECTION_ID,STAMP_AMNT) values($company_id,$section_id,$stamp)";			
			$stm = mysqli_query($conn,$sql);			
			
		}
?>