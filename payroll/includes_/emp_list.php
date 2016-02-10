<?php
ob_start();
session_start();
$company_id =$_SESSION['company_id'];
include('db.php');
?>
<script type="text/javascript">
$(document).ready(function(){
   $('#btn_search').click(function(){
		var section_id 	=$('#section_id').val();
		var sampleArray2=$('#FeatureCodes').val();
		var type_id		=$('#type_id').val();
		var uurl	='html2pdf/employee_listApdf.php?section_id='+section_id+'&sampleArray2='+sampleArray2+'&type_id='+type_id;
		//alert(uurl);		 
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
	
	$('#custome_tbl').hide();
	
});

function get_custome(secl_type)
{
	if(secl_type!='*')
	{
		$('#custome_tbl').show(); 
	}
	else
	{
		$('#custome_tbl').hide(); 	
	}
	$('#FeatureCodes option').remove();
}



function setAll(value) {
	var vvl=value;
	sampleArray.push(vvl);
	//vall();
  }
 function delAll(value) {

	var vvl=value;
	while (sampleArray.indexOf(vvl) !== -1) {
  	sampleArray.splice(sampleArray.indexOf(vvl), 1);
		}
		//vall();
  }

function vall()
{
	alert(sampleArray);
}




function enter_comment(super_id)
{

	if(!(document.getElementById(super_id).checked))
		{                   
			delAll(super_id);
		}
	else
		{   
			setAll(super_id);
		}

}

function SelectMoveRows(SS1,SS2)
{
    var SelID='';
    var SelText='';
    // Move rows from SS1 to SS2 from bottom to top
    for (i=SS1.options.length - 1; i>=0; i--)
    {
        if (SS1.options[i].selected == true)
        {
            SelID=SS1.options[i].value;
            SelText=SS1.options[i].text;
            var newRow = new Option(SelText,SelID);
            SS2.options[SS2.length]=newRow;
            SS1.options[i]=null;
        }
    }
   // SelectSort(SS2);
   selectAll(document.getElementById('FeatureCodes'),true)
}


function selectAll(selectBox,selectAll) { 
    // have we been passed an ID 
    if (typeof selectBox == "string") { 
        selectBox = document.getElementById(selectBox);
    } 
    // is the select box a multiple select box? 
    if (selectBox.type == "select-multiple") { 
        for (var i = 0; i < selectBox.options.length; i++) { 
             selectBox.options[i].selected = selectAll; 
        } 
    }
}
</script>    
 
<div class="grid_10">
    <div class="box round first fullpage">
        <h2>Employee List</h2>
        <div class="block" id="block">
            <table class="form">
                <tr>
                    <td><label>Section</label></td>
                    <td>
                    <select id="section_id" name="section_id" onchange="get_custome(this.value)" style="width:150px;">
                     	<option value="*">All</option>
                        <option value="custom">Custom</option>
                    </select></td>
                    <td><label>Type</label></td>
                    <td colspan="2"><select id="type_id" name="type_id" style="width:150px;">
                        <option value="1">In</option>
                        <option value="2">Out</option>
                    </select></td>
                </tr>
                <tr>
                	<td colspan="4">
                    	<form name="Example">
                        <table class="form" id="custome_tbl">
                            <tr>
                            <td style="text-align:right;">
                            <select name="Features" size="9" style="width:150px;" MULTIPLE>
                               <?php
                                $company_id	=$_SESSION["company_id"];
                                $sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO where   TBL_PAY_SECTION_INFO.COMPANY_ID='$company_id'  order by TBL_PAY_SECTION_INFO.ID";
                                $stid	= oci_parse($conn, $sql);
                                oci_execute($stid);
                                
                                while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
                                {
                                echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                                }
                                ?>  
                            </select>
                            </td>
                            <td style="text-align:center; " width="0" valign="middle">
                            
                            <input type="Button" value="Add >>" style="width:100px; " onClick="SelectMoveRows(document.Example.Features,document.Example.FeatureCodes)">
                            <br />
                            
                            <input type="Button" value="<< Remove" style="width:100px;" onClick="SelectMoveRows(document.Example.FeatureCodes,document.Example.Features)">
                            
                            </td>
                            <td>
                            <select name="FeatureCodes" id="FeatureCodes" class="FeatureCodes" size="9" style="width:150px;" MULTIPLE>
                            </select>
                            </td>
                            </tr>
                        </table>
                        </form>
                    </td>
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