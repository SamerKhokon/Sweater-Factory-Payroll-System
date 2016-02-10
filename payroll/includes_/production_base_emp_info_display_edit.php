<?php
include('function.php'); 
	$slno = trim($_GET['slno']); 

	$str = "select * from TBL_PAY_EMP_PROFILE where ID=$slno";
	$stm = oci_parse($conn,$str);
	oci_execute($stm);
	while($res = oci_fetch_array($stm,OCI_BOTH+OCI_RETURN_NULLS)) {
			$ID              			= $res['ID'];
			$company_id      	= $res['COMPANY_ID'];
			$employee_name		= $res['NAME'];
			$card_id         	= $res['CARD_ID'];
			$address         	= $res['ADDRESS'];
			$phoneno         	= $res['PHONE_NO'];
			$email           	= $res['EMAIL'];
			$join_date       	= $res['JOIN_DATE'];
			$entry_date      	= $res['ENTRYDATE'];
			$national_id     	= $res['NATIONAL_ID'];
			$basic           	= $res['BASIC'];		 
			$grade           	= $res['GRADE'];
			$designation     	= $res['DESIGNATION'];
			$employee_id     	= $res['EMP_ID'];
			$section_id      	= $res['SECTION_ID'];
			$status          	= $res['STATUS'];
			$remarks         	= $res['REMARKES'];
			$bng_name        	= $res['BNG_NAME'];
			$bng_address     	= $res['BNG_ADDRESS'];
			$bng_designation	= $res['BNG_DESIGNATION'];
			$bng_remarks     	= $res['BNG_REMARKES'];
			$block_id        	= $res['BLOCK_ID'];
			$father_name     	= $res['FATHER_NAME'];
			$mother_name    	= $res['MOTHER_NAME'];
			$mobile_no1      	= $res['MOBILE_NO1'];
			$birthcerNo      	= $res['BIRTHCERTNO'];
			$present_address	= $res['PRESENT_ADDRESS'];
			$parmanent_address 	= $res['PARMANENT_ADDRESS'];
			$DATEOFBIRTH 	= $res['DATEOFBIRTH'];
			
			$h_rent       		= fn_house_rent($section_id,$basic);
			$medical       		= fn_medical($section_id,$basic);
			$convence_head	=162292;
			$amount_cv	=0;
			$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=$convence_head and COMPANY_ID=$company_id and SECTION_ID=$section_id";
			$qstr  = oci_parse($conn,$sql);
			oci_execute($qstr);
			if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
			{
			$amount_cv 	= $row[0];
			}
		 
			$gross				= $basic+$h_rent+$medical+$amount_cv+650;  
	    }
	   if($join_date!='')
	   {
			$date_parse = explode("-",$join_date);
			$d = $date_parse[0];
			$m = $date_parse[1];
			$y = $date_parse[2];
			$new_date1 = month_pos($m).'/'.$d.'/'.$y;
			$new_date	= date('m/d/Y', strtotime($join_date));	  
		} 
		if($DATEOFBIRTH!='')
		{
			$date_parse = explode("-",$DATEOFBIRTH);
			$d = $date_parse[0];
			$m = $date_parse[1];
			$y = $date_parse[2];
			$new_date3 = month_pos($m).'/'.$d.'/'.$y;
			$new_date2	= date('m/d/Y', strtotime($DATEOFBIRTH));	  
		}
  ?>
<script type="text/javascript">
	$(document).ready(function () {
	   $('#section_id').val($('#section_id_container').val());
		$('#msg').hide();
		//setupTinyMCE();
		setupProgressbar('progress-bar');
		setDatePicker('date-picker');
		//$("#date-picker").datepicker();
		setupDialogBox('dialog', 'opener');
		$('input[type="checkbox"]').fancybutton();
		$('input[type="radio"]').fancybutton();		
		    $("#cardno").keydown(function(event){
					if(event.keyCode == 13 ){	$("#empID").focus();	}
			});
		    $("#empID").keydown(function(event){
					if(event.keyCode == 13 ){	$('#nameEN').focus();	}
			});
			$("#nameEN").keydown(function(event){
					if(event.keyCode == 13 ){ $('#nameBN').focus();		}
			});
			$("#nameBN").keydown(function(event){
					if(event.keyCode == 13 ){ $('#basic').focus();	}
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
				$('#date-picker').focus();	
				}
			});
			$("#date-picker").keydown(function(event){
					if(event.keyCode == 13 ){ $('#MobileNo1').focus();		}
			});
			$("#MobileNo1").keydown(function(event){
					if(event.keyCode == 13 ){$('#date-picker2').focus();}
			});
			$("#date-picker2").keydown(function(event){
					if(event.keyCode == 13 ){$('#status').focus();}
			});
			$("#status").keydown(function(event){
					if(event.keyCode == 13 ){$('#FatherName').focus();}
			});
			$("#FatherName").keydown(function(event){
					if(event.keyCode == 13 ){	$('#MotherName').focus();}
			});
			$("#MotherName").keydown(function(event){
					if(event.keyCode == 13 ){$('#birthcerNo').focus();}
			});
			$("#birthcerNo").keydown(function(event){
				if(event.keyCode == 13 ){$('#nationalidNo').focus();}
			});
			$("#nationalidNo").keydown(function(event){
				if(event.keyCode == 13 ){	$('#PresentAdd').focus(); }
			});
			$("#PresentAdd").keydown(function(event){
				if(event.keyCode == 13 ){	$('#ParmanentAdd').focus(); }
			});
			$("#ParmanentAdd").keydown(function(event){
				if(event.keyCode == 13 ){	
					$('#ParmanentAdd').focus(); 
					 	var ID           = $('#ID').val();
						var company_id   = $('#company_id').val();
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
						var	nameEN		 = $('#nameEN').val();			
						var	FatherName	 = $('#FatherName').val();
						var	MotherName	 = $('#MotherName').val();
						var	MobileNo1	 = $('#MobileNo1').val();
						var	birthcerNo	 = $('#birthcerNo').val();
						var	PresentAdd	 = $('#PresentAdd').val();
						var	ParmanentAdd = $('#ParmanentAdd').val();
						var block_id	 = $('#block_id').val();
						var status       = $('#status').val();
						var	nationalidNo = $('#nationalidNo').val();
						var	datepicker2	 = $('#date-picker2').val();
						
						var datastr	='ID='+ID+'&company_id='+company_id+'&section_id='+section_id+'&cardno='+cardno+'&empID='+empID+'&nameEN='+nameEN+'&nameBN='+nameBN+'&basic='+basic+'&gross='+gross+'&grade='+grade+'&datepicker='+datepicker+'&designation='+designation+'&nameBN='+nameBN+'&FatherName='+FatherName+'&MotherName='+MotherName+'&MobileNo1='+MobileNo1+'&nationalidNo='+nationalidNo+'&PresentAdd='+PresentAdd+'&ParmanentAdd='+ParmanentAdd+'&block_id='+block_id+'&status='+status+'&birthcerNo='+birthcerNo+'&datepicker2='+datepicker2;
											  
						$.ajax({
						   type:'post' , 
						   url:'includes/production_base_emp_info/production_base_emp_info_edit_by_ajax.php' ,
						   data:datastr ,
						   cache:false,
						   success:function(st){
							 	$('#msg').html(st);
								$('#msg').show();
								reset_btn();
				location.href="?pagetitle=production_employee_info_display&menu_id=22&sm_id=4";
						   }
						});
				}
			});
		
		$('#btn_save_for_production').click(function(){
		    var ID           = $('#ID').val();
			var company_id   = $('#company_id').val();
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
			var	birthcerNo	 = $('#birthcerNo').val();
			var	PresentAdd	 = $('#PresentAdd').val();
			var	ParmanentAdd = $('#ParmanentAdd').val();
			var block_id	 = $('#block_id').val();
			var status       = $('#status').val();
			var	nationalidNo	 = $('#nationalidNo').val();
			var	datepicker2	 = $('#date-picker2').val();
			
			var datastr	='ID='+ID+'&company_id='+company_id+'&section_id='+section_id+'&cardno='+cardno+'&empID='+empID+'&nameEN='+nameEN+'&nameBN='+nameBN+'&basic='+basic+'&gross='+gross+'&grade='+grade+'&datepicker='+datepicker+'&designation='+designation+'&nameBN='+nameBN+'&FatherName='+FatherName+'&MotherName='+MotherName+'&MobileNo1='+MobileNo1+'&nationalidNo='+nationalidNo+'&PresentAdd='+PresentAdd+'&ParmanentAdd='+ParmanentAdd+'&block_id='+block_id+'&status='+status+'&birthcerNo='+birthcerNo+'&datepicker2='+datepicker2;
								  
			$.ajax({
			   type:'post' , 
			   url:'includes/production_base_emp_info/production_base_emp_info_edit_by_ajax.php' ,
			   data:datastr ,
			   cache:false,
			   success:function(st){
			      alert(st);   
				  location.href="?pagetitle=production_employee_info_display&menu_id=22&sm_id=4";
			   }
			});
		});		
	});	
</script>
<script>
function getname(card_no){
	var section_id	=$('#section_id').val();
	var datastr	='card_no='+card_no+'&section_id='+section_id;
	$.ajax({
			type	:'post',
			url		:'includes/fixed_salary_employee_info/get_name.php',
			data	:datastr,
			cache	:false,
			success	:function(str){
				$('#name').val(str);	
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
		success	:function(str)	{
			$('#block_id').html(str);
		}		
	});
}
function reset_btn(){
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
	$('#ID').val('');
}
</script>
    <!-- /TinyMCE -->
	<input type="hidden" id="ID" value="<?php echo $ID;?>"/>
	<input type="hidden" id="company_id" value="<?php echo $company_id;?>"/>
	<input type="hidden" id="section_id_container" value="<?php echo $section_id;?>"/>
           <div class="grid_10">
            <div class="box round first fullpage">
                <h2>Update Production Employee Info</h2>
                <div class="block" id="block">
                	<div class='message info' id="msg">
						</div>
                    <table class="form">
                        <tr>
                            <td><label>Section</label></td>
                            <td ><select id="section_id" name="section_id" onchange="get_block(this.value)" style="width:150px;">
                             <option value="0">None</option>
                               <?php
								$sql = "select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P'  order by TBL_PAY_SECTION_INFO.ID";
								$stid	= oci_parse($conn, $sql);
								oci_execute($stid);
								
								while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) {
									echo '<option value='.$row[0].'>'.$row[1].'</option>';
								}
								?>
                            </select></td>
                            <td><label>Block/Line</label></td>
							<td colspan="2">							
							<select id="block_id" name="block_id" style="width:150px;">
                             <?php
							 	$i		=0;
								$sel	="";
								$sql	="select ID,BLOCK_NAME from TBL_PAY_SECTION_BLOCK where SECTION_ID=$section_id  and COMPANY_ID=$company_id";
								$stid	= oci_parse($conn, $sql);
								oci_execute($stid);
								while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
								{
									$i++;
									if($block_id==$row[0])
										$sel ="selected";
									else
										$sel	="";
									echo '<option value='.$row[0].' '.$sel.'>'.$row[1].'</option>';
								}
								if($i==0)
								{
									echo '<option value="">NONE</option>';
								}
							 ?>
                             </select>
							</td>
                        </tr>
                        <tr>
                               <td><label>Card No</label></td>
                               <td><input type="text" class="error" id="cardno" onblur="getname(this.value)"  value="<?php echo $card_id;?>" readonly="readonly"/> <span class="error">This is a required field.</span></td>
                               <td><label>Emp ID</label></td>
                               <td><input type="text" id="empID" onblur="getname(this.value)" class="success" value="<?php echo $employee_id;?>"/><span class="success">Enter The RF Card number.</span></td>
                        </tr>
						<tr>
						    <td><label>Name(English)</label></td>
                            <td><input type="text" id="nameEN" class="error" value="<?php echo $employee_name;?>"/><span class="error">This is a required field.</span></td>							
								<!-- Enter the name of bangla using Avro unicode  -->
							<td><label>Name(Bangla)</label></td>
                            <td><input type="text" id="nameBN" class="success" value="<?php echo $bng_name;?>"/><span class="success">Enter Bangla name by Avro.</span></td>								
						</tr>
                        <tr>
                            <td><label>Basic</label></td>
                            <td><input type="text" id="basic" onblur="get_gross(this.value)" value="<?php echo $basic;?>" class="error"/><span class="error">This is a required field.</span></td>
                            <td><label>Gross</label></td>
                            <td><input type="text" id="gross" onblur="get_basic(this.value)" class="error" value="<?php echo $gross; ?>"/><span class="error">This is a required field.</span></td>
                        </tr>
					   <tr>                        
                            <td><label>Grade</label></td>
            				<td><input type="text" id="grade"  value="<?php echo $grade;?>" class="warning" /></td>
						    <td><label>Designation</label></td>
                            <td><input type="text" id="designation" value="<?php echo $designation;?>"   class="warning"/></td>
                        </tr>						
						<tr>
							<td><label>Joining Date</label></td>
              				<td><input type="text" id="date-picker" class="error" value="<?php echo $new_date;?>"/><span class="error">&nbsp;mm/dd/yyyy</span></td>
              				<td><label>Mobile No1</label></td>
                            <td><input type="text" id="MobileNo1" value="<?php echo $mobile_no1;?>" class="error"/><span class="error">This is a required field.</span></td>
                         </tr>
                         <tr>
                         	<td><label>Date of Birth</label></td>
              				<td><input type="text" id="date-picker2" class="error" value="<?php echo $new_date2;?>"/><span class="error">&nbsp;mm/dd/yyyy</span></td>
							<td><label>Status</label></td>
							<td>
                                <select id="status" style="width:150px;">
								  <option value="1" <?php if($status==1) echo 'selected'; ?>>Available</option>
								  <option value="2" <?php if($status==2) echo 'selected'; ?>>Fired</option>
								  <option value="3" <?php if($status==3) echo 'selected'; ?>>Suspend</option>
                                  <option value="4" <?php if($status==4) echo 'selected'; ?>>Resign</option>
								</select>
							</td>				
						</tr>  
                        <tr><td colspan="4" align="center"></td></tr>
                    </table>
					
					<h4>Employee Personal Details</h4>
					<hr>					
					 <table class="form">
                            <tr>
                                <td><label>Father Name</label></td>
                                <td><input type="text" id="FatherName" class="success" value="<?php echo $father_name;?>"/></td>
                                <td><label>Mother Name</label></td>
                                <td><input type="text" id="MotherName" class="success"  value="<?php echo $mother_name;?>" /></td>
							</tr>							
							<tr>
                                <td><label>Birth Cert No</label></td>
                                <td><input type="text" id="birthcerNo" value="<?php echo $birthcerNo;?>" class="success"/><span class="success">This is a optinal field.</span></td>
                                <td><label>National Id No</label></td>
                                <td><input type="text" id="nationalidNo"  value="<?php echo $national_id;?>" class="success" /><span class="success">This is a optinal field</span></td>		
							</tr>
							<tr>
                                <td><label>Present Address</label></td>
                                <td><input id="PresentAdd" value="<?php echo $present_address;?>" class="large" /></td>
                                <td><label>Parmanent Address</label></td>
                                <td><input id="ParmanentAdd" value="<?php echo $parmanent_address;?>" class="large" /></td></tr>
							</table>
					<hr/>
					<div align="right">
					<input type="button" name="btn_save" id="btn_save_for_production" value=" &nbsp;&nbsp;Save&nbsp;&nbsp;" class="btn btn-navy" />
					<input type="button" name="btn_reset" id="btn_reset" value=" &nbsp;&nbsp;Reset&nbsp;&nbsp;" class="btn btn-blue" onclick="reset_btn()" />
					</div>
                </div>         
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
<?php
oci_free_statement($stid);
oci_free_statement($stm);
oci_close($conn);
?>