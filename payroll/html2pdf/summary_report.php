<?php
ob_start();
include_once("../includes/opSessionCheck.inc");
include_once("../includes/function.php");
include("../includes/db.php");
$dateid		=trim($_GET['fdate']);
$company_id =$_SESSION['company_id'];
$section_id	=trim($_GET['section_id']);
$dateto		=trim($_GET['tdate']);

$month_year1=substr($dateid,0,3).''.substr($dateid,6,10);
$month_year2=substr($dateto,0,3).''.substr($dateto,6,10);
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
	height:20px;
	
}

.details td
{
    text-align: center;
    border: solid 1px #000;
	height:15px;
}
.details td.col1
{
    border: solid 1px #000;
    text-align: right;
}

.head table
{
    width:  120%;
    border: solid 0px #000;
}

-->
</style>
<?php
$str	='Summary Salary Report';
?>
<table width="100%" style="width:100%;">
<tr><td style="width:200px;">&nbsp;</td><td><?php echo tbl_header_fun1($dateid,$dateto,$str); ?></td><td align="left"></td>
</tr>
<tr>
	<td style="width:200px;"></td><td><br />Section:&nbsp;<?php if($section_id!='*')  { echo getSectionName($section_id); } else echo 'ALL'; ?></td><td align="left"></td>
</tr>
</table>
<br/>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="details">
    <thead>	
        <tr>
            <th>Section</th>
            <th>Type</th>
            <th>Line</th>
            <th>No of Emp</th>
            <!--<th>Gross</th>-->
            <th>Leave Amnt</th>
            <th>Atten Bonus</th>
            <th>Fest Amnt</th>
            <th>OT Amnt</th>
            <th>Extra OT Amnt</th>
            <th>No Work</th>
            <th>Product Amnt</th>
            <th>Product Bon</th>
            <th>Gross Total</th>
            <th>Advance</th>
            <th>Others</th>
            <th>Samp Ded</th>
            <th>Net Pay</th>
        </tr>
    </thead>
	<tbody>
    <?php
	$emp_total_all_sec1	=0;
	$gross_all_sec1		=0;
	$atn_bon_all_sec1	=0;
	$ot_amnt_all_sec1	=0;
	$exot_amnt_all_sec1	=0;
	$net_py_all_sec1	=0;
	$advance_total1		=0;
	$fest_total1		=0;
	$leave_total1		=0;
	$nowork_total1		=0;
	$pro_bon_total1		=0;
	$pro_amnt_total1	=0;
	$gross_pay_total1	=0;
	$stamp_ded_all_sec1	=0;
	$others_total1		=0;
	
	
	$pdN="";
	$pdN2="";
	$pdN3="";
	$sec_type_n	=0;
	$xsql="";
	if($section_id!='*')
		$xsql	=" and a.SECTION_ID='$section_id'";
		
	
		
	$sql	="select ID from TBL_PAY_SECTION_TYPE order by ID asc";
	$qstr1  = oci_parse($conn,$sql);
	oci_execute($qstr1);
	while($row = oci_fetch_array($qstr1,OCI_BOTH+OCI_RETURN_NULLS))
	{
		$sec_type_id	=$row['ID'];
		
		
		$emp_total_all_sec=0;
		$gross_all_sec	=0;
		$atn_bon_all_sec=0;
		$ot_amnt_all_sec=0;
		$exot_amnt_all_sec=0;
		$net_py_all_sec	=0;
		$advance_total	=0;
		
		$fest_total		=0;
		$leave_total	=0;
		$nowork_total	=0;
		$pro_bon_total	=0;
		$pro_amnt_total	=0;
		$gross_pay_total=0;
		$stamp_ded		=0;
		$stamp_ded_total=0;
		$others_total	=0;
		$mflag			=0;
		$stamp			=0;
		
		
			
		$sql ="select (select SEC_NAME from TBL_PAY_SECTION_INFO where COMPANY_ID=$company_id and ID=a.SECTION_ID) as SEC_NAME,(select SEC_TYPE_ID from TBL_PAY_SECTION_INFO where COMPANY_ID=$company_id and ID=a.SECTION_ID) as SEC_TYPE,a.COMPANY_ID,(select BLOCK_NAME from TBL_PAY_SECTION_BLOCK where COMPANY_ID=$company_id and ID=a.BLOCK_ID and SECTION_ID=a.SECTION_ID) as BLOCK_N,EMP_TOTAL,NET_PAY_TOTAL,GROSS_TOTAL,ATN_BON_TOTAL,OT_AMNT_TOTAL,ADVANCE_TOTAL,LEAVE_AMNT,FEST_AMNT,PRO_AMNT_TOTAL,PRO_BON_TOTAL,GROSS_PAY,EXTRA_OT_AMNT,OTHER_AMNT,b.SEC_TYPE_ID,a.SECTION_ID as SECTION_ID,a.NOWORK_AMNT as NOWORK_AMNT from TBL_PAY_SECTION_PAY a,TBL_PAY_SECTION_INFO b where a.SECTION_ID=b.ID and a.COMPANY_ID=$company_id and b.SEC_TYPE_ID=$sec_type_id   ".$xsql."  and to_char(MONTH_YEAR,'mm/YYYY') between '$month_year1' and '$month_year2' order by a.SECTION_ID,a.BLOCK_ID,b.SEC_TYPE_ID";		
		$qstr  = oci_parse($conn,$sql);
		oci_execute($qstr);
		while($res = oci_fetch_array($qstr,OCI_BOTH+OCI_RETURN_NULLS))
		{
  
		    if($pdN != $res['SEC_NAME'])
			{
				 $pdN = $res['SEC_NAME']; 
				 $style_name1= $res['SEC_NAME'];
			}
			else 
				$style_name1='';
			 
			 $sec_type =$res['SEC_TYPE'];
			 $sec_name=fn_secType($sec_type);
			 
			if($pdN2 !=$sec_name)
			{
				$pdN2 =$sec_name; 
				$sec_name1=$sec_name;
			}
			else 
				$sec_name1='';
			 
			
		   $block_id   = $res['BLOCK_N'];			   
		   
		   $emp_total       = $res['EMP_TOTAL'];
		   $emp_total_all_sec+=$emp_total;
		   
		   
		   $gross				= $res['GROSS_TOTAL'];
		   $gross_all_sec+=$gross;
		   
		   $atn_bon			= $res['ATN_BON_TOTAL'];
		   $atn_bon_all_sec+=$atn_bon;
		   
		   $pro_amnt			= $res['PRO_AMNT_TOTAL'];
		   $pro_amnt_total	+=$pro_amnt;
		   
		   $pro_bon			= $res['PRO_BON_TOTAL'];
		   $pro_bon_total	+=$pro_bon;
		   
		   
		   
		   $ot_amnt			= $res['OT_AMNT_TOTAL'];
		   $ot_amnt_all_sec+=$ot_amnt;
		   
		   $exot_amnt			= $res['EXTRA_OT_AMNT'];
		   $exot_amnt_all_sec+=$exot_amnt;
		   
		   $advance			= $res['ADVANCE_TOTAL'];
		   $advance_total+=$advance;
		   
		   $others			= $res['ADVANCE_TOTAL'];
		   $others_total	+=$others;
		   
		   $leave			= $res['LEAVE_AMNT'];
		   $leave_total+=$leave;
		   
		   
		   $fest			= $res['FEST_AMNT'];
		   $fest_total+=$fest;
		   
		   $nowork_total	=$res['NOWORK_AMNT'];
		   $nowork_total1	+=$nowork_total;
		   
		   $gross_pay			= $res['GROSS_PAY']+$exot_amnt;
		   $gross_pay_total +=$gross_pay;
		   $stamp			=fn_stamp_amnt($res['SECTION_ID']);
		   $stamp_ded	=$emp_total*$stamp;
		   
		   $stamp_ded_total	+=$stamp_ded;
		   
		   $net_pay			= $res['NET_PAY_TOTAL'];;
		   
		   //$net_pay			= $gross_pay-$stamp_ded;
		   $net_py_all_sec+=$net_pay;
		   
		   
		   $sec_type	=$res['SEC_TYPE_ID'];
		   if($pdN3 !=$sec_type)
			{
				$pdN3 =$sec_type; 
				$sec_type_n +=$net_pay;
			}
			else 
				$sec_type_n=0;
				
				
			echo   "<tr>
						<td>$style_name1</td>
						<td>$sec_name1</td>
						<td>$block_id</td>
						<td>$emp_total</td>
						<td>$leave</td>
						<td>$atn_bon</td>
						<td>$fest</td>
						<td>$ot_amnt</td>
						<td>$exot_amnt</td>
						<td>$nowork_total</td>
						<td>$pro_amnt</td>
						<td>$pro_bon</td>
						<td>$gross_pay</td>
						<td>$advance</td>
						<td>$others</td>
						<td>$stamp_ded</td>
						<td>$net_pay</td>
		 			</tr>";
		 			$mflag=1;
		}
		
			$sql_out	="select * from TBL_PAY_SECTION_PAY where SECTION_ID=1000 and to_char(MONTH_YEAR,'mm/YYYY') between '$month_year1' and '$month_year2' order by a.SECTION_ID";
		$qstr  = oci_parse($conn,$sql_out);
		oci_execute($qstr);
		while($resfo = oci_fetch_array($qstr,OCI_BOTH+OCI_RETURN_NULLS))
		{
			$stamp_ded		=$resfo['EMP_TOTAL']*5;
			$stamp_ded		=$resfo['EMP_TOTAL']*5;
			$emp_total_fo	=$resfo['EMP_TOTAL'];
			$leave_amnt_fo	=$resfo['LEAVE_AMNT'];
			$atn_bon_fo		=$resfo['ATN_BON_TOTAL'];
			$fest_fo		=$resfo['FEST_AMNT'];
			$ot_amnt_fo		=$resfo['OT_AMNT_TOTAL'];
			$ot_ex_fo		=$resfo['EXTRA_OT_AMNT'];
			$nowork_fo		=$resfo['NOWORK_AMNT'];
			$pro_amnt_fo	=$resfo['PRO_AMNT_TOTAL'];
			$pro_bon_fo		=$resfo['PRO_BON_TOTAL'];
			$gross_pay_fo	=$resfo['GROSS_PAY'];
			$advance_fo		=$resfo['ADVANCE_TOTAL'];
			$other_amnt_fo	=$resfo['OTHER_AMNT'];
			$net_pay_t_fo	=$resfo['NET_PAY_TOTAL'];
			
			echo "<tr>
					<td></td>
					<td>Fixed Out</td>
					<td></td>
					<td>".$emp_total_fo."</td>
					<td>".$leave_amnt_fo."</td>
					<td>".$atn_bon_fo."</td>
					<td>".$fest_fo."</td>
					<td>".$ot_amnt_fo."</td>
					<td>".$ot_ex_fo."</td>
					<td>".$nowork_fo."</td>
					<td>".$pro_amnt_fo."</td>
					<td>".$pro_bon_fo."</td>
					<td>".$gross_pay_fo."</td>
					<td>".$advance_fo."</td>
					<td>".$other_amnt_fo."</td>
					<td>".$stamp_ded."</td>
					<td>".$net_pay_t_fo."</td>
				</tr>";
			}
			
			$sql_out	="select * from TBL_PAY_SECTION_PAY where SECTION_ID=1001 and to_char(MONTH_YEAR,'mm/YYYY') between '$month_year1' and '$month_year2' order by a.SECTION_ID";
			$qstr  = oci_parse($conn,$sql_out);
			oci_execute($qstr);
			while($resfo = oci_fetch_array($qstr,OCI_BOTH+OCI_RETURN_NULLS))
			{
				$stamp_ded	=$resfo['EMP_TOTAL']*5;
				$emp_total_po	=$resfo['EMP_TOTAL'];
				$leave_amnt_po	=$resfo['LEAVE_AMNT'];
				$atn_bon_po		=$resfo['ATN_BON_TOTAL'];
				$fest_po		=$resfo['FEST_AMNT'];
				$ot_amnt_po		=$resfo['OT_AMNT_TOTAL'];
				$ot_ex_po		=$resfo['EXTRA_OT_AMNT'];
				$nowork_po		=$resfo['NOWORK_AMNT'];
				$pro_amnt_po	=$resfo['PRO_AMNT_TOTAL'];
				$pro_bon_po		=$resfo['PRO_BON_TOTAL'];
				$gross_pay_po	=$resfo['GROSS_PAY'];
				$advance_po		=$resfo['ADVANCE_TOTAL'];
				$other_amnt_po	=$resfo['OTHER_AMNT'];
				$net_pay_t_po	=$resfo['NET_PAY_TOTAL'];
				
				
				
				echo "<tr>
						<td></td>
						<td>Production Out</td>
						<td></td>
						<td>".$emp_total_po."</td>
						<td>".$leave_amnt_po."</td>
						<td>".$atn_bon_po."</td>
						<td>".$fest_po."</td>
						<td>".$ot_amnt_po."</td>
						<td>".$ot_ex_po."</td>
						<td>".$nowork_po."</td>
						<td>".$pro_amnt_po."</td>
						<td>".$pro_bon_po."</td>
						<td>".$gross_pay_po."</td>
						<td>".$advance_po."</td>
						<td>".$other_amnt_po."</td>
						<td>".$stamp_ded."</td>
						<td>".$net_pay_t_po."</td>
					</tr>";
			}
			
			$emp_total_all_sec1 	+=$emp_total_all_sec+$emp_total_fo+$emp_total_po;
			$gross_all_sec1 		+=$gross_all_sec+$gross_pay_fo+$gross_pay_po;
			$leave_total1 			+=$leave_total+$leave_amnt_fo+$leave_amnt_po;
			$atn_bon_all_sec1 		+=$atn_bon_all_sec+$atn_bon_fo+$atn_bon_po;
			$fest_total1 			+=$fest_total+$fest_fo+$fest_po;
			$ot_amnt_all_sec1 		+=$ot_amnt_all_sec+$ot_amnt_fo+$ot_amnt_po;
			$exot_amnt_all_sec1 	+=$exot_amnt_all_sec+$ot_ex_fo+$ot_ex_po;
			
			$nowork_total1 			+=$nowork_total+$nowork_fo+$nowork_po;
			
			$pro_amnt_total1 		+=$pro_amnt_total+$pro_amnt_fo+$pro_amnt_po;
			$pro_bon_total1			+=$pro_bon_total+$pro_bon_fo+$pro_bon_po;
			$advance_total1 		+=$advance_total+$advance_fo+$advance_po;
			$others_total1 			+=$others_total+$other_amnt_fo+$other_amnt_po;
			
			$stamp_ded_all_sec1		+=$stamp_ded_total+$stamp_ded_fo+$stamp_ded_po;
			
			$net_py_all_sec1 		+=$net_py_all_sec+$net_pay_t_fo+$net_pay_t_po;
			$gross_pay_total1 		+=$gross_pay_total+$gross_pay_fo+$gross_pay_po;
			
			if($mflag==1)
			{
			echo "<tr style='background-color:#CCCCCC;'>
			<td colspan='3'>Total:</td><td>$emp_total_all_sec</td>
			<td>$leave_total</td><td>$atn_bon_all_sec</td><td>$fest_total</td><td>$ot_amnt_all_sec</td><td>$exot_amnt_all_sec</td><td>$nowork_total</td><td>$pro_amnt_total</td><td>$pro_bon_total</td><td>$gross_pay_total</td><td>$advance_total</td><td>$advance_total</td><td>$stamp_ded_total</td><td>$net_py_all_sec</td>		   
			</tr>";
			}
		
	}
	echo "<tr style='background-color:#CCCCCC;'>
		   <td colspan='3'>Grand Total:</td><td>$emp_total_all_sec1</td>
		   <td>$leave_total1</td><td>$atn_bon_all_sec1</td><td>$fest_total1</td><td>$ot_amnt_all_sec1</td><td>$exot_amnt_all_sec1</td><td>&nbsp;</td><td>$pro_amnt_total1</td><td>$pro_bon_total1</td><td>$gross_pay_total1</td><td>$advance_total1</td><td>$others_total1</td><td>$stamp_ded_all_sec1</td><td>$net_py_all_sec1</td>		   
		   </tr>
		   <tr>
		   	<td colspan='17'><br><br><br><br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Prepared By
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Checked By
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Authorize By
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Approve By
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Acounts Manager'</td>
		   </tr>";
	
  echo '</tbody></table>';
	oci_free_statement($qstr);
	oci_close($conn);
	$content = ob_get_clean();
	include('html2pdf.class.php');
	try
	{
		$html2pdf = new HTML2PDF('L', 'Legal', 'fr',array(5, 10, 0,0));
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output('lusine.pdf');
	}
	catch(HTML2PDF_exception $e) {
		echo $e;
		exit;
	}
?>