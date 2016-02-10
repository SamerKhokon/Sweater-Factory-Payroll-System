<?php
session_start();	
require '../../includes/db.php';	
	unset($_SESSION['ids2']);
	$ids       = trim($_REQUEST['ids']); 
	$companyid = trim($_SESSION['company_id']);
	
	$str = "SELECT * FROM TBL_PAY_SALARY_SETTING WHERE ID=$ids";
	$stm = mysqli_query($conn,$str);  
	
	while($res = mysqli_fetch_array($stm)) {
	       $slno         = $res['ID'];
		   $company_id   = $res['COMPANY_ID'];
		   $salary_from  = $res['SALARY_FROM'];
		   $salary_to    = $res['SATARY_TO'];
		   $grade        = $res['GRADE'];
		   $designation  = $res['DESIGNATION'];
		   $salary_type  = $res['SALARY_TYPE'];
		   $section_id   = $res['SECTION_ID'];	
	}	
?>
  <div id="fg_container_header">
        <div id="fg_box_Title">Salary</div>
        <div id="fg_box_Close"><a href="javascript:fg_hideform('fg_formContainer','fg_backgroundpopup');">Close(X)</a></div>
    </div>
	
	<!-- 1	106	Attandence Bonus	60	BASIC	 -->
	
    <div id="fg_form_InnerContainer">
 
<table width="100%"   align="center" cellpadding="1" cellspacing="0" class="formtd"  style="border: 0px solid  #008cee;">

            <input type="hidden" id="serialno" value="<?php echo $slno; ?>"/>
			<input type="hidden" id="section_id" value="<?php echo $section_id; ?>"/>
			<input type="hidden" id="company_id" value="<?php echo $company_id;?>"/>
			<input type="hidden" id="salary_type" value="<?php echo $salary_type;?>"/>
      <tr>
            <td width="39%" align="right" valign="top"><span class="style3">Salary From</span></td>
            <td  width="61%" align="left" valign="middle">
            <input type="text" id="salary_from" name="salary_from" class="textfield" size="30" value="<?php echo $salary_from;?>"></td>
    </tr>
          <tr>
            <td width="39%" align="right" valign="top"><span class="style3">Salary To</span></td>
            <td  width="61%" align="left" valign="middle">
            <input type="text" id="salary_to" name="salary_to" class="textfield" size="10" value="<?php echo $salary_to;?>"></td>
    </tr>
	<tr>
            <td width="39%" align="right" valign="top"><span class="style3">Designation</span></td>
            <td  width="61%" align="left" valign="middle">
                <input type="text" id="designation" name="designation" class="textfield" size="10" value="<?php echo $designation;?>">
			</td>
    </tr>
	
         <tr>
          <td colspan="2" align="center">
		  <input type="button" id="btn_setleave" value="Edit Salary" onclick="edit_salary();fg_hideform('fg_formContainer','fg_backgroundpopup');" /></td>
          </tr>
      </table>
</div>