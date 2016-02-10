<?php
ob_start();
include('db.php');
?>
<script type="text/javascript">
$(document).ready(function(){

	setDatePicker('date-picker');
	setDatePicker('dateT');    
   $('#btn_search').click(function(){
		var dateid 		= $('#date-picker').val();
		var dateidT		=$('#dateT').val();

		var uurl	='html2pdf/fixed_emp_salary_pdf_inactive.php?dateid='+dateid+'&dateidT='+dateidT;		 
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
	
	$('#btn_paysleep').click(function(){
		var dateid 		= $('#date-picker').val();
		var dateidT		=$('#dateT').val();
		
		var uurl	='html2pdf/fixed_emp_paysleep_pdf_inactive.php?dateid='+dateid+'&dateidT='+dateidT;		 
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
		var dateid 		=$('#date-picker').val();
		var dateidT		=$('#dateT').val();
		
		var uurl	='html2pdf/fixed_emp_salary_eot_pdf_inactive.php?dateid='+dateid+'&dateidT='+dateidT;		 
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
	
	$('#btn_paysleep_eot').click(function(){
		var dateid 		=$('#date-picker').val();
		var dateidT		=$('#dateT').val();
		var uurl	='html2pdf/fixed_emp_paysleep_eot_pdf_inactive.php?dateid='+dateid+'&dateidT='+dateidT;		 
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
	});//end extra
});

</script>    
 
<div class="grid_10">
    <div class="box round first fullpage">
        <h2>Fixed Salary Reports(Inactive)</h2>
        <div class="block" id="block">
            <table width="508" class="form">
<tr>
                    <td width="48"><label>From</label></td>
          <td width="162"><input type="text" id="date-picker" class="error"/></td>
          <td width="67"><label>To</label></td>
          <td width="211"><input type="text" id="dateT" class="error"/></td>
              </tr>
            </table>
			<table width="52%" class="form">
   		  <tr>
                    <td colspan="2" width="40%" align="center"><label>Actual Report</label></td>
                    <td colspan="2" align="center"><label>Extra OT Report</label></td>
              	</tr>
                <tr>
                    <td colspan="2" align="center"><input type="button" name="btn_paysleep" id="btn_paysleep" value=" &nbsp;&nbsp;PaySleep&nbsp;&nbsp;" class="btn btn-navy" />&nbsp;<input type="button" name="btn_search" id="btn_search" value=" &nbsp;&nbsp;Salary&nbsp;&nbsp;" class="btn btn-navy" /></td>
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