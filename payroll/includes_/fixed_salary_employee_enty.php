<script type="text/javascript">
	$(document).ready(function () {
		$('#msg').hide();
		//setupProgressbar('progress-bar');
		setDatePicker('date-picker');
		setDatePicker('date-picker2');
		//$("#date-picker").datepicker();
		//setupDialogBox('dialog', 'opener');
		//$('input[type="checkbox"]').fancybutton();
		//$('input[type="radio"]').fancybutton();
		
		$("#cardno").keydown(function(event){
			if(event.keyCode == 13 ){
			var card_no2	=$('#cardno').val();
			getname(card_no2);  
			$("#empID").focus();	
			}
		});
		$("#empID").keydown(function(event){
			if(event.keyCode == 13 ){	$('#nameEN').focus();	}
		});
		$("#nameEN").keydown(function(event){
			if(event.keyCode == 13 ){	$('#nameBN').focus();	}
		});
		$("#nameBN").keydown(function(event){
			if(event.keyCode == 13 ){	$('#basic').focus(); }
		});
		$("#basic").keydown(function(event){
		    if(event.keyCode == 13 ){
			var bbasic	=$("#basic").val(); 
			get_gross(bbasic);	
			$('#gross').focus();
			}
		});
		$("#gross").keydown(function(event){
			if(event.keyCode == 13 ){
			var ggross	=$("#gross").val(); 
			get_basic(ggross);
			$('#date-picker').focus();	}
		});
		$("#date-picker").keydown(function(event){
			if(event.keyCode == 13 ){	$('#MobileNo1').focus();   }
		});
		$("#MobileNo1").keydown(function(event){
			if(event.keyCode == 13 ){	$('#date-picker2').focus();  }
		});
		$("#date-picker2").keydown(function(event){
			if(event.keyCode == 13 ){	$('#FatherName').focus();  }
		});
		$("#FatherName").keydown(function(event){
			if(event.keyCode == 13 ){	$('#MotherName').focus(); }
		});
		$("#MotherName").keydown(function(event){
			if(event.keyCode == 13 ){	$('#birthcerNo').focus();  }
		});
		$("#birthcerNo").keydown(function(event){
			if(event.keyCode == 13 ){	$('#nationalidNo').focus();  }
		});
		$("#nationalidNo").keydown(function(event){
			if(event.keyCode == 13 ){	$('#PresentAdd').focus(); }
		});
		$("#PresentAdd").keydown(function(event){
			if(event.keyCode == 13 ){	$('#ParmanentAdd').focus(); }
		});
		$("#ParmanentAdd").keydown(function(event){
			if(event.keyCode == 13 ){
				//$('#ParmanentAdd').focus();
				var section_id	 = $('#section_id').val();
				var cardno		 = $('#cardno').val();
				var basic		 = $('#basic').val();
				var gross		 = $('#gross').val();
				var grade		 = $('#grade').val();
				var datepicker	 = $('#date-picker').val();
				var designation	 = $('#designation').val();
				var	empID		 = $('#empID').val();
				var nameEN		 = $.trim($('#nameEN').val());
				var	nameBN		 = $('#nameBN').val();
				var	FatherName	 = $('#FatherName').val();
				var	MotherName	 = $('#MotherName').val();
				var	MobileNo1	 = $('#MobileNo1').val();
				var	nationalidNo	 = $('#nationalidNo').val();
				var	PresentAdd	 = $('#PresentAdd').val();
				var	ParmanentAdd = $('#ParmanentAdd').val();
				var block_id		=$('#block_id').val();
				var birthcerNo	 	=$('#birthcerNo').val();
				var datepicker2		=$('#date-picker2').val();
				
				var datastr	='section_id='+section_id+'&cardno='+cardno+'&empID='+empID+'&basic='+basic+'&gross='+gross+'&grade='+grade+'&datepicker='+datepicker+'&designation='+designation+'&nameEN='+nameEN+'&nameBN='+nameBN+'&FatherName='+FatherName+'&MotherName='+MotherName+'&MobileNo1='+MobileNo1+'&nationalidNo='+nationalidNo+'&PresentAdd='+PresentAdd+'&ParmanentAdd='+ParmanentAdd+'&birthcerNo='+birthcerNo+'&block_id='+block_id+'&datepicker2='+datepicker2;	
				
				if(section_id==0){
					alert('Please select Section');
				}else if(cardno==''){				
					alert('Please select Card No');
					$("#cardno").focus();	
				}else if(nameEN==''){				
					alert('Employee Name Null!');
					$("#nameEN").focus();	
				}else if(basic==''){				
					alert('Basic Salary Null!');
					$("#basic").focus();	
				}else{
					$.ajax({
						type    : 'post' ,
						url	    : 'includes/fixed_salary_employee_info/fixed_salary_employee_info_enty.php' ,
						data    : datastr ,
						cache   : false ,
						success : function(str)	 {
							$('#msg').html(str);
							$('#msg').show();
							$("#cardno").focus();
							reset_btn();
						}			
					});			
				}
			 }
		});
					
		$('#btn_save').live('click',function(){
				var section_id	 = $('#section_id').val();
				var cardno		 = $('#cardno').val();
				var basic		 = $('#basic').val();
				var gross		 = $('#gross').val();
				var grade		 = $('#grade').val();
				var datepicker	 = $('#date-picker').val();
				var datepicker2	 = $('#date-picker2').val();
				var designation	 = $('#designation').val();
				var	empID		 = $('#empID').val();
				var nameEN		 = $.trim($('#nameEN').val());
				var	nameBN		 = $('#nameBN').val();
				var	FatherName	 = $('#FatherName').val();
				var	MotherName	 = $('#MotherName').val();
				var	MobileNo1	 = $('#MobileNo1').val();
				var	nationalidNo	= $('#nationalidNo').val();
				var	PresentAdd	 = $('#PresentAdd').val();
				var	ParmanentAdd = $('#ParmanentAdd').val();
				var block_id	=$('#block_id').val();
				var birthcerNo	 =$('#birthcerNo').val();
			
			var datastr	='section_id='+section_id+'&cardno='+cardno+'&empID='+empID+'&basic='+basic+'&gross='+gross+'&grade='+grade+'&datepicker='+datepicker+'&designation='+designation+'&nameEN='+nameEN+'&nameBN='+nameBN+'&FatherName='+FatherName+'&MotherName='+MotherName+'&MobileNo1='+MobileNo1+'&nationalidNo='+nationalidNo+'&PresentAdd='+PresentAdd+'&ParmanentAdd='+ParmanentAdd+'&birthcerNo='+birthcerNo+'&block_id='+block_id+'&datepicker2='+datepicker2;	
			
			if(section_id==0){
				alert('Please select Section');
			}else if(cardno==''){				
				alert('Please select Card No');
				$("#cardno").focus();	
			}else if(nameEN==''){				
				alert('Employee Name Null!');
				$("#nameEN").focus();	
			}else if(basic==''){				
				alert('Basic Salary Null!');
				$("#basic").focus();	
			}else{
				$.ajax({
					type    : 'post' ,
					url	    : 'includes/fixed_salary_employee_info/fixed_salary_employee_info_enty.php' ,
					data    : datastr ,
					cache   : false ,
					success : function(str)	 {
					    $('#msg').html(str);
						$('#msg').show();
						$("#cardno").focus();
						reset_btn();
					}			
				});			
			}
		});		
	});
</script>
<script>
function getname(card_no){
	var section_id	=$('#section_id').val();
	var datastr	='card_no='+card_no+'&section_id='+section_id;
	$.ajax({
		type	:'post',
		url		:'includes/fixed_salary_employee_info/get_name2.php',
		data	:datastr,
		cache	:false,
		success	:function(str){
			//$('#nameEN').val(str);
				var mstr = str;
				var mystr = mstr.split('!@#$');
				$('#nameEN').val($.trim(mystr[0]));
				$('#basic').val($.trim(mystr[1]));
				$('#grade').val($.trim(mystr[2]));
				$('#designation').val($.trim(mystr[3]));
				$('#empID').val($.trim(mystr[4]));
				if($.trim(mystr[1])!='')
				{
					$('#gross').val($.trim(mystr[5]));
				}
				else
					$('#gross').val('');
				$('#nameBN').val($.trim(mystr[6]));
				$('#MobileNo1').val($.trim(mystr[7]));
				$('#nationalidNo').val($.trim(mystr[8]));
				$('#PresentAdd').val($.trim(mystr[9]));
				$('#ParmanentAdd').val($.trim(mystr[10]));
				$('#FatherName').val($.trim(mystr[11]));
				$('#MotherName').val($.trim(mystr[12]));
				$('#date-picker').val($.trim(mystr[13]));
				$('#date-picker2').val($.trim(mystr[15]));
				$('#birthcerNo').val($.trim(mystr[14]));
				//alert(mystr[15]);	
		}
	});
}
function get_gross(basic){
	var section_id	=parseInt($('#section_id').val());
	if(section_id!=0){
		var datastr	='basic='+basic+'&section_id='+section_id;
		$.ajax({
			type	:'post',
			url		:'includes/fixed_salary_employee_info/get_gradeanddesignation.php',
			data	:datastr,
			cache	:false,
			success	:function(str)	{
				var myString = str;
				var stringParts = myString.split('!@#$');
				$('#gross').val($.trim(stringParts[0]));
				$('#grade').val($.trim(stringParts[1]));
				$('#designation').val($.trim(stringParts[2]));
			}
		});
	}	
}
function get_basic(gross){
	var section_id	=parseInt($('#section_id').val());
	if(section_id!=0)	{
		var datastr	='basic='+gross+'&section_id='+section_id;
		$.ajax({
			type	:'post',
			url		:'includes/fixed_salary_employee_info/get_gradeanddesignation2.php',
			data	:datastr,
			cache	:false,
			success	:function(str)			{
				var myString = str;
				var stringParts = myString.split('!@#$');
				$('#basic').val($.trim(stringParts[0]));
				$('#grade').val($.trim(stringParts[1]));
				$('#designation').val($.trim(stringParts[2]));
			}
		});
	}
}
function get_block(sec_id){
var datastr	='sec_id='+sec_id;
$.ajax({
		type	:'post',
		url		:'includes/production_base_emp_info/get_block.php',
		data	:datastr,
		cache	:false,
		success	:function(str)		{
			$('#block_id').html(str);
		}		
	});
}
function reset_btn(){
	//var section_id	=$('#section_id').val(0);
	var cardno		=$('#cardno').val('');
	var basic		=$('#basic').val('');
	var gross		=$('#gross').val('');
	var grade		=$('#grade').val('');
	var datepicker	=$('#date-picker').val('');
	var datepicker2	=$('#date-picker2').val('');
	var designation	=$('#designation').val('');
	var	empID		=$('#empID').val('');
	var nameEN		=$('#nameEN').val('');
	var	nameBN		=$('#nameBN').val('');
	var	FatherName	=$('#FatherName').val('');
	var	MotherName	=$('#MotherName').val('');
	var	MobileNo1	=$('#MobileNo1').val('');
	var	nationalidNo=$('#nationalidNo').val('');
	var	PresentAdd	=$('#PresentAdd').val('');
	var	ParmanentAdd=$('#ParmanentAdd').val('');
	var birthcerNo	=$('#birthcerNo').val('');
}
</script>
    <!-- /TinyMCE -->
           <div class="grid_10">
            <div class="box round first fullpage">
               <h2>Add New Employee Of Fixed</h2>
                <div class="block" id="block">
					<div class='message info' id="msg"></div>
                    <table class="form">
                        <tr>
                            <td><label>Section</label></td>
                            <td><select id="section_id" name="section_id" onchange="get_block(this.value)" style="width:150px;">
                                    <option value="0">None</option>
                                    <?php
									$company_id	=$_SESSION["company_id"];
                                    $sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='F' and TBL_PAY_SECTION_INFO.COMPANY_ID=$company_id  order by TBL_PAY_SECTION_INFO.ID";
                                    $stid	= oci_parse($conn, $sql);
                                    oci_execute($stid);
                                    
                                    while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
                                    {
                                        echo '<option value='.$row[0].'>'.$row[1].'</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><label>Block/Line</label></td>
							<td colspan="2">
							
                                <select id="block_id" name="block_id" style="width:150px;">
                               		<option value="0">None</option>
                                </select>
							</td>
                        </tr>
                        <tr>
                           <td><label>Card No</label></td>
                           <td><input type="text" class="error" id="cardno" onblur="getname(this.value)"  /> <span class="error">This is a required field.</span>
                           </td>
                           <td><label>Emp ID</label></td>
                           <td><input type="text" id="empID"  class="success" /><span class="success">Enter The RF Card number.</span>
                           </td>
							    
                        </tr>
						
						
						<tr>
						    <td><label>Name(English)</label></td>
                            <td><input type="text" id="nameEN" class="error" /><span class="error">This is a required field.</span></td>							
								<!-- Enter the name of bangla using Avro unicode  -->
							<td><label>Name(Bangla)</label></td>
                            <td><input type="text" id="nameBN" class="success" /><span class="success">Enter Bangla name by Avro.</span></td>
								
						</tr>
						
                        <tr>
                            <td><label>Basic</label></td>
                            <td><input type="text" id="basic"  class="error"/><span class="error">This is a required field.</span>
                            </td>
                            <td><label>Gross</label></td>
                            <td><input type="text" id="gross" class="error" /><span class="error">This is a required field.</span>
                            </td>
                        </tr>
                        
					   <tr>
                            <td><label>Grade</label></td>
                            <td><input type="text" id="grade"  class="warning" /></td>
									
                            <td><label>Designation</label></td>
                            <td><input type="text" id="designation"  class="warning"/></td>
                        </tr>
						
						<tr>
							<td><label>Joining Date</label></td>
                            <td>
                                <input type="text" id="date-picker" class="error"/><span class="error">&nbsp;mm/dd/yyyy</span></td>
								<td><label>Mobile No1</label>    </td>
								<td><input type="text" id="MobileNo1"  class="error"/><span class="error">This is a required field.</span></td>
						</tr>
                        <tr>
							<td><label>Date of Birth</label></td>
                            <td>
                                <input type="text" id="date-picker2" class="error"/><span class="error">&nbsp;mm/dd/yyyy</span></td>
								<td colspan="2"></td>
						</tr>
                        <tr>
                        	<td colspan="4" align="center"></td>
                        </tr>
                    </table>
					
					<h4>Employee Personal Details</h4>
					<hr>
					
					 <table class="form">
                        <tr>
                            <td><label>Father Name</label></td>
                            <td><input type="text" id="FatherName" class="success" /></td>
                            <td><label>Mother Name</label></td>
                            <td><input type="text" id="MotherName" class="success" /></td>
                        
                    
                        </tr>
                        
                        <tr>
                            <td><label>Birth Cert No</label></td>
                            <td><input type="text" id="birthcerNo"  class="success"/><span class="success">This is a optional field.</span></td>
                            <td><label>National Id No</label></td>
                            <td><input type="text" id="nationalidNo" class="success" /><span class="success">This is a optional field.</span></td>
                        
                        </tr>
                        <tr>
                            <td><label>Present Address</label></td>
                            <td><input type="text" id="PresentAdd" name="PresentAdd" class="large" /></td>
                            <td><label>Parmanent Address</label></td>
                            <td><input type="text" id="ParmanentAdd" name="ParmanentAdd" class="large" /></td>
                        </tr>
							
							
					</table>
					<hr/>
					<div align="right">
					<input type="button" name="btn_save" id="btn_save" value=" &nbsp;&nbsp;Save&nbsp;&nbsp;" class="btn btn-navy" />
					<input type="button" name="btn_reset" id="btn_reset" value=" &nbsp;&nbsp;Reset&nbsp;&nbsp;" class="btn btn-blue" onclick="reset_btn()" />
					</div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
<?php
oci_free_statement($stid);
oci_close($conn);
?>  