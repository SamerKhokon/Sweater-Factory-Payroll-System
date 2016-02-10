<?php
ob_start();
//$content = ob_get_clean();
    // convert to PDF
    //require_once(dirname(__FILE__).'/../html2pdf.class.php');	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="../js/jquery-1.4.2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){    
   $('#btn_search').click(function(){
		var dateid = $('#dateid').val();		  
		var uurl	='pdfpage.php?dateid='+dateid;		 
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
</head>
<body>
<table>
	<tr>
    	<td><input type="text" id="dateid" style="width:" value="12/08/2012" /></td><td><input type="button" name="btn_search" id="btn_search" /></td>
    </tr>
</table>
<div id="pdfdata">
<!--<iframe src="pdfpage.php?dateid=12" width="300" height="500"></iframe>-->
</div>
</body>
</html>