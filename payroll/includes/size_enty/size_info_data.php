<?php 
session_start();
$company_id	=$_SESSION["company_id"];
require '../../../includes/db.php';
?>

		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"sPaginationType": "full_numbers"	
			
				});
			});
		</script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
<div id="demo">
    <thead>
        <tr>
            <th>Section Name</th>
            <th>Style Name</th>            
            <th>Size Name</th>
            <th>Rate</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
	$section_id	=trim($_POST['section_id']);
	if($section_id!='')
	{
		$wherext=' and TBL_PAY_RATE_SETTING.SECTION_ID='.$section_id;
	}
	else
	{
		$wherext='';
	}
	$where	=" where TBL_PAY_RATE_SETTING.STYLE_ID=TBL_PAY_STYLE_INFO.ID and 
	TBL_PAY_RATE_SETTING.SIZE_ID=TBL_PAY_SIZE_SETTING.ID and 
	TBL_PAY_RATE_SETTING.COMPANY_ID=TBL_COMPANY_INFO.ID and 
	TBL_PAY_SECTION_INFO.ID=TBL_PAY_RATE_SETTING.SECTION_ID and TBL_PAY_RATE_SETTING.COMPANY_ID=$company_id ";
	$where.=$wherext;
	
	$sql	="select TBL_PAY_RATE_SETTING.ID,TBL_PAY_RATE_SETTING.SECTION_ID,TBL_PAY_RATE_SETTING.RATE,TBL_PAY_STYLE_INFO.STYLE_NAME,TBL_PAY_SIZE_SETTING.SIZE_NAME,TBL_COMPANY_INFO.COMPANY_NAME,TBL_PAY_SECTION_INFO.SEC_NAME,TBL_PAY_RATE_SETTING.QUANTITY from TBL_PAY_RATE_SETTING,TBL_PAY_STYLE_INFO,TBL_PAY_SIZE_SETTING,TBL_COMPANY_INFO,TBL_PAY_SECTION_INFO ".$where." ";
	
    $stid	= oci_parse($conn, $sql);
    oci_execute($stid);
        
    while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
        {
    ?>
        <tr class="gradeA">
            <td><?php echo $row[6]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td><?php echo $row[4]; ?></td>
			<td><?php echo $row[2]; ?></td>
            <td><?php echo $row[7]; ?></td>
            <td><input type="button" name="<?php echo $row[0]; ?>" id="btn_edit" value="Edit" class="btn btn-teal" /><input type="button" name="<?php echo $row[0]; ?>" id="btn_del" value="delete" class="btn btn-red" /></td>
           
        </tr>
     <?php
     }
     ?>
    </tbody>
    <tfoot>
		<tr>
			<th></th>
            <th></th>
			<th></th>
            <th></th>
			<th></th>
            <th></th>
		</tr>
    </tfoot>
	</div>
</table>
<?php
oci_free_statement($stid);
oci_close($conn);
?>