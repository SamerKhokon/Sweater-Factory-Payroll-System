<?php
require_once 'Excel/reader.php';
$data = new Spreadsheet_Excel_Reader();
$data->read('SizeInfo.xls');
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
		$Member_name = strtoupper($data->sheets[$i]['cells'][$j][2]);
		$SpouseN = strtoupper($data->sheets[$i]['cells'][$j][3]);
		$rt = $data->sheets[$i]['cells'][$j][4];
		$dt = $data->sheets[$i]['cells'][$j][5];
		
	echo $sql = "insert into TBL_PAY_SIZE_SETTING_N(SIZE_NAME,SECTION_NAME,RATE,COMPANY_ID,QT,STYLE_NAME) values ('".$SpouseN."','".$member_id."','".$rt."','1','".$dt."','".$Member_name."')";
	echo $j.'<br>';
 //$res = mysql_query($sql);
 	$stid	= oci_parse($conn, $sql);
    oci_execute($stid);	
	}
}	


?>
