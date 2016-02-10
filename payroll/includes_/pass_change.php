<?php  
session_start(); 
include('db.php');
$new_pass=trim($_POST['npass']);
$sql="update USERS set USER_PASSWORD='$new_pass' where U_ID=".$_SESSION['usr_id']."";
$stm = oci_parse($conn,$sql);
$res =oci_execute($stm);
if($res)
echo 'Password Change successfully';
?>