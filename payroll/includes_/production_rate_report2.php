<?php
ob_start();
include('db.php');
$company_id	=$_SESSION['company_id'];
?>
<script type="text/javascript">
$(document).ready(function(){


	setDatePicker('date-picker');
	setDatePicker('dateto');    
   $('#btn_search').click(function(){
		var dateid 		=$('#date-picker').val();
		var section_id	=$('#section_id').val();
		var style_id	=$('#style_id').val();
		var dateto		=$('#dateto').val();
		//alert(section_id);		  
		var uurl	='html2pdf/production_rate_report.php?dateid='+dateid+'&section_id='+section_id+'&style_id='+style_id+'&dateto='+dateto;		 
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
        <h2>Rate Details</h2>
        <div class="block" id="block">
            <table class="form">
                <tr>
                    <td><label>Section</label></td>
                    <td>
                    <select id="section_id" name="section_id" style="width:150px;">
                    <option value="0">ALL</option>
                    <?php
                    //$sql	="select ID,SEC_NAME from TBL_PAY_SECTION_INFO where COMPANY_ID='$company_id' order by ID";
					$sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P' and TBL_PAY_SECTION_INFO.COMPANY_ID=$company_id  order by TBL_PAY_SECTION_INFO.ID";
			
                    $stid	= oci_parse($conn, $sql);
                    oci_execute($stid);
                    
                    while(($row = oci_fetch_array($stid, OCI_BOTH))) 
                    {
                    echo '<option value='.$row[0].'>'.$row[1].'</option>';
                    }
                    ?>
                    </select>
                    </td>
                    <td><label>Style</label></td>
                    <td>
                    <select id="style_id" name="style_id[]" style="width:150px;">
                    <option value="0">ALL</option>
                    <?php
                    $sql	="select ID,STYLE_NAME from TBL_PAY_STYLE_INFO where COMPANY_ID='$company_id' order by ID";
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
                
                <tr>
                    <td><label>From</label></td>
                    <td><input type="text" id="date-picker" class="error"/></td>
                    <td><label>To</label></td>
                    <td><input type="text" id="dateto" class="error"/></td>
                </tr>
                <tr>
                	<td colspan="4" align="center"></td>
                </tr>
            </table>
            <div align="right">
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
    