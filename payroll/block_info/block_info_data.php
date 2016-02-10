<?php 
session_start();
$company_id=$_SESSION["company_id"];
require '../../includes/db.php';
?>

		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"sPaginationType": "full_numbers"	
			
				} );
			} );
			 

		</script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
<div id="demo">
    <thead>
        <tr>
            <th>Block Name</th>
            <th>Section Name</th>            
            <th>Company Name</th>
        </tr>
    </thead>
    <tbody>
    <?php

	$sql	="select TBL_PAY_SECTION_BLOCK.ID,TBL_PAY_SECTION_BLOCK.BLOCK_NAME,
	TBL_PAY_SECTION_INFO.SEC_NAME,TBL_COMPANY_INFO.COMPANY_NAME from 
	TBL_PAY_SECTION_BLOCK,TBL_COMPANY_INFO,TBL_PAY_SECTION_INFO where 
	TBL_PAY_SECTION_BLOCK.COMPANY_ID=TBL_COMPANY_INFO.ID and 
	TBL_PAY_SECTION_BLOCK.SECTION_ID=TBL_PAY_SECTION_INFO.ID";
    $stid	= mysqli_query( $conn,$sql);
    
        
    while(($row = mysqli_fetch_array($stid))) 
        {
    ?>
        <tr class="gradeA">
			<td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>

        </tr>
     <?php
     }
     ?>
    </tbody>
    <tfoot>
			<tr>
			<th>cvbcvbcvb</th>
			<th>Total:</th>
			<th>Total:</th>
		
			
			
		<!--	<th>&nbsp;</th> -->
		</tr>
    </tfoot>
	</div>
</table>