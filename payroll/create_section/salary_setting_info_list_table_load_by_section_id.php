<?php   session_start();
		require '../../includes/db.php';
	$comid  = trim($_SESSION['company_id']);	   
	$section_id = trim($_POST['section_id']);
    $sql	= "SELECT * FROM TBL_PAY_SALARY_SETTING WHERE COMPANY_ID=$comid and SECTION_ID=$section_id";
	$stid	= mysqli_query($conn,$sql);
	
 ?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {	
		$('#example1').dataTable( {
			"sPaginationType": "full_numbers"				
		});	
       //data_load();	   		
	});
</script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example1">
<div id="demo">
    <thead>
	  <tr>
	     <th>Salary From</th>
		 <th>Salary To</th>
		 <th>Grade</th>
		 <th>Designation</th>
		 <th>Actions</th>
	  </tr>	
	</thead>
	<tbody>
<?php	while($res = mysqli_fetch_array($stid)) {  
			   $slno         = $res['ID'];
			   $company_id   = $res['COMPANY_ID'];
			   $salary_from  = $res['SALARY_FROM'];
			   $salary_to    = $res['SATARY_TO'];
			   $grade        = $res['GRADE'];
			   $designation  = $res['DESIGNATION'];
			   $salary_type  = $res['SALARY_TYPE'];
			   $section_id   = $res['SECTION_ID'];	
		?>
		<tr class="gradeA">
	     <td><?php echo $salary_from;?></td>
		 <td><?php echo $salary_to;?></td>
		 <td><?php echo $grade;?></td>
		 <td><?php echo $designation;?></td>
		  <td><a href="javascript:void(0);" id="<?php echo $slno;?>" class="salary_setting_edit_link" id="<?php echo $slno;?>">
		  <input type="button" id="salary_setting_edit_button" class="btn btn-teal" value="edit"/>
		  </a></td>		 
		</tr>		
<?php	}?>
</tbody>
</tfoot>	  
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
<br/><br/>