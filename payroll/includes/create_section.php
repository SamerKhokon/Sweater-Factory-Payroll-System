<?php
session_start();
include('db.php');
?>
<!-- sequential step javascript library -->

<!--<script type="text/javascript" src="js/jquery.min.js"></script> 
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<script src="js/formwizard.js" type="text/javascript"></script>

<script type="text/javascript">
// sequential step js
var myform=new formtowizard({
	formid: 'feedbackform',
	persistsection: true,
	revealfx: ['slide', 500]
})
</script>-->
<?php    
	$sql	="select id,type_name from TBL_PAY_SECTION_TYPE order by id";
	$stid	= mysqli_query( $conn,$sql);
	
	$option = "<option>select section type</option>";	
	while(($row = mysqli_fetch_array($stid))) {
	   $option .= '<option value='.$row[0].'>'.$row[1].'</option>';
	}	
	
    $section_str = "select MAX(ID) from TBL_PAY_SECTION_INFO";
	$section_stm = mysqli_query($conn,$section_str);	
	
    while($last_row = mysqli_fetch_array($section_stm)){	
	    $last_section_id = $last_row['MAX(ID)'];
	}	
	//oci_free_statement($section_stm);	
?>
<script type="text/javascript">
$(document).ready(function(){
	//alert('');
    $('#section_name_english').keypress(function(ex){
	    if(ex.which==13) {
		   $.ajax({
		     type:'post' ,
			 url:'create_section/section_check.php' ,
			 data:'section_name='+$('#section_name_english').val(),
			 cache:false ,
			 success:function(st) {			    
			   if(st==1) {
			      alert('Section already exist!');
			   }else{
			      $('#section_name_bangla').focus();
			   }
			 }
		   });		  
		}
	});
    $("#blockListAdd").click(function(){
		alert('dd');
		var block_line = $('#block_line').val();		
		var block_line_ar = [];
		$('#blocklist option').each(function(){ 
				 block_line_ar.push($(this).text());
				 $('#block_line').val('');
		});			
		var pos = $.inArray(block_line,block_line_ar);
			// for checking duplicacy
		if(pos==-1){		
			$('<option value="'+block_line+'" >'+block_line+'</option>').appendTo('#blocklist');
			block_line_ar.push(block_line);	 
		}					
	});
	
	$('#block_line').keypress(function(ex){
	   if(ex.which==13) {
		var block_line = $('#block_line').val();		
		var block_line_ar = [];
		$('#blocklist option').each(function(){ 
			block_line_ar.push($(this).text());
		    $('#block_line').val('');
		});
		$('#block_line').val('');
				
		var pos = $.inArray(block_line,block_line_ar);
		if(pos==-1){		
			$('<option value="'+block_line+'" >'+block_line+'</option>').appendTo('#blocklist');
			block_line_ar.push(block_line);	 
		}				 
       }		
	});	
	
	$('#dyn_button').click(function(){
	       var last_section_id      = $('#last_section_id').val();
	       var section_name_english = $('#section_name_english').val();
		   var section_name_bangla  = $('#section_name_bangla').val();
		   var section_type         = $('#section_type').val();
		   var list = [];
		   
		   $('#blocklist option').each(function(){
			   list.push($(this).text());
		   });	 	 
		   var txtbox = [];
		   $('.txt').each(function(){
		        var vl = $(this).val();		       
			    txtbox.push($(this).val());
				
		   });
		   var sels = [];
		   $('.chk option:selected').each(function(){
			  sels.push($(this).val());
		   });
		   
		   var section_alowence = [];
		   $('.section_alowence_id').each(function(){
		      section_alowence.push($(this).val());
		   });
		   
		   var dataStr = 'last_section_id='+last_section_id+'&section_name_english='+section_name_english+'&section_name_bangla='+section_name_bangla+'&section_type='+section_type+'&list='+list+'&textbox='+txtbox+'&selecbox='+sels+'&alowences='+section_alowence;	 	

			$.ajax({ 
				type:'post',
				url:'create_section/section_steps_entry.php',
				data:dataStr,
				cache:false ,
				success:function(st){
				   alert(st);
				   location.href = "?pagetitle=create_section&menu_id=24&sm_id=24";
				}
			}); 							
		   //alert(dataStr);
		   //location.reload();
	});
  });
function removeOption(combo_id) {
	if(document.getElementById(combo_id).options.length==0)
		return;
	var x = document.getElementById(combo_id);
	x.remove(x.selectedIndex);		
}
</script>
<div class="grid_10" id="grid_10">
    <div class="box round first fullpage">
        <h2>Section Create</h2>
        <div class="block" id="block">
		<!-- sequential step start here -->
		    <input type="hidden" id="last_section_id" value="<?php echo ($last_section_id+1);?>"/>
			<form id="feedbackform">
				
				<!-- step one -->
				<fieldset class="sectionwrap">
				<legend>Section Information</legend>
					<table class="form">
						<tr>
							<td class="col1">Section Name(English):</td>
							<td class="col2"><input id="section_name_english" type="text" size="35" class="error" /></td>
						</tr>
						<tr>
							<td class="col1">Section Name(Bangla):</td>
							<td class="col2"><input id="section_name_bangla" type="text" size="35" class="success" /></td>
						</tr>
						<tr>
							<td class="col1">Section Type: 	</td>
							<td class="col2">						
							<select id="section_type" class="error"><?php echo $option;?></select>
							</td>
						</tr>
					</table>
				</fieldset>
				<!-- step two -->
				<fieldset class="sectionwrap">
				<legend>Section Block</legend>
					<table class="form">
						<tr>
							<td class="col1">Block/Line:</td>
							<td class="col2"><input id="block_line" type="text" class="error" /></td>
							<td><input type="button" id="blockListAdd" value="Add" class="btn btn-teal" style="height:25px;"/></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><select id="blocklist" style="width:150px;"  multiple="multiple"></select><br /><input name="del" value="Remove" type="button" onclick="removeOption('blocklist');" style="height:25px;" class="btn btn-red" /></td>
						</tr>
					</table>
				</fieldset>
			<!-- step three -->
				<fieldset class="sectionwrap">
				<legend>Allowences</legend>
					<table class="form"  id="dynamic_data_table">
					  <?php  
						$dynamic_form_str = "SELECT ID,HEAD_NAME FROM TBL_PAY_SECTION_ALLOWENCE_HEAD";   
						$dynamic_form_stm = mysqli_query($conn,$dynamic_form_str);
						
						while($rs = mysqli_fetch_array($dynamic_form_stm)){
						if($rs['ID']==165 || $rs['ID']==166)
						{
							$disabl	='disabled="disabled"';
						}
						else
						{
							$disabl	='';
						} 	   					  
					  ?>
					  <tr>					  
						<td  >
						<input type="hidden" class='section_alowence_id' id="<?php echo $rs['ID'];?>" value="<?php echo $rs['ID'];?>" /><?php echo $rs['HEAD_NAME'];?></td>
						<td><input type="text" class="txt" /></td>
						<td>
							<select class="chk">
								<option value="BASIC">BASIC</option>
								<option value="GROSS" <?php echo $disabl; ?> >GROSS</option>
							</select>
						</td>						
					  </tr>
					  <?php } ?>
					  
					  <tr><td colspan="3"><input type="button" id="dyn_button" class="btn btn-navy" value="&nbsp;&nbsp;Save&nbsp;&nbsp;"/></td></tr>
					  
					</table>				
				</fieldset>
				</form>			
				<!-- sequential step end here -->
				<br/><br/><br/>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="clear"></div>