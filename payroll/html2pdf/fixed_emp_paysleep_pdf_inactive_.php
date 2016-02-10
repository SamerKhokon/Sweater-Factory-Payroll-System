<?php
//session_start();
ob_start();
include_once("../includes/opSessionCheck.inc");
include_once("../includes/function.php");
include("../includes/db.php");

//header('Content-Type: text/html; charset=utf-8');

$dateid			= $_GET['dateid'];
$dateidT		= $_GET['dateidT'];
$month_year1	= substr($_GET['dateid'],0,3).''.substr($_GET['dateid'],6,10);
$month_year2	= substr($_GET['dateidT'],0,3).''.substr($_GET['dateidT'],6,10);
$company_id		= $_SESSION['company_id'];

$stamp			= 5;
$all_head_ot	= 170;
$atn_bonus_head	= 164;

$str	='Fixed Emp Payslip(Inactive)';

function fixedEmp_paysleep($card_id,$name,$grade,$designation,$basic_view,$h_rent_view,$medical_view,$actual_salary_view,$total_w_day,$atten,$leave,$late_pre,$lunch_out,$abs_days,$atn_bon_view,$holiday,$holi_amnt_view,$ot,$ot_rate,$ot_amount,$total_amnt_view,$fest_v_view,$advance_view,$net_pay_view,$dateid,$dateidT,$str,$section_id,$net_pay,$basic_gain,$stamp,$leave_amnt,$casual_l,$sick_l,$total_amount,$gov_holiday,$govt_holi_amnt,$block_id)
{

	$app = new app_utility();
	
	return '<table border="1" width="100%" style="width:100%;font-family:solaimanlipi;" border="0"><tr><td align="center">'.tbl_header_payslip($dateid,$dateidT,$str).'</td></tr></table>
<table border="0" cellpadding="0" cellspacing="0" align="center"  class="details" style="font-family:vrinda , Arial, Helvetica, sans-serif;"> 
	<tbody><tr>
        	<td colspan="5" align="left" class="colh" style="border-left:1px solid #000000; border-top:1px solid #000000;">Card ID	/<img src="bangla_img/id.png" height="15px;"> :&nbsp;'. $card_id.'<br />Name/<img src="bangla_img/nam.png" height="15px;">	:&nbsp;'.$name.'<br>Grade/<img src="bangla_img/grade.png" height="14px;">:&nbsp;'.$grade.'</td>
			
			
			<td colspan="5">Section/<img src="bangla_img/division.png" height="18px;">
	:&nbsp;'.getSectionName($section_id).'<br>Line:'.getBlockName($block_id,$section_id).'<br />Desig/<img src="bangla_img/designation1.png" height="15px;">:&nbsp;'.$designation.'</td>
			
			<td colspan="2">Basic&nbsp;:'.$basic_view.'<br><img src="bangla_img/basic1.png" height="15px;">:&nbsp;'.$app->get_unicode_bn_num($basic_view).'</td>
			
			<td colspan="2">H Rent&nbsp;:'.$h_rent_view.'<br><img src="bangla_img/house_rent1.png" height="15px;">:&nbsp;'.$app->get_unicode_bn_num($h_rent_view).'</td>
			

			<td colspan="2">Med&nbsp;:'.$medical_view.'<br><img src="bangla_img/medical.png" height="14px;">:&nbsp;'.$app->get_unicode_bn_num($medical_view).'</td>
			
			<td colspan="2">Gross&nbsp;:'.$actual_salary_view.'<br><img src="bangla_img/total.png" height="14px;">:&nbsp;'.$app->get_unicode_bn_num($actual_salary_view).'</td>
			
        </tr>
		<tr>
            <td colspan="6">Attendance Information<br>T.W.D&nbsp;'.$total_w_day.'/<img src="bangla_img/total_day.png">-'.$app->get_unicode_bn_num(make_comma($total_w_day)).'</td>
			<td rowspan="2">Fest<br>Lev</td>
			<td rowspan="2">Fest<br>Amot</td>
            <td rowspan="2">Atten<br />Bonus<br><img src="bangla_img/present_bonus.png"></td>
            <td rowspan="2">Lev<br />Amnt<br /><img src="bangla_img/holiday_qt.png"></td>
			
            <td rowspan="2">OT<br><img src="bangla_img/ot.png"></td>
            <td rowspan="2">OT<br />Rate<br /><img src="bangla_img/ot_rate.png"></td>
            <td rowspan="2">OT<br />Amnt<br><img src="bangla_img/ot_amounts.png" ></td>
            <td rowspan="2">Total<br>Amnt<br><img src="bangla_img/grant_total.png"></td>
            <td rowspan="2">Adv<br><img src="bangla_img/advance.png"></td>
			<td rowspan="2">Stm<br>Ded</td>
            <td rowspan="2">Net Pay<br>Amnt<br /><img src="bangla_img/net_pay.png" height="16px;"></td>
			<td rowspan="2">Signature<br><img src="bangla_img/signature.png"></td>
            
        </tr>
		<tr>
            <td>Atten<br><img src="bangla_img/present.png"></td>
            <td>Lev<br>C/L<br><img src="bangla_img/holiday1.png"></td>
            <td>Lev<br>S/L<br><img src="bangla_img/holiday1.png"></td>
            <td>Lun<br>Out<br><img src="bangla_img/lunch_out.png"></td>
			<td>Fri<br />Day<br><img src="bangla_img/govt_holiday.png"></td>
            <td>Abs<br><img src="bangla_img/absent.png"></td>
			
            
        </tr>
        <tr>
              <td>'.$atten.'<br><br>'.$app->get_unicode_bn_num(make_comma($atten)).'</td>
              <td>'.$casual_l.'<br><br>'.$app->get_unicode_bn_num(make_comma($casual_l)).'</td>
              <td>'.$sick_l.'<br><br>'.$app->get_unicode_bn_num(make_comma($sick_l)).'</td>
              <td>'.$lunch_out.'<br><br>'.$app->get_unicode_bn_num(make_comma($lunch_out)).'</td>
			  <td>'.$holiday.'<br><br>'.$app->get_unicode_bn_num(make_comma($holiday)).'</td>
              <td>'.$abs_days.'<br><br>'.$app->get_unicode_bn_num(make_comma($abs_days)).'</td>
			  
			  
			  <td>'.make_comma($gov_holiday).'<br><br>'.$app->get_unicode_bn_num(make_comma($gov_holiday)).'</td>
			  <td>'.make_comma($govt_holi_amnt).'<br><br>'.$app->get_unicode_bn_num(make_comma($govt_holi_amnt)).'</td>
			  
              <td>'.$atn_bon_view.'<br><br>'.$app->get_unicode_bn_num($atn_bon_view).'</td>
              
              <td>'.make_comma($leave_amnt).'<br><br>'.$app->get_unicode_bn_num(make_comma($leave_amnt)).'</td>
              <td>'.$ot.'<br><br>'.$app->get_unicode_bn_num(make_comma($ot)).'</td>
              <td>'.$ot_rate.'<br><br>'.$app->get_unicode_bn_num(make_comma($ot_rate)).'</td>
              <td>'.$ot_amount.'<br><br>'.$app->get_unicode_bn_num(make_comma($ot_amount)).'</td>
              <td>'.$total_amount.'<br><br>'.$app->get_unicode_bn_num(make_comma($total_amount)).'</td>
              <td>'.$advance_view.'<br><br>'.$app->get_unicode_bn_num($advance_view).'</td>
			  <td>'.$stamp.'<br><br>'.$app->get_unicode_bn_num(make_comma($stamp)).'</td>
		      <td>'.$net_pay_view.'<br><br>'.$app->get_unicode_bn_num($net_pay_view).'</td>
              <td></td>    
		</tr>
		
 </tbody></table><br>............................................................................................................................................................................................................................................................................................................................................................';
}

//<td>'.make_comma($basic_gain).'<br><br>'.$app->get_unicode_bn_num(make_comma($basic_gain)).'</td>


/*
<td>'.$gov_holiday.'<br><br>'.$app->get_unicode_bn_num(make_comma($gov_holiday)).'</td>
              <td>'.$govt_holi_amnt_view.'<br><br>'.$app->get_unicode_bn_num($govt_holi_amnt_view).'</td>
			  <td>'.$gov_holiday.'<br><br>'.$app->get_unicode_bn_num(make_comma($gov_holiday)).'</td>
              <td>'.$govt_holi_amnt_view.'<br><br>'.$app->get_unicode_bn_num($govt_holi_amnt_view).'</td>
			  
			  */
			  
			  
?>
<!--<tr style="font-weight:bold;">
 	<td colspan="3"></td><td>'.$actual_salary_view.'</td><td colspan="6"></td><td>'.$abs_amnt.'</td><td>'.make_comma($atn_bon_view).'</td><td></td><td>'.$holi_amnt_view.'</td><td>'.make_comma($ot_amount).'</td><td></td><td></td><td>'.$total_amnt_view.'</td><td></td><td>'.$advance_view.'</td><td>'.$net_pay_view.'</td><td></td><td></td>
 </tr><tr><td colspan="22" align="left" class="colf"><b>Total Net	: '.call_cnvrt_n2w($net_pay).'</b></td></tr>-->
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
	height:15px;
	
}

.details td
{
    text-align: center;
    border: solid 1px #000;
	height:20px;
}
.details td.colh
{
    border: solid 0px #000;
}
.details td.colf
{
    border: solid 0px #000;
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
*/
</style>
<?php

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
	$abs_amnt_total		=0;
	$govt_holi_total	=0;
	$govt_holi_amnt_total=0;
	
	$ck = '';
	
	
	$sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where  TBL_PAY_SECTION_TYPE.CAT='F' and  TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID  order by TBL_PAY_SECTION_INFO.ID";
	$stid	= oci_parse($conn, $sql);
	oci_execute($stid);
	
	while($res = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
	{
	
	$section_id	=$res[0];
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
	
	
	
	
	$where	=" where 1=1 and 
	a.CARD_ID=b.CARD_ID and a.SECTION_ID=b.SECTION_ID and  
	a.SECTION_ID='$section_id' and a.STATUS!='1'   and to_char(b.MONTH_YEAR,'mm/yyyy') between '$month_year1' and '$month_year2'  
	order by pp,b.MONTH_YEAR";
	
	
	$sql	="select 
	
	a.CARD_ID,a.NAME,a.BASIC,a.GRADE,a.DESIGNATION,
	b.WORKS_DAY,b.TOTAL_ATTEND,b.LEAVE,b.LATE_PRESENT,b.LUNCH_OUT,b.OT,b.HOLY_DAY,b.ADVANCE ,a.GROSS,a.HOUSE_RENT,a.MEDICAL,b.CASUAL,b.SICK,b.GOVT_HOLI,a.BLOCK_ID,cast(substr(a.CARD_ID,2,9) as number) as pp  
	
	from
	 
	TBL_PAY_EMP_PROFILE a ,TBL_PAY_EMP_ATTEN_INFO b   $where";
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	while($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
	
	{
				
		$card_id    		=$row[0];
		$name       		=$row[1];
		$basic      		=round($row[2]);
		$grade				=$row[3];
		$designation    	=$row[4];
		
		$basic_view			=make_comma($basic);
		
		$basic_total	+=$basic;
		
		//$h_rent       	= fn_house_rent($section_id,$basic);
		$h_rent				=round($row[14]);
		$house_rent_total +=$h_rent;
		
		$h_rent_view		=make_comma($h_rent);
		
		//$medical       	= fn_medical($section_id,$basic);
		$medical			=round($row[15]);
		$medical_total	+=$medical;
		$medical_view		=make_comma($medical);
		
		//$actual_salary=$basic+$h_rent+$medical;
		$actual_salary=round($row[13]);
		$actual_salary_total +=$actual_salary;
		
		$total_w_day		=$row[5];
		$atten       		=$row[6];
		$atten_ot       	= floor($atten);
		
		$leave      		=$row[7];
		$late_pre       	=$row[8];
		$lunch_out      	=$row[9];
		$ap_days       		=$row[5];
		$holiday=$row[11];
		$holyD_total	+=$holiday;
		
		$casual_l			=$row[16];
		$sick_l	=$row[17];
		
		$holi_amnt			=round(fn_holiamnt($holiday,$basic,$total_w_day));
		$holi_amnt_total	+=$holi_amnt;
		$holi_amnt_view		=make_comma($holi_amnt);
		
		$leave_amnt			=round(fn_holiamnt($leave,$actual_salary,$total_w_day));
		
		
		$gross				=$actual_salary;
		
		$block_id			=$row[19];
		$gov_holiday		=$row[18];
		$govt_holi_total	+=$gov_holiday;
		$govt_holi_amnt		=round(fn_govholiamnt($gov_holiday,$actual_salary,$total_w_day));
		$govt_holi_amnt_total	+=$govt_holi_amnt;
		$govt_holi_amnt_view=make_comma($govt_holi_amnt);
		
		$ap_days			=$atten + $leave +$holiday+$gov_holiday;
		$abs_days			=($total_w_day -$ap_days);
		$abs_amnt			=fn_holiamnt($abs_days,$gross,$total_w_day);
		
		//$basic_gain	=round((($basic/$total_w_day)*$ap_days),2);
		$basic_gain			=round($gross-$abs_amnt);
		
		if($total_w_day<=$ap_days)
		{
			//$atn_bon=fn_atnbon($section_id,$basic);
			$atn_bon=$atn_bonT;
		}
		else
			$atn_bon=0;
			
		$atn_bon_view		=make_comma($atn_bon);
		$atn_bon_total	+=$atn_bon;
		
		$ot_limit		=($atten_ot*2);
		$ot				=$row[10];
		if($ot>$ot_limit)
			$ot	=$ot_limit;
			
		$ot_total		+=$ot;
				
		/*$ot					=$row[10];
		$ot_total		+=$ot;*/
		//$ot_rate		=make_comma(fn_ot($section_id,$basic));
		$ot_rate 			=round(($basic * $otr),2);
		$ot_amount			=round($ot*$ot_rate);
		
		$ot_amnt_total 	+=$ot_amount;
		
		$advance			  =$row[12];
		$advance_total	+=$advance;
		$advance_view			=make_comma($advance);
		
		$total_amnt				=round($gross+$ot_amount+$atn_bon+$holi_amnt);
		$total_amnt_total	+=$total_amnt;
		
		$actual_salary_view		=make_comma($actual_salary);
		$gross_view				=make_comma($gross);
		$total_amnt_view		=make_comma($total_amnt);
		
		$fest_v					=fn_fest_v($section_id,$basic);
		$total_amnt_festival	+=$fest_v;
		$fest_v_view			=make_comma($fest_v);
		//$net_pay			=($total_amnt+$fest_v)-$advance-$abs_amnt;
		$total_amount			=round($basic_gain+$fest_v+$ot_amount+$atn_bon);
		
		$net_pay				=round(($basic_gain+$fest_v+$ot_amount+$atn_bon)-$advance-$stamp);
		$net_pay_view 			=make_comma($net_pay);
		$net_pay_total		+=$net_pay;
		
		
		echo  fixedEmp_paysleep($card_id,$name,$grade,$designation,$basic_view,$h_rent_view,$medical_view,$actual_salary_view,$total_w_day,$atten,$leave,$late_pre,$lunch_out,$abs_days,$atn_bon_view,$holiday,$holi_amnt_view,$ot,$ot_rate,$ot_amount,$total_amnt_view,$fest_v_view,$advance_view,$net_pay_view,$dateid,$dateidT,$str,$section_id,$net_pay,$basic_gain,$stamp,$leave_amnt,$casual_l,$sick_l,$total_amount,$gov_holiday,$govt_holi_amnt,$block_id);
			
	}
}

oci_free_statement($qstr);
oci_close($conn);

include('html2pdf.class.php');
$content = ob_get_clean();
try
{
	$html2pdf = new HTML2PDF('P', 'L', 'fr', true, 'UTF-8',array(0, 0, 0,0));
	
	$html2pdf-> pdf-> AddFont ('solaimanlipi', 'b', 'solaimanlipi.php');
	$html2pdf-> pdf-> SetFont ('solaimanlipi', 'b', 35);
	$html2pdf->pdf->SetDisplayMode('fullpage');
	$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
	$html2pdf->Output('mojid.pdf');
}
catch(HTML2PDF_exception $e) {
	echo $e;
	exit;
}		
?>