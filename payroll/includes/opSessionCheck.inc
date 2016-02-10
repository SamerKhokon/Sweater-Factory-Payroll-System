<?php
session_start();
if(!isset($_SESSION['company_id']))
{
	header("Location: http://".$_SERVER['SERVER_NAME']."/payroll/index.php");
	return;
}
?>
