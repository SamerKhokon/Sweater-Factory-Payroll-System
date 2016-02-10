<?php   
		session_start();
		require '../../../includes/db.php';
		
		$company_id   =$_SESSION['company_id'];  
		$ID           = trim($_POST['ID']);
		$section_id   = trim($_POST['section_id']);
		$cardno       = trim($_POST['cardno']);
		$empID        = trim($_POST['empID']);
		$basic        = trim($_POST['basic']);
		$gross        = trim($_POST['gross']);
		$grade        = trim($_POST['grade']);
		$datepicker   = trim($_POST['datepicker']);
		$designation  = trim($_POST['designation']);
		$nameBN       = trim($_POST['nameBN']);
		$nameEN       = trim($_POST['nameEN']);
		$FatherName   = trim($_POST['FatherName']);
		$MotherName   = trim($_POST['MotherName']);
		$MobileNo1    = trim($_POST['MobileNo1']);
		$nationalidNo    = trim($_POST['nationalidNo']);
		$PresentAdd   = trim($_POST['PresentAdd']);
		$ParmanentAdd = trim($_POST['ParmanentAdd']);
		$block_id     = trim($_POST['block_id']);
		$status       = trim($_POST['status']);
		$birthcerNo			=trim($_POST['birthcerNo']);
		
		$update = "UPDATE TBL_PAY_EMP_PROFILE SET NAME='$nameEN',CARD_ID='$cardno',JOIN_DATE=to_date('".$datepicker."','mm/dd/yyyy'),
		BASIC='$basic',GRADE='$grade',DESIGNATION='$designation',EMP_ID='$empID',SECTION_ID=$section_id,STATUS='$status',BNG_NAME='$nameBN',BLOCK_ID='$block_id',FATHER_NAME='$FatherName',MOTHER_NAME='$MotherName',MOBILE_NO1='$MobileNo1',NATIONAL_ID='$nationalidNo',PRESENT_ADDRESS='$PresentAdd',PARMANENT_ADDRESS='$ParmanentAdd',BIRTHCERTNO='$birthcerNo'  WHERE COMPANY_ID=$company_id AND ID=$ID";
        $stm = oci_parse($conn,$update);		
		oci_execute($stm);		
		echo 'Data save successfully';
?>