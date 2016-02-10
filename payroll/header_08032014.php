<div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft">
                   <span style="color:#FFFFFF;"></span>
                    <img src="img/slogo.png" alt="Logo" /></div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                    
					<?php
						
			 if ($_SESSION["valid"]=="true")
 {
					?>
					<div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello Admin</li>
                            <li><a href="#">Config</a></li>
                            <li><a href="includes/log_out.php">Logout</a></li>
                        </ul>
                        <br />
                        <span class="small grey">Last Login: 3 hours ago</span>
                    </div>
					
					<?php
					}
					?>
					
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
			
			 if ($_SESSION["valid"]=="true")
 {
            $sql="select * from menu order by order_id";	  			 
	  $result=mysql_query($sql)
	           or die(mysql_error());
		 
	
	while($row=mysql_fetch_array($result))
	{   
	   
	  
	  $menu_name=$row["menu_name"];
		$menu_content=$row["menu_content"];
		$menu_id=$row["menu_id"]; 	
	 
	  
	  echo "<li class='ic-dashboard'><a href='index.php?pagetitle=$menu_content&menu_id=$menu_id'>$menu_name</a><ul>";  
	  
	   $main_menu_id=$row['menu_id'];
      $sql_sub="select * from sub_menu1 where main_menu_id =$main_menu_id";			
	  $result_sub=mysql_query($sql_sub);
	          
	    while($row_sub=mysql_fetch_array($result_sub))
	    {	   
	    $sub_menu_name=$row_sub["sub_menu_name"];
		$sub_menu_content=$row_sub["sub_menu_content"];	
		$main_menu_id=$row_sub["main_menu_id"]; 
        $sm_id=$row_sub["sub_menu_id"];
		 	
	    echo "<li ><a href=\"index.php?pagetitle=$sub_menu_content&menu_id=$main_menu_id&sm_id=$sm_id\">$sub_menu_name</a></li>";  		 
		}
		echo "</ul></li>";
	  }
	  }
	
		?>
	   
            
               <!-- <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href="javascript:"><span>Controls</span></a>
                    <ul>
                        <li><a href="form-controls.php">Forms</a> </li>
                        <li><a href="buttons.php">Buttons</a> </li>
                        <li><a href="form-controls.php">Full Page Example</a> </li>
                        <li><a href="table.php">Page with Sidebar Example</a> </li>
                    </ul>
                </li>
                <li class="ic-typography"><a href="typography.php"><span>Typography</span></a></li>
				<li class="ic-charts"><a href="charts.php"><span>Charts & Graphs</span></a></li>
                <li class="ic-grid-tables"><a href="table.php"><span>Data Table</span></a></li>
                <li class="ic-gallery dd"><a href="javascript:"><span>Image Galleries</span></a>
               		 <ul>
                        <li><a href="image-gallery.php">Pretty Photo</a> </li>
                        <li><a href="gallery-with-filter.php">Gallery with Filter</a> </li>
                    </ul>
                </li>
                <li class="ic-notifications"><a href="notifications.php"><span>Notifications</span></a></li>-->

            </ul>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12" style="background-color:#E6F0F3; height:40px;padding:5px 0px 0px 0px;">
<!--<img src="img/buttons.gif" />-->
	<table width="554">
    	<tr>
        	<td><a href=""><img src="img/32/database.png" title="Database" /></a></td>
            <td><a href=""><img src="img/32/bank.png" title="Bank" /></a></td>
            <td><a href=""><img src="img/32/communication.png" title="Communication" /></a></td>
            <td><a href=""><img src="img/32/library.png" title="Library" /></a></td>
            <td><a href=""><img src="img/32/flag.png" title="Flag" /></a></td>
            <td><a href=""><img src="img/32/full-time.png" title="Full Time" /></a></td>
            <td><a href=""><img src="img/32/hire-me.png" title="Hire Me" /></a></td>
            <td><a href=""><img src="img/32/illustration.png" title="Illustration" /></a></td>
            <td><a href=""><img src="img/32/free-for-job.png" title="Free For Job" /></a></td>
            <td><a href=""><img src="img/32/basket.png" title="Basket" /></a></td>
            <td><a href=""><img src="img/32/networking.png" title="Networking" /></a></td>
        </tr>
    </table>
</div>
