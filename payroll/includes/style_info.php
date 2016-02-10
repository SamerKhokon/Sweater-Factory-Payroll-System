<?php
session_start();
include('db.php');
?>
<link href="jquery_autocompleter/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script src="jquery_autocompleter/jquery.autocomplete.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function () {		
		setDatePicker('date-picker');
		setDatePicker('shiping_date');
		$('#msg').hide();
		$("#jq_tbl").load('includes/style_info/style_info_data.php');		
		
		$("#style").keydown(function(event){
			if(event.keyCode == 13 ){
			$('#sizeNM option').remove();
			$("#txt").focus();
			btn_reset2();
			}
		});			
		$("#txt").keydown(function(event){
			if(event.keyCode == 13 ){
				var txt = $.trim($('#txt').val());
				if(txt!='')
				{
					var ar = [];
					$('#sizeNM option').each(function(){
					  
					   ar.push($(this).text());
					   $('#txt').val('');
					});
					$('#txt').val('');
					var pos = $.inArray(txt,ar);						
					if(pos==-1) {
						$('<option value="'+txt+'" >'+txt+'</option>').appendTo('#sizeNM');
						ar.push(txt);	 
					} 
				}
			}
		});
		$("#date-picker").keydown(function(event){
			if(event.keyCode == 13 ){$("#u_price").focus();}
		});
		$("#u_price").keydown(function(event){
			if(event.keyCode == 13 ){$("#quantity").focus();}
		});
		
		$("#quantity").keydown(function(event){
			if(event.keyCode == 13 ){$("#add_qtyp").focus();}
		});
		$("#add_qtyp").keydown(function(event){
			if(event.keyCode == 13 ){
			
			var ordrqty	=$.trim($('#quantity').val());
			var adqty	=$.trim($('#add_qtyp').val());
			set_addqty(ordrqty,adqty);
			$("#buyer_name").focus();
			
			}
		});
		
		$("#buyer_name").keydown(function(event){
			if(event.keyCode == 13 ){$("#merchendiser_name").focus();}
		});
		$("#merchendiser_name").keydown(function(event){
			if(event.keyCode == 13 ){$("#gauge").focus();}
		});
		$("#gauge").keydown(function(event){
			if(event.keyCode == 13 ){$("#mach_qty").focus();}
		});
		$("#mach_qty").keydown(function(event){
			if(event.keyCode == 13 ){$("#bstyle_name").focus();}
		});
		$("#bstyle_name").keydown(function(event){
			if(event.keyCode == 13 ){$("#shipment_st").focus();}
		});
		
		$("#shipment_st").keydown(function(event){
			if(event.keyCode == 13 ){	
			    var numReg = /^[0-9]+$/;	
				var style			=$.trim($('#style').val());
				var quantity		= $('#quantity').val();
				var datepicker		= $('#date-picker').val();
				var buyer_name		=$('#buyer_name').val();
				var merchend_name	=$('#merchendiser_name').val();
				var gauge			=$('#gauge').val();
				var add_qty			=$('#add_qty').val();
				var u_price			=$('#u_price').val();
				var mach_qty		=$('#mach_qty').val();
				var shipmentd		=$('#shiping_date').val();
				var bstyle_name		=$('#bstyle_name').val();
				var shipment_st		=$('#shipment_st').val();
				var sizeNMarr       = [];
				$('#sizeNM option').each(function(){
					sizeNMarr.push($(this).text());
				});
                if(!numReg.test(quantity)) {
				   alert('quantity must be numeric');
				   $('#quantity').focus();
				   return false;
				}						
				if(style=='')
				 {
				 	alert('Please Write Style');
					$("#style").focus();
				 } else	{

					var datastr	 = 'style='+style+'&quantity='+quantity+'&datepicker='+datepicker+'&sizeNMarr='+sizeNMarr+'&buyer_name='+buyer_name+'&merchend_name='+merchend_name+'&gauge='+gauge+'&add_qty='+add_qty+'&u_price='+u_price+'&mach_qty='+mach_qty+'&shipmentd='+shipmentd+'&bstyle_name='+bstyle_name+'&shipment_st='+shipment_st;
					$.ajax({
						type	:'post',
						url		:'includes/style_info/style_info_enty.php',
						data	:datastr,
						cache	:false,
						success	:function(str)	{
							$('#msg').html(str);
							$('#msg').show();
							btn_reset();
							$("#jq_tbl").load('includes/style_info/style_info_data.php');
						}					
					});					
				}
			}
		});
		
		$("#style").autocomplete("includes/emp_production_issue_info/get_style.php", {
			selectFirst: true
		});		
		
		$("#style").result(function(event, data2, formatted){
		    var st = data2[1]; 
			$.ajax({
			   type:'post' ,
			   url: 'includes/style_info/exist_size_list.php' ,
			   data:'style_id='+st,
			   cache:false ,
			   success:function(sst){
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
			   }
			});			 
		});	
				
		$('#btn_save').click(function(){
			 	var numReg = /^[0-9]+$/;	
				var style			=$.trim($('#style').val());
				var quantity		=$('#quantity').val();
				var datepicker		=$('#date-picker').val();
				var buyer_name		=$('#buyer_name').val();
				var merchend_name	=$('#merchendiser_name').val();
				var gauge			=$('#gauge').val();
				var add_qty			=$('#add_qty').val();
				var u_price			=$('#u_price').val();
				var mach_qty		=$('#mach_qty').val();
				var shipmentd		=$('#shiping_date').val();
				var bstyle_name		=$('#bstyle_name').val();
				var shipment_st		=$('#shipment_st').val();
				var sizeNMarr       = [];
				$('#sizeNM option').each(function(){
					sizeNMarr.push($(this).text());
				});
                if(!numReg.test(quantity)) {
				   alert('quantity must be numeric');
				   $('#quantity').focus();
				   return false;
				}						
				if(style=='')
				 {
				 	alert('Please Write Style');
					$("#style").focus();
				 } else	 {

					var datastr	 = 'style='+style+'&quantity='+quantity+'&datepicker='+datepicker+'&sizeNMarr='+sizeNMarr+'&buyer_name='+buyer_name+'&merchend_name='+merchend_name+'&gauge='+gauge+'&add_qty='+add_qty+'&u_price='+u_price+'&mach_qty='+mach_qty+'&shipmentd='+shipmentd+'&bstyle_name='+bstyle_name+'&shipment_st='+shipment_st;		
					$.ajax({
						type	:'post',
						url		:'includes/style_info/style_info_enty.php',
						data	:datastr,
						cache	:false,
						success	:function(str)	{
							$('#msg').html(str);
							$('#msg').show();
							btn_reset();
							$("#jq_tbl").load('includes/style_info/style_info_data.php');
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
					url:"includes/style_info/delete.php",
					data:'id='+id,
					cache:false,
					success:function(str)
					{
						alert(str);
						$("#jq_tbl").load('includes/style_info/style_info_data.php');
						btn_reset();
					}
				});
			}
			else
			{
				x="Cancel!";
			} 
		
		});
	
		$('#btn').click(function(){		
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
function getname(card_no){
	var datastr	='card_no='+card_no;
	$.ajax({
		type	:'post',
		url		:'includes/fixed_salary_employee_info/get_name.php',
		data	:datastr,
		cache	:false,
		success	:function(str)	{
			$('#name').val(str);	
		}
	});
}
function btn_reset(){
	var style			=$('#style').val('');
	var quantity		=$('#quantity').val('');
	var txt				=$('#txt').val('');
	var buyer_name		=$('#buyer_name').val('');
	
	var merchend_name	=$('#merchendiser_name').val('');
	var gauge			=$('#gauge').val('');
	var add_qtyp		=$('#add_qtyp').val('');
	var add_qty			=$('#add_qty').val('');
	var u_price			=$('#u_price').val('');
	var mach_qty		=$('#mach_qty').val('');
	var shipmentd		=$('#shiping_date').val('');
	var bstyle_name		=$('#bstyle_name').val('');
	var shipment_st		=$('#shipment_st').val('');
	var sizeNM	    	= $('#sizeNM option').remove();
}
function btn_reset2(){
	var quantity	=$('#quantity').val('');
	var txt			=$('#txt').val('');
	var buyer_name	=$('#buyer_name').val('');
	
	var merchend_name	=$('#merchendiser_name').val('');
	var gauge			=$('#gauge').val('');
	var add_qtyp		=$('#add_qtyp').val('');
	var add_qty			=$('#add_qty').val('');
	var u_price			=$('#u_price').val('');
	var mach_qty		=$('#mach_qty').val('');
	var shipmentd		=$('#shiping_date').val('');
	var bstyle_name		=$('#bstyle_name').val('');
	var shipment_st		=$('#shipment_st').val('');
	var sizeNM	    	=$('#sizeNM option').remove();
}
function removeOption(combo_id){
	if(document.getElementById(combo_id).options.length==0)
		return;
	var x=document.getElementById(combo_id);
	x.remove(x.selectedIndex);		
}
function set_addqty(ordrqty,addp1)
{
	var addp =addp1;
	var addqty=0;
	var addchk =addp.search("%");
	if(addchk!=-1)
	{
		var addn = addp.replace("%","");
		var addpn=parseInt(addn);
		var addqty=(parseInt(ordrqty)+parseInt((ordrqty*addpn)/100));
	}
	else
	{
		var addqty=(parseInt(ordrqty)+parseInt((ordrqty*addp)/100));
	}
	$('#add_qty').val(addqty);
}
</script> 
<div class="grid_10">
    <div class="box round first fullpage">
        <h2>Style Info</h2>
        <div class="block " id="block">
         <div class='message info' id="msg">
		 </div>
            <table class="form">
                <tr>
                    <td><label>Style</label></td>
                  	<td><input type="text" id="style" class="error" /><span class="error">This is a required field.</span></td>
                    <td><label>Date</label></td>
                    <td><input type="text" id="date-picker" class="error" value="<?php echo date('m/d/Y'); ?>" /><span class="error">This is a required field.</span></td>
              	</tr>
                <tr valign="top">
                	<td><label>Size</label></td>
                  	<td><input type="text" id="txt" class="error" /><input type="button" value="Add" id="btn" style="height:25px;" class="btn btn-green" /><span class="error">This is a required field.</span>
                    </td>
                    <td><label>Shipping Date</label></td>
                    <td valign="top"><input type="text" id="shiping_date" class="success"  /></td>
                </tr>
                <tr valign="top">
                	<td></td>
                    <td><select id="sizeNM" name="sizeNM[]" style="width:150px; background-color:#e6efc2;" multiple="multiple" ></select><br /><input name="del" value="Remove" type="button" onclick="removeOption('sizeNM');" style="height:25px;" class="btn btn-red" /></td>
                    <td valign="top"><label>Unit Price $</label></td><td valign="top"><input type="text" id="u_price" class="success"  /></td>
                </tr>
                <tr>
                	<td><label>Quantity</label></td>
                    <td><input type="text" id="quantity" class="success"  /></td>
                    <td valign="top"><label>Add Qty %</label></td>
                    <td valign="top"><input type="text" id="add_qtyp" class="success" size="5"  /><input type="text" id="add_qty" class="success" size="10" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td valign="top"><label>Buyer Name</label></td>
                    <td valign="top"><input type="text" id="buyer_name" class="success"  /></td>
                	<td><label>Merchendiser</label></td>
                    <td><input type="text" id="merchendiser_name" class="success"  /></td>
                <tr>
                	<td><label>Gauge</label></td>
                    <td><input type="text" id="gauge" class="success"  /></td>
                    <td valign="top"><label>Machine Qty</label></td>
                    <td valign="top"><input type="text" id="mach_qty" class="success"  /></td>
                </tr>
                <tr>
                	<td><label>Buyer Style Name</label></td>
                    <td><input type="text" id="bstyle_name" class="success" /></td>
                    <td valign="top"><label>Shipment Status</label></td>
                    <td valign="top"><input type="text" id="shipment_st" class="success"  /></td>
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