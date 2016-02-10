<?php   session_start();
		require '../../includes/db.php';
		
	$ID = $_POST['id'];  		
    $sql	= "SELECT * FROM TBL_PAY_PRODUCTIONBONUS_SET WHERE ID=$ID";
	$stm	= mysqli_query( $conn,$sql);
			
    while($res = mysqli_fetch_array($stm)) 
	{
		$slno         = $res['ID'];			   
		$company_id   = $res['COMPANY_ID'];
		$amount_from  = $res['PRODUC_AMNT_FROM'];
		$amount_to    = $res['PRODUC_AMNT_TO'];			   
		$bonus_amount = $res['BONUS_AMNT'];
		$section_id   = $res['SECTION_ID'];  
        $entry_date   = $res['ENTRY_DATE'];		
	}
    echo $slno.'|'.$company_id.'|'.$amount_from.'|'.$amount_to.'|'.$bonus_amount.'|'.$section_id.'|'.$entry_date;	
?>