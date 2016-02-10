<?php
ob_start();
$dateid	=$_GET['dateid'];
$month_year	=substr($_GET['dateid'],0,3).''.substr($_GET['dateid'],6,10);
include('db.php');
$company_id	=1;
$sec_id		=102;
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
        	<th colspan="21">Header </th>
        </tr>
		
        <!--<tr>
            <th colspan="8" style="font-size: 16px;">Title Header </th>
        </tr>-->
       
        <tr>
        	<th rowspan="2">Card ID</th>
            <th rowspan="2">Name</th>
            <th rowspan="2">Designation</th>
            <th rowspan="2">Basic</th>
            <th rowspan="2">House Rent</th>
            <th rowspan="2">Medical</th>
            <th rowspan="2">Actual Salary</th>
            <th colspan="6">Attendence Information</th>
            <th rowspan="2">Gross Amount</th>
            <th rowspan="2">Atten Bonus</th>
            <th rowspan="2">Friday</th>
            <th rowspan="2">OT</th>
            <th rowspan="2">OT Rate</th>
            <th rowspan="2">OT Amount</th>
             <th rowspan="2">Total Amount</th>
            <th rowspan="2">Advance</th>
        </tr>
        <tr>
            <th>T.W.D</th>
            <th>Atten</th>
            <th>Leave</th>
            <th>L.Pre</th>
            <th>L.Out</th>
            <th>A.P Days</th>
            
        </tr>
   
        
    </thead>
	<tbody>
<?php
function allowence($haed_id,$amount,$type,$basic,$gross)
{
	$amtype	= strpos($amount, "%");
	if($amtype)
	{
		$bonus_amount =(($basic * $amount)/100);
	}
	else
		$bonus_amount =$amount;
		
	return $haed_id.'-'.$bonus_amount;
	
}
function gross_salary($sec_id)
{
global $conn;
global $company_id;
//global $sec_id;
	
$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID='166' and COMPANY_ID='".$company_id."' and SECTION_ID='$sec_id'";
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	if($row = oci_fetch_array($qstr, OCI_BOTH))
	{
		$type 		= $row[1];
		$amount_tp 	= $row[0];
		$amtype		= strpos($amount_tp, "%");
		if($amtype)
		{
			$amount	=substr($amount_tp,0,strlen(($amount_tp)-1));
			$house_rent =(($basic * $amount)/100);
		}
		else
			$house_rent =$amount_tp;
		
		$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID='165' and COMPANY_ID='".$company_id."' and SECTION_ID='$sec_id'";
		$qstr  = oci_parse($conn,$sql);
		oci_execute($qstr);
		if($row = oci_fetch_array($qstr, OCI_BOTH))
		{
			$type1 		= $row[1];
			$amount_tp1 	= $row[0];
			$amtype1		= strpos($amount_tp1, "%");
			if($amtype1)
			{
				$amount1	=substr($amount_tp1,0,strlen(($amount_tp1)-1));
				$medical =(($basic * $amount1)/100);
			}
			else
				$medical =$amount_tp1;
			
		}	
			
			
			
			
			
		$gross= $basic+$house_rent+$medical;
		
	}
}







function fn_atnbon($sec_id,$basic)
{
	global $conn;
	global $company_id;
	global $gross;
	
	$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID='164' and COMPANY_ID='".$company_id."' and SECTION_ID='$sec_id'";
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	if($row = oci_fetch_array($qstr, OCI_BOTH))
	{
		$all_efect = $row[1];
		$amount_tp = $row[0];
		
		$amtype	= strpos($amount_tp, "%");
		if($amtype)
		{
			$amount	=substr($amount_tp,0,strlen(($amount_tp)-1));
			
			if($all_efect=='GROSS')
			{
				$bonus_amount =(($gross * $amount)/100);
				$eff='gr';	
			}
			else
			{
				//$amount	=substr($amount_tp,0,strlen(($amount_tp)-1));
				$bonus_amount =(($basic * $amount)/100);
				$eff='basic';	
			
			}
		else
		{
			$bonus_amount =$amount_tp;
		}
		return $bonus_amount.'-'.$eff;
		
	}

}

function fn_house_rent($sec_id,$basic)
{
	global $conn;
	global $company_id;
	$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID='166' and COMPANY_ID='".$company_id."' and SECTION_ID='$sec_id'";
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	if($row = oci_fetch_array($qstr, OCI_BOTH))
	{
		//$amount = $row[0];
		$amount_tp = $row[0];
		$amtype	= strpos($amount_tp, "%");
		if($amtype)
		{
			$amount	=substr($amount_tp,0,strlen(($amount_tp)-1));
			$bonus_amount =(($basic * $amount)/100);
		}
		else
			$bonus_amount =$amount_tp;
			
		return $bonus_amount;
		
	}

}



function fn_medical($sec_id,$basic)
{
	global $conn;
	global $company_id;
	$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID='165' and COMPANY_ID='".$company_id."' and SECTION_ID='$sec_id'";
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	if($row = oci_fetch_array($qstr, OCI_BOTH))
	{
		//$amount = $row[0];
		$amount_tp = $row[0];
		$amtype	= strpos($amount_tp, "%");
		if($amtype)
		{
			$amount	=substr($amount_tp,0,strlen(($amount_tp)-1));
			$bonus_amount =(($basic * $amount)/100);
		}
		else
			$bonus_amount =$amount_tp;
			
		return $bonus_amount;
		
	}

}

function fn_ot($sec_id,$basic)
{
	global $conn;
	global $company_id;
	$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID='170' and COMPANY_ID='".$company_id."' and SECTION_ID='$sec_id'";
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	if($row = oci_fetch_array($qstr, OCI_BOTH))
	{
		//$amount = $row[0];
		$amount_tp = $row[0];
		$amtype	= strpos($amount_tp, "%");
		if($amtype)
		{
			$amount	=substr($amount_tp,0,strlen(($amount_tp)-1));
			$bonus_amount =(($basic * $amount)/100);
		}
		else
			$bonus_amount =$amount_tp;
			
		return $bonus_amount;
		
	}

}


                                                                                                                                                                                                                                                                                                                               
	
$emptypeFixed_Salary ="select ID from TBL_PAY_SECTION_INFO where SEC_TYPE_ID=51";		
$empFxS  = oci_parse($conn,$emptypeFixed_Salary);
oci_execute($empFxS);
$company_id = 1; //$SESSION['COMPANY_ID'];
while($res = oci_fetch_array($empFxS,OCI_BOTH)) 
{
	$section_id	=$res[0];
	$sql	="select 
	
	TBL_PAY_EMP_PROFILE.CARD_ID,TBL_PAY_EMP_PROFILE.NAME,TBL_PAY_EMP_PROFILE.BASIC,
	TBL_PAY_EMP_PROFILE.GRADE,TBL_PAY_EMP_PROFILE.DESIGNATION,
	TBL_PAY_EMP_ATTEN_INFO.WORKS_DAY,TBL_PAY_EMP_ATTEN_INFO.TOTAL_ATTEND,
	TBL_PAY_EMP_ATTEN_INFO.LEAVE,TBL_PAY_EMP_ATTEN_INFO.LATE_PRESENT,
	TBL_PAY_EMP_ATTEN_INFO.LUNCH_OUT,TBL_PAY_EMP_ATTEN_INFO.OT,TBL_PAY_EMP_ATTEN_INFO.HOLY_DAY,TBL_PAY_EMP_ATTEN_INFO.ADVANCE 
	
	from 
	TBL_PAY_EMP_PROFILE ,TBL_PAY_EMP_ATTEN_INFO  
	
	where 
	TBL_PAY_EMP_PROFILE.CARD_ID=TBL_PAY_EMP_ATTEN_INFO.CARD_ID and  
	TBL_PAY_EMP_PROFILE.SECTION_ID='$section_id' and to_char(TBL_PAY_EMP_ATTEN_INFO.MONTH_YEAR,'mm/yyyy')='$month_year'
	order by TBL_PAY_EMP_PROFILE.CARD_ID";
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	while($row = oci_fetch_array($qstr, OCI_BOTH))
	
	{
				
				$card_id    	= $row[0];
				$name       	= $row[1];
				$designation    = $row[4];
				$basic      	= $row[2];
				$h_rent       	= fn_house_rent($section_id,$basic);
				$medical       	= fn_medical($section_id,$basic);
				
				//$actual_salary  =(((14*$row[2])+2000)/10); //gross
				
				
				$actual_salary=$basic+$h_rent+$medical;
				
				
				$total_w_day    = $row[5];
				$atten       	= $row[6];
				$leave      	= $row[7];
				$late_pre       = $row[8];
				$lunch_out      = $row[9];
				$ap_days       	= $row[5];
				
				$atn_bon=fn_atnbon($section_id,$basic);
				
				$holiday=$row[11];
				//$holi_amnt=fn_holiamnt();
				
				$gross			=$actual_salary;
				
				
				
				$ot				=$row[10];
				
				$ot_rate=fn_ot($section_id,$basic);
				$ot_amount=$ot*$ot_rate;
				
				//$festiv=fn_fb();
				$advance		=$row[12];
				$total_amnt		=$row[12];
				
				
				
				
				
				
				
	?>				
		<tr>	
				  <td><?php echo $card_id;?></td>
				  <td><?php echo $name;?></td>
                  <td><?php echo $designation;?></td>
                  <td><?php echo $basic;?></td>
                  <td><?php echo $h_rent;?></td>
                  <td><?php echo $medical;?></td>
                  <td><?php echo $actual_salary;?></td>
                  <td><?php echo $total_w_day; ?></td>
                  <td><?php echo $atten; ?></td>
                  <td><?php echo $leave; ?></td>
                  <td><?php echo $late_pre; ?></td>
                  <td><?php echo $lunch_out; ?></td>
                  <td><?php echo $total_w_day; ?></td>
                  <td><?php echo $gross; ?></td>
                  <td><?php echo $atn_bon; ?>dd</td>
                  <td><?php echo $holiday; ?></td>
                  <td><?php echo $ot; ?></td>
                  <td><?php echo $ot_rate; ?></td>
                  <td><?php echo $ot_amount; ?></td>
                  <td><?php echo $total_amnt; ?></td>
                  <td><?php echo $advance; ?></td>
                 
                  <?php
				 /* $sql2	="select TBL_PAY_SECTION_ALLOWENCE_INFO.ALLOWENCE_HEAD_ID,TBL_PAY_SECTION_ALLOWENCE_INFO.ALLOWENCE_AMOUNT,TBL_PAY_SECTION_ALLOWENCE_INFO.ALLOWENCE_AFFECT,TBL_PAY_SECTION_ALLOWENCE_HEAD.HEAD_NAME from TBL_PAY_SECTION_ALLOWENCE_INFO,TBL_PAY_SECTION_ALLOWENCE_HEAD where TBL_PAY_SECTION_ALLOWENCE_INFO.ALLOWENCE_HEAD_ID=TBL_PAY_SECTION_ALLOWENCE_HEAD.ID and  TBL_PAY_SECTION_ALLOWENCE_INFO.SECTION_ID='".$res[0]."'";
				$ttd="";
				$sql_all_str  = oci_parse($conn,$sql2);
				oci_execute($sql_all_str);
				while($row1 = oci_fetch_array($sql_all_str, OCI_BOTH))
				{
					$atten_bonus	=allowence($row1[0],$row1[1],$row1[2],$basic,$gross);
					$ttd.='<td>'.$atten_bonus.'</td>';
					
				}
				echo $ttd;
				  
					*/
					?>
                  
                  
		</tr>
		<?php		
	
	 } 
}
 ?>  
</tbody>
   <tfoot>
        <tr>
            <th colspan="21" style="font-size: 16px;">
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