<?php
ob_start();
include_once("../includes/opSessionCheck.inc");
include_once("../includes/function.php");
include("../includes/db.php");
$year_date	=trim($_GET['year_date']);
$sampleArray=trim($_GET['sampleArray']);
$company_id = $_SESSION['company_id'];
if($year_date=='')
$year_date=date('d/m/Y');

if($year_date!='')
$year_date=substr($_GET['year_date'],6,10);
else
$year_date=date('Y');

$where="";
$th="";
$td="";
$sampleArray=explode(',',$sampleArray);

for($i=0;$i<count($sampleArray);$i++)
{
$sql="select SEC_NAME from TBL_PAY_SECTION_INFO where ID='".$sampleArray[$i]."'";
$qstr  =oci_parse($conn,$sql);
oci_execute($qstr);
	if($row =oci_fetch_array($qstr,OCI_BOTH+OCI_RETURN_NULLS)){
	$th.='<th colspan="3" align="center">'.$row[0].'</th>&nbsp;';
	$td.='<td>Today</td><td>Total</td><td>Due</td>';
	}
}
$unit_price=0;


$str='Production Follow Up Daily';
?>
<style type="text/css">
<!--
.details table
{
    width:  100%;
    border: solid 0px #000;
}

.details th
{
    text-align: center;
    border: solid 1px #000;
	height:30px;
	
}

.details td
{
    text-align: center;
    border: solid 1px #000;
	height:50px;
}
.details td.col1
{
    border: solid 1px #000;
    text-align: right;
}

.head table
{
    width:  100%;
    border: solid 0px #000;
}

-->
</style>
<table width="100%" align="center">
<tr><td>&nbsp;</td><td style="width:260px;"><?php echo tbl_header($year_date,$str); ?></td><td align="left"></td>
</tr>
</table>
<br/>
<table border="1" cellpadding="0" cellspacing="0" align="center" class="btable">
    <thead>	
        <tr>
            <th rowspan="2">Buyer</th>
            <th rowspan="2">Merchendiser</th>
            <th rowspan="2">Style Name</th>
            <th rowspan="2">Ord.Qty</th>
            <th rowspan="2">Adding<br />% Qty</th>
            <th rowspan="2">Gauge</th>
            <th rowspan="2">Machine<br />Qty</th>
           <!-- <th colspan="3" align="center">Knitting</th>
            <th colspan="3" align="center">Linking</th>
            <th colspan="3" align="center">Mending</th>
            <th colspan="3" align="center">Washing</th>
            <th colspan="3" align="center">Packgeing</th>-->
            <?php
			echo $th;
			?>
        </tr>
        <tr>
            <?php
			echo $td;
			?>
        </tr>
    </thead>
	<tbody>
<?php
$where	=" where to_char(a.ORDER_DATE,'yyyy')='$year_date'";

$mtd="";
$sql="select a.ID,a.BUYER_NAME,a.MERCH_NAME,a.QUENTITY,a.ORDER_QTY,a.UNIT_PRICE,a.SHIPMENT_DATE,a.SHIP_STATUS,GAUGE,ORDER_QTY,STYLE_NAME,MACHINE_QTY,(select STYLE_ID from TBL_PAY_EMP_PRODUCTION where STYLE_ID=a.ID and ROWNUM<2) as style_id from TBL_PAY_STYLE_INFO a ".$where." ";


$qstr  =oci_parse($conn,$sql);
oci_execute($qstr);
while($row =oci_fetch_array($qstr,OCI_BOTH+OCI_RETURN_NULLS)){

$buyer=$row[1];
$merchendiser=$row[2];
$style_id=$row[0];
$unit_price=$row[5];
$order_qty=$row[9];
$machine_qty=$row[11];
$order_value=$unit_price * $order_qty;
$ship_status=$row[7];
if($ship_status=='')
$ship_status='Unshipped';

$mtd="";

for($i=0;$i<count($sampleArray);$i++)
{
$sec_id=$sampleArray[$i];
$total_sec_qty=section_product($sec_id,$style_id,$year_date);
if($total_sec_qty['todayr_quantity']=='')
		$total_todayqty=0;
	else
		$total_todayqty=$total_sec_qty['todayr_quantity'];
	$total_allqty=$total_sec_qty['allr_quantity'];
	
	
	$mtd .='<td>'.$total_todayqty.'</td><td>'.$total_allqty.'</td><td>'.($row[3]-$total_allqty).'</td>';
	
}

	
echo '<tr><td>'.$buyer.'</td><td>'.$merchendiser.'</td><td>'.$row[10].'</td><td>'.$row[9].'</td><td>'.$row[3].'</td><td>'.$row[8].'</td><td>'.$machine_qty.'</td>'.$mtd.'</tr>';

}

echo '</tbody></table>';

oci_free_statement($qstr);
oci_close($conn);

$content = ob_get_clean();
include('html2pdf.class.php');
try
{
	$html2pdf = new HTML2PDF('L', 'Legal', 'fr');
	$html2pdf->pdf->SetDisplayMode('fullpage');
	$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
	$html2pdf->Output('mojid.pdf');
}
catch(HTML2PDF_exception $e) {
	echo $e;
	exit;
}
?>