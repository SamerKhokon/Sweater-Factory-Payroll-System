<?php
	ob_start();
	include_once("../includes/opSessionCheck.inc");
	include_once("../includes/function.php");
	include("../includes/db.php");
?>
<style type="text/css">
<!--
.details{  width:  100%;border-top:1px solid #000;	display:block;}
.htu{      text-align: center;border: solid 1px #000;}
.details th{ text-align: center;border: solid 1px #000;height:30px;font-size:20px;	}
.details td{ text-align: center;border: solid 0px #000;	height:25px;}
.details.td.col1{ border: solid 1px #000;text-align: right;}
head.table{ width:100%;border: solid 0px #000;} 
-->
</style>
<?php 
		
	$company_id = trim($_SESSION['company_id']);
	$section_id	= trim($_GET['section_id']);					
	$card_id    = "";		
	$froms      = trim($_GET['fdate']);
	$tos        = trim($_GET['tdate']);
	$type       = trim($_GET['type_id']);
	if($froms!='')
		$parse_1 = explode("/",$froms);
	if($tos!='')
	$parse_2 = explode("/",$tos);	
	
	if($froms!='')
	{		
		$fm = (int)$parse_1[0];
		$fd = (int)$parse_1[1];
		$fy = (int)$parse_1[2];		
		
		$flast = substr($fy,2,strlen($fy));		
		$from  = $fd.'-'.getMonth($fm).'-'.$flast;
	}
	if($tos!='')
	{
		$tm = (int)$parse_2[0];
		$td = (int)$parse_2[1];
		$ty = (int)$parse_2[2];
		$tlast = substr($ty,2,strlen($ty));
		$to    = $td.'-'.getMonth($tm).'-'.$tlast;
	}
	$str   ='Issue Reports';
	$dateid=date('Y-m-d');
		
		//echo tbl_header($dateid,$str);
	?>
	<table width="90%" style="width:100%;font-family:solaimanlipi;"><tr><td style="width:210px;">&nbsp;</td><td><?php echo tbl_header($dateid,$str); ?></td><td align="left">Report Generated Date:<?php echo date('m/d/Y'); ?></td></tr></table>
	<?php
	if($type=="*"){
		if($section_id=='*')
		  $sec_title = "<h4>All Sections</h4>";
		else
		  $sec_title = "<h4>".getSectionName($section_id)."</h4>";
		  echo "<div style='padding-left:80px;'>".$sec_title."</div>";
		  
		$str1 = "SELECT CARD_ID,(SELECT NAME FROM tbl_pay_emp_profile WHERE COMPANY_ID=a.COMPANY_ID and SECTION_ID=a.SECTION_ID and CARD_ID = a.CARD_ID) AS NAME,(SELECT BLOCK_NAME  FROM tbl_pay_section_block WHERE id = a.BLOCK_ID) AS BLOCK_NAME,(SELECT STYLE_NAME FROM tbl_pay_style_info WHERE id = a.STYLE_ID) as STYLE_NAME,(SELECT SIZE_NAME FROM tbl_pay_size_setting WHERE id = a.SIZE_ID AND STYLE_ID = a.STYLE_ID) AS SIZE_NAME,
		QUANTITY as ISSUE,(select sum(QUANTITY) from tbl_pay_emp_production where CARD_ID=a.CARD_ID) as delivery,PRO_DATE  FROM tbl_pay_emp_production_issue a where ";
		
		if($section_id=="*" && $card_id=="" && $froms=="" && $tos=="") {
		  $str1 .= " COMPANY_ID=$company_id";    
		}
		else if($section_id=="*" && $card_id!="" && $froms=="" && $tos=="") {
		  $str1 .= " COMPANY_ID=$company_id and CARD_ID=$card_id";    
		}
		else if($section_id=="*" && $card_id!="" && $froms!="" && $tos=="") {
		  $str1 .= " COMPANY_ID=$company_id and CARD_ID=$card_id and pro_date='$from'";    
		}			
		else if($section_id=="*" && $card_id!="" && $froms=="" && $tos!="") {
		  $str1 .= " COMPANY_ID=$company_id and CARD_ID=$card_id and pro_date='$to'";    			
		}		
		else if($section_id=="*" && $card_id=="" && $froms!="" && $tos=="") {
		  $str1 .= " COMPANY_ID=$company_id and pro_date='$from'";    			
		}					  
		else if($section_id=="*" && $card_id=="" && $froms=="" && $tos!="") {
		  $str1 .= " COMPANY_ID=$company_id and pro_date='$to'";    			
		}
		else if($section_id=="*" && $card_id!="" && $froms!="" && $tos!="") {
		  if($froms > $tos) {
		  $str1 .= " COMPANY_ID=$company_id and CARD_ID=$card_id and pro_date between '$to' and '$from'"; 
		  }else{
		  $str1 .= " COMPANY_ID=$company_id and CARD_ID=$card_id and pro_date between '$from' and '$to'";		  
		  }   
		}						
		else if($section_id=="*" && $card_id=="" && $froms!="" && $tos!="") {
		  if( $froms > $tos) {
			$str1 .= " COMPANY_ID=$company_id and pro_date between '$to' and '$from'"; 
		  }else{
			$str1 .= " COMPANY_ID=$company_id and pro_date between '$from' and '$to'";			  
		  }   
		}									
		else if($section_id=="*" && $card_id=="" && $froms!="" && $tos!="") {
		  if( $froms > $tos ) {
			$str1 .= " COMPANY_ID=$company_id and pro_date between '$from' and '$to'"; 
		  }else{
			$str1 .= " company_id=$company_id and pro_date between '$to' and '$from'";			  
		  }   
		}		
		else if($section_id!="*" && $card_id=="" && $froms!="" && $tos=="") {
			$str1 .= " COMPANY_ID=$company_id and section_id=$section_id and pro_date='$from'";			
		}
		else if($section_id!="*" && $card_id=="" && $froms=="" && $tos!="") {
			$str1 .= " COMPANY_ID=$company_id and section_id=$section_id and pro_date='$to'";			
		}
		else if($section_id!="*" && $card_id=="" && $froms!="" && $tos!="") {
		   if($froms>$tos) {
		  $str1 .= " COMPANY_ID=$company_id and section_id=$section_id and pro_date between '$to' and '$from'";
		   }else{
		  $str1 .= " COMPANY_ID=$company_id and section_id=$section_id and pro_date between '$from' and '$to'";
		   }				
		}
		else if($section_id!="*" && $card_id=="" && $froms=="" && $tos=="") {
		  $str1 .= " COMPANY_ID=$company_id and section_id=$section_id";    
		}			
		else if($section_id!="*" && $card_id!="" && $froms=="" && $tos=="") {
		  $str1 .= " COMPANY_ID=$company_id and section_id=$section_id and CARD_ID=$card_id";    
		}						
		else if($section_id!="*" && $card_id!="" && $froms!="" && $tos=="") {
	$str1 .= " COMPANY_ID=$company_id and section_id=$section_id and CARD_ID=$card_id and pro_date='$from'";    
		}									
		else if($section_id!="*" && $card_id!="" && $froms=="" && $tos!="") {
	$str1 .= " COMPANY_ID=$company_id and section_id=$section_id and CARD_ID=$card_id and pro_date='$to'";    
		}			
		else if($section_id!="*" && $card_id!="" && $froms!="" && $tos!="") {
		  if($froms>$tos) {
			$str1 .= " COMPANY_ID=$company_id and section_id=$section_id and CARD_ID=$card_id and pro_date between '$to' and '$from'";    
		  }else{
			$str1 .= " COMPANY_ID=$company_id and section_id=$section_id and CARD_ID=$card_id and pro_date between '$from' and '$to'";    			  
		  }
		}										  
		//echo $str1;
		
		
			$stm1 = oci_parse($conn,$str1);
			oci_execute($stm1);
			$ncol = oci_num_fields($stm1);
			echo "<table border='0' cellpadding='0' cellspacing='0'  align='center' class='details'><tbody><tr>";
			for($i=2;$i<=$ncol;$i++) {
				$f = oci_field_name($stm1,$i);
				echo "<th>&nbsp;".file_name_sizing($f)."&nbsp;</th>";
			}
			echo "</tr>";
			while($res= oci_fetch_array($stm1,OCI_BOTH+OCI_RETURN_NULLS)) {
			  echo "<tr>";
			  for($i=2;$i<=$ncol;$i++) {
				$f = oci_field_name($stm1,$i);
				echo "<td>".$res[$f]."</td>"; 
			  }
			  echo "</tr>";
			}			
			echo "</tbody></table>";
	}		
        // end first condition
		
		// this block only for issue
	else if($type=="1"){
		$str2 = "SELECT card_id,(SELECT name  FROM tbl_pay_emp_profile WHERE card_id = a.card_id and section_id=a.section_id and company_id=a.company_id) AS name,(SELECT sec_name   FROM tbl_pay_section_info  WHERE id = a.section_id) AS sec_name,(SELECT block_name FROM tbl_pay_section_block WHERE id = a.block_id) AS block_name,(SELECT style_name FROM tbl_pay_style_info    WHERE id = a.style_id) as style_name,(SELECT size_name  FROM tbl_pay_size_setting  WHERE id = a.size_id AND style_id = a.style_id) AS size_name ,quantity,PRO_DATE  FROM tbl_pay_emp_production_issue a where ";
		
		if($section_id=="*" && $card_id=="" && $froms=="" && $tos=="") {
		  $str2 .= " COMPANY_ID=$company_id";    
		}
		if($section_id!="*" && $card_id=="" && $froms=="" && $tos=="") {
		  $str2 .= " COMPANY_ID=$company_id and section_id=$section_id";    
		}					
		else if($section_id=="*" && $card_id!="" && $froms=="" && $tos=="") {
		  $str2 .= " COMPANY_ID=$company_id and card_id=$card_id";    
		}
		else if($section_id!="*" && $card_id!="" && $froms=="" && $tos=="") {
		  $str2 .= " COMPANY_ID=$company_id and section_id=$section_id and card_id=$card_id";    
		}			
		else if($section_id!="*" && $card_id!="" && $froms!="" && $tos=="") {
$str2 .= " COMPANY_ID=$company_id and section_id=$section_id and card_id=$card_id and pro_date='$from'";    
		}						
		else if($section_id!="*" && $card_id=="" && $froms!="" && $tos=="") {
		  $str2 .= " COMPANY_ID=$company_id and section_id=$section_id and pro_date='$from'";    
		}									
		else if($section_id!="*" && $card_id!="" && $froms=="" && $tos!="") {
		$str2 .= " COMPANY_ID=$company_id and section_id=$section_id and card_id=$card_id and pro_date='$to'";    
		}						
		else if($section_id!="*" && $card_id=="" && $froms=="" && $tos!="") {
		  $str2 .= " COMPANY_ID=$company_id and section_id=$section_id and pro_date='$to'";    
		}		
		else if($section_id!="*" && $card_id!="" && $froms!="" && $tos!="") {
		  if($froms>$tos) {
			$str2 .= " company_id=$company_id and section_id=$section_id and card_id=$card_id and pro_date between '$to' and '$from'";    
		  }else{
			$str2 .= " COMPANY_ID=$company_id and section_id=$section_id and card_id=$card_id and pro_date between '$from' and '$to'";
		  }    			  
		}					
		else if($section_id!="*" && $card_id=="" && $froms!="" && $tos!=""){
		  if($froms>$tos) {
		 $str2 .= " COMPANY_ID=$company_id and section_id=$section_id and pro_date between '$to' and '$from'";    
		  }else{
		 $str2 .= " COMPANY_ID=$company_id and section_id=$section_id and pro_date between '$from' and '$to'";
		  }    			  
		}	
		else if($section_id=="*" && $card_id=="" && $froms!="" && $tos=="") {
		  $str2 .= " COMPANY_ID=$company_id and card_id=$card_id and pro_date='$from'";    
		}			
		else if($section_id=="*" && $card_id=="" && $froms=="" && $tos!="") {
		  $str2 .= " company_id=$company_id and card_id=$card_id and pro_date='$to'";    
		}
		else if($section_id=="*" && $card_id!="" && $froms!="" && $tos=="") {
		  $str2 .= " COMPANY_ID=$company_id and card_id=$card_id and pro_date='$from'";    
		}
		else if($section_id=="*" && $card_id!="" && $froms=="" && $tos!="") {
		  $str2 .= " COMPANY_ID=$company_id and card_id=$card_id and pro_date='$to'";    
		}					
		else if($section_id=="*" && $card_id=="" && $froms!="" && $tos!="") {
		  if($froms>$tos){
		  $str2 .= " COMPANY_ID=$company_id and pro_date between '$to' and '$from'";
		  }else {
		  $str2 .= " COMPANY_ID=$company_id and pro_date between '$from' and '$to'";			  
		  }
		}				
		else if($section_id=="*" && $card_id!="" && $froms!="" && $tos!="") {
		  if($froms > $tos){
		  $str2 .= " company_id=$company_id and card_id=$card_id and pro_date between '$to' and '$from'";
		  }else {
		  $str2 .= " COMPANY_ID=$company_id and card_id=$card_id and pro_date between '$from' and '$to'";		  
		  }
		}	
		
		//echo $str2;
		  if($section_id=='*') {
			   echo '<h4>All Sections</h4>';
		   }else{
			   echo "<h4>".getSectionName($section_id)."</h4>";
			}
			$stm2 = oci_parse($conn,$str2);
			oci_execute($stm2);
			$ncol2 = oci_num_fields($stm2);
			echo "<table border='0' cellpadding='0' cellspacing='0'  align='center' class='details'><tbody><tr>";
			for($i=2;$i<=$ncol2;$i++) {
				$f2 = oci_field_name($stm2,$i);
				echo "<th>&nbsp;".file_name_sizing($f2)."&nbsp;</th>";
			}
			echo "</tr>";
			while( $res = oci_fetch_array($stm2,OCI_BOTH)) {
			  echo "<tr>";
			  for( $i=2 ; $i<=$ncol2 ; $i++ ) {
				$f2 = oci_field_name($stm2,$i);
				echo "<td>".$res[$f2]."</td>";
			  }
			  echo "</tr>";
			}		
			echo "</tbody></table>";
	}
	 
	 
	 // this block for only receive
	else if($type=='2') {
		$str3 = "SELECT card_id,(SELECT name  FROM tbl_pay_emp_profile   WHERE card_id = a.card_id and section_id=a.section_id and company_id=a.company_id) AS name,(SELECT sec_name   FROM tbl_pay_section_info   WHERE id = a.section_id) AS sec_name,(SELECT block_name  FROM tbl_pay_section_block   WHERE id = a.block_id) AS block_name,(SELECT style_name   FROM tbl_pay_style_info   WHERE id = a.style_id) as style_name,(SELECT size_name   FROM tbl_pay_size_setting   WHERE id = a.size_id   AND style_id = a.style_id) AS size_name ,quantity as delivery , PRO_DATE  FROM tbl_pay_emp_production a where ";
		
		if($section_id=="*" && $card_id=="" && $froms=="" && $tos=="") {
		  $str3 .= "COMPANY_ID=$company_id";    
		}
		else if($section_id=="*" && $card_id!="" && $froms=="" && $tos=="") {
		  $str3 .= "COMPANY_ID=$company_id and card_id=$card_id";    
		}			
		else if($section_id=="*" && $card_id=="" && $froms!="" && $tos=="") {
		  $str3 .= "COMPANY_ID=$company_id and pro_date='$from'";    
		}		
		else if($section_id=="*" && $card_id=="" && $froms=="" && $tos!="") {
		  $str3 .= "COMPANY_ID=$company_id and pro_date='$to'";    
		}			
		else if($section_id=="*" && $card_id=="" && $froms!="" && $tos!="") {
		  if($froms>$tos) {
		  $str3 .= "COMPANY_ID=$company_id and pro_date between '$to' and '$from'";    
		  }else{
			$str3 .= "COMPANY_ID=$company_id and pro_date between '$from' and '$to'";    
		  }
		}								
		else if($section_id=="*" && $card_id!="" && $froms!="" && $tos!="") {
		  if($froms>$tos) {
		  $str3 .= "COMPANY_ID=$company_id and card_id=$card_id and pro_date between '$to' and '$from'";    			  
		  }else{
		  $str3 .= "COMPANY_ID=$company_id and card_id=$card_id and pro_date between '$from' and '$to'";    
		  }
		}	
		else if($section_id=="*" && $card_id!="" && $froms!="" && $tos=="") {
		  $str3 .= "COMPANY_ID=$company_id and card_id=$card_id and pro_date='$from'";    			  
		}				
		else if($section_id!="*" && $card_id=="" && $froms=="" && $tos=="") {
		  $str3 .= "COMPANY_ID=$company_id and section_id=$section_id";    
		}			
		else if($section_id!="*" && $card_id!="" && $froms=="" && $tos=="") {
		  $str3 .= "COMPANY_ID=$company_id and section_id=$section_id and card_id=$card_id";    
		}						
		else if($section_id!="*" && $card_id!="" && $froms!="" && $tos=="") {
	$str3 .= "COMPANY_ID=$company_id and section_id=$section_id and card_id=$card_id and pro_date='$from'";
		}
		else if($section_id!="*" && $card_id!="" && $froms=="" && $tos!="") {
	$str3 .= "COMPANY_ID=$company_id and section_id=$section_id and card_id=$card_id and pro_date='$to'";			
		}			  
		else if($section_id!="*" && $card_id!="" && $froms!="" && $tos!="") {
		  if($froms>$tos){
		  $str3 .= "COMPANY_ID=$company_id and section_id=$section_id and card_id=$card_id and pro_date between '$to' and '$from'";			
		  }else{
		  $str3 .= "COMPANY_ID=$company_id and section_id=$section_id and card_id=$card_id and pro_date between '$from' and '$to'";						   
		  }
		}			
		else if($section_id!="*" && $card_id=="" && $froms!="" && $tos!=""){
		  if($froms>$tos){
	$str3 .= "COMPANY_ID=$company_id and section_id=$section_id and pro_date between '$to' and '$from'";		
		  }else{
		  $str3 .= "COMPANY_ID=$company_id and section_id=$section_id and pro_date between '$from' and '$to'";
		  }
		}
		
		//echo $str3;
		$stm3 = oci_parse($conn,$str3);
		oci_execute($stm3);
		$ncol3 = oci_num_fields($stm3);
		echo "<table border='0' cellpadding='0' cellspacing='0' align='center' class='details'><tbody><tr>";
		for($i=1;$i<=$ncol3;$i++) {
			$f3 = oci_field_name($stm3,$i);
			echo "<th>&nbsp;".file_name_sizing($f3)."&nbsp;</th>";
		}
		echo "</tr>";
		while( $res = oci_fetch_array($stm3,OCI_BOTH)) {
			echo "<tr>";
			for( $i=2 ; $i<=$ncol3 ; $i++ ) {
			 $f3 = oci_field_name($stm3,$i);
			 echo "<td>".$res[$f3]."</td>";
			}
			echo "</tr>";
		}		
		echo "</tbody></table>";													
	}

	include('html2pdf.class.php');
	$content = ob_get_clean();
	try
	{
		$html2pdf = new HTML2PDF('L', 'A4', 'fr',array(0, 0, 0,0));
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output('mojid.pdf');
	}
	catch(HTML2PDF_exception $e) {
		echo $e;
		exit;
	}
?>