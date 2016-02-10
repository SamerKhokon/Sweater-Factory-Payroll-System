<?php 
session_start();
$company_id	=$_SESSION["company_id"];
$card_no	=trim($_POST["card_no2"]);
$section_id	=trim($_POST['section_id']);
//$en_date	=trim($_POST['en_date']);
$en_date=substr($_POST['en_date'],0,3).''.substr($_POST['en_date'],6,10);
require '../../../includes/db.php';
?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#example').dataTable( {
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
            <th>Rate</th>
            <th>Amount</th>			
			<th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
	$where	=" where TBL_PAY_EMP_PRODUCTION.STYLE_ID=TBL_PAY_STYLE_INFO.ID 
	and TBL_PAY_EMP_PRODUCTION.SIZE_ID=TBL_PAY_SIZE_SETTING.ID and TBL_PAY_EMP_PRODUCTION.CARD_ID='$card_no' and TBL_PAY_EMP_PRODUCTION.SECTION_ID=$section_id and TBL_PAY_EMP_PRODUCTION.COMPANY_ID=$company_id and to_char(TBL_PAY_EMP_PRODUCTION.PRO_DATE,'mm/yyyy')='$en_date'	order by TBL_PAY_EMP_PRODUCTION.PRO_DATE desc";
	
    $sql	="select to_char(TBL_PAY_EMP_PRODUCTION.PRO_DATE,'mm/dd/yyyy'),TBL_PAY_STYLE_INFO.STYLE_NAME,TBL_PAY_SIZE_SETTING.SIZE_NAME,TBL_PAY_EMP_PRODUCTION.QUANTITY,(select  RATE from TBL_PAY_RATE_SETTING where STYLE_ID=TBL_PAY_EMP_PRODUCTION.STYLE_ID and SIZE_ID=TBL_PAY_EMP_PRODUCTION.SIZE_ID and SECTION_ID=$section_id),TBL_PAY_EMP_PRODUCTION.ID from TBL_PAY_EMP_PRODUCTION,TBL_PAY_STYLE_INFO,TBL_PAY_SIZE_SETTING  $where";
    $stid	=mysqli_query($conn, $sql);
  
     $total_amnt		=0;
	 $quantity_total	=0;   
    while($row = mysqli_fetch_array($stid)) 
        {
		$quantity		=$row[3];
		$rate			=$row[4];
		$amount		=($quantity * $rate);
		$total_amnt	+=$amount;
		
		$quantity_total	+=$quantity;
    ?>
        <tr class="gradeA">
			<td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $quantity; ?></td>
            <td><?php echo $rate; ?></td>
            <td><?php echo $amount; ?></td>
            <td><input type="button" id="btn_del" name="<?php echo $row[5]; ?>" class="btn btn-teal"  value="Delete" /></td>
        </tr>
     <?php
     	}
     ?>
    </tbody>
    <tfoot>
		<tr>
			<th>Total</th>
			<th></th>
            <th></th>
			<th align="left"><?php echo $quantity_total; ?></th>
            <th></th>
            <th align="left"><?php echo $total_amnt; ?></th>
            <th></th>
		</tr>
    </tfoot>
	</div>
</table>
<?php
oci_free_statement($stid);
oci_close($conn);
?>
