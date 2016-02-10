<?php
session_start();	
require '../../includes/db.php';	
	unset($_SESSION['ids2']);
	$ids = trim($_REQUEST['ids']); 
	$companyid = trim($_SESSION['company_id']);
	
	$str = "SELECT * FROM TBL_PAY_SECTION_ALLOWENCE_INFO WHERE ID=$ids";
	$stm = mysqli_query($conn,$str);
    
	
	while($res = mysqli_fetch_array($stm)) {
	    $id				  = $res['ID'];
		$sectionid        = $res['SECTION_ID'];
	    $comid			  =	$res['COMPANY_ID'];
		$alowence_head_id = $res['ALLOWENCE_HEAD_ID'];
		$alowence_amount  = $res['ALLOWENCE_AMOUNT'];
		$alowence_affect  = $res['ALLOWENCE_AFFECT'];
	}	
?>
  <div id="fg_container_header">
        <div id="fg_box_Title">Allowences</div>
        <div id="fg_box_Close"><a href="javascript:fg_hideform('fg_formContainer','fg_backgroundpopup');">Close(X)</a></div>
    </div>
	
	<!-- 1	106	Attandence Bonus	60	BASIC	 -->
	
    <div id="fg_form_InnerContainer">
 
<table width="100%"   align="center" cellpadding="1" cellspacing="0" class="formtd"  style="border: 0px solid  #008cee;">
            <input type="hidden" id="serialno" value="<?php echo $id; ?>"/>
			<input type="hidden" id="section_id" value="<?php echo $sectionid; ?>"/>
			<input type="hidden" id="company_id" value="<?php echo $comid;?>"/>
			<input type="hidden" id="alowence_head_id" value="<?php echo $alowence_head_id;?>">
			<?php
					$strs = "SELECT ID,HEAD_NAME FROM TBL_PAY_SECTION_ALLOWENCE_HEAD WHERE ID=$alowence_head_id";
					$stmm = mysqli_query($conn,$strs);
                   			
			        while($r = mysqli_fetch_array($stmm)) {
					   $head_name = $r['HEAD_NAME'];
					}			
				?>
          <tr>
            <td width="39%" align="right" valign="top"><span class="style3">Alowence Name</span></td>
            <td  width="61%" align="left" valign="middle">
            <input type="text" id="alowence_name" name="alowence_name" class="textfield" size="30" value="<?php echo $head_name;?>"></td>
    </tr>
          <tr>
            <td width="39%" align="right" valign="top"><span class="style3">Alowence Amount</span></td>
            <td  width="61%" align="left" valign="middle">
            <input type="text" id="alowence_amount" name="alowence_amount" class="textfield" size="10" value="<?php echo $alowence_amount;?>"></td>
    </tr>
		  <tr>
            <td width="39%" align="right" valign="top"><span class="style3">Alowence Type </span></td>
            <td  width="61%" align="left" valign="middle">
           <select id="alowence_type" name="alowence_type" class="textfield">
			   <?php  if($alowence_affect=="BASIC"){ ?>
			   <option value="<?php echo $alowence_affect;?>"><?php echo $alowence_affect;?></option>
			   <option value="GROSS">GROSS</option>
			   <?php }else{ ?>
						<option value="BASIC">BASIC</option>
			   <?php }?>
			</select>
			</td>
    </tr>
         <tr>
          <td colspan="2" align="center">
		  <input type="button" id="btn_setleave" value="Edit Allowence" onclick="edit_alowence();fg_hideform('fg_formContainer','fg_backgroundpopup');" /></td>
          </tr>
      </table>
</div>