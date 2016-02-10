<?php
session_start();
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
            <th>Order Date</th>
            <th>Style<br />Name</th> 
            <th>Order<br />Qty</th>
            <th>Add Qty</th>
            <th>Buyer Name</th>
            <th>M Name</th>
            <th>Shipping Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
	$sql	="select TBL_PAY_STYLE_INFO.ID,TBL_PAY_STYLE_INFO.STYLE_NAME,
	TBL_PAY_STYLE_INFO.BUYER_NAME,TBL_PAY_STYLE_INFO.QUENTITY,
	to_char(TBL_PAY_STYLE_INFO.ORDER_DATE,'mm/dd/yyyy') as ORDER_DATE ,
	TBL_COMPANY_INFO.COMPANY_NAME,TBL_PAY_STYLE_INFO.ORDER_QTY,
	TBL_PAY_STYLE_INFO.MERCH_NAME,
	to_char(TBL_PAY_STYLE_INFO.SHIPMENT_DATE,'mm/dd/yyyy') as SHIPMENT_DATE,
	TBL_PAY_STYLE_INFO.SHIP_STATUS from TBL_PAY_STYLE_INFO,
	TBL_COMPANY_INFO where TBL_PAY_STYLE_INFO.COMPANY_ID=TBL_COMPANY_INFO.ID and 
	TBL_PAY_STYLE_INFO.COMPANY_ID=$company_id";
	
    $stid	= mysqli_query( $conn,$sql);
    
        
    while($row = mysqli_fetch_array($stid)) 
        {
    ?>
        <tr class="gradeA">
			<td><?php echo $row['ORDER_DATE']; ?></td>
            <td><?php echo $row['STYLE_NAME']; ?></td>
            <td><?php echo $row['ORDER_QTY']; ?></td>
            <td><?php echo $row['QUENTITY']; ?></td>
            <td><?php echo $row['BUYER_NAME']; ?></td>
            <td><?php echo $row['MERCH_NAME']; ?></td>
            <td><?php echo $row['SHIPMENT_DATE']; ?></td>
            <td><input type="button" id="btn_edit" name="<?php echo $row[0]; ?>" class="btn btn-teal"  value="Edit" /><input type="button" id="btn_del" name="<?php echo $row[0]; ?>" class="btn btn-teal"  value="Delete" /></td>
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
            <th></th>
            <th></th>
		</tr>
    </tfoot>
	</div>
</table>
