<?php   
	session_start();
		
	require '../../includes/db.php';
	$comid  = trim($_SESSION['company_id']);	   
	$section_id = trim($_POST['section_id']);
	
    $sql	= "SELECT * FROM TBL_PAY_SALARY_SETTING WHERE COMPANY_ID=$comid and SECTION_ID=$section_id";
	$stid	= mysqli_query($conn, $sql);
	
 ?>
	
		<br/>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {	
		$('#example').dataTable( {
			"sPaginationType": "full_numbers"				
		});	
       //data_load();	   		
	});
</script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
<div id="demo">
    <thead>
	  <tr>
	     <th>Salary From</th>
		 <th>Salary To</th>
		 <th>Grade</th>
		 <th>Designation</th>
          <th>Type</th>
		 <th>Actions</th>
	  </tr>	
	</thead>
	<tbody>
<?php	
while($res = mysqli_fetch_array($stid)) {  
			   $slno         = $res['ID'];
			   $company_id   = $res['COMPANY_ID'];
			   $salary_from  = $res['SALARY_FROM'];
			   $salary_to    = $res['SATARY_TO'];
			   $grade        = $res['GRADE'];
			   $designation  = $res['DESIGNATION'];
			   $salary_type  = $res['SALARY_TYPE'];
			   $section_id   = $res['SECTION_ID'];	
			   if($salary_type==1)
			   		$sl_type	='Basic';
				else if($salary_type==2)
					$sl_type	='Gross';
				else
					$sl_type	='';
				
		?>
		<tr class="">
	     <td><?php echo $salary_from;?></td>
		 <td><?php echo $salary_to;?></td>
		 <td><?php echo $grade;?></td>
		 <td><?php echo $designation;?></td>
          <td><?php echo $sl_type;?></td>
		  <td><a href="javascript:void(0);"  id="<?php echo $slno;?>" class="salary_setting_edit_link">
		  <input type="button"  id="salary_setting_edit_button" class="btn btn-teal" value="Edit"/></a><input type="button" id="btn_del" name="<?php echo $res[0]; ?>" class="btn btn-teal" value="Delete"/></td>		 
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
         <th></th>
	  </tr>	
</tfoot>
</div>	  
</table>	
<br/><br/><br /><br /><br /><br />
<?php
oci_free_statement($stid);
oci_close($conn);
?>