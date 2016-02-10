<?php session_start();
$company_id=$_SESSION["company_id"];
require '../../../includes/db.php';
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
            <th>Company Name</th>
            <th>Section Name</th>
            <th>Style Name</th>            
            <th>Size Type</th>
            <th>Rate</th>
        </tr>
    </thead>
    <tbody>
    <?php

	$sql	="select TBL_PAY_RATE_SETTING.ID,TBL_PAY_RATE_SETTING.SECTION_ID,TBL_PAY_RATE_SETTING.RATE,TBL_PAY_STYLE_INFO.STYLE_NAME,TBL_PAY_SIZE_SETTING.SIZE_NAME,TBL_COMPANY_INFO.COMPANY_NAME,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_RATE_SETTING,TBL_PAY_STYLE_INFO,TBL_PAY_SIZE_SETTING,TBL_COMPANY_INFO,TBL_PAY_SECTION_INFO where TBL_PAY_RATE_SETTING.STYLE_ID=TBL_PAY_STYLE_INFO.ID and TBL_PAY_RATE_SETTING.SIZE_ID=TBL_PAY_SIZE_SETTING.ID and TBL_PAY_RATE_SETTING.COMPANY_ID=TBL_COMPANY_INFO.ID and TBL_PAY_SECTION_INFO.ID=TBL_PAY_RATE_SETTING.SECTION_ID";
	
    $stid	= oci_parse($conn, $sql);
    oci_execute($stid);
        
    while(($row = oci_fetch_array($stid, OCI_BOTH))) 
        {
    ?>
        <tr class="gradeA">
			<td><?php echo $row[5]; ?></td>
            <td><?php echo $row[6]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td><?php echo $row[4]; ?></td>
			<td><?php echo $row[2]; ?></td>
            <!--<td><input type="button" id="btn_edit" name="<?php echo $row[0]; ?>" class="btn btn-teal" value="Edit" /><input type="button" id="<?php echo $row[0]; ?>" class="btn-icon btn-grey btn-minus" value="Delete" /></td>-->
        </tr>
     <?php
     }
     ?>
    </tbody>
    <tfoot>
			<tr>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
            <th>&nbsp;</th>
			<th>&nbsp;</th>
            <th>&nbsp;</th>
		</tr>
    </tfoot>
	</div>
</table>