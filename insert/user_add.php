<?php
session_start();
if(!isset($_SESSION['usr_id']))
{
	header("Location: ../index.php");
	return;
}
require '../includes/db.php';

$u_name		=$_POST['u_name'];
$u_id		=$_POST['u_id'];
$pass		=$_POST['pass'];
$user_group	=$_POST['user_group'];
$sql="select USER_ID from USER_INFO where USER_ID='".$u_id."'";
$stid1	= oci_parse($conn, $sql);
oci_execute($stid1);
if(($row = oci_fetch_array($stid1, OCI_BOTH))) 
{
	$res = 'already Exist'; 
}
else
{
$sql="insert into USER_INFO(USER_NAME,USER_ID,USER_PASSWORD,USER_GROUP,RES_ID,FLAG,ENTRY_DATE) values('".$u_name."','".$u_id."','".$pass."','".$user_group."','".$_SESSION['usr_id']."','1',sysdate)";
$stid1	= oci_parse($conn, $sql);
oci_execute($stid1);
oci_commit($conn);
$res ='Successfully Add';
}
?>
<script type="text/javascript">
	$(document).ready(function () {
		$('#btn_submit').click(function(){
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
<div id="result" style="text-align:center;"><?php echo $res; ?></div>
<div class="block" id="block">
                    <table class="form">
                        <tr>
                            <td class="col1">
                                <label>
                                    User Name</label>                            </td>
                            <td class="col2">
                                <input type="text" id="u_name" name="u_name" />                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    User Id</label>                            </td>
                            <td>
                                <input type="text" id="u_id" name="u_id"  />                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Password</label>                            </td>
                            <td>
                                <input type="password" id="pass" name="pass"  />                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Retype Password</label>                            </td>
                            <td>
                                <input type="password" id="re_pass" name="re_pass"  />                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    User Type</label>                            </td>
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
                                    <option value="3">User </option>
                                    <?php
                                    }
                                    ?>
                                </select>                            </td>
                        </tr>
                        <tr style="display:none;">
                            <td>
                                <label>
                                    Date Picker</label>                            </td>
                            <td>
                                <input type="text" id="date-picker" />                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="button" value="Submit" id="btn_submit" name="btn_submit" /></td>
                        </tr>
                    </table>
                </div>
                <div>
                All Information goes Here..2........................
                </div>
