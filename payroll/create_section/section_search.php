<?php 
session_start();   
$secid = trim($_POST['secid']); 
$comid = trim($_SESSION['company_id']);
require '../../includes/db.php';
require '../includes/function.php';
?>		
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#example').dataTable( {
		"sPaginationType": "full_numbers"				
	});
	$('#example1').dataTable( {
		"sPaginationType": "full_numbers"				
	});		
	$('#example2').dataTable( {
		"sPaginationType": "full_numbers"				
	});		
});
</script>		
<?php
		$bid2=$secid;
		$section_block = "SELECT * FROM TBL_PAY_SECTION_BLOCK WHERE COMPANY_ID=$comid AND SECTION_ID=$secid";
		$section_block_stm = mysqli_query($conn,$section_block);		
		
?>

<table align="right">
<tr>
<td align="right">
<a href='javascript:void(0)' class='section_block_edit'
								onclick="javascript:fg_popup_form('fg_formContainer','fg_form_InnerContainer','fg_backgroundpopup',<?php echo $bid2; ?>,'create_section/add_block.php')"><input type="button" value="Add New Block" class="btn btn-teal" /></a>
 </td>
 </tr>
</table>
<h3>Block Information</h3>
<hr/>
 <table cellpadding="0" cellspacing="0" border="0" class="display" id="example"	>
 <div id="demo">
	<thead><tr><th>Block Name</th><th>Bangla Block Name</th><th>Actions</th></tr></thead>		
		<tbody>
		<?php		
		while($rs = mysqli_fetch_array($section_block_stm) )	{
				$bid            =  $rs['ID'];
				$section_id     =  $rs['SECTION_ID'];
				$company_id     =  $rs['COMPANY_ID'];
				$block_name     =  $rs['BLOCK_NAME'];
				$bng_block_name =  $rs['BNG_BLOCK_NAME'];
		?>			
					<tr  class="gradeA">				
						<td><?php echo $block_name;?></td>
						<td><?php echo $bng_block_name;?></td>
						
						<td align='center'>
						<a href='javascript:void(0)' class='section_block_edit' id='$bid' 
								onclick	="javascript:fg_popup_form('fg_formContainer','fg_form_InnerContainer','fg_backgroundpopup',<?php echo $bid; ?>,'create_section/set_leave.php')"><input type="button" value="Edit" class="btn btn-teal" /></a>&nbsp;
						</td>
					</tr>		  	
		<?php	}		?>
		</tbody>
        <tfoot>
		   <th></th>
		   <th></th>		
		   <th></th>						
	    </tfoot>
</div>
</table>		
		<!-- end first datatable -->		
		<!--  start second table -->
		
<?php		 
	$alowence = "select TBL_PAY_SECTION_ALLOWENCE_INFO.*,TBL_PAY_SECTION_ALLOWENCE_HEAD.HEAD_NAME 	FROM TBL_PAY_SECTION_ALLOWENCE_INFO,TBL_PAY_SECTION_ALLOWENCE_HEAD where TBL_PAY_SECTION_ALLOWENCE_HEAD.ID=TBL_PAY_SECTION_ALLOWENCE_INFO.ALLOWENCE_HEAD_ID and 
	TBL_PAY_SECTION_ALLOWENCE_INFO.SECTION_ID=$secid AND TBL_PAY_SECTION_ALLOWENCE_INFO.COMPANY_ID=$comid";

	$alowence_stm = mysqlii_query($conn,$alowence);
	
?>
<br /><br /><br /><br /><br /><br /><br />
 <h3>Allowence Information</h3>
<hr/>
 <table cellpadding="0" cellspacing="0" border="0" class="display" id="example1"	>
 <div id="demo">

	  <thead>
			<tr>			
				<th>Section Name</th>
				<th>Alowence Name</th>
				<th>Alowence Amount</th>
				<th>Alowence Affect</th>	
				<th>Actions</th>
			</tr>
	   </thead>
		<tbody>		
		<?php		
		while($res = mysqli_fetch_array($alowence_stm)) 	{
				$id 		      = $res['ID'];
				$company_id       = $res['COMPANY_ID'];
				$section_id	      = $res['SECTION_ID'];
				$alowence_head_id = $res['ALLOWENCE_HEAD_ID'];
				$alowence_amount  = $res['ALLOWENCE_AMOUNT'];
				$alowence_affect  = $res['ALLOWENCE_AFFECT'];
				$head_name        = $res['HEAD_NAME'];
		?>			 
			<tr  class="gradeA">				 
				<td><?php echo getSectionName($section_id) ?></td>
				<td><?php echo $head_name;       ?></td>	
				<td><?php echo $alowence_amount; ?></td>
				<td><?php echo $alowence_affect; ?></td>			 
				 <td align='center'><a href='javascript:void(0);' onclick="javascript:fg_popup_form('fg_formContainer','fg_form_InnerContainer','fg_backgroundpopup',<?php echo $id; ?>,'create_section/edit_alowence_form.php')" id='<?php echo $id;?>'>
				 <input type="button" value="Edit" class="btn btn-teal"/></a></td>
				</tr>
			<?php	}?>	
 		    </tbody>
			<tfoot>	
				   <th></th>
				   <th></th>
				   <th></th>
				   <th></th>
				   <th></th>
			</tfoot>	
	</div>		
</table>
<!--  start third table -->
<?php		 
		$strss = "SELECT * FROM TBL_PAY_SALARY_SETTING WHERE COMPANY_ID=$comid and SECTION_ID=$secid";
		$stmss = mysqli_query($conn,$strss);
		
?>	
<br /><br /><br /><br /><br /><br /><br />
 <h3>Salary Information</h3>
<hr/>
 <table cellpadding="0" cellspacing="0" border="0" class="display" id="example2"	>
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
<?php		
    while($res = mysqli_fetch_array($stmss)) {
		   $slno         = $res['ID'];
		   $company_id   = $res['COMPANY_ID'];
		   $salary_from  = $res['SALARY_FROM'];
		   $salary_to    = $res['SATARY_TO'];
		   $grade        = $res['GRADE'];
		   $designation  = $res['DESIGNATION'];
		   $salary_type  = $res['SALARY_TYPE'];
		   $section_id   = $res['SECTION_ID'];	
?>			 
			<tr  class="gradeA">
				 <td><?php echo $salary_from;?></td>
				 <td><?php echo $salary_to;?></td>
				 <td><?php echo $grade;?></td>	
				 <td><?php echo $designation;?></td>				 
			 
				 <td align='center'><a href='javascript:void(0);' onclick="javascript:fg_popup_form('fg_formContainer','fg_form_InnerContainer','fg_backgroundpopup',<?php echo $slno; ?>,'create_section/edit_salary_form.php')" id='<?php echo $slno;?>'><input type="button" value="Edit" class="btn btn-teal"/></a></td>
		    </tr>
	<?php	}?>	
		 </tbody>
		<tfoot>
		   <th></th>
		   <th></th>
		   <th></th>
		   <th></th>
		   <th></th>	
		</tfoot>	
	</div>		
</table>
<br/><br/><br/>
