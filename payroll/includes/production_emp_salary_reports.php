﻿<?php
session_start();

ob_start();
include('db.php');
$company_id2		=$_SESSION["company_id"];
?>
<script type="text/javascript">
$(document).ready(function(){


	setDatePicker('date-picker');
	setDatePicker('dateT');    
   $('#btn_search').click(function(){
		var dateid = $('#date-picker').val();
		var section_id = $('#section_id').val();
		var dateidT		=$('#dateT').val();
		var block_id	=$('#block_id').val();
		var company_id2	='<?php echo $company_id2;?>';
		//alert(section_id);
		if(company_id2==2)
		{
			var uurl	='html2pdf/production_emp_salary_pdf_top_style.php?dateid='+dateid+'&section_id='+section_id+'&dateidT='+dateidT+'&block_id='+block_id;
		}
		else
		{
			var uurl	='html2pdf/production_emp_salary_pdf.php?dateid='+dateid+'&section_id='+section_id+'&dateidT='+dateidT+'&block_id='+block_id;
		}
		/*		  
		var uurl	='html2pdf/production_emp_salary_pdf.php?dateid='+dateid+'&section_id='+section_id+'&dateidT='+dateidT+'&block_id='+block_id;
		*/		 
		 if (window.showModalDialog){
			            window.showModalDialog(uurl,"mywindow",
			            "dialogWidth:1024px;dialogHeight:768px");
			        } else {
			            mywindow= window.open ("popup.html", "mywindow","menubar=0,toolbar=0,location=0,resizable=1,status=1,scrollbars=1,width=1024px,height=768px");
			            mywindow.moveTo(300,300);
			            if (window.focus)
			                mywindow.focus();
				}
	});
	$('#btn_paysleep').click(function(){
		var dateid 		=$('#date-picker').val();
		var section_id 	=$('#section_id').val();
		var dateidT		=$('#dateT').val();
		var block_id	=$('#block_id').val();
		var company_id2	='<?php echo $company_id2;?>';
		//alert(section_id);
		if(company_id2==2)
		{
			var uurl	='html2pdf/production_emp_paysleep_pdf_top_style.php?dateid='+dateid+'&section_id='+section_id+'&dateidT='+dateidT+'&block_id='+block_id;
		}
		else
		{		  
			var uurl	='html2pdf/production_emp_paysleep_pdf.php?dateid='+dateid+'&section_id='+section_id+'&dateidT='+dateidT+'&block_id='+block_id;
		}		 
		if (window.showModalDialog)
		{
			window.showModalDialog(uurl,"mywindow","dialogWidth:1024px;dialogHeight:768px");
				
		} 
		else
		{
			mywindow= window.open ("popup.html", "mywindow","menubar=0,toolbar=0,location=0,resizable=1,status=1,scrollbars=1,width=1024px,height=768px");
			mywindow.moveTo(300,300);
			if (window.focus)
				mywindow.focus();
		}
	}); 
	//for buyer
	$('#btn_salary_buyer').click(function(){
		var dateid = $('#date-picker').val();
		var section_id = $('#section_id').val();
		var dateidT		=$('#dateT').val();
		var block_id	=$('#block_id').val();	  
		var uurl	='html2pdf/production_emp_salary_buyer_pdf.php?dateid='+dateid+'&section_id='+section_id+'&dateidT='+dateidT+'&block_id='+block_id;		 
		 if (window.showModalDialog){
			            window.showModalDialog(uurl,"mywindow",
			            "dialogWidth:1024px;dialogHeight:768px");
			        } else {
			            mywindow= window.open ("popup.html", "mywindow","menubar=0,toolbar=0,location=0,resizable=1,status=1,scrollbars=1,width=1024px,height=768px");
			            mywindow.moveTo(300,300);
			            if (window.focus)
			                mywindow.focus();
				}
	});
	$('#btn_paysleep_buyer').click(function(){
		var dateid 		= $('#date-picker').val();
		var section_id 	= $('#section_id').val();
		var dateidT		=$('#dateT').val();
		var block_id	=$('#block_id').val();
		//alert(section_id);		  
		var uurl	='html2pdf/production_emp_paysleep_buyer_pdf.php?dateid='+dateid+'&section_id='+section_id+'&dateidT='+dateidT+'&block_id='+block_id;		 
		if (window.showModalDialog)
		{
			window.showModalDialog(uurl,"mywindow","dialogWidth:1024px;dialogHeight:768px");
				
		} 
		else
		{
			mywindow= window.open ("popup.html", "mywindow","menubar=0,toolbar=0,location=0,resizable=1,status=1,scrollbars=1,width=1024px,height=768px");
			mywindow.moveTo(300,300);
			if (window.focus)
				mywindow.focus();
		}
	});
	//end buyer
	
	$('#btn_salary_eot').click(function(){
		var dateid = $('#date-picker').val();
		var section_id = $('#section_id').val();
		var dateidT		=$('#dateT').val();
		var block_id	=$('#block_id').val();	  
		var uurl	='html2pdf/production_emp_salary_eot_pdf.php?dateid='+dateid+'&section_id='+section_id+'&dateidT='+dateidT+'&block_id='+block_id;		 
		 if (window.showModalDialog){
			            window.showModalDialog(uurl,"mywindow",
			            "dialogWidth:1024px;dialogHeight:768px");
			        } else {
			            mywindow= window.open ("popup.html", "mywindow","menubar=0,toolbar=0,location=0,resizable=1,status=1,scrollbars=1,width=1024px,height=768px");
			            mywindow.moveTo(300,300);
			            if (window.focus)
			                mywindow.focus();
				}
	});
	$('#btn_paysleep_eot').click(function(){
		var dateid 		= $('#date-picker').val();
		var section_id 	= $('#section_id').val();
		var dateidT		=$('#dateT').val();
		var block_id	=$('#block_id').val();
		//alert(section_id);		  
		var uurl	='html2pdf/production_emp_paysleep_eot_pdf.php?dateid='+dateid+'&section_id='+section_id+'&dateidT='+dateidT+'&block_id='+block_id;		 
		if (window.showModalDialog)
		{
			window.showModalDialog(uurl,"mywindow","dialogWidth:1024px;dialogHeight:768px");
				
		} 
		else
		{
			mywindow= window.open ("popup.html", "mywindow","menubar=0,toolbar=0,location=0,resizable=1,status=1,scrollbars=1,width=1024px,height=768px");
			mywindow.moveTo(300,300);
			if (window.focus)
				mywindow.focus();
		}
	});//end extra ot

});


function get_block(sec_id)
{
var datastr	='sec_id='+sec_id;
$.ajax({
		type	:'post',
		url		:'includes/production_base_emp_info/get_block.php',
		data	:datastr,
		cache	:false,
		success	:function(str)
		{
			$('#block_id').html(str);
		}
		
	});

}
</script>    
 
<div class="grid_10">
    <div class="box round first fullpage">
        <h2>Production Employee Salary Reports</h2>
        <div class="block" id="block">
            <table width="728" class="form">
<tr>
                    <td width="65"><label>Section</label></td>
<td width="409"><select id="section_id" name="section_id" onchange="get_block(this.value)" style="width:150px;">
                     <option value="0">None</option>
                       <?php
					   	$company_id		=$_SESSION["company_id"];
                        $sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P' and TBL_PAY_SECTION_INFO.COMPANY_ID=$company_id  order by TBL_PAY_SECTION_INFO.ID";
                        $stid	= mysqli_query($conn, $sql);
                        
                        
                        while(($row = mysqli_fetch_array($stid))) 
                        {
                            echo '<option value='.$row[0].'>'.$row[1].'</option>';
                        }
                        ?>
                    </select></td>
          <td width="66"><label>Block/Line</label></td>
  <td width="168" colspan="2">
                    
<select id="block_id" name="block_id" style="width:150px;">
                     <option value="">ALL</option>
                     </select>							</td>
              </tr>
                
                <tr>
                    <td><label>From</label></td>
                    <td><input type="text" id="date-picker" class="error"/></td>
                    <td><label>To</label></td>
                    <td><input type="text" id="dateT" class="error"/> </td>
                </tr>
                <tr>
                    <td colspan="4" align="center"></td>
                </tr>
            </table>
<table width="59%" class="form">
<tr>
                    <td colspan="2" align="center"><label>Actual Report</label></td>
                  <td colspan="2" align="center"><label>Extra OT Report</label></td>
                  <td width="33%" colspan="2" align="center"><label>Buyers Report</label></td>
           	  </tr>
                <tr>
                    <td colspan="2" align="center"><input type="button" name="btn_paysleep" id="btn_paysleep" value=" &nbsp;&nbsp;PaySleep&nbsp;&nbsp;" class="btn btn-navy" />&nbsp;<input type="button" name="btn_search" id="btn_search" value=" &nbsp;&nbsp;Salary&nbsp;&nbsp;" class="btn btn-navy" /></td>
                    <td colspan="2" align="center"><input type="button" name="btn_paysleep_eot" id="btn_paysleep_eot" value=" &nbsp;&nbsp;PaySleep&nbsp;&nbsp;" class="btn btn-maroon" />&nbsp;<input type="button" name="btn_salary_eot" id="btn_salary_eot" value=" &nbsp;&nbsp;Salary&nbsp;&nbsp;" class="btn btn-maroon" /></td>
                    <td colspan="2" align="center"><input type="button" name="btn_paysleep_buyer" id="btn_paysleep_buyer" value=" &nbsp;&nbsp;PaySleep&nbsp;&nbsp;" class="btn btn-green" />&nbsp;<input type="button" name="btn_salary_buyer" id="btn_salary_buyer" value=" &nbsp;&nbsp;Salary&nbsp;&nbsp;" class="btn btn-green" /></td>
                </tr>
            </table>
      </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>
    