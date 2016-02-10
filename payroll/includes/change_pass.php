<?php  
ob_start();  
include('db.php');
$old_pass='';
$sql="select USER_PASSWORD from USERS where U_ID=".$_SESSION['usr_id']."";
$stm = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($stm) ) {
   $old_pass = $row['USER_PASSWORD'];
} 
?>
<script type="text/javascript">
$(document).ready(function(){
	$('#msg').hide();
	$("#old_pass").keydown(function(event){
		if(event.keyCode == 13 ){
			if($('#old_pass').val() == "")
			{
				alert( "Please Enter Old Password.");
				$('#old_pass').focus();
				return false ;
			}
			else if($('#old_pass').val() != $('#old_passh').val())
			{
				
				//alert( "Old Password Not Match.");
				$('#old_pass').focus();
				$('#old_passem').show();
				$('#old_passm').hide();
				return false ;
			}
			else
			{
				$('#new_pass').focus();
				$('#old_passm').show();
				$('#old_passem').hide();
			}
		}
	});
	$("#new_pass").keydown(function(event){

		if(event.keyCode == 13 ){
		
		if($('#old_pass').val() != $('#old_passh').val())
			{
				alert( "Please Enter Old Password.");
				$('#old_pass').focus();
				return false ;
			}
		else if($('#new_pass').val() == "")
			{
				alert( "Please Enter New Password.");
				$('#new_pass').focus();
				return false ;
			}
		else
			{
				$('#r_new_pass').focus();
			}
		}
	});
	
	$("#r_new_pass").keydown(function(event){
		if(event.keyCode == 13 ){
		
			if($('#new_pass').val() == "")
			{
				alert( "Please Enter New Password.");
				$('#new_pass').focus();
				return false ;	
			}
			else if($('#new_pass').val() != $('#r_new_pass').val())
			{
				{
					alert( "New and Confirm Password not Match.");
					$('#r_new_pass').focus();
					return false;
				}
			}
			else
			{
		
				var npass=$('#new_pass').val();
				var datastr	='npass='+npass;
				$.ajax({
					type	:'post',
					url		:'includes/pass_change.php',
					data	:datastr,
					cache	:false,
					success	:function(str){
					$('#msg').html(str);
					$('#msg').show();
					$('#old_passh').val(npass);
					freset();
					}
				});
			}
		}
	});
	
	$('#btn_submit').click(function(){
		if($('#old_pass').val() == "")
		{
			alert( "Please Enter Old Password.");
			$('#old_pass').focus();	
		}
		else if($('#old_pass').val() != $('#old_passh').val())
		{
			alert("Old Password Not Match.");
			$('#old_pass').focus();
		}
		else if($('#new_pass').val() == "")
		{
			alert( "Please Enter New Password.");
			$('#new_pass').focus();
		}
		else if($('#new_pass').val() != $('#r_new_pass').val())
		{
			alert( "New and Confirm Password not Match.");
			$('#r_new_pass').focus();
		}
		else
		{
			var npass=$('#new_pass').val();
			var datastr	='npass='+npass;
			$.ajax({
				type	:'post',
				url		:'includes/pass_change.php',
				data	:datastr,
				cache	:false,
				success	:function(str){
				$('#msg').html(str);
				$('#msg').show();
				$('#old_passh').val(npass);
				freset();
				}
			});
		}
		
	});
	function freset()
	{
		$('#old_pass').val('');
		$('#new_pass').val('');
		$('#r_new_pass').val('');
		$('#old_pass').focus();
		$('#old_passm').hide();
		$('#old_passem').hide();
	}
	  
});
</script>     
<div class="grid_10">
    <div class="box round first fullpage">
        <h2>Password Change</h2>
        <div class="block" id="block">
        	<div class='message info' id="msg"></div>
            <table class="form">
                <tr>
                    <td width="136"><label>Old Password</label></td>
                  <td width="144"><input type="text" id="old_pass" class="error"/></td>
                    <td width="17"><input type="hidden" id="old_passh" class="error" value="<?=$old_pass; ?>"/></td>
                  <td width="427"><span class="error" id="old_passem" style="display:none;">Password Mis Match.</span><span class="success" id="old_passm" style="display:none;">Password Match Successfully.</span></td>
              </tr>
                
                <tr>
                    <td><label>New Password</label></td>
                    <td><input type="text" id="new_pass" class="success"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><label>Retyle New Password</label></td>
                    <td><input type="text" id="r_new_pass" class="error"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                
                <tr>
                    <td colspan="2" align="right"><input type="button" name="btn_submit" id="btn_submit" value=" &nbsp;&nbsp;Send&nbsp;&nbsp;" class="btn btn-navy" /></td>
                  <td colspan="2">&nbsp;</td>
                </tr>
            </table>    
      </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>    