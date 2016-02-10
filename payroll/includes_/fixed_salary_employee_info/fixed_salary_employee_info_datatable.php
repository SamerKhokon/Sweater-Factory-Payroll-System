<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {	
		$('#example').dataTable( {
			"sPaginationType": "full_numbers"				
		});	
       //data_load();	
	});
</script>
<?php    error_reporting(0);
	session_start();
	//include_once("../opSessionCheck2.inc");
	require '../../../includes/db.php';		
	$company_id=$_SESSION["company_id"];
	//global $section_id;	
	
	
	
	
	//$section_id = trim($_POST['section_id']);	  
	
	 
	  $str = "select * from tbl_pay_emp_profile where  COMPANY_ID=$company_id and section_id in
			(select ID from TBL_PAY_SECTION_INFO where  sec_type_id=(select id from tbl_pay_section_type where cat='F'))  order by cast(substr(card_id,2,9) as number)";
		
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
	
?>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
<div id="demo">
    <thead>
	  <tr>
      	 <th>Card ID</th>
	     <th>Name</th>
		 <th>Mobileno</th>
		 <th>Join Date</th>
		 <th>Section</th>
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
				$status          = $res['STATUS'];	
		?>
		<tr class="gradeA">
         <td><?php echo $card_id;?></td>
	     <td><?php echo $name;?></td>
		 <td><?php echo $phone_no;?></td>
		 <td><?php echo $join_date;?></td>
		 <td><?php echo section_name($section_id);?></td>
		 <td><?php echo $basic;     ?></td>
		 <td><?php echo $emp_id;    ?></td>
		  <td><a href="index.php?pagetitle=fixed_salary_employee_info_display_edit&menu_id=22&sm_id=3&slno=<?php echo $res['ID'];?>"  >
		  <input type="button" id="fixed_salary_info_display_edit_button" class="btn btn-teal" value="edit"/>
		  </a>		  
		  &nbsp;
<a href="index.php?pagetitle=employee_profile_display&menu_id=22&sm_id=3&slno=<?php echo $res['ID'];?>"  >
<input type="button" id="fixed_salary_info_display_detail_button" class="btn btn-teal" value="details"/>
		  </a>		  
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
<br/><br/>