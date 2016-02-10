<?php
//session_start();
ob_start();
include_once("../includes/opSessionCheck.inc");
include_once("../includes/function.php");
include_once("../includes/db.php");

$dateid	=$_GET['dateid'];
$dateidT=$_GET['dateidT'];
$month_year1=substr($_GET['dateid'],0,3).''.substr($_GET['dateid'],6,10);
$month_year2=substr($_GET['dateidT'],0,3).''.substr($_GET['dateidT'],6,10);
$company_id	=$_SESSION['company_id'];
$section_id	=$_GET['section_id'];
$block_id		=$_GET['block_id'];
$block_id2		=$_GET['block_id'];
$stamp	=5;
$all_head_ot	=170;
$atn_bonus_head	=164;

$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=$all_head_ot and COMPANY_ID=$company_id and SECTION_ID=$section_id";
$qstr  = oci_parse($conn,$sql);
oci_execute($qstr);
if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
{
	$amount_tp = $row[0];
	$amtype	= strpos($amount_tp, "%");
	if($amtype)
	{
		$otr1	=substr($amount_tp,0,strlen(($amount_tp)-1));
		$otr		=($otr1/100);
	}
}

$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=$atn_bonus_head and COMPANY_ID=$company_id and SECTION_ID=$section_id";
$qstr  = oci_parse($conn,$sql);
oci_execute($qstr);
if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
{
	$atn_bonT 	=$row[0];
}

$xsql	="";
if($block_id!='')
	$xsql=" and a.BLOCK_ID=$block_id ";

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
	height:18px;
	
}

.details td
{
    text-align: center;
    border: solid 1px #000;
	height:30px;
}
.details td.col1
{
    border: solid 0px #000;
    text-align: center;
	width:20%;
}

.head table
{
    width:  120%;
    border: solid 0px #000;
}

-->
</style>
<br />
<div style="width:1240px;">
<?php
	$str	='Production Salary Reports';
?>
<table width="100%" style="width:120%;">
<tr>
    	<td style="width:230px;"><?php //echo 'Left Side Left Side' ; ?></td><td><?php echo tbl_header_fun1($dateid,$dateidT,$str); ?></td><td align="right">&nbsp;</td>
    </tr>
</table>
</div>
<table border="0" cellpadding="0" cellspacing="0" align="center"  class="details"> 
    <thead>
    	<tr>
        	<th colspan="9"><b>Section:<?php echo  getSectionName($section_id) ?></b></th><th colspan="8"><b>Line:<?php echo getBlockName($block_id,$section_id); ?></b></th><th colspan="3">Page Number:&nbsp;[[page_cu]]/[[page_nb]]</th>
        </tr>
        <tr>
            <th rowspan="2">Card Id<br />No</th>
            <th rowspan="2">Name</th>
            <th rowspan="2">Designation</th>
            <th rowspan="2">Grade</th>
            <th rowspan="2">Basic</th>
            <th rowspan="2">H Rent</th>
          	<th rowspan="2">Med</th>
         	<th rowspan="2">Gross</th>
            <th colspan="7">Attendance Information</th>
            <th rowspan="2">OT<br />Hours</th>
            <th rowspan="2">OT<br />Rate</th>
            <th rowspan="2">OT<br />Amnt</th>
            <th rowspan="2">Net Pay<br />Amnt</th>
           
            <th rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature&nbsp;&nbsp;&nbsp;&nbsp;</th>
            
        </tr>
        <tr>
            <td>T.W.D</td>
            <td>Atten</td>
            <td>Lev<br>C/L</td>
            <td>Lev<br>S/L</td>
            <td>Lun<br>Out</td>
            <td>Fri<br>Day</td>
            <td>Abs</td>
            
        </tr>
   
        
    </thead>
	<tbody>
<?php

//to_char(b.MONTH_YEAR,'mm/yyyy')='$month_year'	
	$basic_total		=0;
	$house_rent_total	=0;
	$medical_total		=0;
	$atn_bon_total		=0;
	$holyD_total		=0;
	$actual_salary_total=0;
	$holi_amnt_total	=0;
	$govt_holi_amnt_total=0;
	$ot_total			=0;
	$ot_amount			=0;
	$ot_amnt_total		=0;
	$total_amnt_total	=0;
	$total_amnt_festival=0;
	$advance_total		=0;
	$net_pay_total		=0;
	$atn_bon			=0;
	$production_amnt	=0;
	$total_v			=0;
	$basic_gain			=0;
	$abs_amnt			=0;
	$abs_amnt_total		=0;
	$produc_amnt_total	=0;
	$produc_bonus_total	=0;
	$gross_total		=0;
	$total_emp			=0;
	$govt_holi_total	=0;
	$stamp_total		=0;
	$leave_amnt_total	=0;
	$j=0;
		
	$where	=" where 1=1 and 
	a.CARD_ID=b.CARD_ID  and a.SECTION_ID=b.SECTION_ID and  
	a.SECTION_ID='$section_id' and a.STATUS='1' and b.EXTRA_OT>0 and to_char(b.MONTH_YEAR,'mm/yyyy') between '$month_year1' and '$month_year2' ".$xsql."   
	order by pp";
	
	
	$sql	="select 
	
	a.CARD_ID,a.NAME,a.BASIC,a.GRADE,a.DESIGNATION,
	b.WORKS_DAY,b.TOTAL_ATTEND,b.LEAVE,b.LATE_PRESENT,b.LUNCH_OUT,b.OT,b.HOLY_DAY,b.ADVANCE,a.GROSS,a.HOUSE_RENT,a.MEDICAL,b.CASUAL,b.SICK,a.BLOCK_ID,a.GRADE,b.GOVT_HOLI,b.EXTRA_OT,cast(substr(a.CARD_ID,2,9) as number) as pp  
	
	from
	 
	TBL_PAY_EMP_PROFILE a ,TBL_PAY_EMP_ATTEN_INFO b  ".$where." ";
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	while($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
	
	{
				
				$j++;
				$total_emp+=$j;
				$card_id    	= $row[0];
				$name       	= $row[1];
				$designation    = $row[4];
				$basic      	=round($row[2]);
				$basic_view		=make_comma($basic);
				
				$basic_total	+=$basic;
				
				//$h_rent       	= fn_house_rent($section_id,$basic);
				$h_rent       	=round($row[14]);
				$house_rent_total +=$h_rent;
				
				$h_rent_view	=make_comma($h_rent);
				
				//$medical       	= fn_medical($section_id,$basic);
				$medical       	=round($row[15]);
				$medical_total	+=$medical;
				$medical_veiw	=make_comma($medical);
				
				$casu_l       	=$row[16];
				$sick_l       		=$row[17];
				$block_id       =$row[18];
				$grade       	=$row[19];
				
				//$actual_salary	=$basic+$h_rent+$medical;
				$actual_salary       	=round($row[13]);
				$actual_salary_total +=$actual_salary;
				
				
				$atten       	= $row[6];
				$atten_ot       = floor($atten);
				$leave      	= $row[7];
				$late_pre       = $row[8];
				$lunch_out      = $row[9];
				
				
				$total_w_day    = $row[5];

				$holiday=$row[11];
				$holyD_total	+=$holiday;
				
				$gov_holiday	=$row[20];
				
				$ap_days       	= $atten + $leave +$holiday+$gov_holiday;
				$abs_days		=($total_w_day -$ap_days);
				$abs_amnt	=fn_holiamnt($abs_days,$basic,$total_w_day);
				$abs_amnt_total	+=$abs_amnt;
				
				if($total_w_day<=$ap_days)
				{
					//$atn_bon=fn_atnbon($section_id,$basic);
					$atn_bon=$atn_bonT;
				}
				else
					$atn_bon	=0;
					
				$atn_bon_total	+=$atn_bon;
				$atn_bon_view	=make_comma($atn_bon);
					
				
				$holi_amnt		=round(fn_holiamnt($holiday,$basic,$total_w_day));
				$holi_amnt_total	+=$holi_amnt;
				$holi_amnt_view	=make_comma($holi_amnt);
				
				
				$govt_holi_total	+=$gov_holiday;
				$govt_holi_amnt		=round(fn_govholiamnt($gov_holiday,$actual_salary,$total_w_day));
				$govt_holi_amnt_total	+=$govt_holi_amnt;
				$govt_holi_amnt_view=make_comma($govt_holi_amnt);
				
				$extra_ot			=$row[21];
				$gross				=$actual_salary;
				$gross_total	+=$gross;
				
				$leave_amnt			=round(fn_holiamnt($leave,$gross,$total_w_day));
				$leave_amnt_total	+=$leave_amnt;
				
				$ot_limit		=($atten_ot*2);
				$ot				=$row[10];
				if($ot>$ot_limit)
					$ot	=($ot - $ot_limit)+$extra_ot;
				else
					$ot	=$extra_ot;
				/*	
				if($ot>$ot_limit)
					$ot	=$ot_limit;*/
				$ot_total	+=$ot;
				//$ot_rate=make_comma(fn_ot($section_id,$basic));
				$ot_rate=round(($basic * $otr),2);
				$ot_amount=round($ot*$ot_rate);
				
				$ot_amnt_total +=$ot_amount;
				
				//$festiv=fn_fb();
				$advance			=$row[12];
				$advance_total	+=$advance;
				$advance_view		=make_comma($advance);
				
				$total_amnt			=$gross+$ot_amount+$atn_bon;
				$total_amnt_view	=make_comma($total_amnt);
				
				$total_amnt_total	+=$total_amnt;
				
				
				$actual_salary_view	=make_comma($actual_salary);
				$gross_view			=make_comma($gross);
				
				
				//$fest_v				=fn_fest_v($section_id,$basic);
				$fest_v	=0;
				$total_amnt_festival	+=$fest_v;
				$fest_v_view		=make_comma($fest_v);
				
				
				
				$produc_amnt		=fn_product_amnt($card_id,$section_id,$dateid,$dateidT);
				$produc_amnt_total+=(int)$produc_amnt['production_amnt'];
			
				$produc_bonus		=round(fn_production_bonus($produc_amnt['production_amnt'],$section_id));
				$produc_bonus_total+=(int)$produc_bonus;
				//$produc_chk	=($produc_amnt);
				$produc_chk			=($produc_amnt['production_amnt']+$produc_bonus+$fest_v+$ot_amount+$atn_bon+$leave_amnt+$govt_holi_amnt);
				
				//$basic_gain	=round((($basic/$total_w_day)*$ap_days),2);
				$basic_gain			=round($gross-$abs_amnt);
				
				if($produc_chk<$basic_gain)
					$total_v		=round($basic_gain);
				else
					$total_v		=round($produc_chk);
					
				
				//$total_amnt	=($produc_chk+$leave_amnt);
				
				//$net_pay		=($total_amnt+$fest_v)-$advance;
				$net_pay			=$total_v - $advance-$stamp;
				$net_pay_view 		=make_comma($net_pay);
				$net_pay_total	+=$net_pay;
				$stamp_total		+=$stamp;
				
				
				
	?>				
		<tr>	
              <td><?php echo $card_id;?></td>
              <td><?php echo $name;?></td>
              <td><?php echo $designation;?></td>
              <td><?php echo $grade;?></td>
              <td><?php echo $basic_view;?></td>
              <td><?php echo $h_rent_view;?></td>
              <td><?php echo $medical_veiw;?></td>
              <td><?php echo $actual_salary_view;?></td>
              <td><?php echo $total_w_day; ?></td>
              <td><?php echo $atten; ?></td>
              <td><?php echo $casu_l; ?></td>
              <td><?php echo $sick_l; ?></td>
              <td><?php echo $lunch_out; ?></td>
              <td><?php echo $holiday; ?></td>
              <td><?php echo $abs_days; ?></td>
              <td><?php echo $ot; ?></td>
              <td><?php echo $ot_rate; ?></td>
              <td><?php echo $ot_amount; ?></td>
              <td><?php echo $ot_amount; ?></td>
              <td>&nbsp;</td>
              
		</tr>
		<?php		
	
	 }
	 
	 $sql="select ID from TBL_PAY_SECTION_BLOCK where SECTION_ID='$section_id'";
		$qstr  = oci_parse($conn,$sql);
		oci_execute($qstr);
		if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
		{
			if($block_id2!='')
			{ 
				section_pay_eot($company_id,$section_id,$block_id2,$dateid,$ot_amnt_total);
			}
		}
		else
		{
			section_pay_eot($company_id,$section_id,$block_id2,$dateid,$ot_amnt_total);	
		}
 ?>  
<tr style="font-weight:bold;">
 	<td colspan="4">Total Employee:<?php echo $j; ?></td><td colspan="3"></td><td><?php //echo make_comma($actual_salary_total); ?></td><td colspan="7"></td><td><?php  //echo make_comma($ot_total); ?></td><td><?php  //echo make_comma($ot_amnt_total); ?></td><td><?php echo make_comma($ot_amnt_total); ?></td><td><?php echo make_comma($ot_amnt_total); ?></td><td></td>
 </tr>
 
 
 <tr style="font-weight:bold;">
 	<td colspan="20" align="left"><?php
echo '<b>In Word:&nbsp;</b>'.call_cnvrt_n2w($ot_amnt_total);
?>
<br><br><br><br><br><br>
<table style="width:100%;border:0px #333333;">
    	<tr>
        	<td class="col1" id="col1">Prepared By</td><td class="col1" id="col1">Checked By</td><td class="col1" id="col1">Authorize By</td><td class="col1" id="col1">Approve By</td><td class="col1" id="col1">Acounts Manager</td>
        </tr>
    </table>
</td>
 </tr>
 
</tbody>
   <!--<tfoot>
        <tr>
            <th colspan="28" style="font-size: 16px;">
               Footer<?php //echo $produc_bonus; /*echo $produc_amnt['production_quantity'];*/?>
            </th>
        </tr>
    </tfoot>-->
</table>
  
<?php
//echo tbl_footer();


oci_free_statement($qstr);
oci_close($conn);

$content = ob_get_clean();

include('html2pdf.class.php');
try
{
	$html2pdf = new HTML2PDF('L', 'A4', 'fr',array(1, 10, 0,0));
	$html2pdf->pdf->SetDisplayMode('fullpage');
	$html2pdf->writeHTML($content);
	$html2pdf->Output('mojid.pdf');
}
catch(HTML2PDF_exception $e) {
	echo $e;
	exit;
}

?>