<?php
/*
164 Attandence Bonus
165 medical
166 house rent
167	No Work
168 Festival Bonus
169	Production Bonus
170	Over Time (OT)
*/


class salary_cal
{
	var $house_rnt;
	var $medical;
	var $atn_bonus;
	var $over_time;
	var $pro_amnt;
	var $card_id;
	var $dateT;
	var $dateF;
	var $holiday;
	var $basic;
	var $day_of_month;
	var $amount;
	var $dateid;
	var $dateid2;
	var $str;
	var $number;
	var $cheque_amt;
	
	function __construct()
	{
		$this->house_rnt=166;	
		$this->medical=165;
		$this->atn_bonus=164;
		$this->over_time=170;
		$this->pro_amnt;
		$this->card_id;
		$this->dateT;
		$this->dateF;
		$this->holiday;
		$this->basic;
		$this->day_of_month;
		$this->amount;
		$this->dateid;
		$this->str;
		$this->number;
		$this->cheque_amt;

		global $conn;
    	$this->conn = $conn;
		global $company_id;
		$this->company_id = $company_id;

	}
	
	function gross_salary($sec_id,$basic)
	{		
		$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=".$this->house_rnt."  and COMPANY_ID=".$this->company_id." and SECTION_ID='$sec_id'";
			$qstr  = oci_parse($this->conn,$sql);
			oci_execute($qstr);
			if($row = oci_fetch_array($qstr, OCI_BOTH))
			{
				$type 		= $row[1];
				$amount_tp 	= $row[0];
				$amtype		= strpos($amount_tp, "%");
				if($amtype)
				{
					$amount	=substr($amount_tp,0,strlen($amount_tp)-1);
					$house_rent =(($basic * $amount)/100);
				}
				else
					$house_rent =$amount_tp;
				
				$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=".$this->medical." and COMPANY_ID=".$this->company_id." and SECTION_ID='$sec_id'";
				$qstr  = oci_parse($this->conn,$sql);
				oci_execute($qstr);
				if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
				{
					$type1 		= $row[1];
					$amount_tp1 	= $row[0];
					$amtype1		= strpos($amount_tp1, "%");
					if($amtype1)
					{
						$amount1	=substr($amount_tp1,0,strlen($amount_tp1)-1);
						$medical =(($basic * $amount1)/100);
					}
					else
						$medical =$amount_tp1;
					
				}	
					
				return $gross= round(($basic+$house_rent+$medical),2);
				
			}
	}
	
	function fn_atnbon($sec_id,$basic)
	{
		$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=".$this->atn_bonus."  and COMPANY_ID=".$this->company_id." and SECTION_ID='$sec_id'";
		$qstr  = oci_parse($this->conn,$sql);
		oci_execute($qstr);
		if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
		{
			$all_efect 	=$row[1];
			$amount_tp 	=$row[0];
			$gross	 	=gross_salary($sec_id,$basic);
			
			$amtype	= strpos($amount_tp, "%");
			if($amtype)
			{
				$amount	=substr($amount_tp,0,strlen($amount_tp)-1);
				
				if($all_efect=='GROSS')
				{
					$bonus_amount =(($gross * $amount)/100);
				}
				else
				{
					$bonus_amount =(($basic * $amount)/100);
				}
			}
			else
			{
				$bonus_amount =$amount_tp;
			}
			return round($bonus_amount,2);
			
		}
	
	}
	
	
	function fn_house_rent($sec_id,$basic)
	{
		$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=".$this->house_rnt." and COMPANY_ID=".$this->company_id." and SECTION_ID='$sec_id'";
		$qstr  = oci_parse($this->conn,$sql);
		oci_execute($qstr);
		if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
		{
			//$amount = $row[0];
			$amount_tp = $row[0];
			$amtype	= strpos($amount_tp, "%");
			if($amtype>0)
			{
				$amount	=substr($amount_tp,0,strlen($amount_tp)-1);
				$bonus_amount =(($basic * $amount)/100);
			}
			else
				$bonus_amount =$amount_tp;
				
			return round($bonus_amount,2);
			
		}
	
	}

	function fn_medical($sec_id,$basic)
	{
		$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=".$this->medical."  and COMPANY_ID=".$this->company_id." and SECTION_ID='$sec_id'";
		$qstr  = oci_parse($this->conn,$sql);
		oci_execute($qstr);
		if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
		{
			//$amount = $row[0];
			$amount_tp = $row[0];
			$amtype	= strpos($amount_tp, "%");
			if($amtype>0)
			{
				$amount	=substr($amount_tp,0,strlen($amount_tp)-1);
				$bonus_amount =(($basic * $amount)/100);
			}
			else
				$bonus_amount =$amount_tp;
				
			return $bonus_amount;
			
		}
	
	}

	function fn_ot($sec_id,$basic)
	{
		$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID=".$this->over_time." and COMPANY_ID=".$this->company_id." and SECTION_ID='$sec_id'";
		$qstr  = oci_parse($this->conn,$sql);
		oci_execute($qstr);
		if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
		{
			$all_efect 	=$row[1];
			$amount_tp = $row[0];
			$gross	 	=gross_salary($sec_id,$basic);
			
			$amtype	= strpos($amount_tp, "%");
			if($amtype)
			{
				$amount	=substr($amount_tp,0,strlen(($amount_tp)-1));
				
				if($all_efect=='GROSS')
	
				{
					$bonus_amount =(($gross * $amount)/100);
				}
				else
				{
					$bonus_amount =(($basic * $amount)/100);
				}
			}
			else
			{
				$bonus_amount =$amount_tp;
			}
				
			return round($bonus_amount,2);
			
		}
	
	}
	
	function fn_fest_v($sec_id,$basic)
	{
		//168 for festival allo
		/*$sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID='168' and COMPANY_ID=".$this->company_id." and SECTION_ID='$sec_id'";*/
		
		$sql	="select BONUS_AMOUNT,SALARY_TYPE from TBL_PAY_FESTIVALBONUS_SETTING where COMPANY_ID=".$this->company_id." and SECTION_ID=$sec_id and $basic between SALARY_FROM and SALARY_TO";
		$qstr  = oci_parse($this->conn,$sql);
		oci_execute($qstr);
		if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
		{
			$all_efect 	=$row[1];
			$amount_tp = $row[0];
			$gross	 	=gross_salary($sec_id,$basic);
			
			$amtype	= strpos($amount_tp, "%");
			if($amtype)
			{
				$amount	=substr($amount_tp,0,strlen($amount_tp)-1);
				
				if($all_efect=='GROSS')
				{
					$bonus_amount =(($gross * $amount)/100);
				}
				else
				{
					$bonus_amount =(($basic * $amount)/100);
				}
			}
			else
			{
				$bonus_amount =$amount_tp;
			}
				
			return round($bonus_amount,2);
			
		}
	
	}
	
	function fn_holiamnt($holiday,$basic,$day_of_month)
	{
		return $bonus_amount = round((($basic/$day_of_month)*$holiday),2);
	}
	function fn_product_amnt($card_id,$section_id,$dateT,$dateF)
	{
		$production_amnt	=0;
		$production_quantity=0;
		$sql	="select sum(QUANTITY) as total,STYLE_ID,SIZE_ID,(select RATE from TBL_PAY_RATE_SETTING where STYLE_ID=a.STYLE_ID and SIZE_ID=a.SIZE_ID and COMPANY_ID=".$this->company_id." and SECTION_ID='$section_id') as rate from TBL_PAY_EMP_PRODUCTION a where a.CARD_ID='$card_id' and a.COMPANY_ID=".$this->company_id." and a.SECTION_ID='$section_id' and to_char(a.PRO_DATE,'mm/dd/yyyy') between '$dateT' and '$dateF'  group by a.STYLE_ID,a.SIZE_ID";
		$qstr  = oci_parse($this->conn,$sql);
		oci_execute($qstr);
		while($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
		{
			
			$production_quantity+=$row[0];
			$production_amnt	+=($row[0] * $row[3]);
		}
			$data = array(
			 'production_quantity' => $production_quantity,
			 'production_amnt' => $production_amnt
		   );
	
	   return $data;
		
	}
	function fn_production_bonus($pro_amnt,$section_id)
	{
		$bonus_anmt	=0;
		$amount	="";
		$sql	="select BONUS_AMNT from TBL_PAY_PRODUCTIONBONUS_SET where COMPANY_ID=".$this->company_id." and SECTION_ID=$section_id and  $pro_amnt between PRODUC_AMNT_FROM and PRODUC_AMNT_TO";
		$qstr  = oci_parse($this->conn,$sql);
		oci_execute($qstr);
		if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
		{
			$amount	=$row[0];
		}
		if($amount!='')
		{
			$amounttp	=strpos($amount, "%");
			if(strlen($amounttp)>0)
			{
				$amnt	=substr($amount,0,strlen($amount)-1);
				$bonus_anmt	=(($pro_amnt * $amnt)/100);
					
			}
			else
			{
				$bonus_anmt =$amount;
			}
			
		}		
		return round($bonus_anmt,2);
		
	}
	
	
	function section_pay($total_emp,$company_id,$section_id,$block_id,$actual_salary_total,$atn_bon_total,$ot_amnt_total,$produc_amnt_total,$advance_total,$net_pay_total,$produc_bonus_total,$dateid)
{
	$month_year1=substr($dateid,0,3).''.substr($dateid,6,10);
	$pyres=0;
	$sql="select ID from TBL_PAY_SECTION_PAY where SECTION_ID=$section_id and COMPANY_ID=$company_id and BLOCK_ID=$block_id and to_char(MONTH_YEAR,'mm/yyyy')='$month_year1'";
	$qstr  = oci_parse($this->conn,$sql);
	oci_execute($qstr);
	if($row = oci_fetch_array($qstr, OCI_BOTH+OCI_RETURN_NULLS))
	{
		$pyres=$row[0];
		//$up_id=$row[1];
	}
	if($pyres==0)
	{
		//insert
		$mf =0;
		$sql2="insert into TBL_PAY_SECTION_PAY(SECTION_ID,COMPANY_ID,BLOCK_ID,GROSS_TOTAL,ATN_BON_TOTAL,OT_AMNT_TOTAL,PRO_AMNT_TOTAL,PRO_BON_TOTAL,ADVANCE_TOTAL,NET_PAY_TOTAL,EMP_TOTAL,MONTH_YEAR) values($section_id,$company_id,$block_id,$actual_salary_total,$atn_bon_total,$ot_amnt_total,$produc_amnt_total,$produc_bonus_total,$advance_total,$net_pay_total,$total_emp,to_date('$dateid','mm/dd/yyyy'))";
		$result=oci_parse($this->conn,$sql2);
		$success=oci_execute($result);
		
	}
	else
	{
	//update
	$mf =1;
	$sql2="update  TBL_PAY_SECTION_PAY set SECTION_ID=$section_id,COMPANY_ID=$company_id,BLOCK_ID=$block_id,GROSS_TOTAL=$actual_salary_total,ATN_BON_TOTAL=$atn_bon_total,OT_AMNT_TOTAL=$ot_amnt_total,PRO_AMNT_TOTAL=$produc_amnt_total,PRO_BON_TOTAL=$produc_bonus_total,ADVANCE_TOTAL=$advance_total,NET_PAY_TOTAL=$net_pay_total,EMP_TOTAL=$total_emp where ID=$pyres";
	$result=oci_parse($this->conn,$sql2);
	$success=oci_execute($result);
	}
	//return $sql2;
}
	
	
	function tbl_header($dateid,$str)
	{
	if($dateid=='')
		$dateid=date('d-m-Y');
	$sql	="select COMPANY_NAME,ADDRESS,ID from TBL_COMPANY_INFO where ID=".$this->company_id."";
	$stm  = oci_parse($this->conn,$sql);
	oci_execute($stm);
	if($rs = oci_fetch_array($stm,OCI_BOTH+OCI_RETURN_NULLS))
		{
			$com_name =$rs[0];
			$com_add =$rs[1];	
		}
		return $tbl_h	='<table border="0" cellpadding="0" cellspacing="0"  align="center" class="head" style="font-family:Arial; font-size:20px;">
		<tr>
		   <td align="center"><img src="../company_logo/'.$rs[2].'.gif" /></td>
		 </tr>
		 <tr>
			<td align="center">'.$com_name.'<br>'.$com_add.'</td>
		 </tr>
		 <tr>
		 <td>'.$str.'&nbsp;'.$dateid.'</td>
		 </tr>
	</table>';	
	}
	
	function tbl_header_fun1($dateid,$dateid2,$str)
	{
	
	global	$conn;
	if($dateid=='')
		$dateid='';
	if($dateid2=='')
		$dateid2='';
		
	$sql	="select COMPANY_NAME,ADDRESS,ID from TBL_COMPANY_INFO where ID=".$this->company_id."";
	$stm  = oci_parse($this->conn,$sql);
	oci_execute($stm);
	if($rs = oci_fetch_array($stm,OCI_BOTH+OCI_RETURN_NULLS))
	{
		$com_name =$rs[0];
		$com_add =$rs[1];	
	}
	return $tbl_h	='<table border="0" cellpadding="0" cellspacing="0" width="70%"  align="center" class="head" style="font-family:Arial; font-size:16px;">
		<tr>
		   <td align="center"><img src="../company_logo/'.$rs[2].'.gif" /></td>
		 </tr>
		 <tr>
			<td align="center">'.$com_name.'<br>'.$com_add.'</td>
		 </tr>
		 <tr>
			<td align="center">'.$str.'</td>
		 </tr>
		 <tr>
			<td>'.$dateid.' To '.$dateid2.'</td>
		 </tr>
	</table>';	
	}
	
	function tbl_footer()
	{
		return $ttl	='<table width="100%" style="width:100%;" align="center">
		<tr>
			<td style="width:270px;">Check By</td><td style="width:270px;">Authorize By</td><td style="width:270px;">Approve By</td><td align="right">Accounts</td>
		</tr>
	</table>';
	}

	function getSectionName($section_id)
	{
		$st = "select SEC_NAME FROM TBL_PAY_SECTION_INFO where ID=$section_id";
		$stm = oci_parse($this->conn,$st);
		oci_execute($stm);
		while($res = oci_fetch_array($stm,OCI_BOTH+OCI_RETURN_NULLS))
		{
			$sec_name = $res['SEC_NAME'];
		}
		return $sec_name;
	}
	
	
	function make_comma($amount)
	{
		$delimiter = ","; // replace comma if desired
		$a = explode('.',$amount);
		$d = '';
		if(count($a)>1) $d=$a[1];
		if(strlen($d)==1) $d.='0';
		$count=0;
		$len=3;
		$i = intval($amount);
		if(!is_numeric($i)) { return ''; }
		$minus = '';
		if($i < 0) { $minus = '-'; }
		$i = abs($i);
		$n = $i;
		$a = array();
		//echo strlen($n);
		while(strlen($n) > $len)
		{
			$count++;
			if($count==1)
			{
				$nn = substr($n,(strlen($n)-3));
				$a[] = $nn;
				$n = substr($n,0,(strlen($n)-3));
				$len = 2;
			}
			else if($count<=3)
			{
				$nn = substr($n,(strlen($n)-2));
				$a[] = $nn;
				$n = substr($n,0,(strlen($n)-2));
			}
			else if($count>3) break;
		}
		if(strlen($n) > 0) { $a[] = $n; }
		$n='';
		for($ii=count($a);$ii>0;$ii--)
		{
			if($ii==1) $delimiter = '';
			$n.=$a[$ii-1].''.$delimiter;
		}
		if(strlen($d) < 1) { $amount = $n; }
		else { $amount = $n.'.'.$d; }
		$amount = $minus.''.$amount;
		return $amount;
	}
	
	
	
	function convert_number($number) 
	{ 
		if (($number < 0) || ($number > 999999999)) 
		{ 
		throw new Exception("Number is out of range");
		} 
	
		$Gn = floor($number / 1000000);  /* Millions (giga) */ 
		$number -= $Gn * 1000000; 
		$kn = floor($number / 1000);     /* Thousands (kilo) */ 
		$number -= $kn * 1000; 
		$Hn = floor($number / 100);      /* Hundreds (hecto) */ 
		$number -= $Hn * 100; 
		$Dn = floor($number / 10);       /* Tens (deca) */ 
		$n = $number % 10;               /* Ones */ 
	
		$res = ""; 
	
		if ($Gn) 
		{ 
			$res .= convert_number($Gn) . " Million"; 
		} 
	
		if ($kn) 
		{ 
			$res .= (empty($res) ? "" : " ") . 
				convert_number($kn) . " Thousand"; 
		} 
	
		if ($Hn) 
		{ 
			$res .= (empty($res) ? "" : " ") . 
				convert_number($Hn) . " Hundred"; 
		} 
	
		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
			"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
			"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
			"Nineteen"); 
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
			"Seventy", "Eigthy", "Ninety"); 
	
		if ($Dn || $n) 
		{ 
			if (!empty($res)) 
			{ 
				$res .= " and "; 
			} 
	
			if ($Dn < 2) 
			{ 
				$res .= $ones[$Dn * 10 + $n]; 
			} 
			else 
			{ 
				$res .= $tens[$Dn]; 
	
				if ($n) 
				{ 
					$res .= "-" . $ones[$n]; 
				} 
			} 
		} 
	
		if (empty($res)) 
		{ 
			$res = "zero"; 
		} 
	
		return $res; 
	} 

	function call_cnvrt_n2w($cheque_amt)
	{
		//$cheque_amt = 8747.50 ;
		$ret1	="";
		$ret	="";
		
		$test = explode('.',$cheque_amt);
		if(count($test)<2)
		{
			$test[0]=$test[0];
			$test[1]="";	
		} 
		try
		{
			$ret	=convert_number($test[0]).' BDT';
			if($test[1]!="")
				$ret1	=' and '.convert_number($test[1]).' BDP';
			return $ret.$ret1;	
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}	
	
}

class app_utility
	{
		var $generate_number_value;
		var $unicode_bn_num_array=array();
		
		function app_utility() 
		{
			$this->__construct();
		}	
		function  __construct()
		{
			$this->unicode_bn_num_array[0] = "&#2534;";
			$this->unicode_bn_num_array[1] = "&#2535;";
			$this->unicode_bn_num_array[2] = "&#2536;";
			$this->unicode_bn_num_array[3] = "&#2537;";
			$this->unicode_bn_num_array[4] = "&#2538;";
			$this->unicode_bn_num_array[5] = "&#2539;";
			$this->unicode_bn_num_array[6] = "&#2540;";
			$this->unicode_bn_num_array[7] = "&#2541;";
			$this->unicode_bn_num_array[8] = "&#2542;";
			$this->unicode_bn_num_array[9] = "&#2543;";
						
			$this->unicode_bn_num_array['.'] = ".";
			$this->unicode_bn_num_array['%'] = "%";
			$this->unicode_bn_num_array['-'] = "-";
			$this->unicode_bn_num_array['+'] = "+";
			$this->unicode_bn_num_array['/'] = "/";
			$this->unicode_bn_num_array[','] = ",";
		}
		
		function get_unicode_bn_num($en_num)
		{
			
			//if(empty($en_num)) return;
			if(empty($en_num) && '0' != $en_num) return;
			$this->generate_number_value="";
						
			for($i=0;$i<strlen($en_num);$i++)
				$this->generate_number_value .= $this->unicode_bn_num_array[$en_num[$i]];
			
			return $this->generate_number_value;
		}
		
		
		
		function formated_date_from_dmY_Ymd($incomming_dt,$sep='-')
		{
			if($incomming_dt=="")
				return "";
		
			$incomming_dt_array=split($sep,$incomming_dt);
			
	return "$incomming_dt_array[2]-$incomming_dt_array[1]-$incomming_dt_array[0]";					
		
		}		
}
	
	
function getMonth($x)
{
   switch($x)
   {
	 case 1:  return 'JAN';break;
	 case 2:  return 'FEB';break;
	 case 3:  return 'MAR';break;
	 case 4:  return 'APR';break;
	 case 5:  return 'MAY';break;
	 case 6:  return 'JUN';break;
	 case 7:  return 'JUL';break;
	 case 8:  return 'AUG';break;
	 case 9:  return 'SEP';break;
	 case 10: return 'OCT';break;
	 case 11: return 'NOV';break;
	 case 12: return 'DEC';break;
	 break;
   }
}

 function month_pos($m) 
 {
		switch($m) {
		   case 'JAN': return '01';break;
		   case 'FEB': return '02';break;
		   case 'MAR': return '03';break;
		   case 'APR': return '04';break;
		   case 'MAY': return '05';break;
		   case 'JUN': return '06';break;
		   case 'JUL': return '07';break;
		   case 'AUG': return '08';break;
		   case 'SEP': return '09';break;
		   case 'OCT': return '10';break;
		   case 'NOV': return '11';break;
		   case 'DEC': return '12';break;
		   default:
		}  
}


function file_name_sizing($f) {
   $parse =  explode("_",$f);
   $str = "";
   $i = 0 ;
   while($i<count($parse)) {
	  $str .= ucfirst(strtolower($parse[$i]))." "; 				  
	  $i++;
   }
   return trim($str);
}

function getMonthName($m,$d,$y){
return date('F',mktime(0,0,0,$m,$d,$y));
}
function getDayName2($month,$date,$year) {
return date("l", mktime(0,0,0,$month,$date,$year)).'-'.substr(getMonthName($month,$date,$year),0,3).'-'.$year;
}

function num_days ($day, $month, $year) { 
    $day_array = array("Mon" => "Monday", "Tue" => "Tuesday", "Wed" => "Wednesday", "Thu" => "Thursday", "Fri" => "Friday", "Sat" => "Saturday", "Sun" => "Sunday");

    $month_array = array(1 => "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

    /* * Check our arguments are valid. */

    /* * $day must be either a full day string or the 3 letter abbreviation. */ 
    if (!(in_array($day, $day_array) || array_key_exists($day, $day_array))) { 
        return 0; 
    }

    /* * $month must be either a full month name or its 3 letter abrreviation */ 
    if (($mth = array_search(substr($month,0,3), $month_array)) <= 0) { 
        return 0; 
    }

    /* * Now fetch the previous $day of $month+1 in $year; * this will give us the last $day of $month. */

    /* * Calculate the timestamp of the 01/$mth+1/$year. */ 

    $time = mktime(0,0,0,$mth+1,1,$year);
    $str = strtotime("last $day", $time);

    /* * Return nth day of month. */ 

    $date = date("j", $str);

    /* * If the difference between $date1 and $date2 is 28 then * there are 5 occurences of $day in $month/$year, otherwise * there are just 4. */ 

    if ($date <= 28) { 
        return 4; 
    } else { 
        return 5; 
    } 
} 

	
?>