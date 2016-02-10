<?php
session_start();

/*
	require 'includes/db.php';
	
	$user_name=$_POST["user_name"];
	
	$password=$_POST["password"];
	$user_type=$_POST["user_type"];  
    $sql="select * from  user_info where login_id='$user_name' and login_pass='$password'";
  
   
   
	
   $result=mysql_query($sql);
			  
	 
	    $row=mysql_fetch_array($result);
		
	    $usr_uid=$row["login_id"];
		
		 $usr_pass=$row["login_pass"];
		 

		if($usr_uid==$user_name and $password==$usr_pass and $usr_uid!="" and $password!="")
	   {
	   */
	   $usr_uid="suman";
	   if($usr_uid=="suman")
	   
	   
	   {
	   
	   
	   
	   
	   
	   
	   
	    $_SESSION["valid"]="true";	
		
		$user_type=$row["user_type"];		
		//$pos_id=$row["pos_id"];
		//$member_id=$row["member_id"];
		//$founder_id=$row["founder_id"];
		$user_id=$row["login_id"];
		
		
		
		
		$_SESSION["user_type"]=$user_type;	
		$_SESSION["user_name"]=$user_name;	
		$_SESSION["user_id"]=$user_id;		
		$_SESSION["pos_id"]=$pos_id;		
		//$_SESSION["member_id"]=$member_id;	 
	        //$_SESSION["founder_id"]=$founder_id;	

/*
	                   $chk_stat="select member_status from user_info where login_id='$user_id'";
						$res_chk_stat=mysql_query($chk_stat);
						$row_chk_stat=mysql_fetch_array($res_chk_stat);						
						$member_status=$row_chk_stat['member_status'];
						$_SESSION["member_status"]=$member_status;







			
		$_SESSION["sid"]=date("YmdHiss",time());		
	    
		
		$login_time=date("Y-m-d H:i:s",time());		
		$_SESSION["login_time"]=$login_time;		
		$login_ip=$_SERVER['REMOTE_ADDR'];
		
	*/
	    header("Location:../");
	   
	 
	 
	}
	  
	  else
	  {
	 
	    header("Location:../?error=1");    
	 }
	 
	
	mysql_close($mysql_connection);
	
		 
?>

