<?php
ob_start();
include('db.php');
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
		var section_id = $('#section_id').val();
		//alert(section_id);		  
		var uurl	='fixed_salary_pdf2.php?dateid='+dateid+'&section_id='+section_id;		 
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


function get_block(sec_id)
{
var datastr	='sec_id='+sec_id;
$.ajax({
		type	:'post',
		url		:'../includes/production_base_emp_info/get_block.php',
		data	:datastr,
		cache	:false,
		success	:function(str)
		{
			$('#block_id').html(str);
		}
		
	});

}
</script>
</head>
<body>
<table>
	<tr>
    	<td>Section</td><td><select id="section_id" name="section_id" onchange="get_block(this.value)">
                             <option value="0">None</option>
                               <?php
								$sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='F'  order by TBL_PAY_SECTION_INFO.ID";
								$stid	= oci_parse($conn, $sql);
								oci_execute($stid);
								
								while(($row = oci_fetch_array($stid, OCI_BOTH))) 
								{
									echo '<option value='.$row[0].'>'.$row[1].'</option>';
								}
								?>
                            </select></td>
                            <td><label>Block/Line</label></td>
							<td colspan="2">
							
							<select id="block_id" name="block_id">
                             <option value="0">None</option>
                             </select>
							</td>
                            <td><input type="text" id="dateid" style="width:" value="09/06/2012" /></td><td><input type="button" name="btn_search" id="btn_search" /></td>
    </tr>
</table>
<div id="pdfdata">
<!--<iframe src="pdfpage.php?dateid=12" width="300" height="500"></iframe>-->
</div>
</body>
</html>