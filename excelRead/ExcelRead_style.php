<?php
require_once 'Excel/reader.php';
$data = new Spreadsheet_Excel_Reader();
$data->read('StyleInfo.xls');
error_reporting(E_ALL ^ E_NOTICE);

$tns = "192.168.10.18/orcl"; 		  
$conn = oci_connect('lusine_pay', 'lusine_pay', $tns);
if (!$conn) {
$e = oci_error();
trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$num_sheet	=$data->sheets; //tab count

$num_cols = $data->sheets[1]['numCols']."<br/>";
//echo $num_rows = $data->sheets[1]['numRows']."<br/>";


for($i=0;$i<count($num_sheet);$i++)
{
	$num_rows = $data->sheets[$i]['numRows'];
	
	for ($j = 2; $j <= $num_rows; $j++) {
	
		$member_id = strtoupper($data->sheets[$i]['cells'][$j][1]);
		$Member_name = $data->sheets[$i]['cells'][$j][2];
		$SpouseN = $data->sheets[$i]['cells'][$j][3];
		
	echo $sql = "insert into TBL_PAY_STYLE_INFO(STYLE_NAME,QUENTITY,ORDER_DATE,COMPANY_ID) values ('".$member_id."','".$SpouseN."',to_date('".$Member_name."','dd/mm/YYYY'),'1')";
	echo $j.'<br>';
 //$res = mysql_query($sql);
 	$stid	= oci_parse($conn, $sql);
    oci_execute($stid);	
	}
}	


?>
