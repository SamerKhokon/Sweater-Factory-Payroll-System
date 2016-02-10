 <div class="grid_2">
    <div class="box sidemenu" style=" height:650px;" >
        <div class="block" id="section-menu">
            <ul class="section menu">
            <?php

			if ($_SESSION["valid"]=="true")
			{
				/*
				$sql="select * from TBL_PAYROLL_MAIN_MENU order by ORDER_ID";
				$stid	= mysql_query($conn, $sql);
				oci_execute($stid);
				while(($row = mysql_fetch_array($stid, OCI_BOTH)))
				{   
				*/
				 //$main_menu_id=$row['ID'];
					 
				     
					 if (isset($_GET['menu_id'])) 
					 {
						
						$mm	=0;
						$main_menu_id=$_GET['menu_id'];
						 
						$sql_sub="select * from TBL_PAYROLL_SUB_MENU1 where MAIN_MENU_ID = $main_menu_id";			
						$stid2	= mysqli_query($conn, $sql_sub);
					
						while($row_sub = mysqli_fetch_array($stid2))
						{
						$kk	=0;	   
						$sub_menu_name=$row_sub["SUB_MENU_NAME"];
						$sub_menu_content=$row_sub["SUB_MENU_CONTENT"];	
						$main_menu_id=$row_sub["MAIN_MENU_ID"]; 
						$sm_id=$row_sub["ID"];
							
						echo "<li><a href=\"index.php?pagetitle=$sub_menu_content&menu_id=$main_menu_id&sm_id=$sm_id\" class='menuitem'>$sub_menu_name</a>";
						
						$sql_sub2	="select * from TBL_PAYROLL_SUB_MENU1 where MAIN_MENU_ID= $sm_id";
						$stid_s	= mysqli_query($conn,$sql_sub2);
					
						while($row_sub = mysqli_fetch_array($stid_s))
						{
							$mm=1;
						}
						if($mm==1)
						echo "<ul class='submenu'>";
						
						$sql_sub2	="select * from TBL_PAYROLL_SUB_MENU1 where MAIN_MENU_ID= $sm_id";
						$stid_s	= mysqli_query($conn, $sql_sub2);
						
						while($row_sub = mysqli_fetch_array($stid_s))
						{
							$row_sub2	=$row_sub["SUB_MENU_NAME"];
							$sub_menu_content2=$row_sub["SUB_MENU_CONTENT"];	
							
							echo "<li><a href=\"index.php?pagetitle=$sub_menu_content2&menu_id=$main_menu_id&sm_id=$sm_id\">$row_sub2</a></li>";
							
						}
						
						
						
						//echo 'kk='.$mm;
						if($mm==1)
						{
							echo "</ul>";
						}
						
						echo "</li>";
						}
					}
			}
			?>
            </ul>
        </div>
    </div>
</div>