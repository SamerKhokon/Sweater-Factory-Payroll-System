<?php 
    $filename = "../employee_pic/".basename($_FILES['myfile']['name']) ;
    $type = $_FILES['myfile']['type'];	  
	$id   = $_POST['id'].'.jpg';	
	
	
	/*  
	  $id = "";
	  if($type=="image/jpeg" || $type=="image/jpg") { 
       $id = $_POST['id'].'.jpg';
	   up($id);
	  }else if($type=="image/gif"){
	   $id = $_POST['id'].'.gif';
	   up($id);
	  }else if($type=="image/bmp"){
	   $id = $_POST['id'].'.bmp';
	   up($id);
	  }else if($type=="image/png"){
	   $id = $_POST['id'].'.png';	
	   up($id);
      }	   
	  else{
	     echo 'Upload only image!';
	  } 
	function   up($id) {
	 // rename(basename($_FILES['myfile']['name']),$id);		  
    */
		  if( move_uploaded_file($_FILES['myfile']['tmp_name'] , "../employee_pic/".$id) ){
		       echo 'uploaded successfully!';
			   ?>
			   	<script type="text/javascript">window.close();
				     // location.reload();
				</script>
			   <?php
		  }else{
			   echo 'have an error!';
		  }	
		  //} 	 
?>