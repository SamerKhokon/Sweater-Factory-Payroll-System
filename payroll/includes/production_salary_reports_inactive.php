<?php
session_start();
ob_start();
include('db.php');
$company_id2=$_SESSION["company_id"];
?>
<script type="text/javascript">
$(document).ready(function(){


	setDatePicker('date-picker');
	setDatePicker('dateT');    
   $('#btn_search').click(function(){
		var dateid = $('#date-picker').val();
		var dateidT		=$('#dateT').val();
		var company_id2	='<?php echo $company_id2;?>';
		if(company_id2==2)
		{
		var uurl	='html2pdf/production_emp_salary_pdf_inactive_top_style.php?dateid='+dateid+'&dateidT='+dateidT;
		}
		else
		{
			var uurl	='html2pdf/production_emp_salary_pdf_inactive.php?dateid='+dateid+'&dateidT='+dateidT;
		}		 
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
		var dateidT		=$('#dateT').val();
		var company_id2	='<?php echo $company_id2;?>';
		
		//alert(section_id);
		if(company_id2==2)
		{		  
			var uurl	='html2pdf/production_emp_paysleep_pdf_inactive_top_style.php?dateid='+dateid+'&dateidT='+dateidT;
		}
		else
		{
			var uurl	='html2pdf/production_emp_paysleep_pdf_inactive.php?dateid='+dateid+'&dateidT='+dateidT;
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
	
	$('#btn_salary_eot').click(function(){
		var dateid = $('#date-picker').val();
		var dateidT		=$('#dateT').val();
		var uurl	='html2pdf/production_emp_salary_eot_pdf_inactive.php?dateid='+dateid+'&dateidT='+dateidT;		 
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
		var dateidT		=$('#dateT').val();
		//alert(section_id);		  
		var uurl	='html2pdf/production_emp_paysleep_eot_pdf_inactive.php?dateid='+dateid+'&dateidT='+dateidT;		 
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

</script>    
 
<div class="grid_10">
    <div class="box round first fullpage">
        <h2>Production Employee Salary Reports(Inactive)</h2>
        <div class="block" id="block">
            <table width="100%" class="form">
<tr>
                    <td width="93"><label>From</label></td>
          <td width="396"><input type="text" id="date-picker" class="error"/></td>
          <td width="136"><label>To</label></td>
          <td width="330"><input type="text" id="dateT" class="error"/> </td>
              </tr>
                <tr>
                    <td colspan="4" align="center"></td>
                </tr>
            </table>
		  <table width="100%" class="form">
		    <tr>
              <td colspan="2" align="center"><label>Actual Report</label></td>
                  <td colspan="2" align="center"><label>Extra OT Report</label></td>
           	  </tr>
                <tr>
                    <td colspan="2" align="center"><input type="button" name="btn_paysleep" id="btn_paysleep" value=" &nbsp;&nbsp;PaySleep&nbsp;&nbsp;" class="btn btn-navy" />
                      &nbsp;
                  <input type="button" name="btn_search" id="btn_search" value=" &nbsp;&nbsp;Salary&nbsp;&nbsp;" class="btn btn-navy" /></td>
                  <td colspan="2" align="center"><input type="button" name="btn_paysleep_eot" id="btn_paysleep_eot" value=" &nbsp;&nbsp;PaySleep&nbsp;&nbsp;" class="btn btn-maroon" />&nbsp;<input type="button" name="btn_salary_eot" id="btn_salary_eot" value=" &nbsp;&nbsp;Salary&nbsp;&nbsp;" class="btn btn-maroon" /></td>
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