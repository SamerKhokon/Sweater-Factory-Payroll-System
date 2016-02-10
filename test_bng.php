<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
আমার সোনার বাংলা
<?php
$conn = oci_connect('payroll', 'payroll', '');
if (!$conn) {
$e = oci_error();
trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}	 
 $sql	="select BNG_HEAD_NAME from TBL_PAY_SECTION_ALLOWENCE_HEAD";
                    $stid	= oci_parse($conn, $sql);
                    oci_execute($stid);
     while($rs = oci_fetch_array($stid,OCI_BOTH)) {
	   echo $rs['BNG_HEAD_NAME'].'<br/>';
	 }               


?>
</body>
</html>