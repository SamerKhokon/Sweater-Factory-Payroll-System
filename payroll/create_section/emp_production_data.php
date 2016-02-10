<?php session_start();
$company_id=1;	//from session
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
            <th>Section Name</th>
            <th>Company Name</th>            
            <th>Section Type</th>
        </tr>
    </thead>
    <tbody>
    <?php

	$sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME,TBL_COMPANY_INFO.COMPANY_NAME,TBL_PAY_SECTION_TYPE.TYPE_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE,TBL_COMPANY_INFO where TBL_PAY_SECTION_INFO.COMPANY_ID=TBL_COMPANY_INFO.ID and TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID";
    $stid	= mysqli_query( $sql);
  
        
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
		</tr>
  
    </tfoot>
	</div>
</table>
<br/><br/>