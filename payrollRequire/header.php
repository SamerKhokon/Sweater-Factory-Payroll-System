<div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft">
                   <span style="color:#FFFFFF;">Company Logo</span>
                    <!--<img src="img/logo.png" alt="Logo" />--></div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello Admin</li>
                            <li><a href="#">Config</a></li>
                            <li><a href="#">Logout</a></li>
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
		?>
            </ul>
        </div>
        <div class="clear">
        </div>