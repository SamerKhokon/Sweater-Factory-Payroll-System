<?php
$tns = "192.168.10.18/orcl"; 		  
$conn = oci_connect('lusine_pay', 'lusine_pay', $tns);
if (!$conn) {
$e = oci_error();
trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
	$j	=0;
	$sql	="select SECTION,CARDNO,NAME,GROSS,BASIC,to_char(JOINDATE,'dd/mm/YYYY'),GRADE,DESIGNATION,H_RENT,COMPANY_ID,STATUS,MEDI from TEMP_EMP_F";
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	while($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
	{
		$j++;
		echo $sql2	="insert into TBL_PAY_EMP_PROFILE(SECTION_ID,CARD_ID,NAME,GROSS,BASIC,JOIN_DATE,GRADE,DESIGNATION,HOUSE_RENT,COMPANY_ID,STATUS,MEDICAL) values('".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."',to_date('".$row[5]."','dd/mm/YYYY'),'".$row[6]."','".$row[7]."','".$row[8]."','".$row[9]."','".$row[10]."','".$row[11]."')";
		
		//echo $j.'<br>';
		
		//$qstr2  = oci_parse($conn,$sql2);
	    //oci_execute($qstr2);
		
	}
?>