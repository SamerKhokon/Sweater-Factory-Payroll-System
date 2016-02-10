 <?php 	  
$conn = oci_connect('payroll', 'payroll123456', 'orcl');
if (!$conn) {
$e = oci_error();
trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}	 
?>