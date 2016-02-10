<?php   
		session_start();
		include('../function.php');
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
		$birthcerNo		=trim($_POST['birthcerNo']);
		
		$house_rent     = fn_house_rent($section_id,$basic);
		$medical       	= fn_medical($section_id,$basic);
		$convence_head	=162292;
		$amount_cv	=0;
		$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=$convence_head and COMPANY_ID=$company_id and SECTION_ID=$section_id";
		$qstr  = oci_parse($conn,$sql);
		oci_execute($qstr);
		if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
		{
			$amount_cv 	= $row[0];
		}
		
		$gross=$basic+$house_rent+$medical+$amount_cv+650;
		$datepicker2   = trim($_POST['datepicker2']);
		
		$update = "UPDATE TBL_PAY_EMP_PROFILE SET NAME='$nameEN',CARD_ID='$cardno',JOIN_DATE=to_date('".$datepicker."','mm/dd/yyyy'),
		BASIC='$basic',GRADE='$grade',DESIGNATION='$designation',EMP_ID='$empID',SECTION_ID=$section_id,STATUS='$status',BNG_NAME='$nameBN',BLOCK_ID='$block_id',FATHER_NAME='$FatherName',MOTHER_NAME='$MotherName',MOBILE_NO1='$MobileNo1',NATIONAL_ID='$nationalidNo',PRESENT_ADDRESS='$PresentAdd',PARMANENT_ADDRESS='$ParmanentAdd',BIRTHCERTNO='$birthcerNo',GROSS='$gross',HOUSE_RENT='$house_rent',MEDICAL='$medical',DATEOFBIRTH=to_date('".$datepicker2."','mm/dd/yyyy')  WHERE COMPANY_ID=$company_id AND ID=$ID";
        $stm = oci_parse($conn,$update);		
		oci_execute($stm);		
		echo 'Data save successfully';
?>