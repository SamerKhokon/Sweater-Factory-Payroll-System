<?php   
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION['company_id'];
$month_year =substr($_POST['datepicker'],0,3).''.substr($_POST['datepicker'],6,10);
$section_id	=trim($_POST['section_id']);
$block_name	=trim($_POST['block_name']);
$xsql	="";
if($block_name!='')
{
$xsql	=" and b.BLOCK_ID=$block_name";
}

if($section_id!='')
{
$sql	="select a.ID,EXTRA_OT,a.CARD_ID,b.NAME,b.DESIGNATION,b.HOUSE_RENT,b.MEDICAL,b.BASIC,b.GROSS from TBL_PAY_EMP_ATTEN_INFO a,TBL_PAY_EMP_PROFILE b where a.CARD_ID=b.CARD_ID and b.STATUS=1 and a.SECTION_ID=$section_id and a.COMPANY_ID=$company_id ".$xsql." and to_char(a.MONTH_YEAR,'mm/yyyy')='$month_year' order by cast(substr(b.card_id,2,9) as number)";

$res	= oci_parse($conn, $sql);
          oci_execute($res);
?>
<table border="1" cellpadding="0" cellspacing="0" width="100%" class="display">
    <thead>
        <tr>
            <th align="left">Card Id</th>
            <th align="left">Extra OT</th>
            <th align="left">Name</th>
            <th align="left">Designation</th>
            <th align="left">Basic</th>
            <th align="left">House Rent</th>
            <th align="left">Medical</th>
            <th align="left">Gross</th>
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
            <td align="left"><?php echo $row[2]; ?><input type="hidden" name="user_id[]" id="user_id<?php echo $row[0];?>" value="<?php echo $row['ID'];?>" /></td>
            <td align="left"><input class="flat" size="6" type="text" name="eot[]" id="eot<?php echo $row[0];?>" value="<?php echo $row[1];?>" /></td>
            <td align="left"><?php echo $row[3];?></td>
            <td align="left"><?php echo $row[4];?></td>
            <td align="left"><?php echo round($row[5]);?></td>
            <td align="left"><?php echo round($row[7]);?></td>
            <td align="left"><?php echo round($row[6]);?></td>
            <td align="left"><?php echo round($row[8]);?></td>
            
        </tr>
    <?php
   }
   if($i>0)
   {
    ?>
    <tr>
    	<td colspan="8"><hr /></td>
    </tr>
    <tr>
		<td colspan="8" align="right"><input type="button" name="btn_saveall" id="btn_saveall" value="&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;" class="btn btn-navy" /></td>    
    </tr>
    <?php
	}
	?>
    </tbody>  
</table>
<?php
}
?>