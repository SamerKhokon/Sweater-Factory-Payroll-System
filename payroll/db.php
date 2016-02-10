 <?php
  $conn = mysqli_connect("localhost","root","","lusine_pay_bk");
 //mysql_select_db("lusine_pay_bk",$conn);
 if(!$conn) {
    trigger_error(mysqli_errno());
 }
 /*
$tns = "192.168.10.18/orcl"; 		  
$conn = oci_connect('lusine_pay', 'lusine_pay', $tns);
if (!$conn) {
$e = oci_error();
trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}	 */
?>