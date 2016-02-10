<?php	
session_start();	
require '../../includes/db.php';		
$company_id      = trim($_SESSION['company_id']);	   
$section_id = trim($_POST['section_id']);

$sql = "SELECT * FROM TBL_PAY_SECTION_STAMP WHERE COMPANY_ID=$company_id AND SECTION_ID=$section_id";
$stid	= mysqli_query($conn, $sql);
	
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
		 <th>Stamp Amount</th>
	  </tr>	
	</thead>
	<tbody>
<?php	while($res = mysqli_fetch_array($stid)) {  
			   $slno         = $res['ID'];
			   $section_id   = $res['SECTION_ID'];  
			   $company_id   = $res['COMPANY_ID'];
			   $stamp_amnt   = $res['STAMP_AMNT'];
		?>
		<tr class="gradeA">
	    
		 <td><?php echo $stamp_amnt;?></td>
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