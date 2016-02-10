<?php	session_start();
		require '../../includes/db.php';
		
    $comid  = trim($_SESSION['company_id']);
    $section_id = trim($_POST['section_id']);	
	
    $sql	= "SELECT * FROM TBL_PAY_FESTIVALBONUS_SETTING WHERE COMPANY_ID=$comid and SECTION_ID=$section_id";
	$stid	= mysqli_query($conn, $sql);
	
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
	     <th>Salary From</th>
		 <th>Salary To</th>
		 <th>Bonus Amount</th>
		 <th>Actions</th>
	  </tr>	
	</thead>
	<tbody>
<?php	while($res = mysqli_fetch_array($stid)) {  
			   $slno         = $res['ID'];
			   $section_id   = $res['SECTION_ID'];  
			   $company_id   = $res['COMPANY_ID'];
			   $salary_from  = $res['SALARY_FROM'];
			   $salary_to    = $res['SALARY_TO'];			   
			   $bonus_amount = $res['BONUS_AMOUNT'];
			   $salary_type  = $res['SALARY_TYPE'];	
		?>
		<tr class="gradeA">
	     <td><?php echo $salary_from;?></td>
		 <td><?php echo $salary_to;?></td>
		 <td><?php echo $bonus_amount;?></td>
		 <td><a href="javascript:void(0);" class="festival_bonus_edits_link" id="<?php echo $slno;?>"><input type="button" class="btn btn-teal" value="edit"/></a></td>
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