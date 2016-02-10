<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
<?php
$conn = oci_connect('payroll', 'payroll', '','AL32UTF8');
if (!$conn) {
$e = oci_error();
trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}	 
 $sql	="select BNG_HEAD_NAME from TBL_PAY_SECTION_ALLOWENCE_HEAD where BNG_HEAD_NAME is not null";
                    $stid	= oci_parse($conn, $sql);
                    oci_execute($stid);
     while($rs = oci_fetch_array($stid,OCI_BOTH)) {
	  // echo mb_strlen($rs['BNG_HEAD_NAME']).'-'.$rs['BNG_HEAD_NAME'].'<br/>';
	  	echo $rs[0].'<br/>';
	 }               


?>
</body>
</html>