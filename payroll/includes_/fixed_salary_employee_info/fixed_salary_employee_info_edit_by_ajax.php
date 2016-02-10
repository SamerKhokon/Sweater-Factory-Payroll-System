<?php
		session_start();
		require '../../../includes/db.php';
			$company_id   =$_SESSION['company_id'];  
			$ID           = trim($_POST['ID']);
			
			$section_id    = $_POST['section_id'];
			$cardno        = $_POST['cardno'];
			$empID         = $_POST['empID'];
			$basic         = $_POST['basic'];
			$gross         = $_POST['gross'];
			$grade         = $_POST['grade'];
			$block_id  = $_POST['block_id'];
			$datepicker    = $_POST['datepicker'];
			$designation   = $_POST['designation'];
			$nameEN        = $_POST['nameEN'];
			$nameBN        = $_POST['nameBN'];
			$FatherName    = $_POST['FatherName'];
			$MotherName    = $_POST['MotherName'];
			$MobileNo1     = $_POST['MobileNo1'];
			$nationalidNo     = $_POST['nationalidNo'];
			$PresentAdd    = $_POST['PresentAdd'];
			$ParmanentAdd  = $_POST['ParmanentAdd'];
			$birthcerNo			=trim($_POST['birthcerNo']);

		  $update = "UPDATE TBL_PAY_EMP_PROFILE SET NAME='$nameEN',CARD_ID=$cardno,JOIN_DATE=to_date('".$datepicker."','mm/dd/yyyy'),
		BASIC=$basic,GRADE='$grade',DESIGNATION='$designation',EMP_ID=$empID,SECTION_ID=$section_id,STATUS='$status',BNG_NAME='$nameBN',BLOCK_ID=$block_id,FATHER_NAME='$FatherName',MOTHER_NAME='$MotherName',MOBILE_NO1='$MobileNo1',NATIONAL_ID='$nationalidNo',PRESENT_ADDRESS='$PresentAdd',PARMANENT_ADDRESS='$ParmanentAdd',BIRTHCERTNO='$birthcerNo'  WHERE COMPANY_ID=$company_id AND ID=$ID";
        $stm = oci_parse($conn,$update);		
		oci_execute($stm);		
		echo 'Data save successfully';
?>