<?php
echo '<table>';
$sql	="select id,res_id,sms_count from sms_in";
$stmt	=oci_parse($comm,$sql);
oci_execute($stmt)
while($row=oci_fatch_array($stmt,OCI_BOTH+OCI_RETURN_NULLS))
{
	echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td></tr>';
}
echo '</table>';
?>
<script type="text/javascript">
	$(document).ready(function () {
	
		$('#btn_submit').click(function(){
		var total_sms	=$('#total_sms').val();
		var pay_m		=$('#pay_m').val();
		var c_num		=$('#c_num').val();
		var amount		=$('#amount').val();
		var datak		='total_sms='+total_sms+'&pay_m='+pay_m+'&c_num='+c_num+'&amount='+amount;
		
					$.ajax({
					type:"post",
					url:"insert/sms_req.php",
					data:datak,
					success:function(str)
					{
						$('#result').html(str);
						$('#total_sms').val('');
						$('#amount').val('');
						$('#c_num').val('');
						
						setInterval(function(){myTimer()},2000);
					}
			});
		
		});
		
	});
	
function myTimer()
{
	document.getElementById("result").innerHTML='&nbsp;';
}
var pkey=0;

function ret_valid_digit(evt, type, cnt)
{
	pkey= (evt.which) ? evt.which : event.keyCode;

	if(pkey==8 || pkey==127)
		return true;

	if(type=='int')
	{
		if(pkey>=48 && pkey <=57)
			return true;
	}
	else if(type=='double')
	{
		if(pkey>=48 && pkey <=57)
			return true;
	
		if(pkey==46 && cnt==-1)
			return true;
	}

	return false;
}
</script>
  
<div class="grid_10">
    <div class="box round first fullpage">
        <h2>Request SMS Panel</h2>
        <div id="result" style="text-align:center;">&nbsp;</div>
        <div class="block" id="block">
            <table class="form">
                <tr>
                    <td class="col1"><label>Total SMS</label></td>
                    <td class="col2"><input type="text" id="total_sms" name="total_sms"  onkeypress="return ret_valid_digit(event,'int',this.value.indexOf('.'));" /></td>
                </tr>
                <tr>
                	<td colspan="2"><label>Payment Info :</label></td>
                </tr>
                 <tr>
                	<td><label>Payment Method</label></td>
                    <td><select name="pay_m" id="pay_m">
                        <option value="1">VISA</option>
                        <option value="2">MASTER</option>
                        <option value="3">bKash</option>
                        <option value="4">mPay</option>
                    </select>
                    </td>
                </tr>
                <tr>
                	<td><label>Card Number</label></td>
                    <td><input type="text" name="c_num" id="c_num" /></td>
                </tr>
                <tr>
                	<td><label>Amount</label></td>
                    <td><input type="text" name="amount" id="amount" onkeypress="return ret_valid_digit(event,'double',this.value.indexOf('.'));"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="button" value="Submit" id="btn_submit" name="btn_submit" /></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
    