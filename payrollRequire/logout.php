<?php
session_start();
unset($_SESSION['usr_id']);
unset($_SESSION['user_group']);
unset($_SESSION['user_name']);
unset($_SESSION['payroll']);
unset($_SESSION['inv']);
unset($_SESSION['hr']);

unset($_SESSION['payroll_user_main_manu']);
unset($_SESSION['payroll_user_sub_manu']);
unset($_SESSION['inv_user_main_manu']);
unset($_SESSION['inv_user_sub_manu']);
unset($_SESSION['hr_user_main_manu']);
unset($_SESSION['hr_user_sub_manu']);

unset($_SESSION['payroll_main_menu_all']);
unset($_SESSION['payroll_sub1_menu_all']);
unset($_SESSION['inv_main_menu_all']);
unset($_SESSION['inv_sub1_menu_all']);
unset($_SESSION['hr_main_menu_all']);
unset($_SESSION['hr_sub1_menu_all']);
	
header("Location: home.php");
?>