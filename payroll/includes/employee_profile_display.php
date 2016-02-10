<?php
session_start();
include('db.php');
?>
<script type="text/javascript">
  function upload_window (xid) {
     window.open('includes/upload_picture.php?id='+xid,'','width=400,height=120');
  }
  $(document).ready(function(){
    //$('#employee_image_table').load('',function(){});
  });
</script>
<div class="grid_10" id="grid_10">
    <div class="box round first fullpage">
        <h2>Employee Profile</h2>
        <div class="block" id="block">
		
		<?php $eid = trim($_GET['slno']);
			$str = "select * from TBL_PAY_EMP_PROFILE WHERE ID=$eid";
			$stm = mysqli_query($conn,$str);
		 
			while($res = mysqli_fetch_array($stm)) {
				$slno         = $res['ID'];
				$empid        = $res['EMP_ID'];
				$name         = $res['NAME'];
				$company_id   = $res['COMPANY_ID'];
				$section_id   = $res['SECTION_ID'];
				$card_id      = $res['CARD_ID'];
				$address      = $res['PRESENT_ADDRESS'];
				$per_address  = $res['PARMANENT_ADDRESS'];
				$phone        = $res['MOBILE_NO1'];
				$father_name  = $res['FATHER_NAME'];
				$mother_name  = $res['MOTHER_NAME'];
				$section      = $res['SECTION_ID'];
				$join_date    = $res['JOIN_DATE'];
				$national_id  = $res['NATIONAL_ID'];
				$designation  = $res['DESIGNATION'];
				$basic        = $res['BASIC'];
				$gross        = $res['GROSS'];
				$house_rent   = $res['HOUSE_RENT'];
				$medical      = $res['MEDICAL'];
				$status       = $res['STATUS'];
				$DATEOFBIRTH  = $res['DATEOFBIRTH'];					
			}	
              if( $status==1 )      $status = "<b style='color:green;'>Available</b>";
              else if( $status==2 ) $status = "<b style='color:red;'>Fired</b>";			  
			  else if( $status==3 ) $status = "<b style='color:red;'>Resigned</b>";
			  
			  
			  if($DATEOFBIRTH!='')
				{	  
					/*$parse_date = explode("-",$DATEOFBIRTH); 
					$d = $parse_date[0];
					$m = $parse_date[1];
					$y = $parse_date[2];
					$new_date1 = month_pos($m).'/'.$d.'/'.$y;
					*/
					$new_date2 = date('m/d/Y', strtotime($DATEOFBIRTH));
				}
				
			 ?>  
			<table width="100%" id="employee_image_table">
					<tr>
                       <?php  
						$loc 	=  "./employee_pic/".$slno.".jpg";
						$l 		= "";
						if(file_exists($loc)){
							$l = $loc;
						}else{
							$l = "./employee_pic/Blank-Facebok-Profile.jpg";
						}
					   ?>
						<td><img width="200" height="200" src="<?php echo $l;?>" />
						<br/>
                         <a href="javascript:void(0);" onclick="upload_window('<?php echo $slno; ?>');"><span style="color:green;">Change picture</span></a>
						</td>
						<td><h1 style="text-align:center;"><?php echo $name;?><h1></td>
					</tr>		
					<tr>
					   <td>&nbsp;</td>
					   <td style="text-align:center;"><b>Status:</b> <?php echo $status;?></td>
					</tr> 
			</table>
			
			  
			<h2>Present Status</h2>
			  
               <table width="30%">			  
				<tr>
				   <td><h6>Present Address:</h6></td>
				   <td>&nbsp;<b style="color:#008a8a;"><?php echo $address;?></b></td>
				</tr>   
				<tr>
				    <td><h6>Permanent Address:</h6></td>
					<td>&nbsp;<b style="color:#008a8a;"><?php echo $per_address;?></b></td>
				</tr>
				<tr>
				   <td><h6>Basic:</h6></td> 
				   <td>&nbsp;<b style="color:#008a8a;"><?php echo $basic;  ?></b></td>
				</tr>
				<tr>
				   <td><h6>Gross: </h6></td>  
				   <td>&nbsp;<b style="color:#008a8a;"><?php echo $gross;?></b></td>
				</tr>
                <tr>
				    <td><h6>House Rent: </h6></td>
					<td>&nbsp;<b style="color:#008a8a;"><?php echo $house_rent;?></b></td>
				</tr>
				<tr>
				    <td><h6>Medical:   </h6></td>
					<td>&nbsp;<b style="color:#008a8a;"><?php echo $medical;?></b></td>
				</tr>
			</table>			  
			  
			  
			  <h2>Personal Details</h2>
			 
               <table width="40%" >			  
				<tr>
				    <td><h6>Phone:</h6></td>       
					<td>&nbsp;<b style="color:#008a8a;"><?php echo $phone;  ?></b></td>
				</tr>
				<tr>
				    <td><h6>Father Name: </h6></td>
					<td>&nbsp;<b style="color:#008a8a;"><?php echo $father_name;?></b></td>
				</tr>
                <tr>
				   <td><h6>Mother Name: </h6></td>
				   <td>&nbsp;<b style="color:#008a8a;"><?php echo $mother_name;?></b></td>
				</tr>
                <tr>
				   <td><h6>Date of Birth:   </h6></td>
				   <td>&nbsp;<b style="color:#008a8a;"><?php echo $new_date2; ?></b></td>
				</tr>
				<tr>
				   <td><h6>Join Date:   </h6></td>
				   <td>&nbsp;<b style="color:#008a8a;"><?php echo $join_date;?></b></td>
				</tr>
                <tr>
				   <td><h6>National ID: </h6></td>
				   <td>&nbsp;<b style="color:#008a8a;"><?php echo $national_id;?></b></td>
				</tr>	   	
				<tr>
				   <td><h6>Designation: </h6></td>
				   <td>&nbsp;<b style="color:#008a8a;"><?php echo $designation;?></b></td>
				</tr>	
			</table>
			
    		
            <a href="?pagetitle=production_employee_info_display&menu_id=22&sm_id=4">
			<input type="button" class="btn btn-teal" value="&nbsp;Back&nbsp;"/>
			</a>			
	</div>
 </div>
</div>
<div class="clear"></div>
<div class="clear"></div>