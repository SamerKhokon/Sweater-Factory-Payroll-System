<?php
ob_start();   
include_once("../includes/opSessionCheck.inc");
include_once("../includes/function.php");
include("../includes/db.php");
$company_id =$_SESSION['company_id'];
$section_id =trim($_GET['section_id']);
$style_id 	=trim($_GET['style_id']);
$datefm		=trim($_GET['dateid']);
$dateto		=trim($_GET['dateto']);

$dateto		=explode("/",$dateto);
$datefm		=explode("/",$datefm);
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
	$str	='The Rate Summery';
	echo tbl_header_fun1($datefm,$dateto,$str)
?>
<br/>
<?php
	$company_id = $_SESSION['company_id'];
	if($section_id==0)
	{
		$sql ="select DISTINCT SECTION_ID from  TBL_PAY_RATE_SETTING where  COMPANY_ID=$company_id";
		$stmt	=oci_parse($conn,$sql);
		oci_execute($stmt);
		 $section_id="";
		while($rs = oci_fetch_array($stmt,OCI_BOTH))
		{
			$section_id .=$rs['SECTION_ID'].',';
		}
		$section_id = substr($section_id,0,strlen($section_id)-1);	
	}
	if($style_id==0)
	{
		$sql ="select DISTINCT STYLE_ID from  TBL_PAY_RATE_SETTING where  COMPANY_ID=$company_id and SECTION_ID in (".$section_id.")";
		$stmt	=oci_parse($conn,$sql);
		oci_execute($stmt);
		$style_id="";
		while($rs = oci_fetch_array($stmt,OCI_BOTH))
		{
			$style_id .=$rs['STYLE_ID'].',';
		}
		$style_id = substr($style_id,0,strlen($style_id)-1);		
	}
	
	$from_date	=from_date($datefm[0],$datefm[2]); //date('01/m/Y');
	$to_date	=to_date($dateto[0],$dateto[2]);//date('t/m/Y');
	
	function from_date($month, $year)
	{
	  if (empty($month)) {
		  $month = date('m');
	   }
	   if (empty($year)) {
		  $year = date('Y');
	   }
	   $result = strtotime("{$year}-{$month}-01");
	   return date('d/m/Y', $result);
	}
	
	function to_date($month, $year) {
		if (empty($month)) {
		  $month = date('m');
		}
		if (empty($year)) {
		  $year = date('Y');
		}
		$result = strtotime("{$year}-{$month}-01");
		$result = strtotime('-1 second', strtotime('+1 month', $result));
		return date('d/m/Y', $result);
	} 
	//str_to_date(ENTY_DATE,'%d/%m/%Y')
	$where	=" where COMPANY_ID=$company_id
	 and to_date(ENTY_DATE,'dd/mm/rrrr') between to_date('$from_date','dd/mm/rrrr') and to_date('$to_date','dd/mm/rrrr') and  SECTION_ID in (".$section_id.")";
	 
	 
	$emp_profile_str ="select DISTINCT SECTION_ID,
	(select SEC_NAME from TBL_PAY_SECTION_INFO where ID=b.SECTION_ID) as SEC_NAME	
	from TBL_PAY_RATE_SETTING b  ".$where." ";		
	
	$stm  = oci_parse($conn,$emp_profile_str);
	oci_execute($stm);
	?>

<table border="0" cellpadding="0" cellspacing="0"  align='center' class="details">
	<col style="width: 30%" class="col1">
    <col style="width: 25%">
    <col style="width: 25%">
    <col style="width: 20%">
    <thead>    
        <tr>
            <th style="border-top:2px solid #000000;border-right:1px solid #000000;  border-left:1px solid #000000;">Section</th>
            <th style="border-top:2px solid #000000; border-right:1px solid #000000;">Style</th>
            <th style="border-top:2px solid #000000; border-right:1px solid #000000;">Size</th>
            <th style="border-top:2px solid #000000; border-right:1px solid #000000;">Rate</th>
        </tr>
    </thead>
    <tbody>
<?php	
	
	while($rs = oci_fetch_array($stm,OCI_BOTH+OCI_RETURN_NULLS))
	{				         			
		$section_name = $rs['SEC_NAME'];
		$section_id   = $rs['SECTION_ID'];
	?>	
	<tr style="font-family:Arial; font-size:20px;">
		<td  style="border-right:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000;"  align="center"><?php echo $rs['SEC_NAME'];?></td>
        <td style="border-right:1px solid #000000; border-top:1px solid #000000;"></td>
        <td style="border-right:1px solid #000000; border-top:1px solid #000000;"></td>
        <td style="border-right:1px solid #000000; border-top:1px solid #000000;"></td>
	</tr>

	<?php 
	//and to_char(b.ENTY_DATE,'mm/dd/yyyy') between '$datefm' and '$dateto' 
	$str = "select (select STYLE_NAME from TBL_PAY_STYLE_INFO where ID=b.STYLE_ID) as STYLE_NAME,(select SIZE_NAME from TBL_PAY_SIZE_SETTING where ID=b.SIZE_ID 
	and STYLE_ID=b.STYLE_ID) as SIZE_NAME,RATE from TBL_PAY_RATE_SETTING b where
	COMPANY_ID=$company_id and section_id=$section_id and STYLE_ID in (".$style_id.")";
	
	$qstr = oci_parse($conn,$str);
	oci_execute($qstr);
	while($r = oci_fetch_array($qstr,OCI_BOTH+OCI_RETURN_NULLS))
	{
	    $style_name = $r['STYLE_NAME']; 
		$size_name  = $r['SIZE_NAME'];
		$rate       = $r['RATE'];  
		?>
		
	  <tr style="font-family:Arial; font-size:20px;">
	     <td style="border-right:1px solid #000000;  border-left:1px solid #000000;"></td>
		 <td style="border-right:1px solid #000000;"><?php echo $style_name;?></td>
		 <td style="border-right:1px solid #000000;"><?php echo $size_name;?></td>
		 <td style="border-right:1px solid #000000;"><?php echo $rate;?></td>		
	  </tr>
		
<?php	}
 } 
 ?>
</tbody>
<tfoot>

     <tr>
        <th colspan="4" style="font-size: 16px;  border-top:1px solid #000000;"></th>
    </tr> 
</tfoot>
</table>
<?php
oci_free_statement($qstr);
oci_free_statement($stmt);
oci_free_statement($stm);
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