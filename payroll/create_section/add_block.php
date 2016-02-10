<?php
session_start();
require '../../includes/db.php';
unset($_SESSION['ids2']);
$ids = $_REQUEST['ids'];
	
?>
    <div id="fg_container_header">
        <div id="fg_box_Title">Add Block</div>
        <div id="fg_box_Close"><a href="javascript:fg_hideform('fg_formContainer','fg_backgroundpopup');">Close(X)</a></div>
    </div>

    <div id="fg_form_InnerContainer">
    
<?php
//$sql ="SELECT * FROM item WHERE id  = '$ids'";


?>

<table width="100%"   align="center" cellpadding="1" cellspacing="0" class="formtd"  style="border: 0px solid  #008cee;">
          <tr>
			<input type="hidden" id="section_id" value="<?php echo $ids; ?>"/>
			<input type="hidden" id="company_id" value="<?php echo $_SESSION["company_id"];?>"/>
            <td width="34%" align="right" valign="top"><span class="style3">Block Name</span></td>
            <td  width="66%" align="left" valign="middle">
            <input type="text" id="block_name" name="block_name"  class="textfield" size="10"></td>
    </tr>
		  <tr>
            <td width="34%" align="right" valign="top"><span class="style3">Bangla Block Name </span></td>
            <td  width="66%" align="left" valign="middle">
            <input type="text" id="bangla_block_name" name="bangla_block_name"  class="textfield" size="10"></td>
    </tr>
         <tr>
          <td colspan="2" align="center">
		  <input type="button" id="btn_setleave" value="Save" onclick="add_block();fg_hideform('fg_formContainer','fg_backgroundpopup');" /></td>
          </tr>
      </table>
</div>