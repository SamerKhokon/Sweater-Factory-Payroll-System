<?php
    $company_id	=$_SESSION["company_id"];			
	$sql	="SELECT ID,SEC_NAME FROM TBL_PAY_SECTION_INFO where COMPANY_ID=$company_id";
	$stid	= oci_parse($conn, $sql);
	oci_execute($stid);
	$option = "<option value=''>select section type</option>";	
	while($row = oci_fetch_array($stid, OCI_BOTH)) {
	   $option .= '<option value='.$row[0].'>'.$row[1].'</option>';
	}	
?>
<!-- popup window -->
<link rel="STYLESHEET" type="text/css" href="create_section/popup_css/popup-contact.css" />
<script type='text/javascript' src="create_section/popup_js/fg_moveable_popup.js"></script>

<div class="grid_10" id="grid_10">
    <div class="box round first fullpage">
        <h2>Section Info</h2>
        <div class="block" id="block">
		   <table class="form">
		      <tr>
			     <td><label>Search by Section</label>
			     <select id="section_type" style="width:150px;"><?php echo $option ; ?> </select>
			     </td>
				
			  </tr>	                  			  
		   </table>	
		   <div  id="section_info_display"></div>	
		       <!-- <input type="text" id="block_name_" value=""/> -->
        </div>  <!-- end block -->
		
		
		<!-- popup div -->
		<div id='fg_formContainer'></div>
		<div id='fg_backgroundpopup'></div>

		
	<br/><br/><br/>	
    </div>	
</div>
<div class="clear"></div>
<div class="clear"></div>
<script type="text/javascript">
$(document).ready(function(){  

	$("#section_type").change(function(event){ 
	
		var section_type = $('#section_type').val();
		if(section_type!="") {
			$('#section_info_display').load('create_section/section_search.php',
			{'secid':section_type},function(){});  
		}
	});
});
</script>
<?php
oci_free_statement($stid);
oci_close($conn);
?>