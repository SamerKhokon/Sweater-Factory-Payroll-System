<?php
ob_start();
include('db.php');
?>
<script type="text/javascript">
$(document).ready(function(){

   $('#btn_search').click(function(){
		var section_id 	=$('#section_id').val();
		var block_id	=$('#block_id').val();
		var status_id	=$('#status_id').val();
		var uurl	='html2pdf/employee_listPpdf.php?section_id='+section_id+'&block_id='+block_id+'&status_id='+status_id;		 
		if(window.showModalDialog)
		{
			window.showModalDialog(uurl,"mywindow","dialogWidth:1024px;dialogHeight:768px");
				
		} 
		else
		{
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
		url		:'includes/production_base_emp_info/get_block_search.php',
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
        <h2>Production Employee List</h2>
        <div class="block" id="block">
            <table class="form">
                <tr>
                    <td><label>Section</label></td>
                    <td><select id="section_id" name="section_id" onchange="get_block(this.value)" style="width:150px;">
                     	<option value="*">All</option>
                       <?php
                        $sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where  TBL_PAY_SECTION_TYPE.CAT='P' and  TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID  order by TBL_PAY_SECTION_INFO.ID";
                        $stid	= oci_parse($conn, $sql);
                        oci_execute($stid);
                        
                        while(($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS))) 
                        {
                            echo '<option value='.$row[0].'>'.$row[1].'</option>';
                        }
                        ?>
                    </select></td>
                    <td><label>Block/Line</label></td>
                    <td colspan="2">
                    
                    <select id="block_id" name="block_id" style="width:150px;">
                     <option value="">All</option>
                     </select></td>
                </tr>
                <tr>
                 	<td><label>Status</label></td>
                	<td>
                    <select id="status_id" name="status_id" style="width:150px;">
                     <option value="">All</option>
                     <option value="1">IN</option>
                     <option value="2">OUT</option>
                   
                     </select></td>
                 <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="4" align="right"><input type="button" id="btn_search" value="&nbsp;Search&nbsp;" class="btn btn-navy"  /></td>
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