<?php
session_start();
//include_once("payroll/opSessionCheck2.inc");	
isset($_SESSION["valid"]) ? $_SESSION["valid"] : $_SESSION["valid"]=false;
require 'includes/db.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ERP | Simple Solution</title>
  
    <link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
     <script>
	$(document).ready(function(){
		$('#txt_username').focus();
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
			   var username =$('#txt_username').val();
			   var password =$('#txt_password').val();
			   var company_id =$('#company_id').val();
			   
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
    
    </head>

    <body>
<div id="login">

		<?php 
        	if ($_SESSION["valid"]=="true") {
        ?>
      <div id="log-Sup1">
    <div id="logWrap">
          <h1><img src="css/images/slogo.png" /><br /><br />
        <span><?php
				if(!isset($_SESSION['usr_id']))
				{
					echo '<a href="?pagetitle=login">Login </a>';
				}
				else
				{
					echo ''.$_SESSION['user_name'].'&nbsp;&nbsp;<a href="includes/log_out.php" style=color:#fff;>Logout</a>';
				}
				?></span></h1>
        <div id="LogPannel1">
        	<br />
        	<?php
				 // where ID in(".$module_ids.")
				$module_ids=$_SESSION['module_id'];
				$href	='';
				$sql="select * from TBL_MODULE where ID in(".$module_ids.") ";
				$stid	= mysql_query($sql);
    			
				while($row = mysql_fetch_array($stid)) 
				{
					 $href=$row[3];
				 ?>
       		<span id="LogPannel2">
                <h3 align="center"><a href="<?php echo $href;  ?>"><?php echo $row[2];?></a></h3>
              </span>
                <?php
				}
				$sql="select * from TBL_MODULE where ID not in(".$module_ids.") ";
				$stid	= mysql_query( $sql);
    			
				while($row = mysql_fetch_array($stid)) 
				{
					 $href='';
				 ?>
              <span id="LogPannel3">  
                <h3 align="center"><a href="<?php echo $href;  ?>"><?php echo $row[2];?></a></h3>
                </span>
                <?php
				}
				?>
                 <!--<h2 align="center"><a href="#"  class="button blue skew" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h2>-->
               
                 
                
                
        
        
      </div>
         </div>
  </div>
      
      <?php
	  }
	  else
	  {
	  ?>
        <div id="log-Sup">
    <div id="logWrap">
          <h1><img src="css/images/slogo.png" /><br /><br />
        <span style="font-size:18px;">Member Login</span></h1>
        
          <div id="LogPannel">
         
   
        <form method="" action="#">
         
              <input name="user_name" id="txt_username" type="text"  value="Username" onfocus="if(this.value=='Username')this.value=''" onblur="if(this.value=='')this.value='Username'" />
              <input name="password" id="txt_password" type="password"  value="password" onfocus="if(this.value=='password')this.value=''" onblur="if(this.value=='')this.value='password'" />
           <br />
           <br />
            
              &nbsp;&nbsp;&nbsp;<select class="sel"  name="company_id" id="company_id" style="width:150px;">
                               		<option value="">NONE</option>
									<?php
                                    $sql	="select ID,company_NAME from tbl_company_info order by ID";
                                    $stid	= mysql_query($sql);
                                    
                                    while($row = mysql_fetch_array($stid)) 
                                    {
                                        echo '<option value='.$row[0].'>'.$row[1].'</option>';
                                    }
                                    ?>
                                </select>
                              <br />
                           <span style="margin:10px 0px 0px 0px; display:block; ">
                                
                                <input type="button" class="btn" id="login_button" name="submit" value="Sign In"/>
                           </span>
                                 
                               
             <!--<input name="submit" type="button" value="LOGIN" />-->
            
              <label style="text-align:left;padding:0px 0px 0px -40px; width:100%">
           <input type="checkbox" id="remember_me"  name="remember_me"/>&nbsp;Remember Me
          </label>
              <p></p>
              <p style=" margin:-15px 0px 0px 0px;"><a class="sign">Forgot Password</a>?</p>
            </form>
        <div class="message">
              <p>Just click <strong>login</strong> to go forward.</p>
            </div>
      </div>
      
        </div>
  </div>
  <?php
	  }
	  ?>
      <div class="push"><img src="css/images/6.png" /></div>
    </div>

</body>
</html>
