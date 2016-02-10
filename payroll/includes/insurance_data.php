<?php
session_start();
ob_start();
include('db.php');
$company_id = $_SESSION['company_id'];
?>
<script type="text/javascript">
$(document).ready(function(){


	setDatePicker('date-picker');    
   $('#btn_search').click(function(){
		var uurl	='html2pdf/insurance_data.php';		 
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
});
</script>    
 
<div class="grid_10">
    <div class="box round first fullpage">
        <h2>Insurance Data</h2>
        <div class="block" id="block">
            <div align="left">
            <input type="button" name="btn_search" id="btn_search" value=" &nbsp;&nbsp;Search&nbsp;&nbsp;" class="btn btn-navy" />
            </div>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>  