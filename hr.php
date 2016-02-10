<?php
session_start();
require 'includes/db.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Dashboard | Own Admin</title>
    <?php include("link.php");?>
</head>
<body>
    <div class="container_12">
        <?php include("header_hr.php");?>
       <?php include("left_menu.php");
			 if(!empty($_GET['pagetitle']) && file_exists('includes/'.strtolower($_GET['pagetitle']).".php")){
			 require_once('includes/'.strtolower($_GET['pagetitle']).".php");
            }
            else{
			 require_once('includes/body.php');
              }
	   ?>
        
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <?php include("footer.php");?>
</body>
</html>
