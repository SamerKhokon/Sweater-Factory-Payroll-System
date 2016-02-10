<?php
session_start();
include('db.php');
?>
<link href="jquery_autocompleter/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script src="jquery_autocompleter/jquery.autocomplete.js" type="text/javascript"></script>
<link  rel="STYLESHEET" type="text/css"  href="includes/production_emp_attendence_info/popup_css/popup-contact.css" />
<script type='text/javascript' src="includes/production_emp_attendence_info/popup_js/fg_moveable_popup.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		setupTinyMCE();
		setupProgressbar('progress-bar');
		setDatePicker('date-picker');
		setupDialogBox('dialog', 'opener');
		$('input[type="checkbox"]').fancybutton();
		$('input[type="radio"]').fancybutton();
		$('#msg').hide();
		$("#cardno").keydown(function(event){
			if(event.keyCode == 13 )
				{
					var card_no		=$("#cardno").val();
					var section_id	=$("#section_id").val();
					var month_year	=$("#date-picker").val();
					var datastr	='card_no='+card_no+'&section_id='+section_id+'&month_year='+month_year;
					//alert(datastr);
					$.ajax({
						type	:'post',
						url		:'includes/production_emp_attendence_info/get_info.php',
						data	:datastr,
						cache	:false,
						success	:function(str)
						{
							
							var myString = str;
							//alert(myString);
							var stringParts = myString.split('!@#$');
							$('#name').val(stringParts[0]);
							$('#atten').val(stringParts[1]);
							$('#l_present').val(stringParts[2]);
							$('#no_work').val(stringParts[3]);
							$('#ot').val(stringParts[4]);
							$('#advanced').val(stringParts[5]);
							$('#leave').val(stringParts[6]);
							$('#lunch_out').val(stringParts[7]);
							//$('#block_name').val(stringParts[8]);
							var bl_n	=$.trim(stringParts[8]);
							//alert(bl_n);
							if(bl_n!='')
							{
								//alert(bl_n);
								$('#block_name').val(stringParts[8]);	
							}
						
							//$('#govt_holi').val(stringParts[9]);
							var gov_h	=$.trim(stringParts[9]);
							if(gov_h!='')
							{
								$('#govt_holi').val(stringParts[9]);
							}
							$('#leave1val').val(stringParts[12]);
							$('#leave2val').val(stringParts[10]);
							$('#leave3val').val(stringParts[11]);
							$('#atn_tab_id').val(stringParts[13]);
							$('#other_amnt').val(stringParts[14]);
						}
					});
					
					
					
					$("#atten").focus();
				}
			});
		$("#atten").keydown(function(event){
			if(event.keyCode == 13 )
				{
					$("#ot").focus();
				}
			});
		$("#ot").keydown(function(event){
			if(event.keyCode == 13 )
					{
						$("#leave").focus();
					}
				});
		$("#leave").keydown(function(event){
			if(event.keyCode == 13 )
				{
					$("#l_present").focus();
				}
			});
		$("#l_present").keydown(function(event){
			if(event.keyCode == 13 )
				{
					$("#no_work").focus();
				}
			});
		$("#no_work").keydown(function(event){
			if(event.keyCode == 13 )
				{
					$("#lunch_out").focus();
				}
			});
				
		$("#lunch_out").keydown(function(event){
			if(event.keyCode == 13 )
				{
					$("#other_amnt").focus();
				}
			});
		$("#other_amnt").keydown(function(event){
			if(event.keyCode == 13 )
				{
					$("#advanced").focus();
				}
			});
		
		$("#advanced").keydown(function(event){
			if(event.keyCode == 13 )
				{
				
					var section_id			=$('#section_id').val();
					var block_name			=$('#block_name').val();
					var date_condition		=$('#date_condition').val();
					var datepicker			=$('#date-picker').val();
					var total_day_of_month	=$('#total_day_of_month').val();
					
					var cardno				=$('#cardno').val();
					var name				=$.trim($('#name').val());
					var atten				=$('#atten').val();
					var leave				=$('#leave').val();
					var lunch_out			=$('#lunch_out').val();
					var l_present			=$('#l_present').val();
					var friday				=$('#friday').val();
					var ot					=$('#ot').val();
					var no_work				=$('#no_work').val();
					var night				=$('#night').val();
					var advanced			=$('#advanced').val();
					
					var sick				=$('#leave1val').val();
					var casual				=$('#leave2val').val();
					var annual				=$('#leave3val').val();
					var govt_holi			=$('#govt_holi').val();
					var other_amnt			=$('#other_amnt').val();
					
					var datastr	='section_id='+section_id+'&block_name='+block_name+'&date_condition='+date_condition+'&datepicker='+datepicker+'&total_day_of_month='+total_day_of_month+'&cardno='+cardno+'&name='+name+'&atten='+atten+'&leave='+leave+'&lunch_out='+lunch_out+'&l_present='+l_present+'&friday='+friday+'&ot='+ot+'&no_work='+no_work+'&night='+night+'&advanced='+advanced+'&sick='+sick+'&casual='+casual+'&annual='+annual+'&govt_holi='+govt_holi+'&other_amnt='+other_amnt;
					if(name=="")
					{
						alert('Please Select a Valid Card No');
						$('#cardno').focus();
						return;
					}
					else if(atten=='')
					{
						alert('Atten is null!');
						$("#atten").focus();
						return;
					}
					else if(cardno=='')
					{
						alert('Cardno is null!');
						$("#cardno").focus();
						return;
					}
					else
					{
						$.ajax({
							type	:'post',
							url		:'includes/production_emp_attendence_info/production_emp_attendence_info_enty.php',
							data	:datastr,
							cache	:false,
							success	:function(str)
							{
								$('#msg').html(str);
								$('#msg').show();
								btn_reset();
								$('#cardno').focus();
							}
						
						});
					
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
					url		:'includes/production_emp_attendence_info/get_info.php',
					data	:datastr,
					cache	:false,
					success	:function(str)
					{
						
						var myString = str;
						var stringParts = myString.split('!@#$');
						$('#name').val(stringParts[0]);
						$('#atten').val(stringParts[1]);
						$('#l_present').val(stringParts[2]);
						$('#no_work').val(stringParts[3]);
						$('#ot').val(stringParts[4]);
						$('#advanced').val(stringParts[5]);
						$('#leave').val(stringParts[6]);
						$('#lunch_out').val(stringParts[7]);
						var bl_n	=$.trim(stringParts[8]);
						//alert(bl_n);
						if(bl_n!='')
						{
							//alert(bl_n);
							$('#block_name').val(stringParts[8]);	
						}
						//$('#govt_holi').val(stringParts[9]);
						var gov_h	=$.trim(stringParts[9]);
						if(gov_h!='')
						{
							$('#govt_holi').val(stringParts[9]);
						}
						
						$('#leave1val').val(stringParts[12]);
						$('#leave2val').val(stringParts[10]);
						$('#leave3val').val(stringParts[11]);
						
						$('#atn_tab_id').val(stringParts[13]);
						$('#other_amnt').val(stringParts[14]);
					}
				});
	
			$("#atten").focus();
		
		});
			
			
				
		$('#btn_save').live('click',function(){	
		
		});
		
		
		$('#btn_auto').live('click',function(){
		  	var section_id			=$('#section_id').val();
		  	var block_name			=$('#block_name').val();
			var datepicker			=$('#date-picker').val();
            var total_day_of_month	=$('#total_day_of_month').val();
			var friday				=$('#friday').val(); 
			var atten			=parseInt(total_day_of_month) - parseInt(friday);
			var advanced			=$('#advanced').val(); 
		 	var ot					=$('#ot').val();
			var govt_holi			=$('#govt_holi').val();
			
			var datastr	='section_id='+section_id+'&datepicker='+datepicker+'&total_day_of_month='+total_day_of_month+'&atten='+atten+'&friday='+friday+'&ot='+ot+'&advanced='+advanced+'&block_name='+block_name+'&govt_holi='+govt_holi;
			//alert(datastr);
			$.ajax({
					type	:'post',
					url		:'includes/production_emp_attendence_info/production_attendence_info_enty_auto.php',
					data	:datastr,
					cache	:false,
					success	:function(str)
					{
						alert(str);
					}
				
				});
			
			
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
						url:"includes/production_emp_attendence_info/delete.php",
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
		
	});
</script>
<script>
var sec_id2='';
function get_block(sec_id)
{
	var datastr	='sec_id='+sec_id;
	$.ajax({
			type	:'post',
			url		:'includes/production_emp_attendence_info/get_block.php',
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
				$('#total_day_of_month').val(30);
				$('#friday').val(0);
				/*
				$('#total_day_of_month').val(stringParts[0]);
				$('#friday').val(stringParts[1]);
				*/
            }
	
	});	
}
function btn_reset()
{
	var cardno				=$('#cardno').val('');
	var name				=$('#name').val('');
	var atten				=$('#atten').val('');
	var leave				=$('#leave').val('');
	var lunch_out			=$('#lunch_out').val('');
	var l_present			=$('#l_present').val('');
	var ot					=$('#ot').val('');
	var advanced			=$('#advanced').val('');
	var no_work				=$('#no_work').val('');
	//var govt_holi			=$('#govt_holi').val('');
	var sick				=$('#leave1val').val('');
	var casual				=$('#leave2val').val('');
	var annual				=$('#leave3val').val('');
	var atn_tab_id			=$('#atn_tab_id').val('');
	var other_amnt			=$('#other_amnt').val('');
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
        <h2>Production Emp Attendence Info</h2>
        <div class="block" id="block">
         	<div class='message info' id="msg">
			</div>
            <table width="74%" border="0"  class="form">
                <tr>
                    <td width="20%"><label>Section</label></td>
                    <td width="30%" >
                    <select id="section_id" name="section_id" onchange="get_block(this.value)" style="width:150px;">
                    <option value="0">None</option>
                    <?php
					$company_id=$_SESSION["company_id"];
                    $sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P' and TBL_PAY_SECTION_INFO.COMPANY_ID=$company_id  order by TBL_PAY_SECTION_INFO.ID";
                    $stid	= mysqli_query($conn, $sql);
                    
                    
                    while(($row = mysqli_fetch_array($stid))) 
                    {
                    echo '<option value='.$row[0].'>'.$row[1].'</option>';
                    }
                    ?>
                    </select>                    </td>
                    <td width="20%"><label>Block/Line</label></td>
                    <td width="30%" colspan="2">
                    <div id="block_id">
                    <select id="block_name" name="block_name" style="width:150px;">
                    <option value="0">None</option>
                    </select>
                    </div>
                    </td>
                </tr>
                <tr>
                
                    <td><label>Date</label></td>
                    
                    <td><input type="text" id="date-picker" onchange="get_date_res(this.value)" class="error"/></td>
                  <td><label>Fri/Holi Day</label></td>
                    <td><input type="text" id="friday" class="success" readonly="readonly" /></td>  
                </tr>
                <tr>
                    <td><label>Total Days Of Month</label></td>
                    <td><input type="text" id="total_day_of_month" class="warning" readonly="readonly" /></td>
                    <td><label>Fest Holi Day</label>
                    </td>
                    <td><input type="text" id="govt_holi" class="success" />
                    </td>
                    
                </tr>
            </table>	
<hr/>
				
           
            <div id="details">          
            <table width="711" border="0" class="form">
                <tr>
                    <td width="20%"><label>Card No</label></td>
                    <td width="40%"><input type="text" id="cardno"  class="error"  /><span class="error">This is required field</span></td>
                    <td width="10%"><label> Name</label></td>
                    <td width="30%"><input type="text" id="name"  readonly="readonly" class="warning"/></td>
                </tr>
                <tr>
                    <td><label>Atten</label></td>
                    <td><input type="text" id="atten" class="error"  /><span class="error">This is required field</span></td>
           
                    <td><label>OT</label></td>
                    <td><input type="text" id="ot" class="success" /></td>
                </tr>
                <tr>   
                    <td><label>Leave</label></td>
                    <td>
                    <input type="text" id="leave" class="success" />
                    <input type="button"  name="btn_leave" id="btn_leave" value="..." class="btn btn-green" onclick="javascript:fg_popup_form('fg_formContainer','fg_form_InnerContainer','fg_backgroundpopup',$('#cardno').val(),$('#date-picker').val(),$('#section_id').val())" /><span class="success">Enter Leave Details info.</span>
                    </td>
                    
                    <td><label>Late Present</label></td>
                    <td><input type="text" id="l_present" class="success"  /></td>
                </tr>
                <tr>
                    <td><label>No Work</label></td>
                    <td><input type="text" id="no_work" class="success" /></td>
                    <td><label>Lunch Out</label></td>
                    <td><input type="text" id="lunch_out" class="success" /></td>
                </tr>
                <tr>
                    <td><label>Others</label></td>
                    <td><input type="text" id="other_amnt" class="success" /></td>
                    <td><label>Advanced</label></td>
                    <td><input type="text" id="advanced" class="success" /><input type="hidden" id="leave1val" class="success" /><input type="hidden" id="leave2val" class="success" /><input type="hidden" id="leave3val" class="success" /><input type="hidden" id="atn_tab_id" name="atn_tab_id" /></td>     
                </tr>
                	<td colspan="2" align="left"></td><td colspan="2" align="right"><input type="button"  name="btn_save" id="btn_save" value="&nbsp;&nbsp;Save&nbsp;&nbsp;" class="btn btn-navy" />&nbsp;<input type="button"  name="btn_del" id="btn_del" value=" &nbsp;&nbsp;Delete&nbsp;&nbsp;" class="btn btn-red" />
				  <input type="button"  name="btn_reset" id="btn_reset" value=" &nbsp;&nbsp;Reset&nbsp;&nbsp;" class="btn btn-blue" /></td>
                <tr>
                </tr>
            
            </table>
			
			<hr/>
			<input type="button"  name="btn_auto" id="btn_auto" value=" &nbsp;&nbsp;Auto Generate&nbsp;&nbsp;" class="btn btn-red" /><br /><span class="error">This Option Only For Use Entry The Auto Attendence of Employee of Abave Selected Section </span>
            </div>
            
            <div id='fg_formContainer'>
            
            </div>
            <div id='fg_backgroundpopup'></div>
            
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="clear"></div>   