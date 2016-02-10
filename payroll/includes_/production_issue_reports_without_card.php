<?php
ob_start();
include('db.php');
$company_id	=$_SESSION['company_id'];
?>
<script type="text/javascript">
$(document).ready(function(){
	setDatePicker('tdate');
	setDatePicker('fdate');    
   $('#btn_search').click(function(){
		var tdate = $('#tdate').val();
		var fdate = $('#fdate').val();
		var section_id = $('#section_id').val();
		var style_id = $('#style_id').val();
		var type_id = $('#type_id').val();
		
		var uurl	='html2pdf/production_issue_report_without_card.php?tdate='+tdate+'&fdate='+fdate+'&section_id='+section_id+'&type_id='+type_id;		 
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

</script>    
 
<div class="grid_10">
    <div class="box round first fullpage">
        <h2>Production Issue Reports</h2>
        <div class="block" id="block">
            <table class="form">
                <tr>
                    <td><label>Section</label></td>
                    <td>
                    <select id="section_id" name="section_id" style="width:150px;">
                    <option value="*">ALL</option>
                    <?php
                    $sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P'  order by TBL_PAY_SECTION_INFO.ID";
                    $stid	= oci_parse($conn, $sql);
                    oci_execute($stid);
                    
                    while($row = oci_fetch_array($stid, OCI_BOTH)) 
                    {
                    	echo '<option value='.$row[0].'>'.$row[1].'</option>';
                    }
                    ?>
                    </select>
                    </td>
                    <td><label>Category</label></td>
                    <td><select id="type_id" name="type_id" style="width:150px;">
                            <option value="*">Issue+Receive</option>
                            <option value="1">Only Issue</option>
                            <option value="2">Only Receive</option>
                    	</select></td>
                </tr>
                
                <tr>
                    <td><label>From Date</label> </td>
                    <td><input type="text" id="fdate" class="error"/></td>
                    <td><label>To Date</label></td>
                    <td><input type="text" id="tdate" class="error"/></td>
                </tr>
            </table>
            <div align="right">
            <input type="button" name="btn_search" id="btn_search" value=" &nbsp;&nbsp;Search&nbsp;&nbsp;" class="btn btn-navy" />
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>    