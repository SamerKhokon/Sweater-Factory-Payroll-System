<?php
ob_start();
//$dateid	=$_GET['dateid'];
include('db.php');
?>


<style type="text/css">
<!--
table
{
    width:  100%;
    border: solid 1px #000;
}

th
{
    text-align: center;
    border: solid 1px #000;
    background: #EEFFEE;
	
}

td
{
    text-align: left;
    border: solid 1px #000;
}

td.col1
{
    border: solid 1px #000;
    text-align: right;
}

-->
</style>


<table border="1" cellpadding="0" cellspacing="0" width="100%">
    
    
  	<!--<col style="width: 5%" class="col1">
    <col style="width: 25%">
    <col style="width: 30%">
    <col style="width: 20%">
    <col style="width: 20%">-->
     
    
    <thead>
    	<tr>
        	<th colspan="8">Header </th>
        </tr>
		
        <!--<tr>
            <th colspan="8" style="font-size: 16px;">Title Header </th>
        </tr>-->
       
        <tr><th>Card ID</th>
            <th>Name</th>
            <th>Style</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Total</th>
            <th>Production Date</th>   
        </tr>
   
        
    </thead>
	<tbody>
<?php	
$emp_profile_str ="select COMPANY_ID,CARD_ID,NAME from TBL_PAY_EMP_PROFILE";
		
		$emp_profile_stm  = oci_parse($conn,$emp_profile_str);
		oci_execute($emp_profile_stm);
		$company_id = 1;//$SESSION['COMPANY_ID'];
while($res = oci_fetch_array($emp_profile_stm,OCI_BOTH)) {
		    
			$card_id    = $res['CARD_ID'];
			$name       = $res['NAME'];			
?>		
	<tr>	
			  <td><?php echo $card_id;?></td>
			  <td><?php echo $name;?></td>
			  <td></td><td></td>			   <td></td><td></td><td></td><td></td>
	</tr>		
<?php 
 $production_str ="select 
			(select STYLE_NAME from TBL_PAY_STYLE_INFO where ID=a.STYLE_ID ) as STYLE_NAME,(select SIZE_NAME from TBL_PAY_SIZE_SETTING where ID=a.SIZE_ID) as SIZE_NAME,QUANTITY,(select RATE from TBL_PAY_RATE_SETTING where STYLE_ID=a.STYLE_ID and SIZE_ID=a.SIZE_ID) as Rate,((select RATE from TBL_PAY_RATE_SETTING where STYLE_ID=a.STYLE_ID and SIZE_ID=a.SIZE_ID)*QUANTITY) as TOTAL,PRO_DATE
			from  TBL_PAY_EMP_PRODUCTION  a where CARD_ID=$card_id AND COMPANY_ID=$company_id";
			$production_stm = oci_parse($conn, $production_str);
			oci_execute($production_stm);
		while($rs = oci_fetch_array($production_stm,OCI_BOTH)) {
			   $style_name = $rs['STYLE_NAME'];
			   $size_name = $rs['SIZE_NAME'];
			   $quantity = $rs['QUANTITY'];
			   $rate = $rs['RATE'];
			   $total = $rs['TOTAL'];
			   $production_date = $rs['PRO_DATE']; 

echo            "<tr>
				<td></td>
				<td></td>			   
				<td>$style_name</td>
				<td>$size_name</td>
				<td>$quantity</td>
				<td>$rate</td>
				<td>$total</td>
				<td>$production_date</td>
		 </tr>";
	
  }  

 } 
    
  echo '</tbody>
   <tfoot>
        <tr>
            <th colspan="8" style="font-size: 16px;">
                 Title footer
            </th>
        </tr>
    </tfoot>
</table>';

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