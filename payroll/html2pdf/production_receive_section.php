<?php
ob_start();
include_once("../includes/opSessionCheck.inc");
include_once("../includes/function.php");
include("../includes/db.php");
$dateid		=trim($_GET['dateid']);
$company_id =$_SESSION['company_id'];
$section_id	=trim($_GET['section_id']);
$dateto		=trim($_GET['dateto']);
$block_id	=trim($_GET['block_id']);

$month_year1=substr($_GET['dateid'],0,3).''.substr($_GET['dateid'],6,10);
$month_year2=substr($_GET['dateto'],0,3).''.substr($_GET['dateto'],6,10);
?>
<style type="text/css">
	<!--
	.htable{
	border:none;
	display:block;
	width:  94%;
	
	
	}
	tr .htable {
	border:none;
	display:block;
	
	
	}
	td .htable {
	border:none;
	display:block;
	
	
	}
	.htd{ border:1px solid #00FF00; background-color:#FF0000;}
	
	.btable{ width:  100%;  border: solid 1px #000;}
	.btable th{ text-align: center; border: solid 1px #000; height:30px;	}
	.btable td{ text-align: left; border: solid 1px #000; height:25px; }
	.btable tr { border:1px solid #000;}
	td.col1{   border: solid 1px #000;   text-align: right;}
	
	-->
</style>
<?php
$str	='Pro Receive Section Wise';
//echo tbl_header($dateid,$str);
?>
<table width="100%">
<tr><td style="width:120px;">&nbsp;</td><td><?php echo tbl_header_fun1($dateid,$dateto,$str); ?></td><td align="left"></td>
</tr>
<!--<tr>
	<td style="width:100px;"></td><td><br />Section:&nbsp;<?php //echo  getSectionName($section_id); ?></td><td align="left"></td>
</tr>-->
</table>

<br/>
<table border="1" cellpadding="0" cellspacing="0" align="center" class="btable">
  	<col style="width: 10%" class="col1">
    <col style="width: 20%">
    <col style="width: 20%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <thead>	
        <tr>
            <th>Section</th>
            <th>Style</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Total Amount</th>
        </tr>
    </thead>
	<tbody>
<?php
$xsqlb	="";
$xsql2	="";
$grand_total_amnt=0;
if($block_id!='')
		$xsqlb	=" and a.BLOCK_ID='$block_id'";
if($section_id!='')
			$xsql2=" and b.SECTION_ID=$section_id ";
			
$sql ="select distinct SECTION_ID,
			(select SEC_NAME FROM TBL_PAY_SECTION_INFO where ID=b.SECTION_ID and COMPANY_ID=b.COMPANY_ID) as SEC_NAME from TBL_PAY_EMP_PRODUCTION b 
			where COMPANY_ID=$company_id ".$xsql2." and SECTION_ID is not null";		
		
		$qstr  = oci_parse($conn,$sql);
		oci_execute($qstr);
		while($rs = oci_fetch_array($qstr,OCI_BOTH+OCI_RETURN_NULLS)){
		$section_id2   = $rs['SECTION_ID'];	
		$section_name = $rs['SEC_NAME'];
		echo   "<tr><td>$section_name</td><td colspan='5'></td></tr>";		
		
$production_str ="select (select STYLE_NAME from TBL_PAY_STYLE_INFO where  ID=a.STYLE_ID and COMPANY_ID=$company_id) as STYLE_NAME,(select SIZE_NAME from TBL_PAY_SIZE_SETTING where ID=a.SIZE_ID and STYLE_ID=a.STYLE_ID and COMPANY_ID=$company_id) as SIZE_NAME,(select RATE from TBL_PAY_RATE_SETTING where STYLE_ID=a.STYLE_ID and SIZE_ID=a.SIZE_ID and COMPANY_ID=$company_id and SECTION_ID=$section_id2) as RATE,sum(QUANTITY)  as QUANTITY from TBL_PAY_EMP_PRODUCTION a where  a.COMPANY_ID=$company_id and a.SECTION_ID=$section_id2 ".$xsqlb." and  to_char(a.pro_date,'mm/dd/YYYY') between '$dateid' and '$dateto'  group by STYLE_ID,SIZE_ID order by STYLE_ID";

		$production_stm = oci_parse($conn, $production_str);
		oci_execute($production_stm);
		$total_quantity = 0;
		$pdN='';
		$total_amnt=0;	
		while($rs = oci_fetch_array($production_stm,OCI_BOTH+OCI_RETURN_NULLS))
		{
		   $style_name = $rs['STYLE_NAME'];
		   $size_name  = $rs['SIZE_NAME'];
		   
		    if($pdN != $rs['STYLE_NAME']){
			 $pdN = $rs['STYLE_NAME']; 
			 $style_name1= $rs['STYLE_NAME'];
			  }
			  else 
			 $style_name1='';
			
		   $quantity   = $rs['QUANTITY'];			   
		   
		   $rate       = $rs['RATE'];
		   if($rate=='')
		   	$rate	=0;
		   $total_quantity += $quantity;
		   $total = $quantity * $rate;
		   
		   $total_amnt	+=$total;
			   
	echo   "<tr>
				<td></td>
				<td>$style_name1</td>
				<td>$size_name</td>
				<td>$quantity</td>
				<td>$rate</td>
				<td>$total</td>
		 </tr>";	
  } 
           echo "<tr>
		   <td></td><td></td><td>Total</td>
		   <td>$total_quantity</td><td>Total Amnt</td><td>$total_amnt</td>	   
		   </tr>";
		 $grand_total_amnt	+=$total_amnt;   
}
echo "<tr>
		   <td colspan='5'>Grand Total</td><td>$grand_total_amnt</td>	   
		   </tr>";  
		    
  echo '</tbody></table>';
echo tbl_footer_A4();

$content = ob_get_clean();
include('html2pdf.class.php');
try
{
	$html2pdf = new HTML2PDF('P', 'A4', 'fr');
	$html2pdf->pdf->SetDisplayMode('fullpage');
	$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
	$html2pdf->Output('mojid.pdf');
}
catch(HTML2PDF_exception $e) {
	echo $e;
	exit;
}
?>