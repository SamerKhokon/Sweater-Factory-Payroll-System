<?php
ob_start();
include_once("../includes/opSessionCheck.inc");
include_once("../includes/function.php");
include("../includes/db.php");
//style_wise_production_summery.php

$company_id	=$_SESSION["company_id"];
?>
<style type="text/css">
		<!--
.details
{
    width:  100%;
	border-top:6px solid #FF0000;
	display:block;
	
}

.htu
{
    text-align: center;
    border: solid 5px #000;

	
}
.details th
{
    text-align: center;
    border: solid 0px #000;
	height:30px;
	font-size:20px;
	
}

.details td
{
    text-align: center;
    border: solid 0px #000;
	height:25px;
}
.details.td.col1
{
    border: solid 1px #000;
    text-align: right;
}

head.table
{
    width:  100%;
    border: solid 0px #000;
}
-->
</style>  
  
<?php
	$str	='Insurance Data';
	$dateT = date('Y/m/d');
	echo tbl_header($dateT,$str);
?>
<br />
<table border="0" cellpadding="0" cellspacing="0"  align='center' class="details">
  	<thead>
    <tr>
       <th  style="border-top:2px solid #000000;border-right:1px solid #000000;  border-left:1px solid #000000; border-bottom:1px solid #000000;">SL No</th>
       <th style="border-top:2px solid #000000; border-right:1px solid #000000;  border-bottom:1px solid #000000;">Name</th>
         <th style="border-top:2px solid #000000; border-right:1px solid #000000;  border-bottom:1px solid #000000;">Designation</th>
         <th style="border-top:2px solid #000000; border-right:1px solid #000000;  border-bottom:1px solid #000000;">ID No</th>
       <th style="border-top:2px solid #000000; border-right:1px solid #000000;  border-bottom:1px solid #000000;">Date of birth</th>
       <th style="border-top:2px solid #000000; border-right:1px solid #000000;  border-bottom:1px solid #000000;">Join Date</th>
    </tr>
    </thead>
    <tbody>  
	<?php 
			$i	=0;
			$str_for_all = "select NAME,DESIGNATION,CARD_ID,to_char(DATEOFBIRTH,'dd/mm/YYYY') DATEOFBIRTH,to_char(JOIN_DATE,'dd/mm/YYYY') JOIN_DATE,cast(substr(CARD_ID,2,9) as number) as pp from TBL_PAY_EMP_PROFILE WHERE COMPANY_ID=$company_id and STATUS=1 order by pp";
$qstr_m = oci_parse($conn,$str_for_all);    
oci_execute($qstr_m);
			while(($res = oci_fetch_array($qstr_m, OCI_BOTH)))
			{
			$i++;
			?>
			<tr>
                <td style="border-left:1px solid #000000;border-right:1px solid #000000;"><?php echo $i; ?></td>
                <td style="border-right:1px solid #000000;"><?php echo $res['NAME']; ?></td>
                <td style="border-right:1px solid #000000;"><?php echo $res['DESIGNATION']; ?></td>
                <td style="border-right:1px solid #000000;"><?php echo $res['CARD_ID']; ?></td>
                <td style="border-right:1px solid #000000;"><?php echo $res['DATEOFBIRTH']; ?></td>
                <td style="border-right:1px solid #000000;"><?php echo $res['JOIN_DATE']; ?></td>
			</tr>
			<?php
			}  
	?>
	</tbody>
    <tfoot>
        <tr>
            <th colspan="6" style="font-size: 16px; border-top:1px solid #000000;">
            </th>
        </tr>
    </tfoot>
</table>
<?php
	oci_free_statement($qstr);
	oci_close($conn);
	$content = ob_get_clean();
	include('html2pdf.class.php');
	try
	{
		$html2pdf = new HTML2PDF('P', 'A4', 'fr');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output('lusine.pdf');
	}
	catch(HTML2PDF_exception $e) {
		echo $e;
		exit;
	}
?>