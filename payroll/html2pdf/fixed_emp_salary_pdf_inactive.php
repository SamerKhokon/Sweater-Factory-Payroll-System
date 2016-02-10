<?php
ob_start();
include_once("../includes/opSessionCheck.inc");
include_once("../includes/function.php");
include_once("../includes/db.php");

$dateid			=trim($_GET['dateid']);
$dateidT		=trim($_GET['dateidT']);
$month_year1	=substr($_GET['dateid'],0,3).''.substr($_GET['dateid'],6,10);
$month_year2	=substr($_GET['dateidT'],0,3).''.substr($_GET['dateidT'],6,10);

$month_day		=substr($_GET['dateidT'],3,2);

$company_id		=$_SESSION['company_id'];

$all_head_ot	=170;
$atn_bonus_head	=164;


$convence_head	=162292;
$amount_cv	=0;

//convence

$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=$convence_head and COMPANY_ID=$company_id and SECTION_ID=$section_id";
$qstr  = oci_parse($conn,$sql);
oci_execute($qstr);
if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
{
	$amount_cv 	= $row[0];
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
	height:18px;
}

.details td
{
    text-align: center;
    border: solid 1px #000;
	height:77px;
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
	$str	='Fixed Salary Reports(Inactive)';
	//echo tbl_header_fun1($dateid,$dateidT,$str);
?>
<br />
<table width="100%" style="width:100%;font-family:solaimanlipi;"><tr><td style="width:260px;">&nbsp;</td><td><?php echo tbl_header_fun1($dateid,$dateidT,$str); ?></td><td align="right">&nbsp;</td></tr></table>

<table border="0" cellpadding="0" cellspacing="0" align="center"  class="details"> 
    <thead>
    
    	<!--<tr>
        	<th colspan="9"><b>Section:<?php echo  getSectionName($section_id); ?></b></th><th colspan="10"></th><th colspan="6"><b>Line:<?php echo getBlockName($block_id,$section_id); ?></b></th><th colspan="3">Page Number:&nbsp;[[page_cu]]/[[page_nb]]</th>
        </tr>-->
        
        <tr>
        	<th rowspan="2">Section</th>
            <th rowspan="2">Card<br />ID<br />No</th>
            <th rowspan="2">Name</th>
            <th rowspan="2">Desig</th>
            <th rowspan="2">Gd</th>
            <th rowspan="2">Basic</th>
            <th rowspan="2">H Rent</th>
            <th rowspan="2">Med</th>
            <th rowspan="2">Con<br />amt</th>
            <th rowspan="2">Food</th>
            <th rowspan="2">Gross</th>
            <th colspan="7">Attendance Information</th>
            <th rowspan="2">Lev<br />Amnt</th>      
            <th rowspan="2">Attn<br />Bon</th>
            <th rowspan="2">Fest<br />Holi<br />Day</th>
            <th rowspan="2">Fest<br />Holi<br />Amnt</th>
            <th rowspan="2">OT</th>
            <th rowspan="2">OT<br />Rate</th>
            <th rowspan="2">OT<br />Amnt</th>
            <th rowspan="2">Basic<br />Gain</th>
            <th rowspan="2">Othr<br />Amnt</th>
            <th rowspan="2">Gross<br />Amnt</th>
            <th rowspan="2">Adv</th>
            <th rowspan="2">Stm<br />Ded</th>
            <th rowspan="2">Net Pay<br />Amnt</th>
            <th rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        </tr>
        <tr>
            <td>Tot<br />day</td>
            <td>P<br />day</td>
            <td>Lev<br>C/L</td>
            <td>Lev<br>S/L</td>
            <td>Late<br>Pre</td>
            <td>Fri<br>Day</td>
            <td>Abs</td>
        </tr>
   
        
    </thead>
	<tbody>
<?php

//to_char(b.MONTH_YEAR,'mm/yyyy')='$month_year'


	$basic_total			=0;
	$house_rent_total		=0;
	$medical_total			=0;
	$atn_bon_total			=0;
	$holyD_total			=0;
	$actual_salary_total	=0;
	$holi_amnt_total		=0;
	$govt_holi_amnt_total	=0;
	$ot_total				=0;
	$ot_amnt_total			=0;
	$total_amnt_total		=0;
	$total_amnt_festival	=0;
	$advance_total			=0;
	$net_pay_total			=0;
	$atn_bon				=0;
	$abs_amnt				=0;
	$abs_amnt_total			=0;
	$basic_gain_total		=0;
	$produc_amnt_total		=0;
	$produc_bonus_total		=0;
	$total_emp				=0;
	$gov_holiday			=0;
	$govt_holi_total		=0;
	$leave_amnt_total		=0;
	$gross_amnt_total		=0;
	$stamp_total			=0;
	$actual_ot_amnt			=0;
	$actual_ot_amnt_total	=0;
	$actual_gross_amnt		=0;
	$actual_gross_amnt_total=0;
	$other_amnt				=0;
	$late_pre				=0;
	$other_amnt_all			=0;
	$all_stay_day			=0;
	$scut					=0;
	$otr					=0;
	$atn_bonT				=0;
	$stamp					=0;
	
	$food_amnt				=0;
	
	$ck = '';
	$j=0;
	
	
	/*$sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where  TBL_PAY_SECTION_TYPE.CAT='F' and  TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID  order by TBL_PAY_SECTION_INFO.ID";
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
		*/
	
	
	$where	=" where 1=1 and 
	a.CARD_ID=b.CARD_ID  and a.SECTION_ID=b.SECTION_ID and b.SECTION_ID=c.ID and c.SEC_TYPE_ID=51  and a.COMPANY_ID=$company_id and a.STATUS!=1 and to_char(b.MONTH_YEAR,'mm/yyyy') between '$month_year1' and '$month_year2'  order by pp";
	
	
	$sql	="select 
	
	a.CARD_ID,a.NAME,a.BASIC,a.GRADE,a.DESIGNATION,
	b.WORKS_DAY,b.TOTAL_ATTEND,b.LEAVE,b.LATE_PRESENT,b.LUNCH_OUT,b.OT,b.HOLY_DAY,b.ADVANCE ,a.GROSS,a.HOUSE_RENT,a.MEDICAL,b.CASUAL,b.SICK,a.BLOCK_ID,a.GRADE,b.GOVT_HOLI,b.EXTRA_OT,b.OTHER_AMNT,(select TO_DATE('".$dateidT."', 'MM/DD/YY')-(select TO_DATE(to_char(JOIN_DATE,'MM/DD/YY'),'MM/DD/YY') from TBL_PAY_EMP_PROFILE where ID=a.ID) FROM dual) as day_diff,a.SECTION_ID,b.ID,cast(substr(a.CARD_ID,2,9) as number) as pp
	
	from
	 
	TBL_PAY_EMP_PROFILE a ,TBL_PAY_EMP_ATTEN_INFO b,TBL_PAY_SECTION_INFO c  ".$where." ";
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	while($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))	
	{
				
				$section_id	=$row[24];
				$stamp	=fn_stamp_amnt($section_id);		
				$sql1	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=$all_head_ot and COMPANY_ID=$company_id and SECTION_ID=$section_id";
				$qstr1  = oci_parse($conn,$sql1);
				oci_execute($qstr1);
				if($row1 = oci_fetch_array($qstr1, OCI_BOTH+OCI_RETURN_NULLS))
				{
					$amount_tp = $row1[0];
					$amtype	= strpos($amount_tp, "%");
					if($amtype)
					{
						$otr1	=substr($amount_tp,0,strlen(($amount_tp)-1));
						$otr		=($otr1/100);
					}
				}
				
				$sql2	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=$atn_bonus_head and COMPANY_ID=$company_id and SECTION_ID=$section_id";
				$qstr2  = oci_parse($conn,$sql2);
				oci_execute($qstr2);
				if($row2 = oci_fetch_array($qstr2, OCI_BOTH+OCI_RETURN_NULLS))
				{
					$atn_bonT 	=$row2[0];
				}
				
				
				
				$j++;
				//$total_emp+=$j;
				$card_id    		=$row[0];
				$name       		=$row[1];
				$designation    	=$row[4];
				$basic      		=round($row[2]);
				$basic_view			=make_comma($basic);
				
				$basic_total	+=$basic;
				
				//$h_rent       	= fn_house_rent($section_id,$basic);
				$h_rent       		=round($row[14]);
				$house_rent_total +=$h_rent;
				
				$h_rent_view		=make_comma($h_rent);
				
				//$medical       	= fn_medical($section_id,$basic);
				$medical       		=round($row[15]);
				$medical_total	+=$medical;
				$medical_veiw		=make_comma($medical);
				
				$casu_l       		=$row[16];
				$sick_l       		=$row[17];
				$block_id       	=$row[18];
				$grade       		=$row[19];
				
				//$actual_salary=$basic+$h_rent+$medical;
				$actual_salary		=round($row[13]);
				
				$actual_salary_total +=$actual_salary;
				
				$total_w_day    	=$row[5];
				$atten       		=$row[6];
				$atten_ot       	=floor($atten);
				
				$food_amnt		=($atten * 25);
				
				$leave      		=$row[7];
				$late_pre       	=$row[8];
				if($late_pre=='')
					$late_pre	=0;
				$lunch_out      	=$row[9];
				$ap_days       		=$row[5];
				/*$atn_bon=fn_atnbon($section_id,$basic);
				$atn_bon_total	+=$atn_bon;
				$atn_bon_view=make_comma($atn_bon);
				*/
				$holiday=$row[11];
				$holyD_total	+=$holiday;
				
				$holi_amnt			=round(fn_holiamnt($holiday,$basic,$total_w_day));
				$holi_amnt_total	+=$holi_amnt;
				
				
				$holi_amnt_view		=make_comma($holi_amnt);
				
				$gov_holiday		=$row[20];
				$govt_holi_total	+=$gov_holiday;
				$govt_holi_amnt		=round(fn_govholiamnt($gov_holiday,$actual_salary,$total_w_day));
				$govt_holi_amnt_total	+=$govt_holi_amnt;
				$govt_holi_amnt_view=make_comma($govt_holi_amnt);
				
				$extra_ot			=$row[21];
				$other_amnt			=$row[22];
				if($other_amnt=='')
					$other_amnt	=0;
				$other_amnt_all	+=$other_amnt;
				
				$gross				=$actual_salary;
				
				$leave_amnt			=round(fn_holiamnt($leave,$gross,$total_w_day));
				$leave_amnt_total	+=$leave_amnt;
				
				$ap_days			=$atten + $leave +$holiday+$gov_holiday;
				$abs_days			=($total_w_day -$ap_days);
				
				
				$all_stay_day		=$row[23];
				$all_stay_day		=$all_stay_day+1;
				/*
				if($all_stay_day<$month_day)
					$scut	=$gross;
				else
					$scut	=$basic;
				*/
				$scut	=$gross;	
				$abs_amnt			=fn_holiamnt($abs_days,$scut,$total_w_day);
				$abs_amnt_total	+=$abs_amnt;
				$basic_gain			=round(($gross-$abs_amnt));
				$basic_gain_total	+=$basic_gain;
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
				{
					$ex_ot	=($ot - $ot_limit);
					$all_eot	=($ex_ot+$extra_ot);
					//fn_extra_ot($section_id,$ex_ot,$card_id,$month_year1);
					$atn_id			=$row[25];
					$sql_u	="update TBL_PAY_EMP_ATTEN_INFO set OT='$ot_limit',EXTRA_OT='$all_eot' where ID='$atn_id'";
					$qstr_u  = oci_parse($conn,$sql_u);
					oci_execute($qstr_u);
					
					$ot	=$ot_limit;
				}
					
				$ot_total		+=$ot;
				//$ot_rate		=make_comma(fn_ot($section_id,$basic));
				$ot_rate 		=round(($basic * $otr),2);
				$ot_amount		=round($row[10]*$ot_rate);
				$ot_amnt_total 	+=$ot_amount;
				
				$actual_ot		=($row[10]+$extra_ot);
				$actual_ot_amnt			=round($actual_ot*$ot_rate);
				$actual_ot_amnt_total	+=$actual_ot_amnt;
				
				//$festiv=fn_fb();
				$advance			=$row[12];
				$advance_total	+=$advance;
				$advance_view		=make_comma($advance);
				
				$total_amnt			=round($gross+$ot_amount+$atn_bon+$holi_amnt+$other_amnt);
				$total_amnt_total	+=$total_amnt;
				
				$actual_salary_view	=make_comma($actual_salary);
				$gross_view			=make_comma($gross);
				$total_amnt_view	=make_comma($total_amnt);
				
				//$fest_v				=fn_fest_v($section_id,$basic);
				$fest_v				=0;
				$total_amnt_festival	+=$fest_v;
				$fest_v_view		=make_comma($fest_v);
				 
				$gross_amnt			=round($basic_gain+$fest_v+$ot_amount+$atn_bon+$other_amnt);
				$gross_amnt_total	+=$gross_amnt;
				
				$actual_gross_amnt	=round($basic_gain+$fest_v+$actual_ot_amnt+$atn_bon+$other_amnt+$food_amnt+$amount_cv);
				$actual_gross_amnt_total	+=$actual_gross_amnt;
				//$net_pay			=($total_amnt+$fest_v)-$advance-$abs_amnt;
				
				//$net_pay			=round(($basic_gain+$fest_v+$ot_amount+$atn_bon+$other_amnt+$food_amnt+$amount_cv)-$advance-$stamp);
				
				$net_pay			=round(($basic_gain+$fest_v+$ot_amount+$atn_bon+$other_amnt)-$advance-$stamp);
				
				$net_pay_view 		=make_comma($net_pay);
				$net_pay_total		+=$net_pay;
				$stamp_total		+=$stamp;
				
	?>				
		<tr>	
            <td><?php echo getSectionName($section_id); ?></td>
            <td><?php echo $card_id;?></td>
            <td><?php echo $name;?></td>
            <td><?php echo $designation;?></td>
            <td><?php echo $grade;?></td>
            <td><?php echo $basic_view;?></td>
            <td><?php echo $h_rent_view;?></td>
            <td><?php echo $medical_veiw;?></td>
            <td><?php echo $amount_cv;?></td>
            <td><?php echo $food_amnt;?></td>
            <td><?php echo $actual_salary_view;?></td>
            <td><?php echo $total_w_day; ?></td>
            <td><?php echo $atten; ?></td>
            <td><?php echo $casu_l; ?></td>
            <td><?php echo $sick_l; ?></td>
            <td><?php echo $late_pre; ?></td>
            <td><?php echo $holiday; ?></td>
            <td><?php echo $abs_days; ?></td>
            <td><?php echo $leave_amnt; ?></td>
            <td><?php echo $atn_bon_view; ?></td>
            <td><?php echo $gov_holiday; ?></td>
            <td><?php echo $govt_holi_amnt_view; ?></td>
            <td><?php echo $row[10]; ?></td>
            <td><?php echo $ot_rate; ?></td>
            <td><?php echo $ot_amount; ?></td>
            <td><?php echo $basic_gain; ?></td>
            <td><?php echo $other_amnt; ?></td>
            <td><?php echo $gross_amnt; ?></td>
            <td><?php echo $advance_view; ?></td>
            <td><?php echo $stamp; ?></td>
            <td><?php echo $net_pay_view; ?></td>
            <td>&nbsp;</td>
		</tr>
		<?php		
	 }
	 		$section_id_out	='1000';
			$block_id2		=0;
	 		section_pay($j,$company_id,$section_id_out,$block_id2,
			$actual_salary_total,$atn_bon_total,$actual_ot_amnt_total,
			$produc_amnt_total,$advance_total,$net_pay_total,$produc_bonus_total,
			$dateid,$leave_amnt_total,$govt_holi_amnt_total,$actual_gross_amnt_total,$other_amnt_all);
			
// }	
?>
 <tr style="font-weight:bold;">
 	<td colspan="5">Total Employee:<?php echo $j; ?></td><td colspan="5"></td><td><?php //echo make_comma($actual_salary_total); ?></td><td colspan="7"></td><td><?php echo make_comma($leave_amnt_total); ?></td><td><?php echo make_comma($atn_bon_total); ?></td><td><?php  //echo make_comma($holi_amnt_total); ?></td><td><?php echo make_comma($govt_holi_amnt_total); ?></td><td><?php //echo make_comma($govt_holi_amnt_total); ?></td><td><?php  //echo make_comma($ot_total); ?></td><td><?php  echo make_comma($ot_amnt_total); ?></td><td><?php //echo make_comma($produc_amnt_total); ?></td><td><?php //echo make_comma($produc_bonus_total); ?></td><td><?php echo $total_v_all; ?></td><td><?php echo $advance_total; ?></td><td><?php echo make_comma($stamp_total); ?></td><td><?php echo make_comma($net_pay_total); ?></td><td></td>
 </tr>
 <tr style="font-weight:bold;">
 	<td colspan="32" align="left"><?php
echo '<b>In Word:&nbsp;</b>'.call_cnvrt_n2w($net_pay_total);
echo '<br><br><br><br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Prepared By
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Checked By
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Authorize By
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Approve By
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Acounts Manager';
?></td>
 </tr>
</tbody>
  <!--<tfoot>
        <tr>
            <th colspan="24" style="font-size: 16px;">
                 Title footer
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
	$html2pdf = new HTML2PDF('L', 'Legal', 'fr',array(0, 5, 0,0));
	$html2pdf->pdf->SetDisplayMode('fullpage');
	$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
	$html2pdf->Output('lusine.pdf');
}
catch(HTML2PDF_exception $e) {
	echo $e;
	exit;
}
?>