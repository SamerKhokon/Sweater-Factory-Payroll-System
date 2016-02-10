<link href="jquery_autocompleter/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script src="jquery_autocompleter/jquery.autocomplete.js" type="text/javascript"></script>
<link  rel="STYLESHEET" type="text/css"  href="includes/fixed_attendence_info/popup_css/popup-contact.css" />
<script type='text/javascript' src="includes/fixed_attendence_info/popup_js/fg_moveable_popup.js"></script>

	<script type="text/javascript">
    $(document).ready(function () {
		$('#msg').hide();
        setDatePicker('date-picker');
		var err	=true;
		
		$("#cardno").keydown(function(event){
			if(event.keyCode == 13 )
				{
					var card_no	=$("#cardno").val();
					var section_id	=$("#section_id").val();
					var month_year	=$("#date-picker").val();
					var block_id	=$("#block_name").val();
					var datastr	='card_no='+card_no+'&section_id='+section_id+'&month_year='+month_year+'&block_id='+block_id;
					
					$.ajax({
						type	:'post',
						url		:'includes/fixed_extra_ot/get_info.php',
						data	:datastr,
						cache	:false,
						success	:function(str)
							{
								var myString = str;
								var stringParts = myString.split('!@#$');
								$('#name').val(stringParts[0]);
								$('#eot').val(stringParts[1]);
								$('#atn_tab_id').val(stringParts[2]);
								$('#block_name').val(stringParts[3]);
							}
						});
		
						$("#eot").focus();
						//alert(card_no);
						
					}
					
			});
			
		$("#eot").keydown(function(event){
			if(event.keyCode == 13 )
				{
					var section_id			=$('#section_id').val();
					var block_name			=$('#block_name').val();
					var datepicker			=$('#date-picker').val();
					var total_day_of_month	=$('#total_day_of_month').val();
					var friday				=$('#friday').val(); 
					var cardno				=$('#cardno').val();
					var name				=$.trim($('#name').val());
					var eot					=$('#eot').val();
					var datastr	='section_id='+section_id+'&datepicker='+datepicker+'&total_day_of_month='+total_day_of_month+'&cardno='+cardno+'&name='+name+'&eot='+eot+'&block_name='+block_name;
					//alert(datastr);
					if(name=='')
					{
						alert('Please Select vaild Emp');
						$("#cardno").focus();
					}					
					else
					{
						$.ajax({
							type	:'post',
							url		:'includes/fixed_extra_ot/fixed_eot_enty.php',
							data	:datastr,
							cache	:false,
							success	:function(str)
							{
								$('#msg').html(str);
								$('#msg').show();
								$('#cardno').focus();
								btn_reset();
							}
						
						});
					}
				}
			});
        
        $('#btn_save').live('click',function(){
            var section_id			=$('#section_id').val();
			var block_name			=$('#block_name').val();
            var date_condition		=$('#date_condition').val();
            var datepicker			=$('#date-picker').val();
            var total_day_of_month	=$('#total_day_of_month').val();
			var friday				=$('#friday').val(); 
            var cardno				=$('#cardno').val();
            var name				=$.trim($('#name').val());
            var eot					=$('#eot').val();
			
            var datastr	='section_id='+section_id+'&date_condition='+date_condition+'&datepicker='+datepicker+'&total_day_of_month='+total_day_of_month+'&cardno='+cardno+'&name='+name+'&atten='+atten+'&block_name='+block_name;
			//alert(datastr);
            if(name=='')
				{
							alert('Please Select vaild Emp');
							$("#cardno").focus();
				}					
			else
				{
					$.ajax({
					type	:'post',
					url		:'includes/fixed_extra_ot/fixed_eot_enty.php',
					data	:datastr,
					cache	:false,
					success	:function(str)
					{
						$('#msg').html(str);
						$('#msg').show();
						$('#cardno').focus();
						btn_reset();
					}
				
				});
			}
        
        });
		
		 $('#btn_del').live('click',function(){
				var atn_tab_id	=$('#atn_tab_id').val();
				if(atn_tab_id !='')
				{
					var r=confirm("Are You Sure Delete?");
					var x;
					if (r==true)
					{
						var id = atn_tab_id;
						$.ajax({
						type:'post',
						url:"includes/fixed_extra_ot/delete.php",
						data:'id='+id,
						cache:false,
						success:function(str)
						{
							alert(str);
							btn_reset();
						}
						});
					}
					else
					{
						x="Cancel!";
					} 
				}
		 });
		
		$("#cardno").result(function(event, data, formatted){
		
			var card_no=data;
			var card_no2	=data[0];
			var section_id	=$('#section_id').val();
			var month_year	=$('#date-picker').val();
			var block_id	=$("#block_name").val();
			var datastr	='card_no='+card_no+'&section_id='+section_id+'&month_year='+month_year+'&block_id='+block_id;
			$.ajax({
					type	:'post',
					url		:'includes/fixed_extra_ot/get_info.php',
					data	:datastr,
					cache	:false,
					success	:function(str)
						{
							var myString = str;
							var stringParts = myString.split('!@#$');
							$('#name').val(stringParts[0]);
							$('#eot').val(stringParts[1]);
							$('#atn_tab_id').val(stringParts[2]);
							$('#block_name').val(stringParts[3]);
						}
					});
	
					$("#eot").focus();
		
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
            url		:'includes/fixed_attendence_info/get_block.php',
            data	:datastr,
            cache	:false,
            success	:function(str)
            {
				var stringParts = str.split('!@#$');
				$('#block_id').html(stringParts[0]);
				sec_id2	=parseInt(stringParts[1]);
				
				$("#cardno").unbind('.autocomplete').autocomplete("includes/fixed_attendence_info/get_code_num.php?sec_id="+sec_id2, {
					 cacheLength: 1,
					 selectFirst: true
				});
				
            }
            
        });

}


function get_section(type_id)
{
	var datastr	='type_id='+type_id;
	$.ajax({
		type	:'post',
		url		:'includes/fixed_attendence_info/get_section.php',
		data	:datastr,
		cache	:false,
		success	:function(str)
		{
			
			$('#section_id').html(str);
			btn_reset();
		}
	});
}

function getname(card_no)
{
	var datastr	='card_no='+card_no;
	$.ajax({
			type	:'post',
			url		:'includes/fixed_salary_employee_info/get_name.php',
			data	:datastr,
			cache	:false,
			success	:function(str)
			{
				$('#name').val(str);	
			}
		});
}

function get_date_res(date_str)
{
	var datastr	='date_str='+date_str;
	$.ajax({
		type	:'post',
		url		:'includes/fixed_attendence_info/get_date_result.php',
		data	:datastr,
        cache	:false,
        success	:function(str)
            {
				var myString = str;
				var stringParts = myString.split('!@#$');
				$('#total_day_of_month').val(stringParts[0]);
				$('#friday').val(stringParts[1]);
            }
	
	});	
}
function btn_reset()
{
	var cardno				=$('#cardno').val('');
	var name				=$('#name').val('');
	var eot					=$('#eot').val('');
	var atn_tab_id			=$('#atn_tab_id').val('');
	
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
        <h2> Extra OT</h2>
      <div class="block" id ="block">
        <div class='message info' id="msg"></div>
          <div id="details">
            <table width="81%" class="form">
            	<tr>
                	<td><label>Section Type</label></td><td><select id="section_type" name="section_type" onchange="get_section(this.value)" style="width:150px;">
                    	<option value="">NONE</option>
                        <option value="F">Fixed</option>
                        <option value="P">Production</option>
                        </select></td><td colspan="2"></td>
                </tr>
				<tr>
                    <td  width="20%"><label>Section</label></td>
					
  					<td  width="38%">
	  					<select id="section_id" name="section_id" onchange="get_block(this.value)" style="width:150px;">
                    	</select>
                    </td >
					
                    <td width="12%"><label>Block/Line</label></td>
                    <td width="30%">
                    <div id="block_id">
                    <select id="block_name" name="block_name" style="width:150px;">
                    	<option value="0">None</option>
                    </select>
                    </div>
                    </td>
              	</tr>
                <tr>
               
                  <td width="20%"><label>Date</label></td>
                  <td width="38%"><input type="text" id="date-picker" onchange="get_date_res(this.value)" class="error" />
					<span class="error">This is a required field.</span>
					</td>
				  <td width="12%"><label>Fri/Holi Day</label></td>
				  <td width="30%"><input type="text" id="friday" class="success" /></td>
					

              </tr>
			  
			  
                <tr>
                    <td><label>Total Days Of Month</label></td>
                    <td><input type="text" id="total_day_of_month" readonly="readonly" class="warning"/></td>
                    <td colspan="2"></td>
                </tr>
            </table>
		  </div>
          <hr/>
           <div id="details">
           
           <table width="81%"  class="form" >
				<tr>
                    <td width="20%"><label>Card No</label></td>
          			<td width="38%" ><input type="text" id="cardno"  class="error"/> <span class="error">This is a required field.</span></td>
					<td width="12%"><label>Name</label></td>
  					<td width="30%"><input type="text" id="name" readonly="readonly" class="warning"/>                  	</td>
             	</tr>
                <tr>
                    <td><label>Extra OT</label></td>
                    <td><input type="text" id="eot" class="error" /><input type="hidden" id="atn_tab_id" name="atn_tab_id" /></td>
					<td colspan="2"></td>
                </tr>
                
                <tr>
                	<td colspan="4" align="right"><input type="button"  name="btn_save" id="btn_save" value=" &nbsp;&nbsp;Save&nbsp;&nbsp;" class="btn btn-navy" />&nbsp;<input type="button"  name="btn_del" id="btn_del" value=" &nbsp;&nbsp;Delete&nbsp;&nbsp;" class="btn btn-red" />
				  <input type="button"  name="btn_reset" id="btn_reset" value=" &nbsp;&nbsp;Reset&nbsp;&nbsp;" class="btn btn-blue" onclick="btn_reset()" /></td>
                </tr>
            </table>
        </div>
           
           <div id='fg_formContainer'>
            </div>
            <div id='fg_backgroundpopup'></div>
           
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="clear"></div>