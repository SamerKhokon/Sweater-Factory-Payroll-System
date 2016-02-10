 <?php
$tns = "192.168.10.18/orcl"; 		  
$conn = oci_connect('lusine_pay', 'lusine_pay', $tns);
if (!$conn) {
$e = oci_error();
trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}	 
?>