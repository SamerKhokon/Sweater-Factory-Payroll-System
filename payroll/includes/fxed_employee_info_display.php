<?php
session_start();
include('db.php');
?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {	
	
		var section_id='';
	  $('#fixed_salary_employee_datatable').load('includes/fixed_salary_employee_info/fixed_salary_employee_info_datatable_by_section_id.php',{'section_id':section_id},function(){});
	  
	    $('#section_id').change(function(){
			  var section_id = $('#section_id').val();
			   $('#fixed_salary_employee_datatable').load('includes/fixed_salary_employee_info/fixed_salary_employee_info_datatable_by_section_id.php' ,{'section_id':section_id},function(){});
			   
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
					url:"includes/fixed_salary_employee_info/delete.php",
					data:'id='+id,
					cache:false,
					success:function(str)
					{
						alert(str);
						
						var section_id='';
	  $('#fixed_salary_employee_datatable').load('includes/fixed_salary_employee_info/fixed_salary_employee_info_datatable_by_section_id.php',{'section_id':section_id},function(){});
						/*$("#jq_tbl").load('includes/style_info/style_info_data.php');
						btn_reset();
						*/
					}
				});
			}
			else
			{
				x="Cancel!";
			} 
		
		});
	
	   
	});
</script>
<div class="grid_10" id="grid_10">
    <div class="box round first fullpage">
        <h2>Fixed Employee Information</h2>
        <div class="block" id="block">		
		<table class="form">
			<tr>
                <td><label>Section:</label></td>
                <td><select id="section_id" style="width:150px;">
                <option value="">None</option>
					<?php
                    $company_id	=$_SESSION["company_id"];
                    $sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='F' and TBL_PAY_SECTION_INFO.COMPANY_ID=$company_id  order by TBL_PAY_SECTION_INFO.ID";
                    $stid	= mysqli_query($conn , $sql);
                    
                    
                    while($row = mysqli_fetch_array($stid)) 
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
		
		<div id="fixed_salary_employee_datatable"></div>
        
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="clear"></div>