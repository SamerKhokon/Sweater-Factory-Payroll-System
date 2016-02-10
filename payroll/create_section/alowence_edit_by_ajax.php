<?php  require '../../includes/db.php';		
	   session_start();
	   
	    $serialno          = trim($_POST['serialno']); 
		$section_id        = trim($_POST['section_id']);
		$company_id        = trim($_POST['company_id']);
		$alowence_head_id  = trim($_POST['alowence_head_id']);
		$alowence_name     = trim($_POST['alowence_name']);
		$alowence_amount   = trim($_POST['alowence_amount']);
		$alowence_type     = trim($_POST['alowence_type']);
		
		$update = "UPDATE TBL_PAY_SECTION_ALLOWENCE_INFO SET ALLOWENCE_AMOUNT='$alowence_amount',ALLOWENCE_AFFECT='$alowence_type' WHERE SECTION_ID=$section_id AND	COMPANY_ID=$company_id AND ID=$serialno";
		
		$stm = mysqli_query($conn,$update);
		//oci_execute($stm);
		
				
		// update all section when edit allowence		
		// 166 = House Rent
		// 165 = Madical
		$sql		="select BASIC,ID,HOUSE_RENT,MEDICAL from  TBL_PAY_EMP_PROFILE where SECTION_ID=$section_id AND COMPANY_ID=$company_id";
		$qstr  = mysqli_query($conn, $sql);
		
		while($row = mysqli_fetch_array($qstr))
		{
			$basic			=$row[0];
			$ID				=$row[1];
			$house_rnt		=$row[2];
			$medical_amnt	=$row[3];
			if($alowence_head_id ==166 )
			{
				$amount_tp =$alowence_amount;
				$amtype	= strpos($amount_tp, "%");
				if($amtype>0)
				{
					$amount	=substr($amount_tp,0,strlen($amount_tp)-1);
					$house_rnt =(($basic * $amount)/100);
				}
				else
				$house_rnt =$amount_tp;
			
			
			
				$update_emp = "update TBL_PAY_EMP_PROFILE set 		
					HOUSE_RENT='$house_rnt'
					where SECTION_ID=$section_id AND COMPANY_ID=$company_id and ID=$ID";
				$stm1 = mysqli_query($conn,$update_emp);
				  
			}
			if($alowence_head_id == 165)
			{
				$amount_tp = $alowence_amount;
				$amtype	= strpos($amount_tp, "%");
				if($amtype>0)
				{
					$amount	=substr($amount_tp,0,strlen($amount_tp)-1);
					$medical_amnt =(($basic * $amount)/100);
				}
				else
					$medical_amnt =$amount_tp;
				
				$update_emp = "update TBL_PAY_EMP_PROFILE set 
					MEDICAL='$medical_amnt'			
					where SECTION_ID=$section_id AND COMPANY_ID=$company_id and ID=$ID";
			}
			$strs = mysqli_query($conn,$update_emp);
			
			
			$gross_amt	=$basic+$house_rnt+$medical_amnt;
			
			$update_emp2 = "update TBL_PAY_EMP_PROFILE set 
					GROSS='$gross_amt'			
					where SECTION_ID=$section_id AND COMPANY_ID=$company_id and ID=$ID";
					
					$strs = mysqli_query($conn,$update_emp2);
				
		}
?>