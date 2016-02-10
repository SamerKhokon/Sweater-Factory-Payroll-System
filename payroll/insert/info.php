<?php
session_start();
require '../includes/db.php';
if(!isset($_SESSION['usr_id']))
{
	echo '<a>Login</a>';
	echo '<br>';
	echo'<div><form action="" method="post" id="form1" name="form1"><input type="hidden" name="frmaction" value="login" size=8 /><label>User Name </label><input type="text" name="uid"  size=8 /><br /><br /><label>Password&nbsp;&nbsp;  </label><input type="text" name="pwd" onKeyUp="whichButton(event)"  size=8 /><br/><br /><input type="button" name="btn_login" id="btn_login" value="Login" onclick="javascript: return formSubmit();" /></form></div>';
}
else
{
	echo $_SESSION['user_name'].'&nbsp;<a href="logout.php">Logout</a><br>';
	$sql ="select AMOUNT from SMS_STOCK where U_ID='".$_SESSION['usr_id']."'";
	$stid1	= oci_parse($conn, $sql);
	oci_execute($stid1);
	if(($row = oci_fetch_array($stid1, OCI_BOTH))) 
	{
		echo 'Avable SMS='.$row[0];
	}
}
?>