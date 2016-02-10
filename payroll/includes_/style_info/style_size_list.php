<?php   
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION['company_id'];
$style_id   =trim($_POST['style_id']);
$section_id	=trim($_POST['section_id']);
if($section_id!='' && $style_id!='')
{
$sql = "select ID,RATE,QUANTITY,(select STYLE_NAME from TBL_PAY_STYLE_INFO where ID=a.STYLE_ID ) as styleName,(select SIZE_NAME from TBL_PAY_SIZE_SETTING where ID=a.SIZE_ID ) as sizeName from TBL_PAY_RATE_SETTING a where a.SECTION_ID=$section_id and a.STYLE_ID=$style_id and a.COMPANY_ID=$company_id";

$res	= oci_parse($conn, $sql);
          oci_execute($res);
?>
<table border="1" cellpadding="0" cellspacing="0" width="100%" class="display">
    <thead>
        <tr>
            <th>Style Name</th>
            <th>Size Name</th>
            <th>RATE</th>
            <th>Quantity</th>
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
            <td align="center"><?php echo $row[3]; ?><input type="hidden" name="user_id[]" id="user_id<?php echo $row['ID'];?>" value="<?php echo $row['ID'];?>" /></td>
            <td align="center"><?php echo $row[4]; ?></td>
            <td align="center"><input class="flat" type="text" name="rate[]" id="rate<?php echo $row['ID'];?>" value="<?php echo $row['RATE'];?>" /></td>
            <td align="center"><?php echo $row['QUANTITY']; ?></td>
        </tr>
    <?php
   }
   if($i>0)
   {
    ?>
    <tr>
    	<td colspan="4"><hr /></td>
    </tr>
    <tr>
		<td colspan="4" align="right"><input type="button" name="btn_saveall" id="btn_saveall" value="&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;" class="btn btn-navy" /></td>    
    </tr>
    <?php
	}
	?>
    </tbody>
    
    <tfoot>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </tfoot>    
</table>
<?php
}
?>