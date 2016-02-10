<?php
session_start();
require '../../includes/db.php';

unset($_SESSION['ids2']);
$ids =trim($_REQUEST['ids']);
$dateI	=trim($_REQUEST['dateI']);
$section_id=trim($_REQUEST['section_id']);
$card_id=$_SESSION['ids2'] = $ids;
$company_id	=$_SESSION["company_id"];
$month_year1=substr($_REQUEST['dateI'],0,3).''.substr($_REQUEST['dateI'],6,10);
$month_year =trim($month_year1);

$sick	=0;
$annual	=0;
$casual	=0;
$casual_l=0;
$annual_l=0;
$sick_l	=0;

if($card_id!='' && $month_year!='')
{
	$sql	="select * from TBL_PAY_LEAVE_INFO where CARD_ID='$card_id' and COMPANY_ID=$company_id and to_char(MONTH_YEAR,'mm/yyyy')='$month_year'";
	$stid	= oci_parse($conn, $sql);
	oci_execute($stid);
	if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
	{
		$sick	=$row[8];
		$annual	=$row[7];
		$casual	=$row[6];
	}
	if($sick=='')
		$sick	=0;
	if($annual=='')
		$annual	=0;	
	if($casual=='')
		$casual	=0;
	
}
$cur_year =date('Y');

$sqlcasu = "select sum(CASUAL) from TBL_PAY_LEAVE_INFO where CARD_ID='$card_id' and COMPANY_ID=$company_id  and SECTION_ID=$section_id  and to_char(MONTH_YEAR,'yyyy')='2012' group by CARD_ID";

$sqlannual = "select sum(ANUAL) from TBL_PAY_LEAVE_INFO where CARD_ID='$card_id' and COMPANY_ID=$company_id and  SECTION_ID=$section_id  and to_char(MONTH_YEAR,'yyyy')='2012' group by CARD_ID";

$sqlsick = "select sum(SICK) from TBL_PAY_LEAVE_INFO where CARD_ID='$card_id' and COMPANY_ID=$company_id and SECTION_ID=$section_id  and to_char(MONTH_YEAR,'yyyy')='2012' group by CARD_ID";

$stid	= oci_parse($conn, $sqlcasu);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
{
	$casual_l=$row[0];
}

$stid	= oci_parse($conn, $sqlannual);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
{
	$annual_l=$row[0];
}

$stid	= oci_parse($conn, $sqlsick);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
{
	$sick_l=$row[0];
}


$leave_anl	=0;
$leave_cal	=0;
$leave_sickl	=0;
 $sql	="select CASUAL,ANUAL,SICK from TBL_PAY_LEAVE_YEARLY where SECTION_ID=$section_id and COMPANY_ID=$company_id	";
 $stid	= oci_parse($conn, $sql);
oci_execute($stid);
if($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))
{
	$leave_anl=$row[1];
	$leave_cal=$row[0];
	$leave_sickl=$row[2];
}
$rest_anl=($leave_anl - $annual_l);
$rest_cas=($leave_cal - $casual_l);
$rest_sick=($leave_sickl - $sick_l);

?>
    <div id="fg_container_header">
        <div id="fg_box_Title">Leave</div>
        <div id="fg_box_Close"><a href="javascript:fg_hideform('fg_formContainer','fg_backgroundpopup');">Close(X)</a></div>
    </div>

    <div id="fg_form_InnerContainer">

<table width="100%"   align="center" cellpadding="1" cellspacing="0" class="formtd"  style="border: 0px solid  #008cee;">
          <tr>
            <td width="29%" align="right" valign="top"><span class="style3">Sick leave</span></td>
            <td  width="71%" align="left" valign="middle">
            <input type="text" id="leave1" name="leave1" class="textfield" size="10" value="<?php echo $sick; ?>"  onkeypress="return ret_valid_digit(event,'double',this.value.indexOf('.'))"
><input type="hidden" id="leave1h" value="<?php echo $rest_sick; ?>" /></td>
    </tr>
		  <tr>
            <td width="29%" align="right" valign="top"><span class="style3">Casual leave</span></td>
            <td  width="71%" align="left" valign="middle">
            <input type="text" id="leave2" name="leave2" class="textfield" size="10" value="<?php echo $casual; ?>" onkeypress="check_casual()"><input type="hidden" id="leave2h" value="<?php echo $rest_cas; ?>" /></td>
    </tr>
          <tr>
            <td width="29%" align="right" valign="top"><span class="style3">Anual leave</span></td>
            <td  width="71%" align="left" valign="middle">
            <input type="text" id="leave3" name="leave3" class="textfield" size="10" value="<?php echo $annual; ?>" onkeypress="check_annual()"><input type="hidden" id="leave3h" value="<?php echo $rest_anl; ?>" /></td>
    </tr>
          <tr>
          <td colspan="2" align="center"><input type="button" id="btn_setleave" value="Set Leave" onclick="set_leave();fg_hideform('fg_formContainer','fg_backgroundpopup');" /></td>
          </tr>
      </table>
</div>