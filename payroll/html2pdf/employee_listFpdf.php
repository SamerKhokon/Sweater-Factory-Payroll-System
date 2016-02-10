<?php
ob_start();
include_once("../includes/opSessionCheck.inc");
include_once("../includes/function.php");
include("../includes/db.php");

$company_id =$_SESSION['company_id'];
$section_id	=trim($_GET['section_id']);
$block_id	=trim($_GET['block_id']);
$status_id	=trim($_GET['status_id']);

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
$str	='ID WISE EMPLOYEE LIST';
?>
<table width="100%" style="width:100%;">
<tr><td style="width:120px;">&nbsp;</td><td><?php echo tbl_header_wdate($str); ?></td><td align="left"></td>
</tr>
</table>
<br/>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="details">
    <thead>	
        <tr>
            <th>SL. No</th>
            <th>ID NO</th>
            <th>NAME</th>
            <th>JOIN DATE</th>
            <th>DESIGNATION</th>
            <th>SECTION</th>
            <th>LINE</th>
            <th>GRADE</th>
            <th>BASIC</th>
            <th>H.RENT</th>
            <th>MEDICAL</th>
            <th>GROSS</th>
        </tr>
    </thead>
	<tbody>
<?php
	$i			=0;
	$pdN		="";
	$pdN2		="";
	$xsql		="";
	$block_str	="";
	$status_str	="";

	if($section_id!='*')
		$xsql	=" and a.SECTION_ID='$section_id'";
	if($block_id!='')
		$block_str=" and a.BLOCK_ID=$block_id";
	if($status_id==1)
		$status_str=" and a.STATUS=$status_id";
	if($status_id==2)
		$status_str=" and a.STATUS!=1";
	
		
	$sql ="select (select SEC_NAME from TBL_PAY_SECTION_INFO where COMPANY_ID=$company_id and ID=a.SECTION_ID) as SEC_NAME,CARD_ID,NAME,to_char(JOIN_DATE,'dd.mm.yyyy') as jdate,a.DESIGNATION,a.SECTION_ID,(select BLOCK_NAME from TBL_PAY_SECTION_BLOCK where COMPANY_ID=$company_id and ID=a.BLOCK_ID) as BLOCK_ID,a.GRADE,a.BASIC,a.HOUSE_RENT,a.MEDICAL,a.GROSS,cast(substr(a.CARD_ID,2,9) as number) as pp from TBL_PAY_EMP_PROFILE a,TBL_PAY_SECTION_INFO b where a.SECTION_ID=b.ID and a.COMPANY_ID=$company_id and b.SEC_TYPE_ID=51  ".$xsql." ".$block_str." ".$status_str." order by pp,SECTION_ID,BLOCK_ID";		
	$qstr  = oci_parse($conn,$sql);
	oci_execute($qstr);
	while($res = oci_fetch_array($qstr,OCI_BOTH+OCI_RETURN_NULLS))
	{
		    $i++;
			/*if($pdN != $res['SEC_NAME'])
			{
				 $pdN = $res['SEC_NAME']; 
				 $sec_name= $res['SEC_NAME'];
			}
			else 
				$sec_name='';
			*/	
			$sec_name	=$res['SEC_NAME'];
			$card_id	=$res['CARD_ID'];
			$name		=$res['NAME'];
			$join_date	=$res[3];
			$desig		=$res['DESIGNATION'];
			$line		=$res['BLOCK_ID'];
			$grade		=$res['GRADE'];
			$basic		=$res['BASIC'];
			$h_rent		=$res['HOUSE_RENT'];
			$medical	=$res['MEDICAL'];
			$gross		=$res['GROSS'];	
		 
	echo	"<tr>
				<td>$i</td>
				<td>$card_id</td>
				<td>$name</td>
				<td>$join_date</td>
				<td>$desig</td>
				<td>$sec_name</td>
				<td>$line</td>
				<td>$grade</td>
				<td>$basic</td>
				<td>$h_rent</td>
				<td>$medical</td>
				<td>$gross</td>
		 </tr>";	
  } 
         echo "<tr>
		   	<td colspan='12'><br><br><br><br><br><br>
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
  echo '</tbody>';
  ?><tfoot>
        <tr>
            <th colspan="12" style="font-size: 16px;">
                 Page Number:&nbsp;[[page_cu]]/[[page_nb]]
            </th>
        </tr>
    </tfoot>
    <?php
	
  echo '</table>';
//echo tbl_footer_A4();

oci_free_statement($qstr);
oci_close($conn);

$content = ob_get_clean();
include('html2pdf.class.php');
try
{
	$html2pdf = new HTML2PDF('P', 'Legal', 'fr',array(5, 10, 0,0));
	$html2pdf->pdf->SetDisplayMode('fullpage');
	$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
	$html2pdf->Output('lusine.pdf');
}
catch(HTML2PDF_exception $e) {
	echo $e;
	exit;
}
?>