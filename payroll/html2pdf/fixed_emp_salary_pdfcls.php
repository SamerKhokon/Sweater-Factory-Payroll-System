<?php
//session_start();
ob_start();
include_once("../includes/opSessionCheck.inc");
//include_once("../includes/function.php");
include_once("../includes/db.php");
include_once("../includes/mojid_class.php");

$dateid	=$_GET['dateid'];
$dateidT=$_GET['dateidT'];
$month_year1=substr($_GET['dateid'],0,3).''.substr($_GET['dateid'],6,10);
$month_year2=substr($_GET['dateidT'],0,3).''.substr($_GET['dateidT'],6,10);
$company_id	=$_SESSION['company_id'];
$section_id	=$_GET['section_id'];

$all_head_ot	=170;
$atn_bonus_head	=164;
$stamp	=5;
$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=$all_head_ot and COMPANY_ID=$company_id and SECTION_ID=$section_id";
$qstr  = oci_parse($conn,$sql);
oci_execute($qstr);
if($row = oci_fetch_array($qstr, OCI_BOTH))
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
if($row = oci_fetch_array($qstr, OCI_BOTH))
{
	$atn_bonT 	=$row[0];
}

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
<?php
	$str	='Fixed Salary Reports';
	//echo tbl_header_fun1($dateid,$dateidT,$str);
	$mytest	=new	salary_cal();
?>
<br />
<table width="100%" style="width:100%;font-family:solaimanlipi;"><tr><td style="width:260px;">&nbsp;</td><td><?php echo $mytest->tbl_header_fun1($dateid,$dateidT,$str); ?></td><td align="right">Report Generated Date:<?php echo date('m/d/Y'); ?></td></tr></table>

<table border="0" cellpadding="0" cellspacing="0" align="center"  class="details"> 
    <thead>
        <tr>
            <th rowspan="2">Card ID</th>
            <th rowspan="2">Name</th>
            <th rowspan="2">Designation</th>
            <th rowspan="2">Basic</th>
            <th rowspan="2">House<br />Rent</th>
            <th rowspan="2">Medical</th>
            <th rowspan="2">Gross</th>
            <th colspan="6">Attendence Information</th>
            <th rowspan="2">Basic<br />Gain</th>      
            <th rowspan="2">Atten<br />Bonus</th>
            <th rowspan="2">Holi<br />Day</th>
            <th rowspan="2">Holi<br />Amnt</th>
            <th rowspan="2">OT</th>
            <th rowspan="2">OT<br />Rate</th>
            <th rowspan="2">OT<br />Amount</th>
          <!--  <th rowspan="2">Total<br />Amount</th>-->
            <th rowspan="2">Fest</th>
            <th rowspan="2">Advance</th>
            <th rowspan="2">Stamp</th>
            <th rowspan="2">Net Pay<br />Amount</th>
            <th rowspan="2">Signature</th>
        </tr>
        <tr>
            <th>T.W.D</th>
            <th>Atten</th>
            <th>Leave</th>
            <th>L.Pre</th>
            <th>L.Out</th>
            <th>Abs.</th>
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
	$ot_total			=0;
	$ot_amnt_total		=0;
	$total_amnt_total	=0;
	$total_amnt_festival=0;
	$advance_total		=0;
	$net_pay_total		=0;
	$atn_bon			=0;
	$abs_amnt			=0;
	$abs_amnt_total=0;
	$basic_gain_total	=0;
	$ck = '';
	
	$where	=" where 1=1 and 
	a.CARD_ID=b.CARD_ID  and a.SECTION_ID=b.SECTION_ID and  
	a.SECTION_ID='$section_id' and to_char(b.MONTH_YEAR,'mm/yyyy') between '$month_year1' and '$month_year2'  
	order by a.CARD_ID";
	
	$mtest = new salary_cal();
	$sql	="select 
	
	a.CARD_ID,a.NAME,a.BASIC,a.GRADE,a.DESIGNATION,
	b.WORKS_DAY,b.TOTAL_ATTEND,b.LEAVE,b.LATE_PRESENT,b.LUNCH_OUT,b.OT,b.HOLY_DAY,b.ADVANCE ,a.GROSS,a.HOUSE_RENT,a.MEDICAL
	
	from
	 
	TBL_PAY_EMP_PROFILE a ,TBL_PAY_EMP_ATTEN_INFO b  ".$where." ";
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	while($row = oci_fetch_array($qstr, OCI_BOTH))
	
	{
				
				$card_id    	= $row[0];
				$name       	= $row[1];
				$designation    = $row[4];
				$basic      	= $row[2];
				$basic_view		=$mtest->make_comma($basic);
				
				$basic_total	+=$basic;
				
				//$h_rent       	= fn_house_rent($section_id,$basic);
				$h_rent       	=$row[14];
				$house_rent_total +=$h_rent;
				
				$h_rent_view	=$mtest->make_comma($h_rent);
				
				//$medical       	= fn_medical($section_id,$basic);
				$medical       	=$row[15];
				$medical_total	+=$medical;
				$medical_veiw	=$mtest->make_comma($medical);
				
				//$actual_salary=$basic+$h_rent+$medical;
				$actual_salary=$row[13];
				
				$actual_salary_total +=$actual_salary;
				
				$total_w_day    = $row[5];
				$atten       	= $row[6];
				$leave      	= $row[7];
				$late_pre       = $row[8];
				$lunch_out      = $row[9];
				$ap_days       	= $row[5];
				/*$atn_bon=fn_atnbon($section_id,$basic);
				$atn_bon_total	+=$atn_bon;
				$atn_bon_view=make_comma($atn_bon);
				*/
				$holiday=$row[11];
				$holyD_total	+=$holiday;
				
				$holi_amnt		=round($mtest->fn_holiamnt($holiday,$basic,$total_w_day));
				$holi_amnt_total	+=$holi_amnt;
				
				
				$holi_amnt_view	=$mtest->make_comma($holi_amnt);
				
				
				
				$gross			=$actual_salary;
				
				$ap_days		=$atten + $leave +$holiday;
				$abs_days		=($total_w_day -$ap_days);
				$abs_amnt	=$mtest->fn_holiamnt($abs_days,$basic,$total_w_day);
				$abs_amnt_total	+=$abs_amnt;
				$basic_gain	=round(($gross-$abs_amnt));
				$basic_gain_total	+=$basic_gain;
				if($total_w_day<=$ap_days)
				{
					//$atn_bon=fn_atnbon($section_id,$basic);
					$atn_bon=$atn_bonT;
				}
				else
					$atn_bon=0;
					
				$atn_bon_view	=$mtest->make_comma($atn_bon);
				$atn_bon_total	+=$atn_bon;
				$ot				=$row[10];
				$ot_total		+=$ot;
				//$ot_rate		=make_comma(fn_ot($section_id,$basic));
				$ot_rate =($basic * $otr);
				$ot_amount		=round($ot*$ot_rate);
				
				$ot_amnt_total 	+=$ot_amount;
				
				//$festiv=fn_fb();
				$advance		=$row[12];
				$advance_total	+=$advance;
				$advance_view	=$mtest->make_comma($advance);
				
				$total_amnt		=$gross+$ot_amount+$atn_bon+$holi_amnt;
				$total_amnt_total	+=$total_amnt;
				
				$actual_salary_view	=$mtest->make_comma($actual_salary);
				$gross_view			=$mtest->make_comma($gross);
				$total_amnt_view	=$mtest->make_comma($total_amnt);
				
				$fest_v				=$mtest->fn_fest_v($section_id,$basic);
				$total_amnt_festival	+=$fest_v;
				$fest_v_view		=$mtest->make_comma($fest_v);
				//$net_pay			=($total_amnt+$fest_v)-$advance-$abs_amnt;
				$net_pay			=round(($basic_gain+$fest_v+$ot_amount)-$advance-$stamp);
				$net_pay_view 		=$mtest->make_comma($net_pay);
				$net_pay_total		+=$net_pay;
				
	?>				
		<tr>	
              <td><?php echo $card_id;?></td>
              <td><?php echo $name;?></td>
              <td><?php echo $designation;?></td>
              <td><?php echo $basic_view;?></td>
              <td><?php echo $h_rent_view;?></td>
              <td><?php echo $medical_veiw;?></td>
              <td><?php echo $actual_salary_view;?></td>
              <td><?php echo $total_w_day; ?></td>
              <td><?php echo $atten; ?></td>
              <td><?php echo $leave; ?></td>
              <td><?php echo $late_pre; ?></td>
              <td><?php echo $lunch_out; ?></td>
              <td><?php echo $abs_days; ?></td>
              <td><?php echo $basic_gain; ?></td>
             
              <td><?php echo $atn_bon_view; ?></td>
              <td><?php echo $holiday; ?></td>
              <td><?php echo $holi_amnt_view; ?></td>
              <td><?php echo $ot; ?></td>
              <td><?php echo $ot_rate; ?></td>
              <td><?php echo $ot_amount; ?></td>
           <!--   <td><?php echo $total_amnt_view; ?></td>-->
              <td><?php echo $fest_v_view; ?></td>
              <td><?php echo $advance_view; ?></td>
               <td><?php echo $stamp; ?></td>
              <td><?php echo $net_pay_view; ?></td>
              <td><?php echo $ck; ?></td>     
		</tr>
		<?php		
	
	 } 
	 
 ?>  
 <tr style="font-weight:bold;">
 	<td colspan="6"></td><td><?php echo $mtest->make_comma($actual_salary_total); ?></td><td colspan="6"></td><td><?php echo $basic_gain_total; ?></td><td><?php echo $mtest->make_comma($atn_bon_total); ?></td><td><?php //echo make_comma($holyD_total); ?></td><td><?php  echo $mtest->make_comma($holi_amnt_total); ?></td><td><?php // echo make_comma($ot_total); ?></td><td></td><td><?php echo $mtest->make_comma($ot_amnt_total); ?></td><td><?php //echo make_comma($total_amnt_festival); ?></td><td><?php echo $mtest->make_comma($advance_total); ?></td><td></td><td><?php echo $mtest->make_comma($net_pay_total); ?></td><td></td>
 </tr>
</tbody>
  <!-- <tfoot>
        <tr>
            <th colspan="24" style="font-size: 16px;">
                 Title footer
            </th>
        </tr>
    </tfoot>-->
</table>
<br />
<br />
<br />
<br />
<br />
<?php
echo $mtest->tbl_footer();
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