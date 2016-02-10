<?php
session_start();
require '../../../includes/db.php';
$company_id	=$_SESSION["company_id"];
//$fm = (isset($all_g[4])) ? $all_g[4] : date('Ym');

	$section_id = trim($_POST['section_id']);	
	if($section_id=='')
		$section_id_str='';
	else
		$section_id_str=" and SECTION_ID=$section_id ";
	
	$type = 'F';
	
    $str = "select * from tbl_pay_emp_profile where COMPANY_ID=$company_id and section_id in
		(select ID from TBL_PAY_SECTION_INFO where sec_type_id=(select id from tbl_pay_section_type where cat='F'))  ".$section_id_str."  order by cast(substr(card_id,3,9) as number)";	
			
	$emp_info_str = oci_parse($conn,$str);
	oci_execute($emp_info_str);
	
	
	function section_name($id) {
			  global $conn,$names;
			  $str = "select SEC_NAME from TBL_PAY_SECTION_INFO where ID=$id";
              $stm = oci_parse($conn,$str);			  
			  oci_execute($stm);
			  while($r = oci_fetch_array($stm,OCI_BOTH)) {
			     $names = $r['SEC_NAME'];
			  }
			  return $names;
			}
	function getBlockName($block_id,$section_id)
		{
			global $conn;
			global $company_id;
			$block_name="";
			if($block_id!='')
			{
				$sql	="select BLOCK_NAME from TBL_PAY_SECTION_BLOCK where SECTION_ID=$section_id and ID=$block_id and COMPANY_ID=$company_id";
				$stm = oci_parse($conn,$sql);
				oci_execute($stm);
				while($res = oci_fetch_array($stm,OCI_BOTH+OCI_RETURN_NULLS))
				{
					$block_name = $res['BLOCK_NAME'];
				}
			}
			return $block_name;
			
		}		
	
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
      	 <th>Card ID</th>
	     <th>Name</th>
		 <th>Join Date</th>
		 <th>Section</th>
         <th>Block/Line</th>
		 <th>Basic</th>
		 <th>Emp ID</th>
		 <th>Actions</th>
	  </tr>	
	</thead>
	<tbody>
<?php  while($res = oci_fetch_array($emp_info_str)) {
				$slno            = $res['ID'];
				$company_id      = $res['COMPANY_ID'];
				$name            = $res['NAME'];
				$card_id         = $res['CARD_ID'];
				$address         = $res['ADDRESS'];
				$phone_no        = $res['PHONE_NO'];
				$email           = $res['EMAIL'];
				$join_date       = $res['JOIN_DATE'];
				$entry_date      = $res['ENTRYDATE'];
				$picture         = $res['PICTURE'];
				$national_id     = $res['NATIONAL_ID'];
				$basic           = $res['BASIC'];
				$grade           = $res['GRADE'];
				$designation     = $res['DESIGNATION'];
				$emp_id          = $res['EMP_ID'];
				$section_id      = $res['SECTION_ID'];
				$block_id      = $res['BLOCK_ID'];
				$status          = $res['STATUS'];	
		?>
		<tr class="gradeA">
         <td><?php echo $card_id;?></td>
	     <td><?php echo $name;?></td>
		 <td><?php echo $join_date;?></td>
		 <td><?php echo section_name($section_id);?></td>
         <td><?php echo getBlockName($block_id,$section_id);?></td>
		 <td><?php echo $basic;     ?></td>
		 <td><?php echo $emp_id;    ?></td>
		  <td><a href="index.php?pagetitle=employee_profile_display&menu_id=22&sm_id=3&slno=<?php echo $res['ID'];?>"><input type="button" id="fixed_salary_info_display_detail_button" class="btn btn-teal" value="details"/>
</a>
<a href="index.php?pagetitle=fixed_salary_employee_info_display_edit&menu_id=22&sm_id=3&slno=<?php echo $res['ID'];?>"><input type="button" id="fixed_salary_info_display_edit_button" class="btn btn-teal" value="edit"/></a><input type="button" id="btn_del" name="<?php echo $res['ID']; ?>" class="btn btn-teal"  value="Delete" />
		  </td>		 
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
		 <th></th>
		 <th></th>
	  </tr>	
</tfoot>
</div>	  
</table>
<br/><br/><br /><br /><br />