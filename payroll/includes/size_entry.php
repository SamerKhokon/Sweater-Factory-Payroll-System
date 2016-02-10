<?php
session_start();
include('db.php');
?>
<link href="jquery_autocompleter/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script src="jquery_autocompleter/jquery.autocomplete.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function () {		
		setDatePicker('date-picker');
		$('#msg').hide();
		//$("#jq_tbl").load('includes/style_info/style_info_data.php');
		//$("#jq_tbl").load('includes/size_enty/size_info_data_new.php',{'section_id':''},function(){});	
		
		
		

		$("#button1").keydown(function(event){
			if(event.keyCode == 13 )
			{
				var sizeN	=$.trim($('#button1').val().toUpperCase());
				
				// add new row to table using addTableRow function
				//addTableRow($("#newtable"),sizeN);
				// prevent button redirecting to new page
				//return false;
				
				
				var newRow = $("<tr><td><input type='text' name='newsize[]' value='"+sizeN+"' /></td></tr>");
   				$("#newtable").append(newRow);
				$('#button1').val('');
				
			}
		});

		
		$("#style").keydown(function(event){
			if(event.keyCode == 13 ){
			var style 	=$('#style').val();
			var section_id	=$('#section_id').val();
			$("#jq_tbl2").load('includes/size_info/style_size_list.php',{'section_id':section_id,'style':style},function(){});	
			$("#size").focus();
			}
		});	
		
		$("#size").keydown(function(event){
			if(event.keyCode == 13 ){
			$("#quantity").focus();
			}
		});
		
		$("#quantity").keydown(function(event){
			if(event.keyCode == 13 ){$("#rate").focus();}
		});
		
		$("#date-picker").keydown(function(event){
			if(event.keyCode == 13 ){$("#style").focus();}
		});
		
		
		
		$("#section_id").change(function () {
			var section_id =$('#section_id').val();
			$("#style").unbind('.autocomplete').autocomplete("includes/style_info/get_style.php?section_id="+section_id, {
			selectFirst: true
			});
			btn_reset();
			
			//$("#jq_tbl").load('includes/size_enty/size_info_data_new.php',{'section_id':section_id},function(){});			
		});
		
		$("#style").result(function(event, data2, formatted){
		    var style_id 	=data2[1];
			var section_id	=data2[2];
			var style		=$('#style').val();
			$("#jq_tbl2").load('includes/size_info/style_size_list.php',{'section_id':section_id,'style':style},function(){});		 
		});
		
		
		$("#rate").keydown(function(event){
			if(event.keyCode == 13 )
			{
			
				var section_id		=$('#section_id').val();	
				var style			=$.trim($('#style').val());
				var datepicker		=$('#date-picker').val();
				var size			=$.trim($('#size').val());
				var quantity		=$.trim($('#quantity').val());
				var rate			=$.trim($('#rate').val());
				var datastr	 = 'section_id='+section_id+'&style='+style+'&datepicker='+datepicker+'&size='+size+'&quantity='+quantity+'&rate='+rate;
					$.ajax({
						type	:'post',
						url		:'includes/size_info/size_enty_new.php',
						data	:datastr,
						cache	:false,
						success	:function(str)
						{
							//alert(str);
						$("#jq_tbl2").load('includes/size_info/style_size_list.php',{'section_id':section_id,'style':style},function(){});	 
							btn_reset();
						
						}
					});
			}
		});
		
		
		
				
		$('#btn_save').click(function(){
			 	var numReg = /^[0-9]+$/;
				var section_id		=$('#section_id').val();	
				var style			=$.trim($('#style').val());
				var datepicker		=$('#date-picker').val();
				var size			=$.trim($('#size').val());
				var quantity		=$.trim($('#quantity').val());
				var rate			=$.trim($('#rate').val());
				
					
				if(style=='')
				 {
				 	alert('Please Write Style');
					$("#style").focus();
				 } else	{

					var datastr	 = 'section_id='+section_id+'&style='+style+'&datepicker='+datepicker+'&size='+size+'&quantity='+quantity+'&rate='+rate;
					$.ajax({
						type	:'post',
						url		:'includes/size_info/size_enty_new.php',
						data	:datastr,
						cache	:false,
						success	:function(str)	{
							//$('#msg').html(str);
							//$('#msg').show();
							//alert(str);
							//btn_reset();
							$("#jq_tbl2").load('includes/size_info/style_size_list.php',{'section_id':section_id,'style':style},function(){});	 
							btn_reset();
			
						}					
					});		
				}	
		});
		
		$('#btn_edit').live('click',function(){
			var id	=$(this).attr('name');
			$.ajax({
					type:'post' ,
					url: 'includes/size_info/exist_size_list_new.php' ,
					data:'id='+id,
					cache:false ,
					success:function(sst)
					{
					 //alert(sst); 
					  var mystr	=sst.split('!@#$');
					  $('#size').val(mystr[1]);
					  $('#quantity').val(mystr[2]);
					  $('#rate').val(mystr[3]);			  
					}
			});
		});
		
		$('#btn_del').live('click',function(){
			var id	=$(this).attr('name');
			var section_id		=$('#section_id').val();	
			var style			=$.trim($('#style').val());
			
			
			var r=confirm("Are You Sure Delete?");
			var x;
			if (r==true)
			{
				var id = id;
				$.ajax({
					type:'post',
					url:"includes/size_info/delete.php",
					data:'id='+id,
					cache:false,
					success:function(str)
					{
						alert(str);
						
						$("#jq_tbl2").load('includes/size_info/style_size_list.php',{'section_id':section_id,'style':style},function(){});	 
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
function btn_reset(){
	var style			=$('#style').val('');
	var size			=$('#size').val('');
	var quantity		=$('#quantity').val('');
	var rate			=$('#rate').val('');
}
</script> 
<div class="grid_10">
    <div class="box round first fullpage">
        <h2>Size Enty</h2>
        <div class="block " id="block">
         <div class='message info' id="msg">
		 </div>
            <table class="form">
            	
                <tr>
                     <td><label>Date</label></td>
                    <td><input type="text" id="date-picker" class="error" value="<?php echo date('m/d/Y'); ?>" /><span class="error">This is a required field.</span></td>
                    <td><label>Size Name</label></td>
                    <td><input type="text" id="size" class="error" value="" /><span class="error">This is a required field.</span></td>
              	</tr>
                
                
            	<tr>
                    <td><label>Section</label></td>
                  	<td>
                    <select id="section_id" name="section_id" style="width:150px;">
                    <?php
					echo '<option value="">NULL</option>';
                    $company_id	=$_SESSION["company_id"];
                    $sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P' and TBL_PAY_SECTION_INFO.COMPANY_ID=$company_id  order by TBL_PAY_SECTION_INFO.ID";
                    $stid	= mysqli_query($conn, $sql);
                    
                    while($row = mysqli_fetch_array($stid )) 
                    {
                        echo '<option value='.$row[0].'>'.$row[1].'</option>';
                    }
                    ?>
                    </select>
                	</td>
                    <td><label>Quantity</label></td>
                    <td><input type="text" id="quantity" class="error" value="" /><span class="error">This is a required field.</span></td>
              	</tr>
                <tr>
                    <td><label>Style</label></td>
                  	<td><input type="text" id="style" class="error" /><span class="error">This is a required field.</span></td>
                     <td><label>Rate</label></td>
                    <td><input type="text" id="rate" class="error" /></td>
              	</tr>
                <tr>
                	<td align="right" colspan="4"><input type="button" name="btn_save" id="btn_save" value=" &nbsp;&nbsp;Save&nbsp;&nbsp;" class="btn btn-navy" /><input type="button"  name="btn_reset" id="btn_reset" value=" &nbsp;&nbsp;Reset&nbsp;&nbsp;" class="btn btn-blue" onclick="btn_reset()" /></td>
                </tr>
            </table>
      </div>
          <hr />
          
           <div class="box round first grid">
        	<h2>Style Wise Size List</h2>
                <div class="block">
            
                	<div id="jq_tbl2"></div>
              
              	</div>
          </div>
		  <br/><br/><br/>
    </div>	  
</div>
<div class="clear"></div>
<div class="clear"></div>   