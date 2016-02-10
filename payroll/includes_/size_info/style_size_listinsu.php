<?php   
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION['company_id'];
$style_id   =trim($_POST['style_id']);
$section_id	=trim($_POST['section_id']);
if($section_id!='' && $style_id!='')
{
$sql = "select ID,SIZE_NAME from TBL_PAY_SIZE_SETTING where STYLE_ID=$style_id and SECTION_ID=$section_id and COMPANY_ID=$company_id";


$res	= oci_parse($conn, $sql);
          oci_execute($res);
?>
<table id="newtable">
    <thead>
        <tr>
            <th>Size Name</th>
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
            <td align="center"><input type="text" id="<?php echo $row['ID'];?>" name="oldsizename[]" value="<?php echo $row[1]; ?>" /></td>
        </tr>
    <?php
   }
   ?>
    </tbody>
    <tfoot>
        <tr>
            <td><input type="button" name="btn_ssave" id="btn_ssave" value="Save" /></td>
        </tr>
    </tfoot>    
</table>
<?php
}
?>