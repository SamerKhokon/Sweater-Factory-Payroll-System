<!--Jquery UI CSS-->
<link href="css/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css" />

<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
<script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
<!-- END: load jquery -->
<!--jQuery Date Picker-->
<script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.progressbar.min.js" type="text/javascript"></script>
<!-- jQuery dialog related-->
<script src="js/jquery-ui/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.draggable.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.position.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.resizable.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.dialog.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.blind.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.explode.min.js" type="text/javascript"></script>
<!-- jQuery dialog end here-->
<script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
<!--Fancy Button-->
<script src="js/fancy-button/fancy-button.js" type="text/javascript"></script>
<script src="js/setup.js" type="text/javascript"></script>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
		    $('#txt_username').focus();
			setupTinyMCE();
            setupProgressbar('progress-bar');
            setDatePicker('date-picker');
            setupDialogBox('dialog', 'opener');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
			
			$('#txt_username').keyup(function(ex){
			   if(ex.which==13) {
			      var username = $('#txt_username').val();
				  if(username=="") {
				    alert('enter username');
					$('#txt_username').focus();
					return;
				  }else{
					  $('#txt_password').focus();
				  }
			   }
			});
			$('#txt_password').keyup(function(ex){
			   if(ex.which==13) {
			      var password = $('#txt_password').val();
				  if(password=="") {
				    alert('enter password');
					$('#txt_password').focus();
					return;
				  }else{
					  $('#company_id').focus();
				  }
			   }
			});			
			$('#company_id').change(function(){
			   var company = $('#company_id option:selected').val();
			   if(company=="") {
			    alert('select company');
				$('#company_id').focus();
				return;
			   }else{
			    $('#login_button').focus();
			   }
			});						
			
			$('#login_button').click(function(){
			   var username = $('#txt_username').val();
			   var password = $('#txt_password').val();
			   var company_id = $('#company_id').val();
			   
			   if(username=="") {
			      alert('enter username');
			      $('#txt_username').focus();
				  return;
			   }else if(password=="") {
			      alert('enter password');
				  $('#txt_password').focus();
				  return;
			   }else if(company_id=="") {
			      alert('select company');
			      $('#company_id').focus();
				  return;
			   }else{			   
					var dataStr = 'user_name='+username+'&password='+password+'&company_id='+company_id;
					$.ajax({
					   type:'post',
					   url:'includes/login_check.php' ,
					   data:dataStr,
					   cache:false,
					   success:function(st) {
					      //alert(st);						  
						  location.href=st;
					   }
					});
					//alert(dataStr);
			   }
			});
			
        });
    </script>
    <!-- /TinyMCE -->
    <style type="text/css">
        #progress-bar
        {
            width: 400px;
        }
    </style>
        <div class="grid_10">
            <div class="box round first fullpage">
                <h2>User Login</h2>
                <div class="block">
					<?php
                    require 'includes/db.php';
                    isset($_GET['error']) ? $_GET['error'] : $_GET['error']=0;
                    
                    if ($_GET['error']==1)
                    {
                    echo "<div class='message error'>
                            <h5>Error!</h5>
                            <p>
                                Sorry ! you have given wrong information.Please try again.
                            </p>
                        </div>";
                    }
                    ?>
				
                    <!-- <form method="POST" action="includes/login_check.php"> -->
                    <table class="form">
                        <tr>
                            <td><label>User Name</label></td>
                            <td><input type="text" class="error" id="txt_username" name="user_name" />
								 <span class="error">This is a required field.</span>
                            </td>
                        </tr>
						
						<tr>
                            <td><label>Password</label></td>
                            <td><input type="password" id="txt_password" class="error" name="password" />
								<span class="error">This is a required field.</span>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Select Company</label></td>
                            <td><select name="company_id" id="company_id" style="width:150px;">
                               		<option value="">NONE</option>
									<?php
                                    $sql	="select ID,company_NAME from tbl_company_info order by ID";
                                    $stid	= mysqli_query($conn,$sql);
                                    
                                    while(($row = mysqli_fetch_array($stid))) 
                                    {
                                        echo '<option value='.$row[0].'>'.$row[1].'</option>';
                                    }
                                    ?>
                                </select><span class="success">Select Company Name from list.</span>
                            </td>
                        </tr>						
						  <tr>
                            <td><label></label></td>
                            <td><input type="button" class="btn" id="login_button" name="submit" value="Sign In"/></td>
                        </tr>
                        <tr>
						<td></td>
						<td>
						<br/>
						<br/>
						
						 I can't access my account    |  Help  
						 </td>
						 </tr>
                    </table>
                    <!-- </form> -->
				
                </div>
				
            </div>
				<br/><br/><br/><br/><br/><br/>
        </div>
	
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
	
    