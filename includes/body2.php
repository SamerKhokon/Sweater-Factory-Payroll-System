<?php
$_SESSION['module_id'];
$module_ids=$_SESSION['module_id'];
?>
<div class="grid_10">
            <div class="box round">
                <h2>
                    Modules</h2>
                 <div class="block">    
                 <?php
				 // where ID in(".$module_ids.")
				$href	='';
				$sql="select * from TBL_MODULE where ID in(".$module_ids.") ";
				$stid	= mysqli_query($conn,$sql);
    			
				while($row = mysqli_fetch_array($stid)) 
				{
					 $href=$row[3];
				 ?>
               
                    <div class="stat-col">
                        <span></span>
                        <p class="purple">
                        	<a href="<?php echo $href;  ?>"><?php echo $row[2];?></a>
                            </p>
                   </div><br /><br /><br /><br /><br /><br />
                <?php
				}
				$sql="select * from TBL_MODULE where ID not in(".$module_ids.") ";
				$stid	= mysqli_query($conn, $sql);
    			
				while($row = mysqli_fetch_array($stid)) 
				{
					 $href='';
				 ?>
               
                    <div class="stat-col">
                        <span></span>
                        <p class="purple">
                        	<a href="<?php echo $href;  ?>"><?php echo $row[2];?></a>
                            </p>
                   </div><br /><br /><br /><br /><br /><br />
                <?php
				}
			?>
                <div class="clear">
                </div>
             </div>
       </div>
</div>