<?php
require_once 'Excel/reader.php';
$data = new Spreadsheet_Excel_Reader();
$data->read('FxdEmpInfo.xls');
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
		$chan_mID = $data->sheets[$i]['cells'][$j][3];
		$MotherN = $data->sheets[$i]['cells'][$j][4];
		$FatherN = $data->sheets[$i]['cells'][$j][5];
		$SpouseN = $data->sheets[$i]['cells'][$j][6];
		$DofBirth = $data->sheets[$i]['cells'][$j][7];
		$Age = $data->sheets[$i]['cells'][$j][8];
		//$birthCer = $data->sheets[$i]['cells'][$j][9];
		$MotherNs	=explode('.',$MotherN);
	
		
	echo $sql = "insert into TEMP_EMP_F(section,cardno,name,gross,basic,joindate,grade,designation) values ('".$member_id."','".$Member_name."','".$chan_mID."','".$MotherNs[0]."','".$FatherN."',to_date('".$SpouseN."','dd/mm/YYYY'),'".$DofBirth."','".$Age."')";
	echo $j.'<br>';
 //$res = mysql_query($sql);
 	//$stid	= oci_parse($conn, $sql);
    //oci_execute($stid);	
	}
}	


?>
