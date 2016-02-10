<?php
	$company_id	=$_SESSION["company_id"];	 
    $section_str = "SELECT ID,SEC_NAME FROM TBL_PAY_SECTION_INFO  where COMPANY_ID=$company_id";
    $section_stm = oci_parse($conn,$section_str);
    oci_execute($section_stm);
	$option = '<option value="">select any section</option>';
    while ($rs = oci_fetch_array($section_stm,OCI_BOTH)) {
	    $option .= '<option value="'.$rs[0].'">'.$rs[1].'</option>';
	}   	
?>	
<script type="text/javascript">

	$(document).ready(function(){	
			

	   $('#section').change(function(){
	   	    var section_id = $('#section').val();
	       	if(section_id!="") {
			   $('#stamp_data').load('create_section/stamp_data.php',
			   {'section_id':section_id},function(){});
		   }
	   });
	   
	   
	   
	   
	   $("#stamp").keydown(function(event){
		  var stamp = $("#stamp").val();
	      if(event.keyCode == 13) {		      
			  if(stamp=="") {
			    alert('enter stamp amount');
				$('#stamp').focus();
				return false;
			  }else if(!flt.test(bonus_amount)){
			    alert('invalid stamp amount');
				$('#stamp').focus();
				return false;			  
			  }
			  else{
					var section=$("#section").val();
					var stamp  = $("#stamp").val();
					var dataStr ='section='+section+'&stamp='+stamp;		
					alert(dataStr);
					$.ajax({
					  type:'post' ,
					  url:'create_section/stamp_amount.php',
					  data:dataStr,
					  cache:false ,
					  success:function(st){
					  	alert('Stamp Amnt Set Successfull');
						$("#stamp").val(''); 							
					  }
					});				 
					$("#stamp").focus();
			  }
		  }
	   });
	   
	   $('#stamp_save').click(function(){	   
		    var section      =$("#section").val();
			var stamp  		 =$("#stamp").val();

			if(section!="") {
				var dataStr ='section='+section+'&stamp='+stamp;			
				
				$.ajax({
				  type:'post' ,
				  url:'create_section/stamp_amount.php',
				  data:dataStr,
				  cache:false ,
				  success:function(st){
					 alert('Stamp Amnt Set Successfull');
						$('#stamp_data').load('create_section/stamp_data.php',
			   			{'section_id':section},function(){});
					 $("#stamp").val('');
					 $("#stamp").focus(); 			     
				  }
				});
			}else{
			   alert('Please select any section');
			}
			$('#stamp').focus();
	   });
	});
</script>
<div class="grid_10" id="grid_10">
    <div class="box round first fullpage">
        <h2>Stamp Setting</h2>
        <div class="block" id="block">
				
		<!-- entry table -->
		<table class="form" id="festival_bonus_entry_table" border="1">
		   <tr>
		     <td><label>Section</label></td>
			 <td><select id="section" style="width:150px;"><?php echo $option;?></select></td>
             <td><label>Stamp</label></td>
			 <td ><input type="text" id="stamp" class="error"/>
		   </tr>
		   <tr>
			 <td colspan="4" align="right"><input type="button" id="stamp_save" class="btn btn-navy" value="&nbsp;&nbsp;Save&nbsp;&nbsp;"/></td>
		   </tr>		   		   		   		   
		</table>	
		<hr/>
			<div id="stamp_data"></div>
		</div>
    </div>
</div>
<div class="clear"></div>
<div class="clear"></div>