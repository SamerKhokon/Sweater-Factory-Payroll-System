<?php
session_start();
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
		var uurl	='html2pdf/summary_report.php?tdate='+tdate+'&fdate='+fdate+'&section_id='+section_id;		 
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
        <h2>Summary Report</h2>
        <div class="block" id="block">
            <table class="form">
                <tr>
                    <td><label>Section</label></td>
                    <td>
                    <select id="section_id" name="section_id" style="width:150px;">
                    <option value="*">ALL</option>
                    <?php
                    $sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_INFO.COMPANY_ID=$company_id order by TBL_PAY_SECTION_INFO.ID";
                    $stid	= mysqli_query($conn, $sql);
                    
                    
                    while($row = mysqli_fetch_array($stid)) 
                    {
                    	echo '<option value='.$row[0].'>'.$row[1].'</option>';
                    }
                    ?>
                    </select>
                    </td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                
                <tr>
                    <td><label>From Date</label> </td>
                    <td><input type="text" id="fdate" class="error"/></td>
                    <td><label>To Date</label></td>
                    <td><input type="text" id="tdate" class="error"/></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td align="center"><input type="button" name="btn_search" id="btn_search" value=" &nbsp;&nbsp;Search&nbsp;&nbsp;" class="btn btn-navy" /></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>    