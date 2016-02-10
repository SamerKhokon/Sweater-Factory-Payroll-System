<?php   require 'includes/db.php';

		$sql1	="select  COMPANY_NAME from TBL_COMPANY_INFO where ID=".$_SESSION['company_id']."";
		//echo $sql1	="select  COMPANY_NAME from TBL_COMPANY_INFO where ID=1";		
		
		$stm = mysqli_query($conn, $sql1);		
		while($res = mysqli_fetch_array($stm) ) {
		   $company_name = $res['COMPANY_NAME'];
		}
		
?>
<div class="grid_12 header-repeat">
    <div id="branding">
        <div class="floatleft" style="margin:-10px 0px 0px 0px; padding:0px 0px 0px 0px;">
           <span style="color:#FFFFFF; margin:0px 0px 0px 0px;" ></span>
           <img src="./img/slogo.png" alt="Logo" /></div>
        <div class="floatright">
            <div class="floatleft">
                <!--<img src="img/img-profile.jpg" alt="Profile Pic" />-->
                </div>
            <div class="floatleft marginleft10">
                <ul class="inline-ul floatleft">
                <?php
				if(!isset($_SESSION['usr_id']))
				{
					echo '<li><a href="?pagetitle=login">Login</a></li>';
				}
				else
				{
					echo '<li>'.$_SESSION['user_name'].'</li><li><a href="includes/log_out.php">Logout</a></li>';
				}
				?>
                </ul>
                <br />
                <span class="small grey"><?php echo $company_name; ?></span>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
</div>
<div class="clear">
</div>
<div class="grid_12">
    <div class="nav">
                	<div class="l"></div>
                	<div class="r"></div>
                	<ul class="artmenu">
	<?php
	$payroll_user_main_menu =$_SESSION['payroll_user_main_menu'];
	$payroll_user_sub_menu 	=$_SESSION['payroll_user_sub_menu'];
	$payroll_user_sub2_menu =$_SESSION['payroll_user_sub2_menu'];
	
	$sql="select * from TBL_PAYROLL_MAIN_MENU where ID in(".$payroll_user_main_menu.") and MODULE_ID=3107";							
	
	//$sql="select * from TBL_PAYROLL_MAIN_MENU where MODULE_ID=3107";								
	
    $stid	= mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_array($stid)) 
    {
		$menu_name		=$row["MENU_NAME"];
		$menu_content	=$row["MENU_CONTENT"];
		$menu_id		=$row["ID"]; 	
	
		echo "<li><a href='?pagetitle=$menu_content&menu_id=$menu_id'>
		<span class='l'></span><span class='r'></span><span class='t'>$menu_name</span></a><ul>";  
		
		$main_menu_id=$row['ID'];
		//$sql_sub="select * from TBL_PAYROLL_SUB_MENU1 where MAIN_MENU_ID=$main_menu_id order by ORDER_ID asc";							
		$sql_sub="select * from TBL_PAYROLL_SUB_MENU1 where MAIN_MENU_ID=$main_menu_id  and ID in (".$payroll_user_sub_menu.") order by ORDER_ID asc";			
		
		$stid1	= mysqli_query($conn, $sql_sub);
		
		while($row_sub = mysqli_fetch_array($stid1)) 
		{  
			$sub_menu_name		=$row_sub["SUB_MENU_NAME"];
			$sub_menu_content	=$row_sub["SUB_MENU_CONTENT"];	
			$main_menu_id		=$row_sub["MAIN_MENU_ID"]; 
			$PAYROLL_SUB_MENU_ID=$row_sub["ID"];
			$subm_menu_id		=$row_sub["ID"];
			
			echo "<li><a href='javascript:void(3)'  name='".$sub_menu_content.".php'  class='acls'>$sub_menu_name</a>";
			$k = 0;
			$sql_sub2="select * from TBL_PAYROLL_SUB_MENU1 where MAIN_MENU_ID=$subm_menu_id  and ID in (".$payroll_user_sub2_menu.")";			
			$stid2	= mysqli_query($conn,$sql_sub2);
			
		
			while($row_sub1 = mysqli_fetch_array($stid2)) 	
			{
				$k++;
				if($k==1)
				echo "<ul>";
				$sub_menu2_name		=$row_sub1["SUB_MENU_NAME"];
				$sub_menu2_content	=$row_sub1["SUB_MENU_CONTENT"];
				$sub_menu2_id		=$row_sub["ID"];	
				echo "<li><a href='javascript:void(0)' name='".$sub_menu2_content.".php' class='acls'>$sub_menu2_name</a></li>";
			}
			if($k>0)
			echo "</ul>";
			echo "</li>";  		 
		}
		echo "</ul></li>";
    }
    ?>
    </ul>
    </div>
</div>

<div class="clear"></div>

<div class="grid_12" style="background-color:#E6F0F3; height:40px;padding:5px 0px 0px 0px;">
<!--<img src="img/buttons.gif" />-->
	<table width="554">
    	<tr>
        	<td><a href="javascript:void(0);"><img src="img/32/database.png" title="Database" /></a></td>
            <td><a href="javascript:void(0);"><img src="img/32/bank.png" title="Bank" /></a></td>
            <td><a href="javascript:void(0);"><img src="img/32/communication.png" title="Communication" /></a></td>
            <td><a href="javascript:void(0);"><img src="img/32/library.png" title="Library" /></a></td>
            <td><a href="javascript:void(0);"><img src="img/32/flag.png" title="Flag" /></a></td>
            <td><a href="javascript:void(0);"><img src="img/32/full-time.png" title="Full Time" /></a></td>
            <td><a href="javascript:void(0);"><img src="img/32/hire-me.png" title="Hire Me" /></a></td>
            <td><a href="javascript:void(0);"><img src="img/32/illustration.png" title="Illustration" /></a></td>
            <td><a href="javascript:void(0);"><img src="img/32/free-for-job.png" title="Free For Job" /></a></td>
            <td><a href="javascript:void(0);"><img src="img/32/basket.png" title="Basket" /></a></td>
            <td><a href="javascript:void(0);"><img src="img/32/networking.png" title="Networking" /></a></td>
        </tr>
    </table>
</div>