 <div class="grid_2">
    <div class="box sidemenu" style=" height:650px;" >
        <div class="block" id="section-menu">
            <ul class="section menu">
            <?php

			if ($_SESSION["valid"]=="true")
			{
				/*
				$sql="select * from TBL_PAYROLL_MAIN_MENU order by ORDER_ID";
				$stid	= oci_parse($conn, $sql);
				oci_execute($stid);
				while(($row = oci_fetch_array($stid, OCI_BOTH)))
				{   
					*/
					
					
					 //$main_menu_id=$row['ID'];
					 
				     
					 if (isset($_GET['menu_id'])) 
					 {
						$main_menu_id=$_GET['menu_id'];
						 
						$sql_sub="select * from TBL_PAYROLL_SUB_MENU1 where MAIN_MENU_ID = $main_menu_id";			
						$stid2	= oci_parse($conn, $sql_sub);
						oci_execute($stid2);
						while($row_sub = oci_fetch_array($stid2, OCI_BOTH+OCI_RETURN_NULLS))
						{
							   
						$sub_menu_name=$row_sub["SUB_MENU_NAME"];
						$sub_menu_content=$row_sub["SUB_MENU_CONTENT"];	
						$main_menu_id=$row_sub["MAIN_MENU_ID"]; 
						$sm_id=$row_sub["ID"];
							
						echo "<li><a href=\"index.php?pagetitle=$sub_menu_content&menu_id=$main_menu_id&sm_id=$sm_id\">$sub_menu_name</a>
										</li>";  		 
						}
					}
			/*	}  */
				
			}
			
			?>
            </ul>
        </div>
    </div>
</div>