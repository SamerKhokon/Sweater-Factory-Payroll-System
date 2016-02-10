<?php
session_start();
require 'includes/db.php';
?>
<div class="grid_12 header-repeat">
    <div id="branding">
        <div class="floatleft">
           <span style="color:#FFFFFF;"></span>
            <img src="img/logo.png" alt="Logo" /></div>
        <div class="floatright">
            <div class="floatleft">
                <!--<img src="img/img-profile.jpg" alt="Profile Pic" />-->
                </div>
            <div class="floatleft marginleft10" style="display:none;">
                <ul class="inline-ul floatleft">
                <?php
				if(!isset($_SESSION['usr_id']))
				{
					echo '<li><a href="?pagetitle=login">Login</a></li>';
				}
				else
				{
					echo '<li>'.$_SESSION['user_name'].'</li><li><a href="logout.php">Logout</a></li>';
				}
				?>
                </ul>
                <br />
                <span class="small grey">Last Login: 3 hours ago</span>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
</div>
<div class="clear">
</div>
<div class="grid_12">
    <ul class="nav main">
	<?php
	$payroll_user_main_manu =$_SESSION['payroll_user_main_manu'];
	$payroll_user_sub_manu 	=$_SESSION['payroll_user_sub_manu'];
	
	echo $payroll_main_menu_all 	=$_SESSION['payroll_main_menu_all'];
	echo $payroll_sub1_menu_all 	=$_SESSION['payroll_sub1_menu_all'];
	
	$sql="select * from PAYROLL_MENU where MAIN_MUNU_ID in('".$payroll_user_main_manu."')";							
    $stid	= oci_parse($conn, $sql);
    oci_execute($stid);
    
    while(($row = oci_fetch_array($stid, OCI_BOTH))) 
    {
		$menu_name		=$row["MENU_NAME"];
		$menu_content	=$row["MENU_CONTENT"];
		$menu_id		=$row["MENU_ID"]; 	
		
		
		echo "<li class='ic-dashboard'><a href='?pagetitle=$menu_content&menu_id=$menu_id'>$menu_name</a><ul>";  
		
		$main_menu_id=$row['MENU_ID'];
		$sql_sub="select * from PAYROLL_SUB_MENU1 where PAYROLL_MENU_ID=$main_menu_id  and PAYROLL_MENU_ID in ('".$payroll_user_sub_manu."')";			
		$stid1	= oci_parse($conn, $sql_sub);
		oci_execute($stid1);
		
		while(($row_sub = oci_fetch_array($stid1, OCI_BOTH))) 
		{  
		$sub_menu_name		=$row_sub["SUB_MENU_NAME"];
		$sub_menu_content	=$row_sub["SUB_MENU_CONTENT"];	
		$main_menu_id		=$row_sub["MAIN_MUNU_ID"]; 
		$sm_id				=$row_sub["SUB_MENU_ID"];
		
		echo "<li><a href=\"?pagetitle=$sub_menu_content&menu_id=$main_menu_id&sm_id=$sm_id\">$sub_menu_name</a></li>";  		 
		}
		echo "</ul></li>";
    }
    ?>

    </ul>
</div>
<div class="clear">
</div>