<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {	
      var section_id='';
	   $('#production_employee_info_datable').load('includes/production_base_emp_info/production_employee_info_datable_by_id.php', {'section_id':section_id},function(){});

       $('#section_id').change(function(){
	      var section_id = $('#section_id').val();
		  $('#production_employee_info_datable').load('includes/production_base_emp_info/production_employee_info_datable_by_id.php',
		  {'section_id':section_id},function(){});
	   });
	   
	   
	   		$('#btn_del').live('click',function(){
			var id	=$(this).attr('name');
			
			var r=confirm("Are You Sure Delete?");
			var x;
			if (r==true)
			{
				var id = id;
				$.ajax({
					type:'post',
					url:"includes/production_base_emp_info/delete.php",
					data:'id='+id,
					cache:false,
					success:function(str)
					{
						alert(str);
						
						 var section_id='';
	   $('#production_employee_info_datable').load('includes/production_base_emp_info/production_employee_info_datable_by_id.php', {'section_id':section_id},function(){});
	   
					}
				});
			}
			else
			{
				x="Cancel!";
			} 
		})

	});
</script>
<div class="grid_10" id="grid_10">
    <div class="box round first fullpage">
        <h2>Production Employee Information</h2>
        <div class="block" id="block">
		
		
		<?php
			$company_id=$_SESSION["company_id"];
			function section_name($id) {
			  global $conn,$names;
			  $str = "select SEC_NAME from TBL_PAY_SECTION_INFO where ID=$id and COMPANY_ID=$company_id";
              $stm = oci_parse($conn,$str);			  
			  oci_execute($stm);
			  while($r = oci_fetch_array($stm,OCI_BOTH+OCI_RETURN_NULLS)) {
			     $names = $r['SEC_NAME'];
			  }
			  return $names;
			}		
			function section_dropdown()   {
			  global $option,$conn;
			     $str = "select ID from TBL_PAY_SECTION_INFO where  and COMPANY_ID=$company_id and sec_type_id=(select id from tbl_pay_section_type where cat='P')";
				 
				 $stm  = oci_parse($conn,$str);
				 oci_execute($stm);
				 while($rs = oci_fetch_array($stm,OCI_BOTH+OCI_RETURN_NULLS)) {
				   $sid = $rs['ID'];
					$option .= "<option value='".$sid."'>".section_name($sid)."</option>";
				 }	
				 return $option;
			}			
		   
		
		?>
		
		 <table class="form">
		   <tr>
		    <td><label>Section</label></td>
			<td><select id="section_id" style="width:150px;">
            <option value="">None</option>
            <?php
			 $company_id	=$_SESSION["company_id"];
                    $sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P' and TBL_PAY_SECTION_INFO.COMPANY_ID=$company_id  order by TBL_PAY_SECTION_INFO.ID";
                    $stid	= oci_parse($conn, $sql);
                    oci_execute($stid);
                    
                    while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
                    {
                    echo '<option value='.$row[0].'>'.$row[1].'</option>';
                    }
                    ?>
			</select>
            </td>
			<td></td>
            <td></td>
		   </tr>
		 </table>
		 
		 <hr/>
		   <div id="production_employee_info_datable"></div> 
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="clear"></div>