<link href="jquery_autocompleter/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script src="jquery_autocompleter/jquery.autocomplete.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function () {
	
		$('#msg').hide();
		var section_id=0;
		$("#jq_tbl").load('includes/size_info/size_info_data.php',{'section_id':section_id},function(){});
	
		$("#date-picker").keydown(function(event){
			if(event.keyCode == 13 )
				{
					$("#style").focus();
				}	
				
			});
			
		$("#style").keydown(function(event){
		if(event.keyCode == 13 )
			{
				$('#size').focus();
			}
		});
		$("#size").keydown(function(event){
		if(event.keyCode == 13 )
			{
				$('#rate').focus();
			}
		});
		$("#rate").keydown(function(event){
			if(event.keyCode == 13 )
			{
				var section_id	=$('#section_id').val();
				var style_id	=$('#style_id').val();
				var size_id		=$('#size_id').val();
				var rate		=$('#rate').val();
				var quantity	=$('#quantity').val();
				var size		=$('#size').val();
				var status		=$('#status').val();
				var datastr	='section_id='+section_id+'&style_id='+style_id+'&size_id='+size_id+'&rate='+rate+'&quantity='+quantity+'&size='+size+'&status='+status;
				if(section_id==0)
				{
					alert('Please Select Section');
					$("#section_id").focus();
				}
				else if(style_id=='')
				{
					alert('Please Fill Style');
					$("#style").focus();
				}
				else if(size_id=='')
				{
					alert('Please Fill Size');
					$("#size").focus();
				}
				else
				{
				$.ajax({
					type	:'post',
					url		:'includes/size_info/size_info_enty.php',
					data	:datastr,
					cache	:false,
					success	:function(str)
						{
							$('#msg').html(str);
							$('#msg').show();
							btn_reset();
							$("#jq_tbl").load('includes/size_info/size_info_data.php',{'section_id':section_id},function(){});
						}
				
					});
				}
			
			}
		});
	
		$('#btn_save').live('click',function(){
		
				var section_id	=$('#section_id').val();
				var style_id	=$('#style_id').val();
				var size_id		=$('#size_id').val();
				var rate		=$('#rate').val();
				var quantity	=$('#quantity').val();
				var size		=$('#size').val();
				var status		=$('#status').val();
				var datastr	='section_id='+section_id+'&style_id='+style_id+'&size_id='+size_id+'&rate='+rate+'&quantity='+quantity+'&size='+size+'&status='+status;
				if(section_id==0)
				{
					alert('Please Select Section');
					$("#section_id").focus();
				}
				else if(style_id=='')
				{
					alert('Please Fill Style');
					$("#style").focus();
				}
				else if(size_id=='')
				{
					alert('Please Fill Size');
					$("#size").focus();
				}
				else
				{
				$.ajax({
					type	:'post',
					url		:'includes/size_info/size_info_enty.php',
					data	:datastr,
					cache	:false,
					success	:function(str)
						{
							$('#msg').html(str);
							$('#msg').show();
							btn_reset();
							$("#jq_tbl").load('includes/size_info/size_info_data.php',{'section_id':section_id},function(){});
						}
				
					});
				}
		
		});
		
	$("#style").autocomplete("includes/emp_production_info/get_style.php", {
		selectFirst: true
	});
		
	var sid='';
	$("#style").result(function(event, data, formatted) {
		$("#style_id").val(data[1]);
		var mystr	='mid='+data[1];
		$.ajax({
			type	:'post',
			url		:'includes/emp_production_info/style_id.php',
			data	:mystr,
			cache	:false,
			success	:function(str)
			{
				 sid=str;	
				 $("#size").autocomplete("includes/emp_production_info/get_size.php?sid="+sid, {
				  selectFirst: true
				  });
				
				
			}
		});
		var section_id	=$('#section_id').val();
		$("#jq_tbl").load('includes/size_info/size_info_data.php',{'section_id':section_id},function(){});

	});
	
	$("#size").result(function(event, data2, formatted){
					
		$("#size_id").val(data2[1]);
		var style_id	=$('#style_id').val();
		var size_id		=$('#size_id').val();
		var section_id	=$('#section_id').val();
		var datastr		='section_id='+section_id+'&style_id='+style_id+'&size_id='+size_id;
		$.ajax({
			type	:'post',
			url		:'includes/size_info/style_data.php',
			data	:datastr,
			cache	:false,
			success	:function(str)
			{	
				var myString = str;
				var stringParts = myString.split('!@#$');
				$('#rate').val(stringParts[0]);
				$('#quantity').val(stringParts[1]);			
			}
		});
		
		
		$('#rate').focus();
	});	
		
		$('#btn_edit').live('click',function(){
			var id		=$(this).attr('name');
			var datastr	='id='+id;
			$.ajax({
				type	:'POST',
				url		:'includes/size_info/size_info_edit.php',
				data	:datastr,
				cache	:false,
				success	:function(str)
				{
					var myString = str;
					var stringParts = myString.split('!@#$');
					var iid	=parseInt(stringParts[0]);
					$('#section_id').val(iid);
					$('#style_id').val(stringParts[1]);
					$('#size_id').val(stringParts[2]);
					$('#rate').val(stringParts[3]);
					$('#style').val(stringParts[4]);
					$('#size').val(stringParts[5]);
					$('#quantity').val(stringParts[6]);
					$('#status').val('edit');
				}			
			});
		
		});
		
});
function get_changedate()
{
	var section_id	=$('#section_id').val();
	$("#jq_tbl").load('includes/size_info/size_info_data.php',{'section_id':section_id},function(){});
}
</script>
<script>
function btn_reset()
{
	var size		=$('#size').val('');
	var style		=$('#style').val('');
	var style_id	=$('#style_id').val('');
	var size_id		=$('#size_id').val('');
	var rate		=$('#rate').val('');
	var quantity	=$('#quantity').val('');
	var status		=$('#status').val('');
	$('#style').focus();	
}
</script>
<!-- /TinyMCE -->
<style type="text/css">
	#progress-bar
	{
		width: 400px;
	}
</style>
 
<div class="grid_10">
    <div class="box round first fullpage">
        <h2>Rate Info</h2>
        <div class="block " id="block">
        <div class='message info' id="msg">
		 </div>
        <table class="form">
            <tr>
                <td width="53"><label>Section</label></td>
              <td width="151">
                <select id="section_id" name="section_id" style="width:120px;" onchange="get_changedate()">
                <option value="0">None</option>
                <?php
                $sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P'  order by TBL_PAY_SECTION_INFO.ID";
                $stid	= oci_parse($conn, $sql);
                oci_execute($stid);
                
                while(($row = oci_fetch_array($stid, OCI_BOTH))) 
                {
                	echo '<option value='.$row[0].'>'.$row[1].'</option>';
                }
                ?>
                </select>
                </td>
              <td width="51"><label>Style</label></td>
              <td width="332"><input type="text" name="style" id="style" class="error" /><input type="hidden" name="style_id2" id="style_id" /><span class="error">This is a required field.</span></td>
              <td width="29"><label>Size</label></td>
              <td width="331">
              <input type="text" name="size" id="size" class="error" /><input type="hidden" name="size_id2" id="size_id" /><span class="error">This is a required field.</span></td>
          </tr>
            <tr>
            	<td colspan="2"></td>
                <td><label>Quantity</label></td>
                <td><input type="text" id="quantity" class="success" value="0" readonly="readonly"  /></td>
                <td><label>Rate</label></td>
                <td><input type="text" id="rate" class="success" value="0"  /><span class="success">Add option Rate</span><input type="hidden" id="status" /></td>
            </tr>
            <tr>
            	<td colspan="6" align="right"><input type="button" name="btn_save" id="btn_save" value=" &nbsp;&nbsp;Update&nbsp;&nbsp;" class="btn btn-navy" /><input type="button"  name="btn_reset" id="btn_reset" value=" &nbsp;&nbsp;Reset&nbsp;&nbsp;" class="btn btn-blue" onclick="btn_reset()" /></td>
            </tr>
        </table>
          </div>
          <div class="box round first grid">
        	<h2>Rate Info Data</h2>
        	<div class="block">
        
           	<div id="jq_tbl"></div>
           
          </div>
         </div>
    </div>
</div>
<div class="clear"></div>
<div class="clear"></div>