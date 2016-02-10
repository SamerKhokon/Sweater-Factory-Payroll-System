<script type="text/javascript">
$(document).ready(function () {

	$('#btn_submit4').click(function(){
	var u_name		= $('#u_name').val();
	var u_id		= $('#u_id').val();
	var pass		= $('#pass').val();
	var re_pass 	= $('#re_pass').val();
	var user_group	= $('#user_group').val();
	var valid2		=false;

	
	if(u_id=='')
	{
		valid2 = false;
		alert('Please Enter User Id');
	}
	
	else if(pass=='')
		{
			valid2 = false;
			alert('Please Enter Pass');
		}
	else if(pass!='')
		{
			if(re_pass=='')
			{
				valid2 = false;
				alert('Please Enter Re Pass');
			}
			else if(pass!=re_pass)
				{
					valid2 = false;
					alert('New and Re pass Mis Match');
				}
			else
			{
				valid2 = true;
				var datak ='u_name='+u_name+'&u_id='+u_id+'&pass='+pass+'&re_pass='+re_pass+'&user_group='+user_group;
				$.ajax({
				type:"post",
				url:"insert/user_add.php",
				data:datak,
				success:function(str)
				{
					setTimeout( function() {
					jQuery('#result').hide();
					}, 5000 );
					$('#user_all').html(str);
					
				}
				});
		
			}
		}
	
	});
	
});
</script>
  
<div class="grid_10">

    <div class="box round first fullpage">
        <h2>
            User Create Panel</h2>
        <div id="user_all">
        <div class="block" id="block">
            <table class="form">
                <tr>
                    <td class="col1"><label>User Name</label></td>
                    <td class="col2"><input type="text" id="u_name" name="u_name" /></td>
                </tr>
                <tr>
                    <td><label>User Id</label></td>
                    <td><input type="text" id="u_id" name="u_id"  /></td>
                </tr>
                <tr>
                    <td><label>Password</label></td>
                    <td><input type="password" id="pass" name="pass"  /></td>
                </tr>
                <tr>
                    <td><label>Retype Password</label></td>
                    <td><input type="password" id="re_pass" name="re_pass"  /></td>
                </tr>
                <tr>
                    <td><label>User Type</label></td>
                    <td>
                        <select id="user_group" name="user_group">
							<?php
                            if($_SESSION['user_group']!=1)
							echo '<option value="3">User </option>';
							else
							{
                            ?>
                            <option value="1">Admin</option>
                            <option value="2">Reseller</option>
                            <option value="3">User</option>
                            <?php
							}
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="button" value="Submit" id="btn_submit4" name="btn_submit4" /></td>
                </tr>
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
    