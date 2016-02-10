<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
আমার সোনার বাংলা

<?php
$conn = oci_connect('payroll', 'payroll', '','AL32UTF8');
if (!$conn) {
$e = oci_error();
trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}	
$sql	="insert into TBL_PAY_SECTION_ALLOWENCE_HEAD(HEAD_NAME,BNG_HEAD_NAME) values('test','আমার সোনার বাংলা')";
$result	=oci_parse($conn,$sql);
$success=oci_execute($result);
?>
</body>
</html>
