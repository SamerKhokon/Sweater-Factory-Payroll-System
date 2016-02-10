<?php
include_once("includes/opSessionCheck.inc");
require 'includes/db.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>ERP | Simple Solution</title>
    <?php include("link.php");?>
</head>
<body>
<div class="container_12">
        
<?php  


 if ($_SESSION["valid"]=="true")
 {

	   //include("header.php");
	   include("header_payroll.php");
	   include("left_menu.php");
	   		//include("body.php");	
			 if(!empty($_GET['pagetitle']) && file_exists('includes/'.strtolower($_GET['pagetitle']).".php")){	
			 require_once('includes/'.strtolower($_GET['pagetitle']).".php");
            }
		else{

			   require_once('includes/body.php');
	
			}
}
else
{
	include("header_payroll.php");
	include("left_menu.php");
	echo "<br/><br/><br/><br/><br/><br/>";
	require_once('includes/login.php');
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
