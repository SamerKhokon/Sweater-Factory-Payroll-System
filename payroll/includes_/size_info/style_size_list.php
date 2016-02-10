<?php   
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION['company_id'];
$style   =trim($_POST['style']);
$section_id	=trim($_POST['section_id']);


$sql	="select ID from TBL_PAY_STYLE_INFO where upper(STYLE_NAME)='$style' and COMPANY_ID=$company_id";
$result	=oci_parse($conn,$sql);
$success=oci_execute($result);
if($row=oci_fetch_array($result, OCI_BOTH+OCI_RETURN_NULLS))
{
	$style_id	=$row[0];	
}


if($section_id!='' && $style_id!='')
{
//$sql = "select ID,SIZE_NAME,(select STYLE_NAME from TBL_PAY_STYLE_INFO where ID=a.STYLE_ID), from TBL_PAY_SIZE_SETTING a where STYLE_ID=$style_id and SECTION_ID=$section_id and COMPANY_ID=$company_id";

$sql = "select a.ID,a.SIZE_NAME,b.STYLE_NAME,(select QUANTITY from TBL_PAY_RATE_SETTING where SECTION_ID=$section_id and COMPANY_ID=$company_id and STYLE_ID=b.ID and SIZE_ID=a.ID),(select RATE from TBL_PAY_RATE_SETTING where SECTION_ID=$section_id and COMPANY_ID=$company_id and STYLE_ID=b.ID and SIZE_ID=a.ID),(select ID from TBL_PAY_RATE_SETTING where SECTION_ID=$section_id and COMPANY_ID=$company_id and STYLE_ID=b.ID and SIZE_ID=a.ID) from TBL_PAY_SIZE_SETTING a,TBL_PAY_STYLE_INFO b where a.STYLE_ID=b.ID and a.STYLE_ID=$style_id and a.SECTION_ID=$section_id and a.COMPANY_ID=$company_id";


$res	= oci_parse($conn, $sql);
          oci_execute($res);
?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#example').dataTable( {
			"sPaginationType": "full_numbers"	
	
		} );
	} );
</script>
<table border="1" cellpadding="0" cellspacing="0" width="100%" class="display" id="example">
    <thead>
        <tr>
            <th>Style Name</th><th>Size Name</th><th>Rate</th><th>Quantity</th><th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $i=0;
   while(($row = oci_fetch_array($res, OCI_BOTH+OCI_RETURN_NULLS))) 
    {
	$i++;
    ?>
       	<tr>
            <td align="center"><?php echo $row[2]; ?></td><td align="center"><?php echo $row[1]; ?></td><td align="center"><?php echo $row[4]; ?></td><td align="center"><?php echo $row[3]; ?></td><td align="center"><input type="button" id="btn_edit" name="<?php echo $row[5]; ?>" class="btn btn-teal"  value="Edit" /><input type="button" id="btn_del" name="<?php echo $row[5]; ?>" class="btn btn-red"  value="Delete" /></td>
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
</table>
<?php
}
?>