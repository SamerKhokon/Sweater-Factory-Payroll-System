<?php
ob_start();
include('db.php');
$company_id = $_SESSION['company_id'];
?>
<script type="text/javascript">
$(document).ready(function(){


	setDatePicker('date-picker');    
   $('#btn_search').click(function(){
		var style_id = $('#style_id').val();
		var year = $('#date-picker').val();
		var uurl	='html2pdf/style_wise_production_summery.php?style_id='+style_id+'&year='+year;		 
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
        <h2>Style Wise Production Reports</h2>
        <div class="block" id="block">
            <table class="form">
                <tr>
                    <td><label>Year</label></td>
                        <td><input type="text" id="date-picker" class="error" value="<?php echo date('m/d/Y'); ?>" size="12" /></td>
                    <td><label>Style Name</label></td>
              		<td>
          				<select id="style_id" name="style_id" style="width:150px;">
                            <option value="*">ALL</option>
                            <?php
                            $sql	="select ID,STYLE_NAME from TBL_PAY_STYLE_INFO where COMPANY_ID=$company_id order by ID";
                            $stid	= oci_parse($conn, $sql);
                            oci_execute($stid);
                            
                            while(($row = oci_fetch_array($stid, OCI_BOTH))) 
                            {
                                echo '<option value='.$row[0].'>'.$row[1].'</option>';
                            }
                            ?>
                       </select>
                     </td>
              </tr>
	     </table>
            <div align="left">
            <input type="button" name="btn_search" id="btn_search" value=" &nbsp;&nbsp;Search&nbsp;&nbsp;" class="btn btn-navy" />
            </div>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>  