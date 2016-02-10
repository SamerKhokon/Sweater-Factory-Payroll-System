<?php
session_start();
include('db.php');

$company_id	=$_SESSION["company_id"];	 
$section_str = "SELECT ID,SEC_NAME FROM TBL_PAY_SECTION_INFO  where COMPANY_ID=$company_id";
$section_stm = mysqli_query($conn,$section_str);

$option = '<option value="">select any section</option>';
while ($rs = mysqli_fetch_array($section_stm)) {
	$option .= '<option value="'.$rs[0].'">'.$rs[1].'</option>';
}   	
?>	
<script type="text/javascript">
    function data_load(){
	  $('#festival_bonus_data_table').load('create_section/festival_bonus_info_list_table.php',
	  function(){});
	}
	$(document).ready(function(){	
	  var section_id = $('#section').val();
	   $('#festival_bonus_data_table').show();
	   $('#festival_bonus_entry_table').show();
	   $('#festival_bonus_edit_table').hide();
	   if(section_id!="") {
			$('#festival_bonus_data_table').load('create_section/festival_bonus_info_list_table.php',{'section_id':section_id},function(){});
	  }
	   
	   $('#section').change(function(){
	   	    var section_id = $('#section').val();
	       if(section_id!="") {

			   $('#festival_bonus_data_table').load('create_section/festival_bonus_data_table_by_section_id.php',
			   {'section_id':section_id},function(){});
		   }
	   });	

	   
	   $("#salary_from").keypress(function(ex){
	      if(ex.which==13) {
		      var decNum = /^([0-9]*)(\.[0-9]{2})?$/;	
		      var salary_from = $("#salary_from").val();
			  if(salary_from=="") {
			    alert('enter salary from');
				$('#salary_from').focus();
				return false;
			  }else if(!decNum.test(salary_from)){
			    alert('salary from must be numeric');
				$('#salary_from').focus();
				return false;			     
			  }else{
			     $('#salary_to').focus();
			  }
		  }
	   });	   
	   $("#salary_to").keypress(function(ex){
	      if(ex.which==13) {
		      var decNum = /^([0-9]*)(\.[0-9]{2})?$/;	
		      var salary_to = $("#salary_to").val();
			  if(salary_to=="") {
			    alert('enter salary to');
				$('#salary_to').focus();
				return false;
			  }else if(!decNum.test(salary_to)){
			    alert('salary to must be numeric');
				$('#salary_to').focus();
				return false;			     
			  }else{
			     $('#bonus_amount').focus();
			  }
		  }
	   });
	   
	   
	   $("#bonus_amount").keypress(function(ex){
	      var flt = /^[0-9]{1,9}([\.][0-9]{1,2})?[\%]?$/;
		  var bonus_amount = $("#bonus_amount").val();
	      if(ex.which==13) {		      
			  if(bonus_amount=="") {
			    alert('enter bonus amount');
				$('#bonus_amount').focus();
				return false;
			  }else if(!flt.test(bonus_amount)){
			    alert('invalid bonus amount');
				$('#bonus_amount').focus();
				return false;			  
			  }
			  else{
					var company_id   = $("#company_id").val();
					var section      = $("#section").val();
					var salary_from  = $("#salary_from").val();
					var salary_to    = $("#salary_to").val();
					var bonus_amount = $("#bonus_amount").val();
					var salary_type  = $("#salary_type").val();			  
				  
					var dataStr ='company_id='+company_id+'&section='+section+'&salary_from='+salary_from+'&salary_to='+salary_to+'&bonus_amount='+bonus_amount+'&salary_type='+salary_type;		
					
					$.ajax({
					  type:'post' ,
					  url:'create_section/festival_bonus_info_entry_by_ajax.php',
					  data:dataStr,
					  cache:false ,
					  success:function(st){
						 alert(st);
						$('#festival_bonus_data_table').load('create_section/festival_bonus_info_list_table.php',{'section_id':section},function(){});
						 $("#salary_from").val('');
						 $("#salary_to").val('');
						 $("#bonus_amount").val('');
						 $('#festival_bonus_entry_table').show();
						 $('#festival_bonus_edit_table').hide();
						 $('#festival_bonus_data_table').show();							
					  }
					});				 
					$("#salary_from").focus();
			  }
		  }
	   });
	   
	   $('#festival_bonus_setting_save').click(function(){	   
		    var company_id   = $("#company_id").val();
		    var section      = $("#section").val();
			var salary_from  = $("#salary_from").val();
			var salary_to    = $("#salary_to").val();
			var bonus_amount = $("#bonus_amount").val();
			var salary_type  = $("#salary_type").val();
			
			var decNum = /^([0-9]*)(\.[0-9]{2})?$/;
			if(salary_from=="") {
			   alert('enter salary from');
			   $('#salary_from').focus();
			   return false;
			}
			if(salary_to=="") {
			   alert('enter salary to');
			   $('#salary_to').focus();
			   return false;
			}			
			if(!decNum.test(salary_from)) {
			   alert('salary from must be numeric');
			   $('#salary_from').focus();
			   return false;
			}
			if(!decNum.test(salary_to)) {
			    alert('salary to must be numeric');
				$("#salary_to").focus();
				return false;
			}	
			if(bonus_amount=="") {
			  alert('enter bonus amount');
			  $('#bonus_amount').focus();
			  return false;
			}
			var flt = /^[0-9]{1,9}([\.][0-9]{1,2})?[\%]?$/;
			if(!flt.test(bonus_amount)) {
			  alert('invalid bonus amount');
			  $('#bonus_amount').focus();
			  return false;			   
			}
			
			if(section!="") {
				var dataStr ='company_id='+company_id+'&section='+section+'&salary_from='+salary_from+'&salary_to='+salary_to+'&bonus_amount='+bonus_amount+'&salary_type='+salary_type;			
				
				$.ajax({
				  type:'post' ,
				  url:'create_section/festival_bonus_info_entry_by_ajax.php',
				  data:dataStr,
				  cache:false ,
				  success:function(st){
					 alert(st);
					$('#festival_bonus_data_table').load('create_section/festival_bonus_info_list_table.php',{'section_id':section},function(){});
					 $("#salary_from").val('');
					 $("#salary_to").val('');
					 $("#bonus_amount").val('');
					 $('#festival_bonus_entry_table').show();
					 $('#festival_bonus_edit_table').hide();
					 $('#festival_bonus_data_table').show();				     
				  }
				});
			}else{
			   alert('Please select any section');
			}
			$('#salary_from').focus();
	   });
	   
	   
	   //"festival_bonus_setting_edit_save"
	   $('.festival_bonus_edits_link').live('click',function(){
	      $('#festival_bonus_entry_table').hide();
	      $('#festival_bonus_edit_table').show();
	      var _id = $(this).attr('id');		  
		  $.ajax({
		    type:'post' ,
			url:'create_section/festival_bonus_row_fetching_by_ajax.php',
			data:'id='+_id,
			cache:false ,
			success:function(st){
				var parse = st.split('|');
                $("#serialno").val(parse[0]);   
				$("#company_id_e").val(parse[2]);
				$("#section_e").val(parse[1]);
				$("#salary_from_e").val(parse[3]);
				$("#salary_to_e").val(parse[4]);
				$("#bonus_amount_e").val(parse[5]);
				$("#salary_type_e").val(parse[6]);
				$('#festival_bonus_data_table').load('create_section/festival_bonus_info_list_table.php',{'section_id':$('#section_e').val()},function(){});			
			}
		  });
	   });
	   
	   $('#festival_bonus_setting_edit_save').click(function(){
	     	
			var serialno       = $("#serialno").val();   
			var company_id_e   = $("#company_id_e").val();
			var section_e      = $("#section_e").val();
			var salary_from_e  = $("#salary_from_e").val();
			var salary_to_e    = $("#salary_to_e").val();
			var bonus_amount_e = $("#bonus_amount_e").val();
			var salary_type_e  = $("#salary_type_e").val();	
			
			var dataStr = 'serialno='+serialno+'&company_id_e='+company_id_e+'&section_e='+section_e+'&salary_from_e='+salary_from_e+'&salary_to_e='+salary_to_e+'&bonus_amount_e='+bonus_amount_e+'&salary_type_e='+salary_type_e;
		
			$.ajax({
			    type:'post' ,
				url:'create_section/festival_bonus_edit_by_ajax.php' ,
				data: dataStr,
				cache:false ,
				success:function(st){
				   alert(st);
				$('#festival_bonus_data_table').load('create_section/festival_bonus_info_list_table.php',{'section_id':section_e},function(){});	
				  	               	
				   $('#festival_bonus_entry_table').show();
				   $('#festival_bonus_edit_table').hide();
				}
			});
			$('#salary_from').focus();			
	   });

       $("#salary_from_e").keypress(function(ex){
	       var  salary_from_e  = $("#salary_from_e").val();		   
		   var decNum = /^([0-9]*)(\.[0-9]{2})?$/;
	       if(ex.which==13) {
		       if(salary_from_e=="") {
			     alert('enter salary from');
				 $('#salary_from_e').focus();
				 return false;
			   }else if(!decNum.test(salary_from_e)) {
			     alert('salary from must be numeric');
				 $('#salary_from_e').focus();
				 return false;
			   }else{
			     $('#salary_to_e').focus(); 
			   }
		   }
	   });
       $("#salary_to_e").keypress(function(ex){
	       var  salary_to_e  = $("#salary_to_e").val();		   
		   var decNum = /^([0-9]*)(\.[0-9]{2})?$/;
	       if(ex.which==13) {
		       if(salary_to_e=="") {
			     alert('enter salary to');
				 $('#salary_from_e').focus();
				 return false;
			   }else if(!decNum.test(salary_to_e)) {
			     alert('salary to must be numeric');
				 $('#salary_to_e').focus();
				 return false;
			   }else{
			     $("#bonus_amount_e").focus(); 
			   }
		   }
	   });    
	  $("#bonus_amount_e").keypress(function(ex){
	       var  bonus_amount_e  = $("#bonus_amount_e").val();		   
		   var decNum = /^([0-9]*)(\.[0-9]{2})?$/;
		   var flt = /^[0-9]{1,9}([\.][0-9]{1,2})?[\%]?$/;
	       if(ex.which==13) {
		       if(bonus_amount_e=="") {
			     alert('enter salary to');
				 $('#bonus_amount_e').focus();
				 return false;
			   }else if(!flt.test(bonus_amount_e)) {
			     alert('invalid bonus amount');
				 $('#bonus_amount_e').focus();
				 return false;
			   }else{
			    
						var serialno       = $("#serialno").val();   
						var company_id_e   = $("#company_id_e").val();
						var section_e      = $("#section_e").val();
						var salary_from_e  = $("#salary_from_e").val();
						var salary_to_e    = $("#salary_to_e").val();
						var salary_type_e  = $("#salary_type_e").val();	
						
						var dataStr = 'serialno='+serialno+'&company_id_e='+company_id_e+'&section_e='+section_e+'&salary_from_e='+salary_from_e+'&salary_to_e='+salary_to_e+'&bonus_amount_e='+bonus_amount_e+'&salary_type_e='+salary_type_e;
					
						$.ajax({
							type:'post' ,
							url:'create_section/festival_bonus_edit_by_ajax.php' ,
							data: dataStr,
							cache:false ,
							success:function(st){
							   alert(st);
							  
							  $('#festival_bonus_data_table').load('create_section/festival_bonus_info_list_table.php',{'section_id':section_e},function(){});	
							  
							  							   	
							   $('#festival_bonus_entry_table').show();
							   $('#festival_bonus_edit_table').hide();
							}
						}); 	
			   }
		   }
	   });  	   
	});
</script>
<div class="grid_10" id="grid_10">
    <div class="box round first fullpage">
        <h2>Festival Bonus Information</h2>
        <div class="block" id="block">
				
		<!-- entry table -->
		<table class="form" id="festival_bonus_entry_table" border="1">
		   
		   <input type="hidden" id="company_id" value="<?php echo $_SESSION['company_id'];?>">
		   <tr>
		     <td><label>Section</label></td>
			 <td><select id="section" style="width:150px;"><?php echo $option;?></select></td>
             <td colspan="2"></td>
		   </tr>
		   <tr>
		     <td><label>Salary From</label></td>
			 <td ><input type="text" id="salary_from" class="error"/>
			 <span class="error">This is required field</span></td>
		     <td><label>Salary To</label></td>
			 <td ><input type="text" id="salary_to" class="error"/>
			 <span class="error">This is required field</span></td>
		   </tr>		   		   
		   <tr>
		     <td><label>Bonus Amount</label></td>
			 <td><input type="text" id="bonus_amount" class="success"/></td>
		     <td><label>Salary Type</label></td>
			 <td><select id="salary_type" style="width:150px;">		
			    <option value="BASIC">BASIC</option>
				<option value="GROSS">GROSS</option>
			 </select></td>
		   </tr>	
		   <tr>
			 <td colspan="4" align="right"><input type="button" id="festival_bonus_setting_save" class="btn btn-navy" value="&nbsp;&nbsp;Save&nbsp;&nbsp;"/></td>
		   </tr>		   		   		   		   
		</table>	
		
		<!-- edit table -->
		<table class="form" id="festival_bonus_edit_table" border="1">
		   <input type="hidden" id="serialno" value=""/>
		   <input type="hidden" id="company_id_e" value="<?php echo $_SESSION['company_id'];?>">
		   <tr>
		     <td><label>Section</label></td>
			 <td><select id="section_e" style="width:150px;"><?php echo $option;?></select></td>
             <td colspan="2"></td>
		   </tr>
		   <tr>
		     <td><label>Salary From</label></td>
			 <td><input type="text" id="salary_from_e" class="error" />
			 <span class="error">This is required field</span>
			 </td>
		     <td><label>Salary To</label></td>
			 <td><input type="text" id="salary_to_e" class="error" />
			 <span class="error">This is required field</span></td>
		   </tr>		   		   
		   <tr>
		     <td><label>Bonus Amount</label></td>
			 <td><input type="text" id="bonus_amount_e" class="success" /></td>
              <td><label>Salary Type</label></td>
			 <td><select id="salary_type_e" style="width:150px;">
			    <option value="BASIC">BASIC</option>
				<option value="GROSS">GROSS</option>
			 </select></td>
		   </tr>
		   <tr>
			 <td colspan="4" align="right"><input type="button" id="festival_bonus_setting_edit_save" class="btn btn-navy" value="&nbsp;&nbsp;Update&nbsp;&nbsp;"/></td>
		   </tr>		   		   		   		   
		</table>					
		<hr/>
			<div id="festival_bonus_data_table"></div>
		</div>
    </div>
</div>
<div class="clear"></div>
<div class="clear"></div>