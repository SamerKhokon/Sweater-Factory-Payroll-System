<link href="jquery_autocompleter/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script src="jquery_autocompleter/jquery.autocomplete.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function () {		
		setDatePicker('date-picker');
		$('#msg').hide();
		//$("#jq_tbl").load('includes/style_info/style_info_data.php');
		$("#jq_tbl").load('includes/size_enty/size_info_data_new.php',{'section_id':''},function(){});		
		
		$("#style").keydown(function(event){
			if(event.keyCode == 13 ){
			$('#sizeNM option').remove();
			$('#sizeQN option').remove();
			$("#txt").focus();
			btn_reset2();
			}
		});	
		$("#txt").keydown(function(event){
			if(event.keyCode == 13 ){$("#txt1").focus();}
		});
				
		$("#txt1").keydown(function(event){
			if(event.keyCode == 13 ){
				var txt = $.trim($('#txt').val().toUpperCase());
				var txt1 = $.trim($('#txt1').val());
				if(txt!='')
				{
					if(txt1=='')
						txt1=0;	
					var ar = [];
					var qr = [];
					$('#sizeNM option').each(function(){
					  
					   ar.push($(this).text());
					   $('#txt').val('');
					});
					$('#sizeQN option').each(function(){
					  
					   qr.push($(this).text());
					   $('#txt1').val('');
					});
					
					$('#txt').val('');
					$('#txt1').val('');
					var pos = $.inArray(txt,ar);						
					if(pos==-1) {
						$('<option value="'+txt+'" >'+txt+'</option>').appendTo('#sizeNM');
						$('<option value="'+txt1+'" >'+txt1+'</option>').appendTo('#sizeQN');
						ar.push(txt);
						qr.push(txt1);
					} 
					$("#txt").focus();
				}
			}
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
			
			$("#jq_tbl").load('includes/size_enty/size_info_data_new.php',{'section_id':section_id},function(){});			
		});
		
		$("#style").result(function(event, data2, formatted){
		    var st 			=data2[1];
			var section_id	=data2[2];
			var datastr	='style_id='+st+'&section_id='+section_id;
			$.ajax({
			   type:'post' ,
			   url: 'includes/style_info/exist_size_list.php' ,
			   data:datastr,
			   cache:false ,
			   success:function(sst){
			   	  var mystr	=sst.split('!@#$');
				  var sst2 =$.trim(mystr[0]);
				  if(sst2!='')
				  {
					  var parse = sst2.split(',');
					  var length = parse.length;
					  var str = "";
					  for(i=0 ; i<length ; i++){
						  str += "<option value='"+$.trim(parse[i])+"'>";
						  str += ""+$.trim(parse[i])+"</option>"; 					
						}				  				  
					  $('#sizeNM').append(str);
					  
				  }
				  var str2 = "";				  
				  var qtsize=$.trim(mystr[12]);
				  if(qtsize!='')
				  { 
					  var parse1 = qtsize.split(',');
					  var length2 = parse1.length;
					  for(i=0 ; i<length2 ; i++){
						  str2 += "<option value='"+$.trim(parse1[i])+"'>";
						  str2 += ""+$.trim(parse1[i])+"</option>"; 					
						}				  				  
					  $('#sizeQN').append(str2);
				  }
			   }
			});			 
		});	
				
		$('#btn_save').click(function(){
			 	var numReg = /^[0-9]+$/;
				var section_id		=$('#section_id').val();	
				var style			=$.trim($('#style').val());
				var datepicker		=$('#date-picker').val();
				var sizeNMarr       = [];
				$('#sizeNM option').each(function(){
					sizeNMarr.push($(this).text());
				});
				var sizeQty       = [];
				$('#sizeQN option').each(function(){
					sizeQty.push($(this).text());
				});
					
				if(style=='')
				 {
				 	alert('Please Write Style');
					$("#style").focus();
				 } else	 {

					var datastr	 = 'section_id='+section_id+'&style='+style+'&datepicker='+datepicker+'&sizeNMarr='+sizeNMarr+'&sizeQty='+sizeQty;
					$.ajax({
						type	:'post',
						url		:'includes/style_info/style_info_enty_new.php',
						data	:datastr,
						cache	:false,
						success	:function(str)	{
							$('#msg').html(str);
							$('#msg').show();
							btn_reset();
							//$("#jq_tbl").load('includes/style_info/style_info_data.php');
							$("#jq_tbl").load('includes/size_enty/size_info_data_new.php',{'section_id':section_id},function(){});
						}					
					});		
				}	
		});
		
		
		$('#btn_edit').live('click',function(){
			var id	=$(this).attr('name');
			$.ajax({
					type:'post' ,
					url: 'includes/style_info/exist_size_list.php' ,
					data:'style_id='+id,
					cache:false ,
					success:function(sst)
					{
					  $('#sizeNM option').remove();
					  var mystr	=sst.split('!@#$');
					  var sst2 =mystr[0];
					  var parse = sst2.split(',');
					  var length = parse.length;
					  var str = "";
					  for(i=0 ; i<length ; i++){
						  str += "<option value='"+$.trim(parse[i])+"'>";
						  str += ""+$.trim(parse[i])+"</option>"; 					
						}				  				  
					  $('#sizeNM').append(str);
					  $('#quantity').val(mystr[1]);
					  $('#buyer_name').val(mystr[2]);
					  $('#u_price').val(mystr[3]);
					  $('#merchendiser_name').val(mystr[4]);
					  $('#gauge').val(mystr[5]);
					  $('#mach_qty').val(mystr[6]);
					  $('#bstyle_name').val(mystr[7]);
					  $('#shipment_st').val(mystr[8]);
					  $('#shiping_date').val(mystr[9]);
					  $('#add_qty').val(mystr[10]);	
					  $.trim($('#style').val(mystr[11]));
					  $('#sizeQN option').remove();
					  var qtsize=mystr[12]; 
					  var parse1 = qtsize.split(',');
					  var length2 = parse1.length;
					  var str2 = "";
					  for(i=0 ; i<length2 ; i++){
						  str2 += "<option value='"+$.trim(parse1[i])+"'>";
						  str2 += ""+$.trim(parse1[i])+"</option>"; 					
						}				  				  
					  $('#sizeQN').append(str2);				  
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
					url:"includes/size_info/delete.php",
					data:'id='+id,
					cache:false,
					success:function(str)
					{
						alert(str);
						$("#jq_tbl").load('includes/size_enty/size_info_data_new.php',{'section_id':''},function(){});
					}
				});
			}
			else
			{
				x="Cancel!";
			} 
		});
		
		$('#btn22').click(function(){		
			var txt = $.trim($('#txt').val());
			if(txt!='')
			{
				var ar = [];
				$('#sizeNM option').each(function(){
					ar.push($(this).text());
				});
				$('#txt').val('');
				var pos = $.inArray(txt,ar);			
				if(pos==-1){
				   $('<option value="'+txt+'" >'+txt+'</option>').appendTo('#sizeNM');
				   ar.push(txt);	 
				}
			} 
		});		
	});
</script>
<script>
function btn_reset(){
	var style			=$('#style').val('');
	var txt				=$('#txt').val('');
	var txt1				=$('#txt1').val('');
	var sizeNM	    	= $('#sizeNM option').remove();
	var sizeQN	    	= $('#sizeQN option').remove();
}
function btn_reset2(){
	var txt			=$('#txt').val('');
	var txt1		=$('#txt1').val('');
	var sizeNM	    	=$('#sizeNM option').remove();
	var sizeQN	    	=$('#sizeQN option').remove();
}
function removeOption(combo_id,combo_id2){
	if(document.getElementById(combo_id).options.length==0)
		return;
	var x=document.getElementById(combo_id);
	var y=document.getElementById(combo_id2);
	//var z = y.options[x.selectedIndex].value;
	var z = y.options[x.selectedIndex];
	//$("select#sizeQN option[value="+z+"]").remove();
	y.remove(z.selectedIndex);
	x.remove(x.selectedIndex);
}
function select2(combo_id,combo_id2)
{
	var x=document.getElementById(combo_id);
	var y=document.getElementById(combo_id2);
	for (var i = 0; i < y.options.length; i++) { 
             y.options[i].selected = false; 
        } 
	y.options[x.selectedIndex].selected = true;
}
function select3(combo_id,combo_id2)
{
	var x=document.getElementById(combo_id);
	var y=document.getElementById(combo_id2);
	for (var i = 0; i < x.options.length; i++) { 
             x.options[i].selected = false; 
        } 
	x.options[y.selectedIndex].selected = true;
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
                    <td><label>Section</label></td>
                  	<td>
                    <select id="section_id" name="section_id" style="width:150px;">
                    <?php
                    $company_id	=$_SESSION["company_id"];
                    $sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P' and TBL_PAY_SECTION_INFO.COMPANY_ID=$company_id  order by TBL_PAY_SECTION_INFO.ID";
                    $stid	= oci_parse($conn, $sql);
                    oci_execute($stid);
                    while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
                    {
                        echo '<option value='.$row[0].'>'.$row[1].'</option>';
                    }
                    ?>
                    </select>
                	</td>
                    <td><label>Date</label></td>
                    <td><input type="text" id="date-picker" class="error" value="<?php echo date('m/d/Y'); ?>" /><span class="error">This is a required field.</span></td>
              	</tr>
                <tr>
                    <td><label>Style</label></td>
                  	<td><input type="text" id="style" class="error" /><span class="error">This is a required field.</span></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
              	</tr>
                <tr valign="top">
                	<td><label>Size</label></td>
                  	<td><input type="text" id="txt" class="error" onfocus="if(this.value=='size name')this.value=''" onblur="if(this.value=='')this.value='size name'" /><input type="text" id="txt1" class="error" size="12" onfocus="if(this.value=='size qty')this.value=''" onblur="if(this.value=='')this.value='size qty'" /><input type="button" value="Add" id="btn" style="height:25px;" class="btn btn-green" /><span class="error">Size Name|Qty</span>                    </td>
                    <td>&nbsp;</td>
                    <td valign="top">&nbsp;</td>
                </tr>
                <tr valign="top">
                	<td></td>
                    <td><select id="sizeNM" name="sizeNM[]" style="width:150px; background-color:#e6efc2;" multiple="multiple" onchange="select2('sizeNM','sizeQN')"></select><select id="sizeQN" name="sizeQN[]" style="width:150px; background-color:#e6efc2;" multiple="multiple" onchange="select3('sizeNM','sizeQN')"></select><br /><input name="del" value="Remove" type="button" onclick="removeOption('sizeNM','sizeQN');" style="height:25px;" class="btn btn-red" /></td>
                    <td valign="top">&nbsp;</td><td valign="top">&nbsp;</td>
                </tr>
                <tr>
                	<td align="right" colspan="4"><input type="button" name="btn_save" id="btn_save" value=" &nbsp;&nbsp;Save&nbsp;&nbsp;" class="btn btn-navy" /><input type="button"  name="btn_reset" id="btn_reset" value=" &nbsp;&nbsp;Reset&nbsp;&nbsp;" class="btn btn-blue" onclick="btn_reset()" /></td>
                </tr>
            </table>
      </div>
          <hr />
          <div class="box round first grid">
        	<h2>Style Info Data</h2>
            <div class="block">
        
          	<div id="jq_tbl"></div>
          
          </div>
          </div>
		  <br/><br/><br/>
    </div>	  
</div>
<div class="clear"></div>
<div class="clear"></div>   