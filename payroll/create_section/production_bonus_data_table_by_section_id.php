<?php  session_start();
		require '../../includes/db.php';	
		
	$comid  = trim($_SESSION['company_id']);		   
	$section_id = trim($_POST['section_id']);	
    $sql	= "SELECT * FROM TBL_PAY_PRODUCTIONBONUS_SET WHERE COMPANY_ID=$comid AND SECTION_ID=$section_id";	
	$stid	= mysqli_query( $conn,$sql);
	

?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#example1').dataTable( {
			"sPaginationType": "full_numbers"				
		});
	});
</script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example1">
<div id="demo">
    <thead>
	  <tr>
	     <th>Amount From</th>
		 <th>Amount To</th>
		 <th>Bonus Amount</th>
		 <th>Actions</th>
	  </tr>	
	</thead>
	<tbody>
<?php	while($res = mysqli_fetch_array($stid)) {  
			   $slno         = $res['ID'];			   
			   $company_id   = $res['COMPANY_ID'];
			   $amount_from  = $res['PRODUC_AMNT_FROM'];
			   $amount_to    = $res['PRODUC_AMNT_TO'];			   
			   $bonus_amount = $res['BONUS_AMNT'];
			   $section_id   = $res['SECTION_ID'];  
               $entry_date   = $res['ENTRY_DATE'];			   
		?>
		<tr class="gradeA">
	     <td><?php echo $amount_from;?></td>
		 <td><?php echo $amount_to;?></td>
		 <td><?php echo $bonus_amount;?></td>
		 <td><a href="javascript:void(0);" class="production_bonus_edits_link" id="<?php echo $slno;?>"><input type="button" class="btn btn-teal" value="edit"/></a></td>
		</tr>		
<?php	}?>
</tbody>
</tfoot>	  
	  <tr>
	     <th></th>
		 <th></th>
		 <th></th>
		 <th></th>
	  </tr>	
</tfoot>
</div>	  
</table>
<br/><br/>