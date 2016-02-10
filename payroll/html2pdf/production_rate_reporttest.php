<?php
ob_start(); 
include_once("../includes/opSessionCheck.inc");
include_once("table_header_footer.php");
include("../includes/db.php");

$company_id = $_SESSION['company_id'];
//$section_id = $_GET['section_id'];
$dateid	=$_GET['dateid']; 
?>
<style type="text/css">
		<!--
		.htable{
		border:none;
		display:block;
		
		
		}
		tr .htable {
		border:none;
		display:block;
		
		
		}
		td .htable {
		border:none;
		display:block;
		
		
		}
		.htd{ border:15px solid #00FF00; background-color:#FF0000;}
		
		.btable{ width:  100%;  border: solid 1px #000;}
		 .btable th{ text-align: center; border: solid 1px #000;  background: #EEFFEE; height:30px;	}
		 .btable td{ text-align: left; border: solid 1px #000; height:50px; }
		td.col1{   border: solid 1px #000;   text-align: right;}
		
		-->
</style>
<!--<table align="right"  class="htable">
  <tr>
  	<td>Abc company ltd.</td>
  </tr>
  <tr>
 	 <td>R#123,h#225,mohakhali,DOHS</td>
  </tr>  
</table>-->
<?php
	echo tbl_header();
?>
<br/>
<table width="100%" cellpadding="0" cellspacing="0" border="1">
	<thead>
	<tr>
    	<td>
        <table>
        	<tr>
            	<td width="30%">Section</td><td>Style</td><td>Size</td><td>Rate</td>
            </tr>
        </table>
        </td>
    </tr>
       </thead>



<!--<table border="0" cellpadding="0" cellspacing="0"  align='center' class="btable">
  	<col style="width: 30%" class="col1">
    <col style="width: 25%">
    <col style="width: 25%">
    <col style="width: 20%">
    <thead>
    	<!-- <tr><th colspan="8">Header </th></tr>	-->
        <!-- <tr>
            <th>Section</th>
            <th>Style</th>
            <th>Size</th>
            <th>Rate</th>
        </tr>
    </thead>-->
	<tbody>
<?php	$company_id = $_SESSION['company_id'];
        $section_id = 3;

		$emp_profile_str ="select DISTINCT SECTION_ID,
		(select SEC_NAME from TBL_PAY_SECTION_INFO where ID=b.SECTION_ID) as SEC_NAME	
		from TBL_PAY_RATE_SETTING b where COMPANY_ID=$company_id";		
		
		$stm  = oci_parse($conn,$emp_profile_str);
		oci_execute($stm);
		while($rs = oci_fetch_array($stm,OCI_BOTH))
		{				         			
		   $section_name = $rs['SEC_NAME'];
		   $section_id   = $rs['SECTION_ID']
?>		
<!--	<tr style="font-family:Arial;" >
		<td><?php echo $rs['SEC_NAME'];?></td>
	</tr>-->
    
    
    <tr>
    	<td>
        <table>
        	<tr>
            	<td colspan="4"><?php echo $rs['SEC_NAME'];?></td>
            </tr>
        </table>
        </td>
    </tr>
	<?php  
	$str = "select (select STYLE_NAME from TBL_PAY_STYLE_INFO where ID=b.STYLE_ID) as STYLE_NAME,(select SIZE_NAME from TBL_PAY_SIZE_SETTING where ID=b.SIZE_ID 
	and STYLE_ID=b.STYLE_ID) as SIZE_NAME,RATE from TBL_PAY_RATE_SETTING b where
	COMPANY_ID=$company_id and section_id=$section_id";
	
	$stms = oci_parse($conn,$str);
	oci_execute($stms);
	while($r = oci_fetch_array($stms,OCI_BOTH)) {
	    $style_name = $r['STYLE_NAME']; 
		$size_name  = $r['SIZE_NAME'];
		$rate       = $r['RATE'];  
		?>
		
	  <tr>
    	<td>
        <table>
      		<tr>
                 <td>&nbsp;</td>
                 <td><?php echo $style_name;?></td>
                 <td><?php echo $size_name;?></td>
                 <td><?php echo $rate;?></td>		
	  		</tr>	
      	</table>
      	</td>
      </tr>
		
<?php	}
 } ?>
</tbody>
   <!--<tfoot>
         <tr>
            <th colspan="4" style="font-size: 16px;">
                 Title footer
            </th>
        </tr> 
    </tfoot>-->
</table>
<?php
		$content = ob_get_clean();
		// convert to PDF
		//require_once(dirname(__FILE__).'/../html2pdf.class.php');
		include('html2pdf.class.php');
		try
		{
			$html2pdf = new HTML2PDF('P', 'A4', 'fr');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
			$html2pdf->Output('mojid.pdf');
		}
		catch(HTML2PDF_exception $e) {
			echo $e;
			exit;
		}
?>