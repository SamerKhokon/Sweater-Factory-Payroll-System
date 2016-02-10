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
	unset($_SESSION['inv_user_main_menu']);
	unset($_SESSION['inv_user_sub_menu']);
	unset($_SESSION['hr_user_main_menu']);
	unset($_SESSION['hr_user_sub_menu']);
	
}

require 'includes/db.php';



//hr all menu and submenu

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$myusername	=addslashes($_POST['uid']); 
	$mypassword	=addslashes($_POST['pwd']); 
	$sql 	= "select * from USERS where USER_ID='".$myusername."' and USER_PASSWORD='".$mypassword."'";
	$stid	= mysql_query( $sql);
    
    while(($row = mysql_fetch_array($stid))) 
    {
		$_SESSION['usr_id']		=$row[0];
		$_SESSION['user_group']	=$row[4];   //1 superAdmin, 2 Admin, 3 user
		$_SESSION['user_name']	=$row[1];
		$_SESSION['payroll']	=$row[5];
		$_SESSION['inv']		='';		//$row[6]
		$_SESSION['hr']			=$row[7];
		
		//payroll menu
		if($_SESSION['payroll']!='')
		{
			
			$payroll_main_menu_all='';
			$payroll_sub1_menu_all='';
			
			$sql="select MAIN_MENU_ID from PAYROLL_MENU";
			$stid	= mysql_query($conn);
			
			while(($rowp = mysql_fetch_array($stid)))
			{
				$payroll_main_menu_all	.=$rowp[0].',';
			}
			
			$sql="select PAYROLL_SUB_MENU_ID from PAYROLL_SUB_MENU1";
			$stid	= mysql_query( $sql);
	
			while(($rowp = mysql_fetch_array($stid)))
			{
				$payroll_sub1_menu_all	.=$rowp[0].',';
			}
			
			$_SESSION['payroll_main_menu_all']	=$payroll_main_menu_all;
			$_SESSION['payroll_sub1_menu_all']	=$payroll_sub1_menu_all;
			
			
			
			$sql2="select MENU_ID,SUB_MENU_ID from PAYROLL_GROUP_MENU where USER_GROUP='".$_SESSION['user_group']."'";
			$stid	= mysql_query( $sql2);
			
			while(($rowu = mysql_fetch_array($stid)))
			{
				$_SESSION['payroll_user_main_menu']	=$rowu[0];
				$_SESSION['payroll_user_sub_menu']	=$rowu[1];
							
			}
		
		}
		
		
		
		//inv menu
		if($_SESSION['inv']!='')
		{
			
			$sql="select MAIN_MENU_ID from INV_MENU";
			$stid	= mysql_query($sql);
			
			while(($row = mysql_fetch_array($stid)))
			{
				$inv_main_menu_all	.=$row[0].',';
			}
			
			$sql="select INV_SUB_MENU_ID from INV_SUB_MENU1";
			$stid	= mysql_query( $sql);
		
			while(($row = mysql_fetch_array($stid)))
			{
				$inv_sub1_menu_all	.=$row[0].',';
			}
			
			$_SESSION['inv_main_menu_all']	=$inv_main_menu_all;
			$_SESSION['inv_sub1_menu_all']	=$inv_sub1_menu_all;	
			
			
			$sql="select MENU_ID,SUB_MENU_ID from INV_GROUP_MENU where USER_GROUP='".$row[4]."'";
			$stid	= mysql_query( $sql);
			
			while(($rowi = mysql_fetch_array($stid)))
			{
				$_SESSION['inv_user_main_menu']	=$rowi[0];
				$_SESSION['inv_user_sub_menu']	=$rowi[1];			
			}
		
		}
		
		//hr menu
		if($_SESSION['hr']!='')
		{
			
			$sql="select MAIN_MENU_ID from HR_MENU";
			$stid	= mysql_query( $sql);
			
			while(($rowhr = mysql_fetch_array($stid)))
			{
				$hr_main_menu_all	=$rowhr[0];
			}
			$sql="select HR_SUB_MENU_ID from HR_SUB_MENU1";
			$stid	= mysql_query($sql);
			
			while(($rowhr = mysql_fetch_array($stid)))
			{
				$hr_sub1_menu_all	=$rowhr[0];
			}
			$_SESSION['hr_main_menu_all']	=$hr_main_menu_all;
			$_SESSION['hr_sub1_menu_all']	=$hr_sub1_menu_all;		
			
			
			$sql="select MENU_ID,SUB_MENU_ID from HR_GROUP_MENU where USER_GROUP='".$row[4]."'";
			$stid	= mysql_query($sql);
			
			while(($rowhr = mysql_fetch_array($stid)))
			{
				$_SESSION['hr_user_main_menu']	=$rowhr[0];
				$_SESSION['hr_user_sub_menu']	=$rowhr[1];			
			}
		
		}

		//header("Location: home.php");
	}
}
//echo $_SESSION['payroll_user_main_manu'];
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
		if($_SESSION['payroll']=='')
			$pdis = 'disabled="disabled"';
		else
			$pdis = '';
		
		if($_SESSION['inv']=='')
			$idis = 'disabled="disabled"';
		else
			$idis = '';
		
		if($_SESSION['hr']=='')
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
