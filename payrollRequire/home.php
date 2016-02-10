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
	
	unset($_SESSION['payroll_user_main_manu']);
	unset($_SESSION['payroll_user_sub_manu']);
	unset($_SESSION['inv_user_main_manu']);
	unset($_SESSION['inv_user_sub_manu']);
	unset($_SESSION['hr_user_main_manu']);
	unset($_SESSION['hr_user_sub_manu']);
	
}

require 'includes/db.php';



//hr all menu and submenu

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$myusername	=addslashes($_POST['uid']); 
	$mypassword	=addslashes($_POST['pwd']); 
	$sql 	= "select * from USERS where USER_ID='".$myusername."' and USER_PASSWORD='".$mypassword."'";
	$stid	= oci_parse($conn, $sql);
    oci_execute($stid);
    
    while(($row = oci_fetch_array($stid, OCI_BOTH))) 
    {
		$_SESSION['usr_id']		=$row[0];
		$_SESSION['user_group']	=$row[4];   //1 superAdmin, 2 Admin, 3 user
		$_SESSION['user_name']	=$row[1];
		$_SESSION['payroll']	=$row[5];
		$_SESSION['inv']		=$row[6];
		$_SESSION['hr']			=$row[7];
		
		//payroll menu
		if($row[5]!=0)
		{
			
			$sql="select MAIN_MUNU_ID from PAYROLL_MENU";
			$stid	= oci_parse($conn, $sql);
			oci_execute($stid);
			while(($row = oci_fetch_array($stid, OCI_BOTH)))
			{
			$payroll_main_menu_all	.=$row[0].',';
			}
			$sql="select PAYROLL_MENU_ID from PAYROLL_SUB_MENU1";
			$stid	= oci_parse($conn, $sql);
			oci_execute($stid);
			while(($row = oci_fetch_array($stid, OCI_BOTH)))
			{
			$payroll_sub1_menu_all	.=$row[0].',';
			}
			
			$_SESSION['payroll_main_menu_all']	=$payroll_main_menu_all;
			$_SESSION['payroll_sub1_menu_all']	=$payroll_sub1_menu_all;
			
			
			
			
			
			
			$sql2="select MENU_ID,SUB_MENU_ID from PAYROLL_GROUP_MENU where USER_GROUP='".$row[4]."'";
			$stid	= oci_parse($conn, $sql2);
			oci_execute($stid);
			while(($row2 = oci_fetch_array($stid, OCI_BOTH)))
			{
				echo $_SESSION['payroll_user_main_manu']	=$row2[0];
				echo $_SESSION['payroll_user_sub_manu']	=$row2[1];
							
			}
		
		}
		
		
		
		//inv menu
		if($row[6]!=0)
		{
			
			$sql="select MAIN_MUNU_ID from INV_MENU";
			$stid	= oci_parse($conn, $sql);
			oci_execute($stid);
			while(($row = oci_fetch_array($stid, OCI_BOTH)))
			{
			$inv_main_menu_all	.=$row[0].',';
			}
			
			$sql="select INV_MENU_ID from INV_SUB_MENU1";
			$stid	= oci_parse($conn, $sql);
			oci_execute($stid);
			while(($row = oci_fetch_array($stid, OCI_BOTH)))
			{
			$inv_sub1_menu_all	.=$row[0].',';
			}
			
			$_SESSION['inv_main_menu_all']	=$inv_main_menu_all;
			$_SESSION['inv_sub1_menu_all']	=$inv_sub1_menu_all;	
			
			
			$sql="select MENU_ID,SUB_MENU_ID from INV_GROUP_MENU where USER_GROUP='".$row[4]."'";
			$stid	= oci_parse($conn, $sql);
			oci_execute($stid);
			while(($row3 = oci_fetch_array($stid, OCI_BOTH)))
			{
				$_SESSION['inv_user_main_manu']	=$row3[0];
				$_SESSION['inv_user_sub_manu']	=$row3[1];			
			}
		
		}
		
		//hr menu
		if($row[7]!=0)
		{
			
			$sql="select MAIN_MUNU_ID from HR_MENU";
			$stid	= oci_parse($conn, $sql);
			oci_execute($stid);
			while(($row = oci_fetch_array($stid, OCI_BOTH)))
			{
				$hr_main_menu_all	=$row[0];
			}
			$sql="select HR_MENU_ID from HR_SUB_MENU1";
			$stid	= oci_parse($conn, $sql);
			oci_execute($stid);
			while(($row = oci_fetch_array($stid, OCI_BOTH)))
			{
				$hr_sub1_menu_all	=$row[0];
			}
			$_SESSION['hr_main_menu_all']	=$hr_main_menu_all;
			$_SESSION['hr_sub1_menu_all']	=$hr_sub1_menu_all;		
			
			
			$sql="select MENU_ID,SUB_MENU_ID from HR_GROUP_MENU where USER_GROUP='".$row[4]."'";
			$stid	= oci_parse($conn, $sql);
			oci_execute($stid);
			while(($row = oci_fetch_array($stid, OCI_BOTH)))
			{
				$_SESSION['hr_user_main_manu']	=$row[0];
				$_SESSION['hr_user_sub_manu']	=$row[1];			
			}
		
		}

		header("Location: home.php");
	}
}
echo $_SESSION['payroll_user_main_manu'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Dashboard | Own Admin</title>
	<script>
    function whichButton(event)
    {
    //alert(event.keyCode);
    if(event.keyCode==13){
        document.form1.submit()
    }
    }
    function formSubmit()
    {
    	document.form1.submit();
    }
    </script>
    
    <?php include("link.php");?>
</head>
<body>
    <div class="container_12">
        <?php include("headerhome.php"); ?>
        
    <?php
	if(!isset($_SESSION['usr_id']))
	{
	?>
       
    <div>
        <div class="block" style="padding:200px; padding-left:400px;">
            
          <div style="width:320px; border: solid 1px #227ab9;background-color:#FFFFFF;" align="left">
        <form action="" method="post" id="form1" name="form1"><input type="hidden" name="frmaction" value="login" size=8 />
        <div style="margin:30px">  
            
          <label>User Name </label>
            <input type="text" name="uid" /><br /><br />
            <label>Password&nbsp;&nbsp;  </label>
            <input type="text" name="pwd" onKeyUp="whichButton(event)"/><br/><br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="btn_login" id="btn_login" value="Login" onclick="javascript: return formSubmit();" /><!--<a onClick="javascript: return formSubmit();" class="button"><span>Login</span></a>-->
            <br />
            <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php //echo $error; ?></div>
            </div>
            </form>
            
        </div>
        </div>
    </div>
    <?php
	}
	if(isset($_SESSION['usr_id']))
	{
		if($_SESSION['payroll']!=1)
			$pdis = 'disabled="disabled"';
		else
			$pdis = '';
		
		if($_SESSION['inv']!=1)
			$idis = 'disabled="disabled"';
		else
			$idis = '';
		
		if($_SESSION['hr']!=1)
			$hrdis = 'disabled="disabled"';
		else
			$hrdis = '';
	?>
    <div>
    
    	<div id="payroll">Payroll Part<br /><input type="button" value="Enter" <?php echo $pdis; ?> /></div>
    	<div id="inv">Inv Part<br /><input type="button" value="Enter" <?php echo $idis; ?> /></div>
        <div id="hr">Hr Part<br /><input type="button" value="Enter" <?php echo $hrdis; ?> /></div>
    
    </div>
    <?php
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
