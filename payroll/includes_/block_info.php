<!-- for table grid-->       
<style type="text/css" title="currentStyle">
@import "../../../media/css/demo_page.css";
@import "../../../media/css/demo_table.css";
</style>
<script type="text/javascript" language="javascript" src="../../../media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../../../media/js/jquery.dataTables.js"></script>

<script type="text/javascript">
$(document).ready(function () {

	$("#nameEN").keydown(function(event){
					if(event.keyCode == 13 )
						{
							$("#nameBN").focus();
						}
			});
	
	$('#msg').hide();
	$("#jq_tbl").load('block_info/block_info_data.php');
	
	$('#btn_save').click(function(){
		var err	=0;
		var section_id	=$('#section_id').val();
		var nameBN		=$('#nameBN').val();
		var nameEN		=$('#nameEN').val();
		if(section_id==0)
		{
			alert('Please Select Section');
			err	=1;
		}
		if(err==0)
		{
			var datastr	='section_id='+section_id+'&nameBN='+nameBN+'&nameEN='+nameEN;
			//alert(datastr)
			$.ajax({
				type	:'post',
				url		:'block_info/block_info_enty.php',
				data	:datastr,
				cache	:false,
				success	:function(str)
				{
					$('#msg').html(str);
					$('#msg').show();
					btn_reset();
					$("#jq_tbl").load('block_info/block_info_data.php');
				}
			
			});
		}
	
	});
	
});
</script>
<script>

function btn_reset()
{
	var section_id	=$('#section_id').val(0);
	var nameBN		=$('#nameBN').val('');
	var nameEN		=$('#nameEN').val('');
}
</script>
<!-- /TinyMCE -->
<style type="text/css">
	#progress-bar
	{
		width: 400px;
	}
</style>


   
<div class="grid_10">
    <div class="box round first fullpage">
        <h2>
            Block Info</h2>
        <div class="block " id="block">
         <div class='message info' id="msg">
		 </div>
            <table class="form">
                <tr>
                    <td><label>Section</label></td>
                    <td>
                    <select id="section_id" name="section">
                    <option value="0">None</option>
                    <?php
                    $sql	="select ID,SEC_NAME from TBL_PAY_SECTION_INFO order by id";
                    $stid	= oci_parse($conn, $sql);
                    oci_execute($stid);
                    
                    while(($row = oci_fetch_array($stid, OCI_BOTH))) 
                    {
                    echo '<option value='.$row[0].'>'.$row[1].'</option>';
                    }
                    ?>
                    </select>
                    <span class="error">This is a required field.</span>
                    </td>
                    <td>
                    <label>Name(English)</label></td>
                    <td>
                    <input type="text" id="nameEN" class="error"  /><span class="error">This is a required field.</span></td>
                    <td>
                </tr>
                <tr>
                	<td colspan="2"></td>
                    <td>
                    <label>Name(Bangla)</label></td>
                    <td>
                    <input type="text" id="nameBN" class="success"  /><span class="success">Enter Bangla name by Avro.</span></td>
                </tr>
                <tr>
                    <td colspan="4" align="right"><input type="button" name="btn_save" id="btn_save" value=" &nbsp;&nbsp;Save&nbsp;&nbsp;" class="btn btn-navy" /><input type="button"  name="btn_reset" id="btn_reset" value=" &nbsp;&nbsp;Reset&nbsp;&nbsp;" class="btn btn-blue" onclick="btn_reset()" /></td>
                </tr>
            </table>
            <hr />
          </div>
          <div class="box round first grid">
        <h2>
            Block Info Data</h2>
        <div class="block">
          <div id="jq_tbl"></div>
          </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="clear"></div>   