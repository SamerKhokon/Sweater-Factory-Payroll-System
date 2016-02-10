<?php   
session_start();
require '../../../includes/db.php';
$company_id	= trim($_SESSION["company_id"]);		
$style_id   = trim($_POST['style_id']);

$str = "select ID,SIZE_NAME,(select ORDER_QTY from TBL_PAY_STYLE_INFO
 where ID=$style_id ) as orquantity,(select BUYER_NAME from 
 TBL_PAY_STYLE_INFO where ID=$style_id ) as buyerName,
 (select UNIT_PRICE from TBL_PAY_STYLE_INFO where ID=$style_id ) 
 as UNIT_PRICE,(select MERCH_NAME from TBL_PAY_STYLE_INFO where ID=$style_id ) 
 as MERCH_NAME,(select GAUGE from TBL_PAY_STYLE_INFO where ID=$style_id ) as GAUGE,
 (select MACHINE_QTY from TBL_PAY_STYLE_INFO where ID=$style_id ) as MACHINE_QTY,
 (select BUYER_ST_NAME from TBL_PAY_STYLE_INFO where ID=$style_id ) as BUYER_ST_NAME,
 (select SHIP_STATUS from TBL_PAY_STYLE_INFO where ID=$style_id ) as SHIP_STATUS,
 (select to_char(SHIPMENT_DATE,'mm/dd/yyyy') from TBL_PAY_STYLE_INFO where ID=$style_id )
 as SHIPMENT_DATE,(select QUENTITY  from TBL_PAY_STYLE_INFO where ID=$style_id ) as 
 quantity,(select STYLE_NAME  from TBL_PAY_STYLE_INFO where ID=$style_id) as style_name
 from tbl_pay_size_setting a where STYLE_ID=$style_id";
$stm = mysqli_query($conn,$str);

$option ="";
while($res = mysqli_fetch_array($stm)) {
	$id    = $res['ID'];
	$orquantity	=$res[2];
	$buyerName=$res[3];
	$unit_price=$res[4];
	$merch_name=$res[5];
	$gauge=$res[6];
	$machine_qty=$res[7];
	$buyer_st_name=$res[8];
	$ship_st=$res[9];
	$shipment_date=$res[10];
	$quantity=$res[11];
	$style_name=$res[12];

	$name  = $res['SIZE_NAME'];
	$option .= $name.',';
}
echo substr($option,0,strlen($option)-1);
echo '!@#$';
echo $orquantity;
echo '!@#$';
echo $buyerName;
echo '!@#$';
echo $unit_price;
echo '!@#$';
echo $merch_name;
echo '!@#$';
echo $gauge;
echo '!@#$';
echo $machine_qty;
echo '!@#$';
echo $buyer_st_name;
echo '!@#$';
echo $ship_st;
echo '!@#$';
echo $shipment_date;
echo '!@#$';
echo $quantity;
echo '!@#$';
echo $style_name;

?>