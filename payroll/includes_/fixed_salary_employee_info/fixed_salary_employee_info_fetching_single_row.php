<?php   require '../../includes/db.php';		
	   session_start();
	   
	$slno = trim($_POST['id']);
	$str = "select * from tbl_pay_emp_profile where ID=$slno";
			
	$emp_info_str = oci_parse($conn,$str);
	oci_execute($emp_info_str);
	
	 while($res = oci_fetch_array($emp_info_str)) {
	    $slno            = $res['ID'];
		$company_id      = $res['COMPANY_ID'];
		$name            = $res['NAME'];
		$card_id         = $res['CARD_ID'];
		$address         = $res['ADDRESS'];
		$phone_no        = $res['PHONE_NO'];
		$email           = $res['EMAIL'];
		$join_date       = $res['JOIN_DATE'];
		$entry_date      = $res['ENTRYDATE'];
		$picture         = $res['PICTURE'];
		$national_id     = $res['NATIONAL_ID'];
		$basic           = $res['BASIC'];
		$grade           = $res['GRADE'];
		$designation     = $res['DESIGNATION'];
		$emp_id          = $res['EMP_ID'];
		$section_id      = $res['SECTION_ID'];
		$status          = $res['STATUS'];
	}
	
		echo $slno.'|'.$company_id.'|'.$name.'|'.$card_id.'|'.$address.'|'.$phone_no.'|'.$email.'|'.$join_date.'|'.$entry_date.'|'.$picture.'|'.$national_id.'|'.$basic.'|'.$grade.'|'.$designation.'|'.$emp_id.'|'.$section_id.'|'.$status;
?>