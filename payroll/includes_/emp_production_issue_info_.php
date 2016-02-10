<link href="jquery_autocompleter/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script src="jquery_autocompleter/jquery.autocomplete.js" type="text/javascript"></script>
<!--Jquery UI CSS-->
<!--jQuery Date Picker-->

<script type="text/javascript">
$(document).ready(function (){
	//var err	=true;
	setDatePicker('date-picker');
	
	$('#btn_save').click(function(){
	
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
			
			var style_id	=$('#style_id').val();
				if(style_id=='')
				{
					alert('Please select Style');
					$('#style').focus();
				}
				else
				{
					$('#quantity').focus();
				}
		}
	});
			
	$("#quantity").keydown(function(event){
		if(event.keyCode == 13 ){
			var style_id	=$('#style_id').val();
			var size_id		=$('#size_id').val();
			var section_id	=$('#section_id').val();
			var block_name	=$('#block_name').val();
			var datepicker	=$('#date-picker').val();			
			var cardno		=$('#cardno').val();
			var name		=$('#name').val();
			
			var quantity	=parseFloat($('#quantity').val());			
			var datastr	='section_id='+section_id+'&block_name='+block_name+'&datepicker='+datepicker+'&cardno='+cardno+'&name='+name+'&style_id='+style_id+'&size_id='+size_id+'&quantity='+quantity;
			if(section_id==0)
			{
				alert('Please select Section');
					$('#section_id').focus();	
			}
			else if(cardno=='')	{
					alert('Please select Card No');
					$('#cardno').focus();
			}
			else if(style_id=='')	{
					alert('Please select Style');
					$('#style').focus();
			}
			else if(size_id==''){
					alert('Please select Size');
					$('#size').focus();
				}
			else
			{  
				
				//alert(datastr);
				/*var style_id	=$('#style_id').val();
				var size_id		=$('#size_id').val();
				var section_id	=$('#section_id').val();
				var datastr2	='section_id='+section_id+'&style_id='+style_id+'&size_id='+size_id;
				$.ajax({
					type	:'post',
					url		:'includes/emp_production_issue_info/style_issue.php',
					data	:datastr2,
					cache	:false,
					success	:function(str)
						{
						var quantity_issued	=parseInt(str);
						//alert(quantity_issued);
						*/
						/*if(quantity<=quantity_issued)   //for check issue
							{*/
								$.ajax({
									type	:'post',
									url		:'includes/emp_production_issue_info/emp_production_info_enty.php',
									data	:datastr,
									cache	:false,
									success	:function(str2){	
									//alert(str2);
									reset_ajax(); 
									$('#style').focus();
									$("#jq_tbl").load('includes/emp_production_issue_info/emp_production_data.php',{'card_no2':cardno,'section_id':section_id,'en_date':datepicker},function(){});
									}				
								});
							
							/*}
							else
							{
								alert('Your Assign Issue is Greater Than Total Issue');
								$('#quantity').focus();
							}*/			
						/*}
					});*/
			} // end if block
		} // end event
	});
	
	$("#cardno").result(function(event, data, formatted){
		var card_no=data;
		var card_no2	=data[0];
		var section_id	=$('#section_id').val();
		var en_date	=$('#date-picker').val();
		var datastr	='card_no='+card_no+'&section_id='+section_id;
		$.ajax({
			type	:'post',
			url		:'includes/emp_production_issue_info/get_name.php',
			data	:datastr,
			cache	:false,
			success	:function(str)
			{
				var myString = str;	
				var stringParts = myString.split('!@#$');
				$('#name').val(stringParts[0]);
				$('#block_name').val(stringParts[1]);											
				$('#style').focus();
			
			}
		});
		
		$("#jq_tbl").load('includes/emp_production_issue_info/emp_production_data.php',{'card_no2':card_no2,'section_id':section_id,'en_date':en_date},function(){}); 
	});
	/*			
	$("#style").autocomplete("includes/emp_production_issue_info/get_style.php", {
		selectFirst: true
	});
	*/
	 $("#style").unbind('.autocomplete').autocomplete("includes/emp_production_issue_info/get_style.php", {
					cacheLength: 1,
					selectFirst: true
				});
				
	var sid='';
	$("#style").result(function(event, data, formatted){
		$("#style_id").val(data[1]);
		var mystr	='mid='+data[1];
		var section_id	=$('#section_id').val();
		$.ajax({
			type	:'post',
			url		:'includes/emp_production_issue_info/style_id.php',
			data	:mystr,
			cache	:false,
			success	:function(str)
			{
				 sid=str;
				/* 	
				 $("#size").autocomplete("includes/emp_production_issue_info/get_size.php?sid="+sid, {
				  selectFirst: true
				  });
				  */
				  $("#size").unbind('.autocomplete').autocomplete('includes/emp_production_issue_info/get_size.php?sid='+sid+'&section_id='+section_id, {
					cacheLength: 1,
					selectFirst: true
				});
			}
		});
	});	
	
					
	$("#size").result(function(event, data2, formatted){			
		$("#size_id").val(data2[1]);
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
					url:"includes/emp_production_issue_info/delete.php",
					data:'id='+id,
					cache:false,
					success:function(str)
					{
						alert(str);
						
						var datepicker	=$('#date-picker').val();			
						var cardno		=$('#cardno').val();
						var section_id	=$('#section_id').val();
						//alert(cardno);
						$("#jq_tbl").load('includes/emp_production_issue_info/emp_production_data.php',{'card_no2':cardno,'section_id':section_id,'en_date':datepicker},function(){});
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
<script>
var sec_id2='';
function get_block(sec_id)
{
	var datastr	='sec_id='+sec_id;
	$.ajax({
			type	:'post',
			url		:'includes/emp_production_issue_info/get_block.php',
			data	:datastr,
			cache	:false,
			success	:function(str)
			{
				
				var stringParts = str.split('!@#$');
				
				$('#block_id').html(stringParts[0]);
				sec_id2	=parseInt(stringParts[1]);
			
				$("#cardno").unbind('.autocomplete').autocomplete("includes/emp_production_issue_info/get_code_num.php?sec_id="+sec_id2, {
					cacheLength: 1,
					selectFirst: true
				});
				
			}
			
		});
		reset_btn();

}
function reset_btn()
	{
		var cardno		=$('#cardno').val('');
		var name		=$('#name').val('');
		var style		=$('#style').val('');
		var size		=$('#size').val('');
		var quantity	=$('#quantity').val('');
		var style_id	=$('#style_id').val('');
		var size_id		=$('#size_id').val('');
	}
function reset_ajax()
	{
		var style		=$('#style').val('');
		var size		=$('#size').val('');
		var quantity	=$('#quantity').val('');
		var style_id	=$('#style_id').val('');
		var size_id		=$('#size_id').val('');
	}

</script>  
<div class="grid_10">
    <div class="box round first fullpage">
       <h2>Employee Production Issue</h2>

	   <div class="block ">
    
            <table  class="form">
                <tr>
                    <td><label>Section</label></td>
                    <td>
                    <select id="section_id" name="section_id" onchange="get_block(this.value)" style="width:150px;">
                    <option value="0">None</option>
                    <?php
					$company_id	=$_SESSION["company_id"];
                    $sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P' and TBL_PAY_SECTION_INFO.COMPANY_ID=$company_id  order by TBL_PAY_SECTION_INFO.ID";
                    $stid	= oci_parse($conn, $sql);
                    oci_execute($stid);
                    
                    while(($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))) 
                    {
                    	echo '<option value='.$row[0].'>'.$row[1].'</option>';
                    }
                    ?>
                    </select>
                    </td>
                    <td><label>Block/Line</label></td>
                    <td><div id="block_id">
                    <select name="block_id" style="width:150px;">
                    	<option value="0">None</option>
                    </select>
                    </div></td>
                    <td><label>Date</label></td>
                    <td>
                    <input type="text" id="date-picker" class="error" value="<?php echo date('m/d/Y'); ?>" /></td>
                </tr>
            </table>
       
     <hr />
	  
           <div id="details">
            <table  class="form">
  				<tr>
                    <td><label>Card No</label></td>
                    <td><input type="text" id="cardno" class="error" /><span class="error">This is a required field.</span></td>
                    <td><label>Style</label></td>
                    <td><input type="text" name="style" id="style" class="error" /><input type="hidden" name="style_id2" id="style_id" /><span class="error">This is a required field.</span></td>	
                
                </tr>
                <tr>
                    <td><label>Name</label></td>
                    <td><input type="text" id="name" class="error" readonly="readonly"  /><span class="error">This is a required field.</span></td>  
                    <td><label>Size</label></td>
                    <td><input type="text" name="size" id="size" class="error" /><input type="hidden" name="size_id2" id="size_id" /><span class="error">This is a required field.</span></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td><label>Quantity</label></td>
                    <td><input type="text" id="quantity" class="error" /><span class="error">This is a required field.</span></td>
                </tr>
                <tr>
                    <td colspan="4" align="right"><input type="button" name="btn_save" id="btn_save" value=" &nbsp;&nbsp;Save&nbsp;&nbsp;" class="btn btn-navy" /><input type="button" name="btn_reset" id="btn_reset" value=" &nbsp;&nbsp;Reset&nbsp;&nbsp;" class="btn btn-blue" onclick="reset_btn()" /></td>
                </tr>
            </table>
		
         </div>
        </div>
        
        <div class="box round first grid">
        <h2>Employee Production Issue Data</h2>
        	<div class="block">
				<div id ="jq_tbl"></div>
	   		</div>
       </div>
      </div>
    </div>

<div class="clear"></div>
<div class="clear"></div> 
<?php
oci_free_statement($stid);
oci_close($conn);
?>  