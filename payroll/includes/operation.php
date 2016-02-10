<script type="text/javascript">
	$(document).ready(function () {
	
		$('.btn_acc').click(function(){
		var idata = $(this).attr('id');
		idata=idata.split("_");
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
						
						//
						
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
  
<div class="grid_10">

    <div class="box round first fullpage">
        <h2>
            SMS Distribution Panel</h2>
        <div id="user_all">
        <div id="result" style="text-align:center;"></div>
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
                    <td><input type="button" name="btn_acc" class="btn_acc" id="A_<?php echo $id; ?>" value="Accept" /><input type="button" name="btn_acc" class="btn_acc" id="C_<?php echo $id; ?>" value="Cancel" /></td>
                </tr>
                <?php
				}
				?>
            </table>
        </div>
     </div>
    </div>
    
    
</div>
<div class="clear">
</div>

</div>
<div class="clear">
</div>
    