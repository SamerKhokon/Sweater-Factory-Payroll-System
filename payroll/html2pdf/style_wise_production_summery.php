<?php
ob_start();
include_once("../includes/opSessionCheck.inc");
include_once("../includes/function.php");
include("../includes/db.php");
//style_wise_production_summery.php

$company_id	=$_SESSION["company_id"];
$all 		=$_GET['style_id'];
$year		=$_GET['year'];
$year		=explode("/",$year);

  if($all=="*"){
  
  		
		$str_for_all = "select distinct STYLE_NAME,BUYER_NAME,QUENTITY,
(select sum(QUANTITY) from tbl_pay_emp_production where STYLE_ID=b.ID) as total,ID 
 from TBL_PAY_STYLE_INFO b where to_char(ORDER_DATE,'mm/YYYY')='$year[0]/$year[2]' order by STYLE_NAME asc";
  }
  else
  {
		$str_for_all = "select distinct STYLE_NAME,BUYER_NAME,QUENTITY,
(select sum(QUANTITY) from tbl_pay_emp_production where STYLE_ID=b.ID) as total,ID 
 from TBL_PAY_STYLE_INFO b  where b.ID=$all and to_char(ORDER_DATE,'mm/YYYY')='$year[0]/$year[2]'  order by STYLE_NAME asc";
 
  }
  $qstr_m = oci_parse($conn,$str_for_all);    
  oci_execute($qstr_m);
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
	$str	='Style Wise Production Reports';
	$dateT = date('Y/m/d');
	echo tbl_header($dateT,$str);
?>
<br />
<table border="0" cellpadding="0" cellspacing="0"  align='center' class="details">
<!--	<col style="width: 30%" class="col1">
    <col style="width: 35%">
    <col style="width: 35%">-->
  	<thead>
    <tr>
       <th  style="border-top:2px solid #000000;border-right:1px solid #000000;  border-left:1px solid #000000; border-bottom:1px solid #000000;">Style Name</th>
       <th style="border-top:2px solid #000000; border-right:1px solid #000000;  border-bottom:1px solid #000000;">Section Name</th>
         <th style="border-top:2px solid #000000; border-right:1px solid #000000;  border-bottom:1px solid #000000;">Buyer Name</th>
       <th style="border-top:2px solid #000000; border-right:1px solid #000000;  border-bottom:1px solid #000000;">Start Date</th>
       <th style="border-top:2px solid #000000; border-right:1px solid #000000;  border-bottom:1px solid #000000;">Last Date</th>
       <th style="border-top:2px solid #000000; border-right:1px solid #000000;  border-bottom:1px solid #000000;">Order Qty</th>
      <th style="border-top:2px solid #000000; border-right:1px solid #000000;  border-bottom:1px solid #000000;">Product Qty</th>
    </tr>
    </thead>
    <tbody>  
	<?php 
	
	while($r = oci_fetch_array($qstr_m,OCI_BOTH+OCI_RETURN_NULLS))
    {   
   		$style_name =$r['STYLE_NAME'];
		
		$style_id	=$r['ID'];
		$sql2	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P' and TBL_PAY_SECTION_INFO.COMPANY_ID='$company_id'  order by TBL_PAY_SECTION_INFO.ID";
		
		$qstr2 = oci_parse($conn,$sql2);
		oci_execute($qstr2);
		while($rss2 = oci_fetch_array($qstr2,OCI_BOTH+OCI_RETURN_NULLS)) 
		{
			$sec_id	=$rss2[0];
			
			$str_for = "select distinct STYLE_NAME,BUYER_NAME,QUENTITY,
(select sum(QUANTITY) from tbl_pay_emp_production where STYLE_ID=b.ID and SECTION_ID='$sec_id') as total,ID 
 from TBL_PAY_STYLE_INFO b  where b.ID=$style_id";
			$qstr3 = oci_parse($conn,$str_for);
			oci_execute($qstr3);
			while($rss3 = oci_fetch_array($qstr3,OCI_BOTH+OCI_RETURN_NULLS)) 
			{
			
				$str_for_start_date = "select * from (select PRO_DATE from tbl_pay_emp_production where STYLE_ID='$style_id' and SECTION_ID='$sec_id' order by PRO_DATE asc) where rownum=1";  
				$qstr = oci_parse($conn,$str_for_start_date);
				oci_execute($qstr);
				while($rs = oci_fetch_array($qstr,OCI_BOTH+OCI_RETURN_NULLS)) 
				{
					$start_date = $rs['PRO_DATE'];
				}
				
				
				$str_for_last_date = "select * from (select PRO_DATE from tbl_pay_emp_production where STYLE_ID='$style_id' and SECTION_ID='$sec_id' order by PRO_DATE desc) where rownum=1";
				$qstr = oci_parse($conn,$str_for_last_date);
				oci_execute($qstr);
				while($rss = oci_fetch_array($qstr,OCI_BOTH+OCI_RETURN_NULLS)) 
				{
					$last_date = $rss['PRO_DATE'];
				}		
			?>
			<tr>
                <td style="border-right:1px solid #000000;  border-left:1px solid #000000;"><?php echo $style_name;?></td>
                <td style="border-right:1px solid #000000;"><?php echo $rss2['SEC_NAME']; ?></td>
                <td style="border-right:1px solid #000000;"><?php echo $r['BUYER_NAME']; ?></td>
                <td style="border-right:1px solid #000000;"><?php echo $start_date;?></td>
                <td style="border-right:1px solid #000000;"><?php echo $last_date;?></td>
                <td style="border-right:1px solid #000000;"><?php echo $r['QUENTITY']; ?></td>
                <td style="border-right:1px solid #000000;"><?php  if( $rss3[3]=='') {$pamnt = 0;} else $pamnt=$rss3[3];  echo $pamnt; ?></td>
			</tr>
			<?php
			}  
		}
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