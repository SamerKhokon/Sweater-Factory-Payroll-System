<?php
session_start();
require '../includes/db.php';
$req_id	=$_POST['req_id'];
$opf	=$_POST['opf'];
if($opf=='A')
{

	$sql="select REQ_FROM,AMOUNT from SMS_REQ where SR_ID='".$req_id."'";
	$stid1	= oci_parse($conn, $sql);
	oci_execute($stid1);
	if(($row = oci_fetch_array($stid1, OCI_BOTH))) 
	{
		$req_frm=$row['REQ_FROM'];
		$amount=$row['AMOUNT'];
	}
	
	$R_stock=0;
	$sql="select AMOUNT from SMS_STOCK where U_ID='".$_SESSION['usr_id']."'";
	$stid1	= oci_parse($conn, $sql);
	oci_execute($stid1);
	if(($row = oci_fetch_array($stid1, OCI_BOTH))) 
	{
		$R_stock=$row['AMOUNT'];
	}
	
	
	if($amount<$R_stock)
	{
	
		$newRsms = ($R_stock - $amount);
	
		// insert buyer sms ++
		$sql="insert into SMS_IN(U_ID,AMOUNT,ENTRY_DATE) values('".$req_frm."','".$amount."',sysdate)";
		$stid1	= oci_parse($conn, $sql);
		oci_execute($stid1);
		oci_commit($conn);
		
		$stock = 0;
		
		$sql="select AMOUNT from SMS_STOCK where U_ID='".$req_frm."'";
		$stid1	= oci_parse($conn, $sql);
		oci_execute($stid1);
		if(($row = oci_fetch_array($stid1, OCI_BOTH))) 
		{
			$stock=$row['AMOUNT'];
		}
		
		//insert buyer sms stock sms
		$new_stock = ($stock + $amount);
		
		$sql="select U_ID from SMS_STOCK where U_ID='".$req_frm."'";
		$stid1	= oci_parse($conn, $sql);
		oci_execute($stid1);
		if(($row = oci_fetch_array($stid1, OCI_BOTH))) 
		{
			$req_frm=$row[0];
			$sql="update SMS_STOCK set AMOUNT='".$new_stock."' where U_ID='".$req_frm."'";
			$stid1	= oci_parse($conn, $sql);
			oci_execute($stid1);
			oci_commit($conn);
		}
		else
		{
			$sql="insert into SMS_STOCK (U_ID,AMOUNT,ENTRY_DATE) values('".$req_frm."','".$new_stock."',sysdate)";
		
			$stid1	= oci_parse($conn, $sql);
			oci_execute($stid1);
			oci_commit($conn);
		}
		//update sms request table
		$sql="update SMS_REQ set FLAG='A' where SR_ID='".$req_id."'";
		$stid1	= oci_parse($conn, $sql);
		oci_execute($stid1);
		oci_commit($conn);
		
		//update reseller stock sms
		$sql="update SMS_STOCK set AMOUNT='".$newRsms."' where U_ID='".$_SESSION['usr_id']."'";  
		$stid1	= oci_parse($conn, $sql);
		oci_execute($stid1);
		oci_commit($conn);
			
		//sms out
		$sql="insert into SMS_OUT(U_ID,AMOUNT,ENTRY_DATE) values('".$_SESSION['usr_id']."','".$amount."',sysdate)";
		$stid1	= oci_parse($conn, $sql);
		oci_execute($stid1);
		oci_commit($conn);
		
		$msg='Your Operation Successfull';
	}
	else
	{
		$msg='Please Check Your Balance';
	}

}
if($opf=='C')
{
	$sql="update SMS_REQ set FLAG='C' where SR_ID='".$req_id."'";
	$stid1	= oci_parse($conn, $sql);
	oci_execute($stid1);
	oci_commit($conn);
		
	$msg='Cancel Successfull';
}
?>
<script type="text/javascript">
	$(document).ready(function () {
	
		$('.btn_accA').click(function(){
		var idata = $(this).attr('id');
		idata		=idata.split("_");
		var datak		='req_id='+idata[1]+'&opf='+idata[0];
		
					$.ajax({
					type:"post",
					url:"insert/sms_op.php",
					data:datak,
					success:function(str)
					{
						$('#user_all').html(str);
						setTimeout( function() {
						jQuery('#result').hide();
						}, 2000 );
						
						
						$.ajax({
						type:"post",
						url:"insert/info.php",
						data:datak,
						success:function(str2)
						{
						$('#user_info').html(str2);
						}
						}); //for user sms info
						
						
					}
			});
		
		});
		
	});
</script>

<div id="result" style="text-align:center;"><?php echo $msg; ?></div>
<div class="block" id="block" align="center">
    <table width="60%" cellpadding="0" cellspacing="0" align="center">
        <tr style="background-color:#e6f0f3; color:#1b548d;">
            <td width="29%">User Name</td>
            <td width="26%">Amount(SMS)</td>
            <td width="14%">Req Date</td>
            <td width="31%">Action</td>
      </tr>
        <?php
       $sql = "select SMS_REQ.SR_ID,SMS_REQ.REQ_TO,SMS_REQ.REQ_FROM,SMS_REQ.AMOUNT,to_date(SMS_REQ.ENTRY_DATE,'dd-mm-YY'),USER_INFO.USER_ID from SMS_REQ,USER_INFO where SMS_REQ.REQ_FROM=USER_INFO.U_ID and  SMS_REQ.REQ_TO='".$_SESSION['usr_id']."' and SMS_REQ.FLAG='R'";
        $stid1	= oci_parse($conn, $sql);
        oci_execute($stid1);
        while(($row = oci_fetch_array($stid1, OCI_BOTH))) 
        {
        $id = $row[0]; 
		?>
		<tr>
			<td><?php echo $row[5]; ?></td>
			<td><?php echo $row[3]; ?></td>
			<td><?php echo $row[4]; ?></td>
			<td><input type="button" name="btn_accA" class="btn_accA" id="A_<?php echo $id; ?>" value="Accept" /><input type="button" name="btn_accA" class="btn_accA" id="C_<?php echo $id; ?>" value="Cancel" /></td>
		</tr>
        <?php
        }
        ?>
    </table>
</div>
</div>
