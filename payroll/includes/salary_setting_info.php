<?php
session_start();
include('db.php');
 
	$company_id	=$_SESSION["company_id"];	
    $section_str = "SELECT ID,SEC_NAME FROM TBL_PAY_SECTION_INFO where COMPANY_ID=$company_id ";
    $section_stm = mysqli_query($conn,$section_str);
    
	global $option;
    while ($rs = mysqli_fetch_array($section_stm)) {
	    $option .= '<option value="'.$rs[0].'">'.$rs[1].'</option>';
	}   	
?>	
<script type="text/javascript">

$(document).ready(function(){ 
	var section_id = $('#section').val(); 
	    $('#salary_setting_info_list_table_load').load('create_section/salary_setting_info_list_table.php',{'section_id':section_id},function(){});
		
	$('#sal_edit_table').hide();
    $('#sal_entry_table').show();
	
	$('#section').change(function(){
		$('#sal_edit_table').hide();
        $('#sal_entry_table').show();
	    var section_id = $('#section').val();
	
	    $('#salary_setting_info_list_table_load').load('create_section/salary_setting_info_list_table.php',{'section_id':section_id},function(){});
		var mdata='section_id='+section_id;
		  $.ajax({
				   type:'post',
				   url:'create_section/check_section_data.php',
				   data:mdata,
				   cache:false ,
				   success:function(str) {
							 var ck=$.trim(str);
							 //alert(ck);
							 if(ck==0)
							 {
									$('#salary_type').val('1');
									$("#salary_type option[value='1']").attr('disabled',false);
									$("#salary_type option[value='2']").attr('disabled',false);				
							 }
							 else
							 {
							 	if(ck==1)
								{
									$('#salary_type').val('1');
									$("#salary_type option[value='2']").attr('disabled','disabled');
									$("#salary_type option[value='1']").attr('disabled','');
								}
								else
								{
									$('#salary_type').val('2');
									$("#salary_type option[value='1']").attr('disabled','disabled');
									$("#salary_type option[value='2']").attr('disabled','');
						
								}
								
							 }
				   		}
				  });
	});
		
	$('#salary_from').keypress(function(ex){
	    var salary_from = $('#salary_from').val();
	    if(ex.which==13) {
		  if(salary_from=="") {
		    alert('enter salary from');
		    $('#salary_from').focus();
			return false;
		  }else{
		     $('#salary_to').focus();
		  }    
		}
	});
	
	$('#salary_to').keypress(function(ex){ 
	   var salary_to = $('#salary_to').val();
	   if(ex.which==13) {
	      if(salary_to=="") {
		     alert('enter salary to');
		     $('#salary_to').focus();
			 return false;
		  }else{
		      $('#grade').focus();
		  }
	   }
	});
	
	$('#grade').keypress(function(ex){
	   var grade = $('#grade').val();
	   if(ex.which==13) {
	      if(grade=="") {
		    alert('enter grade');
		    $('#grade').focus();
			return false;
		  }else{
		    $('#designation').focus();			
		  }
	   }
	});
	$("#designation").keydown(function(event){
		if(event.keyCode == 13 )
			{
				var section     = $('#section').val();
			   var salary_from = $('#salary_from').val();
			   var salary_to   = $('#salary_to').val();
			   var grade	   = $('#grade').val();
			   var designation = $('#designation').val();
			   var salary_type = $('#salary_type').val();
			   
			   if(section!="") {
				   var dataStr = 'section='+section+'&salary_from='+salary_from+'&salary_to='+salary_to+'&grade='+grade+'&designation='+designation+'&salary_type='+salary_type;
				   
				   $.ajax({
					  type:'post' ,
					  url:'create_section/salary_setting_entry_by_ajax.php' ,
					  data:dataStr ,
					  cache:false ,
					  success:function(st){
						
						 $('#salary_setting_info_list_table_load').load('create_section/salary_setting_info_list_table.php',{'section_id':section},function(){});
						 
						alert(st);
						
						//$('#section').val('');
						$('#salary_from').val('');
						$('#salary_to').val('');
						$('#grade').val('');
						$('#designation').val('');
						//$('#salary_type').val('');				 				
						$('#sal_edit_table').hide();
						$('#sal_entry_table').show();
						$('#salary_from').focus();
						
						section_type(section);
						
					  }
				   });
				}
				else
				{
				  alert('Please select any section');
				}   
			}
		});
	
	$('#salary_setting_save').click(function(){
	   	   var section     = $('#section').val();
		   var salary_from = $('#salary_from').val();
		   var salary_to   = $('#salary_to').val();
		   var grade	   = $('#grade').val();
		   var designation = $('#designation').val();
		   var salary_type = $('#salary_type').val();
		   
		   if(section!="") {
			   var dataStr = 'section='+section+'&salary_from='+salary_from+'&salary_to='+salary_to+'&grade='+grade+'&designation='+designation+'&salary_type='+salary_type;
			   
			   $.ajax({
				  type:'post' ,
				  url:'create_section/salary_setting_entry_by_ajax.php' ,
				  data:dataStr ,
				  cache:false ,
				  success:function(st){
				    
					 $('#salary_setting_info_list_table_load').load('create_section/salary_setting_info_list_table.php',{'section_id':section},function(){});
					 
					alert(st);
					$('#salary_from').val('');
					$('#salary_to').val('');
					$('#grade').val('');
					$('#designation').val('');
					$('#salary_type').val('');				 				
					$('#sal_edit_table').hide();
					$('#sal_entry_table').show();
					$('#salary_from').focus();
					
				  }
			   });
			}
			else
			{
			  alert('Please select any section');
			}   
	   });
	   
	   
	   $('.salary_setting_edit_link').live('click',function(){	  
			  var _id = $(this).attr('id');
			  $('#sal_edit_table').show();
			  $('#sal_entry_table').hide();
			  var section_e     = $('#section_e').val();
			  var salary_from_e = $('#salary_from_e').val();
			  var salary_to_e   = $('#salary_to_e').val();
			  var grade_e       = $('#grade_e').val();
			  var designation_e = $('#designation_e').val();
			  var salary_type_e = $('#salary_type_e').val();

             
			  var dataStr = 'section_e='+section_e+'&salary_from_e='+salary_from_e+'&salary_to_e='+salary_to_e+'&grade_e='+grade_e+'&designation_e='+designation_e+'&salary_type_e='+salary_type_e;
			  
			  $.ajax({
				   type:'post',
				   url:'create_section/salary_setting_single_row_fetching.php',
				   data: 'id='+_id,
				   cache:false ,
				   success:function(st) {
				      var parse = st.split('|');
                      $('#serialno').val(parse[0]);					  
					  $('#section_e').val(parse[7]);
					  $('#salary_from_e').val(parse[2]);
			          $('#salary_to_e').val(parse[3]);
			          $('#grade_e').val(parse[4]);
			          $('#designation_e').val(parse[5]);
			          $('#salary_type_e').val(parse[6]);
					  $('#salary_from_e').focus();
					  $('#salary_setting_info_list_table_load').load('create_section/salary_setting_info_list_table.php',{'section_id':$('#section_e').val()},function(){});
				   }
			  });
	   });
	   
		   $('#salary_from_e').keypress(function(ex){
			var salary_from = $('#salary_from_e').val();
			if(ex.which==13) {
			  if(salary_from=="") {
				alert('enter salary from');
				$('#salary_from_e').focus();
				return false;
			  }else{
				 $('#salary_to_e').focus();
			  }    
			}
		});
		$('#salary_to_e').keypress(function(ex){ 
		   var salary_to = $('#salary_to_e').val();
		   if(ex.which==13) {
			  if(salary_to=="") {
				 alert('enter salary to');
				 $('#salary_to_e').focus();
				 return false;
			  }else{
				  $('#grade_e').focus();
			  }
		   }
		});
			$('#grade_e').keypress(function(ex){
		   var grade = $('#grade_e').val();
		   if(ex.which==13) {
			  if(grade=="") {
				alert('enter grade');
				$('#grade_e').focus();
				return false;
			  }else{
				$('#designation_e').focus();			
			  }
		   }
		});
		
		$("#designation_e").keydown(function(event){
		if(event.keyCode == 13 )
			{
					$('#sal_edit_table').hide();
					$('#sal_entry_table').show();
					var serialno      = $('#serialno').val();					  
					var section_e     = $('#section_e').val();
					var salary_from_e = $('#salary_from_e').val();
					var salary_to_e   = $('#salary_to_e').val();
					var grade_e       = $('#grade_e').val();
					var designation_e = $('#designation_e').val();
					var salary_type_e = $('#salary_type_e').val();	      
					var dataStr = 'serialno='+serialno+'&section_e='+section_e+'&salary_from_e='+salary_from_e+'&salary_to_e='+salary_to_e+'&grade_e='+grade_e+'&designation_e='+designation_e+'&salary_type_e='+salary_type_e; 
					
					$.ajax({
					   type:'post' ,
					   url:'create_section/salary_setting_edit_by_ajax.php' ,
					   data:dataStr,
					   cache:false ,
					   success:function(st){
						  alert(st);  
							$('#salary_setting_info_list_table_load').load('create_section/salary_setting_info_list_table.php',{'section_id':section_e},function(){});
									  
					   }
					});
					
				}
			});
	   
	   $('#salary_setting_save_for_edit').click(function(){
	        $('#sal_edit_table').hide();
			$('#sal_entry_table').show();
		    var serialno      = $('#serialno').val();					  
			var section_e     = $('#section_e').val();
			var salary_from_e = $('#salary_from_e').val();
			var salary_to_e   = $('#salary_to_e').val();
			var grade_e       = $('#grade_e').val();
			var designation_e = $('#designation_e').val();
			var salary_type_e = $('#salary_type_e').val();	      
			var dataStr = 'serialno='+serialno+'&section_e='+section_e+'&salary_from_e='+salary_from_e+'&salary_to_e='+salary_to_e+'&grade_e='+grade_e+'&designation_e='+designation_e+'&salary_type_e='+salary_type_e; 
			
			$.ajax({
			   type:'post' ,
			   url:'create_section/salary_setting_edit_by_ajax.php' ,
			   data:dataStr,
			   cache:false ,
			   success:function(st){
			      alert(st);  
				    $('#salary_setting_info_list_table_load').load('create_section/salary_setting_info_list_table.php',{'section_id':section_e},function(){});
                			  
			   }
			});
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
					url:"create_section/delete_salary.php",
					data:'id='+id,
					cache:false,
					success:function(str)
					{
						var myString = str;
						var stringParts = myString.split('!@#$');
						alert(stringParts[0]);
						var section_e=stringParts[1];
$('#salary_setting_info_list_table_load').load('create_section/salary_setting_info_list_table.php',{'section_id':section_e},function(){});
					}
				});
			}
			else
			{
				x="Cancel!";
			} 
		}); 
});
function  section_type(section_id)
{
 var mdata='section_id='+section_id;
		  $.ajax({
				   type:'post',
				   url:'create_section/check_section_data.php',
				   data:mdata,
				   cache:false ,
				   success:function(str) {
							 var ck=$.trim(str);
							 //alert(ck);
							 if(ck==0)
							 {
									$('#salary_type').val('1');
									$("#salary_type option[value='1']").attr('disabled',false);
									$("#salary_type option[value='2']").attr('disabled',false);				
							 }
							 else
							 {
							 	if(ck==1)
								{
									$('#salary_type').val('1');
									$("#salary_type option[value='2']").attr('disabled','disabled');
									$("#salary_type option[value='1']").attr('disabled','');
								}
								else
								{
									$('#salary_type').val('2');
									$("#salary_type option[value='1']").attr('disabled','disabled');
									$("#salary_type option[value='2']").attr('disabled','');
						
								}
								
							 }
				   		}
				  });
	}
</script>

<div class="grid_10" id="grid_10">
    <div class="box round first fullpage">
        <h2>Salary Information</h2>
        	<div class="block" id="block">
		
		<!-- entry table -->
            <table class="form" id="sal_entry_table">
               <tr>
                 <td><label>Section</label></td>
                 <td><select id="section" style="width:150px;"><?php echo $option;?></select></td>
                 <td><label>Type</label></td>
                 <td><select id="salary_type" style="width:150px;">
                   
                    <option value="1">BASIC</option>
                    <option value="2">GROSS</option>
                 </select></td>
               </tr>
               <tr>
                 <td><label>Salary From</label></td>
                 <td><input type="text" id="salary_from" class="error"/><span class="error">This is required field</span></td>
                 <td><label>Salary To</label></td>
                 <td><input type="text" id="salary_to" class="error"/><span class="error">This is required field</span></td>
               </tr>		   		   
               <tr>
                 <td><label>Grade</label></td>
                 <td><input type="text" id="grade" class="error"/><span class="error">This is required field</span></td>
                 <td><label>Designation</label></td>
                 <td><input type="text" id="designation" class="success"/></td>
               </tr>
               <tr>
                 <td colspan="4" align="right"><input type="button" id="salary_setting_save" class="btn btn-navy" value="&nbsp;&nbsp;Save&nbsp;&nbsp;"/><input type="button"  name="btn_reset" id="btn_reset" value=" &nbsp;&nbsp;Reset&nbsp;&nbsp;" class="btn btn-blue" /></td>
               </tr>		   		   		   		   
            </table>
            
            
            <!-- edit table -->
            
            <table class="form" id="sal_edit_table">
              <input type="hidden" id="serialno" value=""/>
               <tr>
                 <td>Section</td>
                 <td><select id="section_e" style="width:150px;"><?php echo $option;?></select></td>
                 <td colspan="2"></td>
               </tr>
               <tr>
                 <td>Salary From</td>
                 <td><input type="text" id="salary_from_e" class="error"/><span class="error">This is required field</span></td>
                 <td>Salary To</td>
                 <td><input type="text" id="salary_to_e" class="error"/><span class="error">This is required field</span></td>
               </tr>		   		   
               <tr>
                 <td>Grade</td>
                 <td><input type="text" id="grade_e" class="error"/><span class="error">This is required field</span></td>
                 <td>Designation</td>
                 <td><input type="text" id="designation_e" class="success"/></td>
               </tr>	
               <tr>
                 <td></td>
                 <td><select  id="salary_type_e" style="width:150px; display:none;">
                    <option></option>
                    <option value="1">BASIC</option>
                    <option value="2">GROSS</option>			 
                 </select></td>
                 <td colspan="2"></td>
               </tr>	
               <tr>
                 <td colspan="4" align="right"><input type="button" id="salary_setting_save_for_edit" class="btn btn-navy" value="&nbsp;&nbsp;Save&nbsp;&nbsp;"/></td>
               </tr>		   		   		   		   
            </table>		
            <hr />
			<div id="salary_setting_info_list_table_load"></div>
		</div>
	</div>
</div>
<div class="clear"></div>
<div class="clear"></div>
<?php
oci_free_statement($section_stm);
oci_close($conn);
?>