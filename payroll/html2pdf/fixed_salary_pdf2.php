<?php
//session_start();
include_once("../includes/opSessionCheck.inc");
include_once("../includes/function.php");
ob_start();
$dateid	=$_GET['dateid'];
$dateidT=$_GET['dateidT'];
$month_year1=substr($_GET['dateid'],0,3).''.substr($_GET['dateid'],6,10);
$month_year2=substr($_GET['dateidT'],0,3).''.substr($_GET['dateidT'],6,10);
include('db.php');
$company_id	=$_SESSION['company_id'];
$section_id	=$_GET['section_id'];

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
	echo tbl_header_fun1($dateid,$dateidT,$str);
?>
<br />


<table border="0" cellpadding="0" cellspacing="0" align="center"  class="details"> 
    <thead>
        <tr>
            <th rowspan="2">Card ID</th>
            <th rowspan="2">Name</th>
            <th rowspan="2">Designation</th>
            <th rowspan="2">Basic</th>
            <th rowspan="2">House<br />Rent</th>
            <th rowspan="2">Medical</th>
            <th rowspan="2">Actual<br />Salary</th>
            <th colspan="6">Attendence Information</th>
            
            <th rowspan="2">Atten<br />Bonus</th>
            <th rowspan="2">Holi<br />Day</th>
            <th rowspan="2">Holi<br />Amnt</th>
            <th rowspan="2">OT</th>
            <th rowspan="2">OT<br />Rate</th>
            <th rowspan="2">OT<br />Amount</th>
            <th rowspan="2">Total<br />Amount</th>
            <th rowspan="2">Fest</th>
            <th rowspan="2">Advance</th>
            <th rowspan="2">Net<br />Payable<br />Amount</th>
            <th rowspan="2">Signature</th>
        </tr>
        <tr>
            <th>T.W.D</th>
            <th>Atten</th>
            <th>Leave</th>
            <th>L.Pre</th>
            <th>L.Out</th>
            <th>A.P<br />Days</th>
            
        </tr>
   
        
    </thead>
	<tbody>
<?php

//to_char(b.MONTH_YEAR,'mm/yyyy')='$month_year'	
	$basic_total	=0;
	$house_rent_total=0;
	$medical_total	=0;
	$atn_bon_total	=0;
	$holyD_total	=0;
	$actual_salary_total	=0;
	$holi_amnt_total	=0;
	$ot_total	=0;
	$ot_amnt_total	=0;
	$total_amnt_total	=0;
	$total_amnt_festival	=0;
	$advance_total	=0;
	$net_pay_total	=0;
	$atn_bon	=0;
	
	$ck = '';
	
	$where	=" where 1=1 and 
	a.CARD_ID=b.CARD_ID and  
	a.SECTION_ID='$section_id' and to_char(b.MONTH_YEAR,'mm/yyyy') between '$month_year1' and '$month_year2'  
	order by a.CARD_ID";
	
	
	$sql	="select 
	
	a.CARD_ID,a.NAME,a.BASIC,a.GRADE,a.DESIGNATION,
	b.WORKS_DAY,b.TOTAL_ATTEND,b.LEAVE,b.LATE_PRESENT,b.LUNCH_OUT,b.OT,b.HOLY_DAY,b.ADVANCE 
	
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
				$basic_view		=make_comma($basic);
				
				$basic_total	+=$basic;
				
				$h_rent       	= fn_house_rent($section_id,$basic);
				$house_rent_total +=$h_rent;
				
				$h_rent_view	=make_comma($h_rent);
				
				$medical       	= fn_medical($section_id,$basic);
				$medical_total	+=$medical;
				$medical_veiw	=make_comma($medical);
				
				$actual_salary=$basic+$h_rent+$medical;
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
				
				$holi_amnt		=fn_holiamnt($holiday,$basic);
				$holi_amnt_total	+=$holi_amnt;
				
				
				$holi_amnt_view	=make_comma($holi_amnt);
				
				
				$gross			=$actual_salary;
				
				$ap_days		=$atten + $leave +$holiday;
				
				if($total_w_day<=$ap_days)
				{
					$atn_bon=fn_atnbon($section_id,$basic);
				}
				else
					$atn_bon=0;
					
				$atn_bon_view	=make_comma($atn_bon);
				$atn_bon_total	+=$atn_bon;
				$ot				=$row[10];
				$ot_total		+=$ot;
				$ot_rate		=make_comma(fn_ot($section_id,$basic));
				
				$ot_amount		=$ot*$ot_rate;
				
				$ot_amnt_total 	+=$ot_amount;
				
				//$festiv=fn_fb();
				$advance		=$row[12];
				$advance_total	+=$advance;
				$advance_view	=make_comma($advance);
				
				$total_amnt		=$gross+$ot_amount+$atn_bon+$holi_amnt;
				$total_amnt_total	+=$total_amnt;
				
				$actual_salary_view	=make_comma($actual_salary);
				$gross_view			=make_comma($gross);
				$total_amnt_view	=make_comma($total_amnt);
				
				$fest_v				=fn_fest_v($section_id,$basic);
				$total_amnt_festival	+=$fest_v;
				$fest_v_view		=make_comma($fest_v);
				$net_pay			=($total_amnt+$fest_v)-$advance;
				$net_pay_view 		=make_comma($net_pay);
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
              <td><?php echo $ap_days; ?></td>
             
              <td><?php echo $atn_bon_view; ?></td>
              <td><?php echo $holiday; ?></td>
              <td><?php echo $holi_amnt_view; ?></td>
              <td><?php echo $ot; ?></td>
              <td><?php echo $ot_rate; ?></td>
              <td><?php echo $ot_amount; ?></td>
              <td><?php echo $total_amnt_view; ?></td>
              <td><?php echo $fest_v_view; ?></td>
              <td><?php echo $advance_view; ?></td>
              <td><?php echo $net_pay_view; ?></td>
              <td><?php echo $ck; ?></td>     
		</tr>
		<?php		
	
	 } 
	 
 ?>  
 <tr style="font-weight:bold;">
 	<td colspan="6"></td><td><?php echo make_comma($actual_salary_total); ?></td><td colspan="6"></td><td><?php echo make_comma($atn_bon_total); ?></td><td><?php //echo make_comma($holyD_total); ?></td><td><?php  echo make_comma($holi_amnt_total); ?></td><td><?php // echo make_comma($ot_total); ?></td><td></td><td><?php echo make_comma($ot_amnt_total); ?></td><td><?php echo make_comma($total_amnt_total); ?></td><td><?php //echo make_comma($total_amnt_festival); ?></td><td><?php echo make_comma($advance_total); ?></td><td><?php echo make_comma($net_pay_total); ?></td><td></td>
 </tr>
</tbody>
   <tfoot>
        <tr>
            <th colspan="24" style="font-size: 16px;">
                 Title footer
            </th>
        </tr>
    </tfoot>
</table>
<?php

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