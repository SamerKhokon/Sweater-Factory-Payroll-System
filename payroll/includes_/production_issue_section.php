<?php
ob_start();
//include('db.php');
?>
<script type="text/javascript">
$(document).ready(function(){
	setDatePicker('date-picker');
	setDatePicker('dateto');  
   $('#btn_search').click(function(){
		var section_id	=$('#section_id').val();
		var dateid 		=$('#date-picker').val();
		var dateto		=$('#dateto').val();
		var block_id	=$.trim($('#block_id').val());
		var uurl	='html2pdf/production_issue_section.php?dateid='+dateid+'&section_id='+section_id+'&dateto='+dateto+'&block_id='+block_id;		 
		 if (window.showModalDialog){
			            window.showModalDialog(uurl,"mywindow",
			            "dialogWidth:1024px;dialogHeight:768px");
			        } else {
			            mywindow= window.open ("popup.html", "mywindow","menubar=0,toolbar=0,location=0,resizable=1,status=1,scrollbars=1,width=1024px,height=768px");
			            mywindow.moveTo(300,300);
			            if (window.focus)
			                mywindow.focus();
				}
	}); 
});


function get_block(sec_id)
{
var datastr	='sec_id='+sec_id;
$.ajax({
		type	:'post',
		url		:'includes/production_base_emp_info/get_block.php',
		data	:datastr,
		cache	:false,
		success	:function(str)
		{
			$('#block_id').html(str);
		}
		
	});

}
</script>    
 
<div class="grid_10">
    <div class="box round first fullpage">
        <h2>Production Issue Section Wise</h2>
        <div class="block" id="block">
            <table class="form">
                <tr>
                    <td><label>Section</label></td>
                    <td><select id="section_id" name="section_id" onchange="get_block(this.value)" style="width:150px;">
                             <option value="0">None</option>
                               <?php
							   	$company_id=$_SESSION['company_id'];
								
								$sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P' and TBL_PAY_SECTION_INFO.COMPANY_ID=$company_id  order by TBL_PAY_SECTION_INFO.ID";
								$stid	= oci_parse($conn, $sql);
								oci_execute($stid);
								
								while(($row = oci_fetch_array($stid, OCI_BOTH))) 
								{
									echo '<option value='.$row[0].'>'.$row[1].'</option>';
								}
								?>
                            </select></td>
                    <td><label>Block/Line</label></td>
                    <td colspan="2">
                    
                    <select id="block_id" name="block_id" style="width:150px;">
                     <option value="">None</option>
                     </select></td>
                </tr>
                
                <tr>
                    <td><label>From</label></td>
                    <td><input type="text" id="date-picker" class="error"/></td>
                    <td><label>To</label></td>
                    <td><input type="text" id="dateto" class="error"/></td>
                </tr>
            
                <tr>
                    <td colspan="3" align="center"></td><td align="center"><input type="button" name="btn_search" id="btn_search" value=" &nbsp;&nbsp;Search&nbsp;&nbsp;" class="btn btn-navy" /></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>
    