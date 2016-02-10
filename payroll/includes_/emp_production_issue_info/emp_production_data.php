<?php 
session_start();
$company_id	=$_SESSION["company_id"];
$card_no 	=trim($_POST["card_no2"]);
$section_id	=trim($_POST['section_id']);
$en_date=substr($_POST['en_date'],0,3).''.substr($_POST['en_date'],6,10);
require '../../../includes/db.php';
?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#example').dataTable({
			"sPaginationType": "full_numbers",
			"aaSorting":[1,"desc"]
		});
	});
</script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
<div id="demo">
    <thead>
        <tr>
            <th>Date</th>
            <th>Styel</th>            
            <th>Size</th>
			<th>Quantity</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
	$where	="  where TBL_PAY_EMP_PRODUCTION_ISSUE.STYLE_ID=TBL_PAY_STYLE_INFO.ID
	 and TBL_PAY_EMP_PRODUCTION_ISSUE.SIZE_ID=TBL_PAY_SIZE_SETTING.ID and TBL_PAY_EMP_PRODUCTION_ISSUE.CARD_ID='$card_no' and TBL_PAY_EMP_PRODUCTION_ISSUE.SECTION_ID=$section_id and TBL_PAY_EMP_PRODUCTION_ISSUE.COMPANY_ID=$company_id and to_char(TBL_PAY_EMP_PRODUCTION_ISSUE.PRO_DATE,'mm/yyyy')='$en_date'	order by TBL_PAY_EMP_PRODUCTION_ISSUE.PRO_DATE desc";
	 
    $sql	="select to_char(TBL_PAY_EMP_PRODUCTION_ISSUE.PRO_DATE,'mm/dd/yyyy'),TBL_PAY_STYLE_INFO.STYLE_NAME,TBL_PAY_SIZE_SETTING.SIZE_NAME,TBL_PAY_EMP_PRODUCTION_ISSUE.QUANTITY,TBL_PAY_EMP_PRODUCTION_ISSUE.ID from TBL_PAY_EMP_PRODUCTION_ISSUE,TBL_PAY_STYLE_INFO,TBL_PAY_SIZE_SETTING  $where";
    $stid	= oci_parse($conn, $sql);
    oci_execute($stid);
    while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
    	{
    ?>
        <tr class="gradeA">
			<td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td><input type="button" id="btn_del" name="<?php echo $row[4]; ?>" class="btn btn-teal"  value="Delete" /></td>
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
		</tr>
    </tfoot>
	</div>
</table>
<br />
<br />
<?php
oci_free_statement($stid);
oci_close($conn);
?>