<?php
session_start();
if(!isset($_SESSION['usr_id']))
{
	unset($_SESSION['usr_id']);
	unset($_SESSION['user_group']);
	unset($_SESSION['user_name']);
	unset($_SESSION['payroll']);
	unset($_SESSION['inv']);
	unset($_SESSION['hr']);
	
	unset($_SESSION['payroll_user_main_menu']);
	unset($_SESSION['payroll_user_sub_menu']);
	unset($_SESSION['payroll_user_sub2_menu']);

	unset($_SESSION['module_id']);
	
}

//if include db connection then header error

/*
$conn = oci_connect('payroll', 'payroll123456', 'orcl');
if (!$conn) {
$e = oci_error();
trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
*/
require 'db.php';


//hr all menu and submenu

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$myusername	=addslashes($_POST['user_name']); 
	$mypassword	=addslashes($_POST['password']);
	$company_id	=addslashes($_POST['company_id']); 
	$sql 	= "select * from USERS where USER_ID='".$myusername."' and USER_PASSWORD='".$mypassword."'";
	$stid	= mysqli_query($conn,$sql);
     
    if($row = mysqli_fetch_array($stid)) {
		$_SESSION['usr_id']			=$row[0];
		$_SESSION['user_group']	=$row[4];   //1 superAdmin, 2 Admin, 3 user
		$_SESSION['user_name']	=$row[1];
		$_SESSION['payroll']			=$row[5];
		$_SESSION['inv']					=$row[6];		//$row[6]
		$_SESSION['hr']					='';
		
		$_SESSION['module_id']		=$row[9];
		
		$_SESSION["valid"]				="true";
		$_SESSION["company_id"]=$company_id;	

	  
	  $sql2="select MENU_ID,SUB_MENU_ID,SUB_MENU2_ID from TBL_PAYROLL_GROUP_MENU where ID='".$_SESSION['user_group']."'";
			$stid	= mysqli_query($conn,$sql2);
			
			while($rowu = mysqli_fetch_array($stid)){
				$_SESSION['payroll_user_main_menu']	=$rowu[0];
				$_SESSION['payroll_user_sub_menu']		=$rowu[1];
				$_SESSION['payroll_user_sub2_menu']	=$rowu[2];				
			}	
			

	  echo './';
	    //header("Location: ../payroll/");
	}
	else
	{
	  echo './?error=1';
		//header("Location:../?error=1");
	}
}

