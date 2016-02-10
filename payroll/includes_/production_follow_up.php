<?php
ob_start();
include('db.php');
?>
<script type="text/javascript">


var sampleArray=new Array();

$(document).ready(function(){
	setDatePicker('year_date');  
   $('#btn_search').click(function(){
		var year_date = $('#year_date').val();
		var sampleArray2=$('#FeatureCodes').val();
		//alert(sampleArray2); 

		var uurl	='html2pdf/production_followup_pdf.php?year_date='+year_date+'&sampleArray='+sampleArray2;
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
        <h2>Production Follow Up</h2>
        <div id="block">
        <form name="Example">
            <table class="form">
                <tr>
                    <td>
                        <select name="Features" size="9" style="width:150px;" MULTIPLE>
						   <?php
							$company_id	=$_SESSION["company_id"];
							$sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P' and TBL_PAY_SECTION_INFO.COMPANY_ID=$company_id  order by TBL_PAY_SECTION_INFO.ID";
							$stid	= oci_parse($conn, $sql);
							oci_execute($stid);
							
							while($row = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) 
							{
							echo '<option value="'.$row[0].'">'.$row[1].'</option>';
							}
                            ?>  
                        </select>
                    </td>
                    <td align="center" valign="middle">
                        <input type="Button" value="Add >>" style="width:100px" onClick="SelectMoveRows(document.Example.Features,document.Example.FeatureCodes)"><br>
                        <br>
                        <input type="Button" value="<< Remove" style="width:100px" onClick="SelectMoveRows(document.Example.FeatureCodes,document.Example.Features)">
                    </td>
                    <td>
                        <select name="FeatureCodes" id="FeatureCodes" class="FeatureCodes" size="9" style="width:150px;" MULTIPLE>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>From</label></td>
                    <td><input type="text" id="year_date" /></td>
                    <td colspan="2"></td>
                </tr>                
                <tr>
                    <td colspan="3" align="right"></td><td align="center"><input type="button" name="btn_search" id="btn_search" value=" &nbsp;&nbsp;Search&nbsp;&nbsp;" class="btn btn-navy" />
                    </td>
                </tr>
            </table>
            </form>
      </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>