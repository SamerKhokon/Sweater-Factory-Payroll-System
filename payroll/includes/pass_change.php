<?php  
session_start(); 
include('db.php');
$new_pass=trim($_POST['npass']);
$sql="update USERS set USER_PASSWORD='$new_pass' where U_ID=".$_SESSION['usr_id']."";
$stm = mysqli_query($conn ,$sql);

if($stm)
echo 'Password Change successfully';
?>