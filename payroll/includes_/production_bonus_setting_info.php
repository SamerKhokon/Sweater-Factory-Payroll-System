<?php
	$company_id	=$_SESSION["company_id"];	 			
	$sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,
TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P' and TBL_PAY_SECTION_INFO.COMPANY_ID=$company_id	  order by TBL_PAY_SECTION_INFO.ID";
	$stid	= oci_parse($conn, $sql);
	oci_execute($stid);
	$option = "<option value=''>select section type</option>";	
	while($row = oci_fetch_array($stid, OCI_BOTH)) {
	   $option .= '<option value='.$row[0].'>'.$row[1].'</option>';
	}	
?>

<script type="text/javascript">
  function data_load(section_id)  {
      $('#production_bonus_data_table').load('create_section/production_bonus_data_list_table.php',{'section_id':section_id},function(){});
  }
  $(document).ready(function(){
      var section_id = $('#section').val();
	  //alert(section_id);
	  if(section_id!=""){
        data_load(section_id);
	  }
	  
	  $('#production_bonus_entry_table').show();
	  $('#production_bonus_edit_table').hide();
	  
	  $('#production_bonus_data_table').show();
	  
	  
	  $('#section').change(function(){
	      var section_id = $('#section').val();
		  if(section_id!="") { 
			  $('#production_bonus_data_table').show();
			  $('#production_bonus_edit_table').hide();
					$('#production_bonus_data_table').load('create_section/production_bonus_data_list_table.php',{'section_id':section_id},function(){});
		  }
	  });
	  
	    $('#amount_from').keypress(function(ex){
		   if(ex.which==13) {
				var decNum = /^([0-9]*)(\.[0-9]{2})?$/;	
				var amount_from = $('#amount_from').val();
				if(amount_from=="") {
				   alert('enter amount from');
				   $('#amount_from').focus();
				   return false;
				}else if(!decNum.test(amount_from)){
				   alert('amount from must be numeric');
				   $('#amount_from').focus();
				   return false;
				}else{
				   $('#amount_to').focus();
				}
		   }	
	    }); 
		
		$('#amount_to').keypress(function(ex){
            if(ex.which==13) {		
				var decNum = /^([0-9]*)(\.[0-9]{2})?$/;	
				var amount_to = $('#amount_to').val();
				if(amount_to=="") {
				   alert('enter amount from');
				   $('#amount_to').focus();
				   return false;
				}else if(!decNum.test(amount_to)){
				   alert('amount from must be numeric');
				   $('#amount_to').focus();
				   return false;
				}else{
				   $('#bonus_amount').focus();
				}
			}	
	    });
		$('#bonus_amount').keypress(function(ex){
		    var	company_id   = $('#company_id').val();
			var	section      = $('#section').val();
			var	amount_from  = $('#amount_from').val();
			var	amount_to    = $('#amount_to').val();
			var bonus_amount = $('#bonus_amount').val();
			var decNum = /^([0-9]*)(\.[0-9]{2})?$/;
			var flt = /^[0-9]{1,9}([\.][0-9]{1,2})?[\%]?$/;
		
			if(ex.which == 13) {
			   if(bonus_amount=="") {
			      alert('enter bonus amount');
			      $('#bonus_amount').focus();
				  return false;
			   }else if(!flt.test(bonus_amount)) {
			      alert('invalid bonus amount');
			      $('#bonus_amount').focus();
				  return false;			     
			   }else{
					if(amount_from=="") {
					   alert('enter amount from');
					   $('#amount_from').focus();
					   return false;
					}
					else if(!decNum.test(amount_from)) {
					   alert('amount from must be numeric');
					   $('#amount_from').focus();
					   return false;
					}					
				    else if(amount_to=="") {
					   alert('enter amount to');
					   $('#amount_to').focus();
					   return false;
					}	
					else if(!decNum.test(amount_to)) {
					   alert('amount to must be numeric');
					   $('#amount_to').focus();
					   return false;
					}
                    else {
						var dataStr = 'company_id='+company_id+'&section='+section+'&amount_from='+amount_from+'&amount_to='+amount_to+'&bonus_amount='+bonus_amount;	
                        
						$.ajax({
						   type: 'post' ,
						   url:  'create_section/production_bonus_entry_by_ajax.php' ,
						   data: dataStr ,
						   cache:false,
						   success:function(st) {
							  alert(st);							
			$('#production_bonus_data_table').load('create_section/production_bonus_data_list_table.php',{'section_id':section},function(){});
							  								
							   // $('#company_id').val('');
							    //$('#section').val(0);
							    $('#amount_from').val('');
							    $('#amount_to').val('');
							    $('#bonus_amount').val('');	
								$('#production_bonus_entry_table').show();
								$('#production_bonus_edit_table').hide();
								$('#production_bonus_data_table').show();			
								$('#amount_from').focus();
						   }
					    });	
                        						
					} 					
			   }
			}						
	    }); 			
		
	  
	  $('#production_bonus_setting_save').click(function(){
	  		$('#production_bonus_data_table_by_section_id').hide();
       	    $('#production_bonus_data_table').show();
			
			var	company_id   = $('#company_id').val();
			var	section      = $('#section').val();
			var	amount_from  = $('#amount_from').val();
			var	amount_to    = $('#amount_to').val();
			var	bonus_amount = $('#bonus_amount').val();	
		
		    
		    var decNum = /^([0-9]*)(\.[0-9]{2})?$/;	
			if(amount_from=="") {
			   alert('enter amount from');
			   $('#amount_from').focus();
			   return false;
			}else if(!decNum.test(amount_from)) {
			   alert('amount from must be numeric');
			   $('#amount_from').focus();
			   return false;			
			}else if(amount_to=="") {
			   alert('enter amount to');
			   $('#amount_to').focus();
			   return false;
			}else if( !decNum.test(amount_to) ) {
			   alert('amount to must be numeric');
			   $('#amount_to').focus();
			   return false;
			}else if(bonus_amount=="") {
			   alert('enter bonus amount');
			   $('#bonus_amount').focus();
			   return false;
			}else{ 
				var dataStr = 'company_id='+company_id+'&section='+section+'&amount_from='+amount_from+'&amount_to='+amount_to+'&bonus_amount='+bonus_amount;
				
				$.ajax({
				   type:'post' ,
				   url:'create_section/production_bonus_entry_by_ajax.php' ,
				   data:dataStr ,
				   cache:false,
				   success:function(st) {
					alert(st);
					
					$('#production_bonus_data_table').load('create_section/production_bonus_data_list_table.php',{'section_id':section},function(){});
					
					//$('#company_id').val('');
					//$('#section').val(0);
					$('#amount_from').val('');
					$('#amount_to').val('');
					$('#bonus_amount').val('');	
					$('#production_bonus_entry_table').show();
					$('#production_bonus_edit_table').hide();
					$('#production_bonus_data_table_by_section_id').hide();
					$('#production_bonus_data_table').show();			
					$('#amount_from').focus();
				   }
				});
			}	
	    });
	  
	  
	  //edit block start
	  $('#amount_from_e').keypress(function(ex){
	     var decNum = /^([0-9]*)(\.[0-9]{2})?$/; 
		 var amount_from_e = $('#amount_from_e').val();
	     if(ex.which==13) {
		    if(amount_from_e=="") {
				alert('enter amount from');
				 $('#amount_from_e').focus();
				 return false;
			 }else if(!decNum.test(amount_from_e)) {
				alert('amount from must be numeric');
				 $('#amount_from_e').focus();
				 return false;		 
			 }
			 else{
			   $('#amount_to_e').focus();
			 }
		}	 
	  });
	  
	  $('#amount_to_e').keypress(function(ex){
	     var decNum = /^([0-9]*)(\.[0-9]{2})?$/; 
		 var amount_to_e = $('#amount_to_e').val();
	     if(ex.which==13) {
			  if(amount_to_e==""){
				alert('enter amount to');
				$('#amount_to_e').focus();
				return false;
			 }else if(!decNum.test(amount_to_e)) {
				alert('amount to must be numeric');
				$('#amount_to_e').focus();
				return false;		 
			 }
			 else{
				$('#bonus_amount_e').focus();
			 }
		 }
	  });
	  
	  $('#bonus_amount_e').keypress(function(ex){
	     var decNum = /^([0-9]*)(\.[0-9]{2})?$/; 
		 var flt = /^[0-9]{1,9}([\.][0-9]{1,2})?[\%]?$/;
		 var bonus_amount_e = $('#bonus_amount_e').val();
	        if(ex.which==13) {
				  if(bonus_amount_e=="") { 
					alert('enter bonus amount');
					$('#bonus_amount_e').focus();
					return false;
				 }else if(!flt.test(bonus_amount_e)) {
					alert('invalid bonus amount');
					$('#bonus_amount_e').focus();
					return false;		 
				 }
				 else{
					  var serialno_e     =$('#serialno_e').val();
					  var company_id_e   =$('#company_id_e').val(); 		      
					  var amount_from_e  =$('#amount_from_e').val();
					  var amount_to_e    =$('#amount_to_e').val();
					  var bonus_amount_e =$('#bonus_amount_e').val();	
					  var section_e      =$('#section_e').val();
					  var entry_date_e   =$('#entry_date_e').val();		 
					  var dataStr = 'serialno_e='+serialno_e+'&company_id_e='+company_id_e+'&amount_from_e='+amount_from_e+'&amount_to_e='+amount_to_e+'&bonus_amount_e='+bonus_amount_e+'&section_e='+section_e+'&entry_date_e='+entry_date_e;		     
				 
				 
						$.ajax({
							 type:'post' ,
							 url:'create_section/production_bonus_edit_by_ajax.php' ,
							 data:dataStr,
							 cache:false ,
							 success:function(st) {
							   alert(st);
								 $('#production_bonus_data_table_by_section_id').hide();
								$('#production_bonus_data_table').show();
							   data_load(section_e);
							   $('#production_bonus_entry_table').show();
							   $('#production_bonus_edit_table').hide();				   
							 }
						});				 
				 
					  $('#bonus_amount_e').focus();
				 }
			}	 
	  });	  
	  
 	  $('.production_bonus_edits_link').live('click',function(){
	      $('#production_bonus_entry_table').hide();
	      $('#production_bonus_edit_table').show();
		  $('#production_bonus_data_table_by_section_id').hide();
       	  $('#production_bonus_data_table').show();		   

	     var _id = $(this).attr('id');
		 $.ajax({
		    type:'post' ,
			url:'create_section/production_bonus_single_row_fetching_by_ajax.php' ,
			data:'id='+_id,
			success:function(st) {			  
			  var parse = st.split('|');
			  $('#serialno_e').val(parse[0]);
			  $('#company_id_e').val(parse[1]); 		      
		      $('#amount_from_e').val(parse[2]);
		      $('#amount_to_e').val(parse[3]);
		      $('#bonus_amount_e').val(parse[4]);	
			  $('#section_e').val(parse[5]);
			  $('#entry_date_e').val(parse[6]);
			  $('#production_bonus_data_table_by_section_id').hide();
       	     $('#production_bonus_data_table').show();
			  data_load(parse[5]);
			  $('#production_bonus_entry_table').hide();
	          $('#production_bonus_edit_table').show();
			}
		 });		 
	  });
	  
       $('#production_bonus_setting_edit_save').click(function(){
	   		  $('#production_bonus_data_table_by_section_id').hide();
       	     $('#production_bonus_data_table').show();
			  var serialno_e     =$('#serialno_e').val();
			  var company_id_e   =$('#company_id_e').val(); 		      
		      var amount_from_e  =$('#amount_from_e').val();
		      var amount_to_e    =$('#amount_to_e').val();
		      var bonus_amount_e =$('#bonus_amount_e').val();	
			  var section_e      =$('#section_e').val();
			  var entry_date_e   =$('#entry_date_e').val();	      
			  var dataStr = 'serialno_e='+serialno_e+'&company_id_e='+company_id_e+'&amount_from_e='+amount_from_e+'&amount_to_e='+amount_to_e+'&bonus_amount_e='+bonus_amount_e+'&section_e='+section_e+'&entry_date_e='+entry_date_e;
			  			  
			  $.ajax({
			     type:'post' ,
				 url:'create_section/production_bonus_edit_by_ajax.php' ,
				 data:dataStr,
				 cache:false ,
				 success:function(st) {
				   alert(st);
				   	 $('#production_bonus_data_table_by_section_id').hide();
					$('#production_bonus_data_table').show();
				   data_load(section_e);
				   $('#production_bonus_entry_table').show();
	               $('#production_bonus_edit_table').hide();				   
				 }
			  });
	   }) 
		
  });
</script>



<div class="grid_10" id="grid_10">
    <div class="box round first fullpage">
        <h2>Product Bonus Setting</h2>
        <div class="block" id="block">		

	
		 <table class="form" id="production_bonus_entry_table">		   
		   <input type="hidden" id="company_id" value="<?php echo $_SESSION['company_id'];?>">
		   <tr>
		     <td width="15%">Section</td>
			 <td width="36%"><select id="section"><?php echo $option;?></select></td>
		   </tr>
		   <tr>
		     <td>Production Amount From</td>
			 <td><input type="text" id="amount_from" class="error"/>
			 <span class="error">This is required field</span></td>
		     <td width="12%" >Product Amount To</td>
			 <td width="37%" ><input type="text" id="amount_to" class="error"/>
			 <span class="error">This is required field</span></td>
		   </tr>		   		   
		   <tr>
		     <td class="col1">Bonus Amount</td>
			 <td class="col2"><input type="text" id="bonus_amount" class="success"/></td>
		   </tr>		   		   
		   <tr>
		     <td class="col1"></td>
			 <td class="col2"><input type="button" id="production_bonus_setting_save" class="btn btn-navy" value="&nbsp;Save&nbsp;"/></td>
		   </tr>		   		   		   		   
		</table>
		
		
	
		
		 <table class="form" id="production_bonus_edit_table" border="0">	
           <input type="hidden" id="serialno_e" value=""/>
		   <input type="hidden" id="company_id_e" value=""/>
		   <input type="hidden" id="entry_date_e" value=""/>
		   <tr>
		     <td width="15%">Section</td>
			 <td width="30%"><select id="section_e"><?php echo $option;?></select></td>
		   </tr>
		   <tr>
		     <td>Production Amount From</td>
			 <td><input type="text" id="amount_from_e" value="" class="error"/>
			 <span class="error">This is required field</span></td>
		     <td>Product Amount To</td>
			 <td><input type="text" id="amount_to_e" value="" class="error" />
			 <span class="error">This is required field</span></td>
		   </tr>		   		   
		   <tr>
		     <td class="col1">Bonus Amount</td>
			 <td class="col2"><input type="text" id="bonus_amount_e" value="" class="success" /></td>
		   </tr>		   		   
		   <tr>
		     <td class="col1"></td>
			 <td class="col2"><input type="button" id="production_bonus_setting_edit_save" class="btn btn-navy" value="&nbsp;Save&nbsp;"/></td>
		   </tr>		   		   		   		   
		</table>				
		<hr/>			   
			<div id="production_bonus_data_table"></div>   
			<div id="production_bonus_data_table_by_section_id"></div>   
        </div>  <!-- end block -->		
		<br/><br/><br/><br/><br/>
    </div>
</div>
<div class="clear"></div>
<div class="clear"></div>