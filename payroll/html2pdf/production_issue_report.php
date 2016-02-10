<?php
	ob_start();
	include_once("../includes/opSessionCheck.inc");
	include_once("../includes/function.php");
	include("../includes/db.php");
?>
<?php 
		
		
	    function style_info($styleid) {
		   global $conn;
		   $style_str = "select STYLE_NAME from TBL_PAY_STYLE_INFO where ID=$styleid";
		   $style_stm = oci_parse($conn,$style_str);
		   oci_execute($style_stm);
		   
		   while($res = oci_fetch_array($style_stm,OCI_BOTH+OCI_RETURN_NULLS)) {
		      $style_name =  $res['STYLE_NAME'];
		   }
		   return $style_name;
		}
		
			  
			$str1 = "SELECT CARD_ID,BLOCK_ID,(select BLOCK_NAME FROM TBL_PAY_SECTION_BLOCK where ID=a.BLOCK_ID) as BLOCK_NAME,STYLE_ID,
			(select STYLE_NAME from ) 
			,SIZE_ID from TBL_PAY_EMP_PRODUCTION a";
					

			$stm1 = oci_parse($conn,$str1);
			oci_execute($stm1);
			
			while($res = oci_fetch_array($stm1,OCI_BOTH+OCI_RETURN_NULLS)) {
			   $card_id    = $res['CARD_ID'];
			   $block_name = $res['BLOCK_NAME'];
			   $styleid    = $res['STYLE_ID'];
			   
			   
			   echo $card_id.' '.$block_name.'<br/>';			   
			   
			   $style_str = "select STYLE_NAME from TBL_PAY_STYLE_INFO where ID=$styleid";
			   $style_stm = oci_parse($conn,$style_str);
			   while($rs = oci_fetch_array($style_stm,OCI_BOTH+OCI_RETURN_NULLS)) {
			      $rs[''];
			   }
			}

/*
               $style_str = "select QUANTITY,(SELECT SIZE_NAME from TBL_PAY_SIZE_SETTING where ID=a.SIZE_ID) as SIZE_NAME from TBL_PAY_EMP_PRODUCTION a where a.SIZE_ID=$sizeid";
			   
			   $style_stm = oci_parse($conn,$style_str);
			   oci_execute($style_stm);
			   while($rs = oci_fetch_array($style_stm,OCI_BOTH+OCI_RETURN_NULLS)) {
			         $size_name = $rs['SIZE_NAME'];
			         $quantity  = $rs['QUANTITY'];
					 echo $size_name." ".$quantity."<br/>";
			   }
			   

			include('html2pdf.class.php');
		$content = ob_get_clean();
		try
		{
			$html2pdf = new HTML2PDF('L', 'A4', 'fr');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
			$html2pdf->Output('mojid.pdf');
		}
		catch(HTML2PDF_exception $e) {
			echo $e;
			exit;
		}*/
?>
