<!--Jquery UI CSS-->
<!--jQuery Date Picker-->
<link href="css/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>

<!-- for table grid-->       
<style type="text/css" title="currentStyle">
@import "../../../media/css/demo_page.css";
@import "../../../media/css/demo_table.css";
</style>
<script type="text/javascript" language="javascript" src="../../../media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../../../media/js/jquery.dataTables.js"></script>
<link href="jquery_autocompleter/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script src="jquery_autocompleter/jquery.autocomplete.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function () {
	
		$("#section_id").change(function(event){
			var section_id	=$('#section_id').val();
			$("#jq_tbl").load('includes/size_info/size_info_data.php',{'section_id':section_id},function(){});
			});
			
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
			$("#rquantity").focus();
			}
		});
		$("#rquantity").keydown(function(event){
			if(event.keyCode == 13 )
			{
				var section_id	=$('#section_id').val();
				var style_id	=$('#style_id').val();
				var size_id		=$('#size_id').val();
				var rate		=$('#rate').val();
				var quantity	=$('#quantity').val();
				var size		=$('#size').val();
				var status		=$('#status').val();
				var rquantity	=$('#rquantity').val();
				var datastr	='section_id='+section_id+'&style_id='+style_id+'&size_id='+size_id+'&rate='+rate+'&quantity='+quantity+'&size='+size+'&status='+status+'&rquantity='+rquantity;
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
		
		
	
		$('#msg').hide();
		$("#jq_tbl").load('includes/size_info/size_info_data.php',{'section_id':0},function(){});
	
		$('#btn_save').live('click',function(){
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

	});
	
	$("#size").result(function(event, data2, formatted){
					
		$("#size_id").val(data2[1]);
		$('#rate').focus();
	});	
		
		$('#btn_edit').live('click',function(){
			var id	=$(this).attr('name');
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
					$('#rquantity').val(stringParts[7]);
					$('#restqty').val(stringParts[8]);
					$('#status').val('edit');
				}			
			});
		
		});
		
});
</script>
<script>
function btn_reset()
{
	var section_id	=$('#section_id').val(0);
	var size		=$('#size').val('');
	var style		=$('#style').val('');
	var style_id	=$('#style_id').val('');
	var size_id		=$('#size_id').val('');
	var rate		=$('#rate').val('');
	var quantity	=$('#quantity').val('');
	var status		=$('#status').val('');
	var rquantity	=$('#rquantity').val('');
	var restqty	=$('#restqty').val('');
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
        <h2>Size and Rate Info</h2>
        <div class="block " id="block">
        <div class='message info' id="msg">
		 </div>
        <table class="form">
            <tr>
                <td><label>Section</label></td>
                <td>
                <select id="section_id" name="section_id" style="width:150px;">
                <option value="0">None</option>
                <?php
                $sql	="select ID,SEC_NAME from TBL_PAY_SECTION_INFO order by ID";
                $stid	= mysql_query( $sql);
                
                
                while($row = mysql_fetch_array($stid)) 
                {
                	echo '<option value='.$row[0].'>'.$row[1].'</option>';
                }
                ?>
                </select>
                </td>
                <td><label>Style</label></td>
                <td><input type="text" name="style" id="style" class="error" /><input type="hidden" name="style_id2" id="style_id" /><span class="error">*</span></td>
                <td>
                <label>Size</label>
                </td>
                <td>
                <input type="text" name="size" id="size" class="error" /><input type="hidden" name="size_id2" id="size_id" /><span class="error">*</span></td>
            </tr>
            <tr>
                <td><label>Rate</label>                    </td>
                <td><input type="text" id="rate" class="success" value="0"  /></td>
                <td><label>Order Quantity</label></td>
                <td><input type="text" id="quantity" class="success" value="0" readonly="readonly" size="8"  /><label>Rest Quantity</label><input type="text" id="restqty" class="success" value="0" readonly="readonly" size="8"  /><span class="success"></span></td>
                <td><label>Quantity</label></td><td><input type="text" id="rquantity" class="success" /><input type="hidden" id="status" /></td>
            </tr>
            <tr>
            	<td colspan="6" align="right"><input type="button" name="btn_save" id="btn_save" value=" &nbsp;&nbsp;Update&nbsp;&nbsp;" class="btn btn-navy" /><input type="button"  name="btn_reset" id="btn_reset" value=" &nbsp;&nbsp;Reset&nbsp;&nbsp;" class="btn btn-blue" onclick="btn_reset()" /></td>
            </tr>
        </table>
          </div>
          <div class="box round first grid">
        <h2>
            Rate Info Data</h2>
        <div class="block">
        
           <div id="jq_tbl"></div>
           <br /><br /><br />
          </div>
         </div>
    </div>
</div>
<div class="clear"></div>
<div class="clear"></div>
