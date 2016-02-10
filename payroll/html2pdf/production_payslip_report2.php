<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
<?php  
ob_start();  //$dateid	=$_GET['dateid']; 
include("../includes/db.php"); 
?>
<style type="text/css">
		<!--
		table{ width:  100%;  border: solid 1px #000;}
		th{ text-align: center; border: solid 1px #000;  background: #EEFFEE;	}
		td{ text-align: left; border: solid 1px #000; }
		td.col1{   border: solid 1px #000;   text-align: right;}
		-->
</style>
<table  cellpadding="0" cellspacing="0" width="100%">
  	<!--<col style="width: 5%" class="col1">
    <col style="width: 25%">
    <col style="width: 30%">
    <col style="width: 20%">
    <col style="width: 20%">-->
    <thead>
    	<tr><th colspan="8">Header </th></tr>		
    </thead>
	<tbody>
<?php	$company_id = 1; $section_id = 3; //$_SESSION['company_id']; ?>		
   <tr>
	    <td>ID/আই. ডি:G225g</td><td>Grade/গ্রেড:D56</td><td>Dept/ডিপার্টমেন্ট:Knitting</td>
		<td>Gross/সর্বমোট:6500</td>
    </tr>
    <tr>	 
	   <td>Name/নাম:Mr. Abul Mal Abdul Muhid</td><td></td>
	   <td>Designation/পদ:Jr. Operator</td><td>Attendance/উপস্থিতি:2500</td>		
	</tr>	
    <tr>	 
	   <td>PC Rate Pay/উৎপাদন হার:Mr. Abul Mal Muhid</td><td>Holiday/ছুটি:1500</td><td></td>
	   <td>Revenue Stamp:100</td>		
	</tr>	
    <tr>	 
	   <td>Production Bonus/উৎপাদন বোনাস :550</td><td>Attendance/:10</td>
	   <td></td><td>Net Total/মোট :8500</td>		
	</tr>		
    <tr>	 
	   <td>Others/ অন্যান্য :15</td><td>No Job/কাজ নাই:0</td>
	   <td></td><td></td>		
	</tr>			
    <tr>	 
	   <td>Eight thousand five hundred taka only</td><td></td><td></td>
	   <td>Signature</td>		
	</tr>				

</tbody>
   <tfoot>
        <tr>
            <th colspan="8" style="font-size: 16px;">
                 Title footer
            </th>
        </tr>
    </tfoot>
</table>
<?php
		$content = ob_get_clean();
		// convert to PDF
		//require_once(dirname(__FILE__).'/../html2pdf.class.php');
		include('html2pdf.class.php');
		try
		{
			$html2pdf = new HTML2PDF('L', 'A4', 'fr');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
			$html2pdf->Output('mojid.pdf');
		}
		catch(HTML2PDF_exception $e) {
			echo $e;
			exit;
		}
?>