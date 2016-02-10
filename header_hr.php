<?php
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
	$hr_user_main_menu	=$_SESSION['hr_user_main_menu'];
	$hr_user_sub_menu 	=$_SESSION['hr_user_sub_menu'];
	
	$hr_main_menu_all 	=$_SESSION['hr_main_menu_all'];
	$hr_sub1_menu_all 	=$_SESSION['hr_sub1_menu_all'];
	
	$sql="select * from HR_MENU where MAIN_MENU_ID in(".$hr_user_main_menu.")";							
    $stid	= mysqli_query($conn, $sql);
    
    
    while(($row = mysqli_fetch_array($stid))) 
    {
		$menu_name		=$row["MENU_NAME"];
		$menu_content	=$row["MENU_CONTENT"];
		$menu_id		=$row["MAIN_MENU_ID"]; 	
		
		
		echo "<li class='ic-dashboard'><a href='?pagetitle=$menu_content&menu_id=$menu_id'>$menu_name</a><ul>";  
		
		$main_menu_id=$row['MAIN_MENU_ID'];
		$sql_sub="select * from HR_SUB_MENU1 where HR_SUB_MENU_ID=$main_menu_id  and HR_SUB_MENU_ID in (".$hr_user_sub_menu.")";			
		$stid1	= mysqli_query($conn, $sql_sub);
		
		
		while(($row_sub = mysqli_fetch_array($stid1))) 
		{  
			$sub_menu_name		=$row_sub["SUB_MENU_NAME"];
			$sub_menu_content	=$row_sub["SUB_MENU_CONTENT"];	
			$main_menu_id		=$row_sub["MAIN_MENU_ID"]; 
			$HR_SUB_MENU_ID		=$row_sub["HR_SUB_MENU_ID"];
			
			echo "<li><a href=\"?pagetitle=$sub_menu_content&menu_id=$main_menu_id&sm_id=$HR_SUB_MENU_ID\">$sub_menu_name</a></li>";  		 
		}
		echo "</ul></li>";
    }
    ?>

    </ul>
</div>
<div class="clear">
</div>