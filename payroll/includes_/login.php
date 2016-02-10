
 
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
            setupTinyMCE();
            setupProgressbar('progress-bar');
            setDatePicker('date-picker');
            setupDialogBox('dialog', 'opener');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
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
                <h2>
                   User Login</h2>
                <div class="block ">
				
				       <?php
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
				
                    <form method="POST" action="includes/login_check.php">
                    <table class="form">
                 
                        <tr>
                            <td>
                                <label>
                                    User Name</label>
                            </td>
                            <td>
                                <input type="text" class="error" />
								 <span class="error">This is a required field.</span>
                            </td>
                        </tr>
						
						      <tr>
                            <td>
                                <label>
                                    Password</label>
                            </td>
                            <td>
                                <input type="password" class="error" />
								<span class="error">This is a required field.</span>
                            </td>
                        </tr>
                             <tr>
                            <td>
                                <label>
                                    Select Company</label>
                            </td>
                            <td>
                                <select id="select" name="select">
								    <option value=""></option>
								
                                    <option value="1">Company Name 1  </option>
                                    <option value="2">Company Name 2  </option>
                                    <option value="3">Company Name 3  </option>
                                </select>
								 <span class="success">Select Company Name from list.</span>
                            </td>
                        </tr>
						
						  <tr>
                            <td>
                                <label>
                                    </label>
                            </td>
                            <td>
                                <input type="submit" class="btn" name="submit" value="Sign In"/>
                            </td>
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
                    </form>
				
                </div>
				
            </div>
				<br/><br/><br/><br/><br/><br/>
        </div>
	
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
	
    