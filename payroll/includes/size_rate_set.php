<?php
session_start();
include('db.php');
?>
<link href="jquery_autocompleter/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script src="jquery_autocompleter/jquery.autocomplete.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function () {		
		setDatePicker('date-picker');
		$('#msg').hide();
		
		$("#style").keydown(function(event){
			if(event.keyCode == 13 ){
			var section_id	=$('#section_id').val();
			var style 		=$('#style').val();
			$("#jq_tbl").load('includes/style_info/style_size_list.php',{'section_id':section_id,'style_id':style},function(){});	 
			}
		});	
		$("#section_id").change(function () {
			var section_id =$('#section_id').val();
			$("#style").unbind('.autocomplete').autocomplete("includes/style_info/get_style.php?section_id="+section_id, {
			selectFirst: true
			});
			btn_reset();		
		});
		
		$("#style").result(function(event, data2, formatted){
		    var style_id 			=data2[1];
			var section_id	=data2[2];
			//var datastr	='style_id='+st+'&section_id='+section_id;
			$("#jq_tbl").load('includes/style_info/style_size_list.php',{'section_id':section_id,'style_id':style_id},function(){});	 
		});
		
		
		$("input.flat").live('keypress', function (e) {
        switch(e.keyCode)
        {
            //left arrow
            case 37:
                $(this).parent()
                        .prev()
                        .children("input.flat")
                        .focus();
                break;
 
            //right arrow
            case 39:
                $(this).parent()
                        .next()
                        .children("input.flat")
                        .focus();
                break;
 
            //up arrow
            case 40:
                $(this).parent()
                        .parent()
                        .next()
                        .children("td")
                        .children("input.flat[name="
                            +$(this).attr("name")+"]")
                        .focus();
                break;
 
            //down arrow
            case 38:
                $(this).parent()
                        .parent()
                        .prev()
                        .children("td")
                        .children("input.flat[name="
                            +$(this).attr("name")+"]")
                        .focus();
                break;
        	}
    	});
		
		
			
		
		$('#btn_saveall').live('click',function(){
			var user_ids = document.getElementsByName('user_id[]');
			var u_ids	="";
			var rate	="";
			
			var len = user_ids.length;
			//alert(len);
			for(var i=0; i<len; i++)
			{
				var id = user_ids[i].value;
				//alert(id);
				if(u_ids=="")
					u_ids = user_ids[i].value;
				else
					u_ids += '|'+user_ids[i].value;
						
				var rate_field = 'rate'+id;
				if(rate=="")
					rate += document.getElementById(rate_field).value;
				else
					rate += '|'+document.getElementById(rate_field).value;	
			}
			var datak = 'user_ids='+u_ids+'&rate='+rate;
			$.ajax({
				type:"post",
				url:"includes/style_info/all_size_rate_edit.php",
				data:datak,
				success:function(str)
					{
						$('#msg').html(str);
						$('#msg').show();
						var section_id='';
						var style_id	='';
						$("#jq_tbl").load('includes/style_info/style_size_list.php',{'section_id':section_id,'style_id':style_id},function(){});	 		$("#style").val('');
						$("#style").focus();
					}
				});
			});	
			
	});
</script>
<div class="grid_10">
    <div class="box round first fullpage">
        <h2>Size Enty</h2>
        <div class="block " id="block">
         <div class='message info' id="msg">
		 </div>
            <table class="form">
            	<tr>
                    <td><label>Section</label></td>
                  	<td>
                    <select id="section_id" name="section_id" style="width:150px;">
                    <option value="">None</option>
                    <?php
                    $company_id	=$_SESSION["company_id"];
                    $sql	="select TBL_PAY_SECTION_INFO.ID,TBL_PAY_SECTION_INFO.SEC_NAME from TBL_PAY_SECTION_INFO,TBL_PAY_SECTION_TYPE where TBL_PAY_SECTION_INFO.SEC_TYPE_ID=TBL_PAY_SECTION_TYPE.ID and TBL_PAY_SECTION_TYPE.CAT='P' and TBL_PAY_SECTION_INFO.COMPANY_ID=$company_id  order by TBL_PAY_SECTION_INFO.ID";
                    $stid	= mysqli_query($conn, $sql);
                    
                    while($row = mysqli_fetch_array($stid)) 
                    {
                        echo '<option value='.$row[0].'>'.$row[1].'</option>';
                    }
                    ?>
                    </select></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
              	</tr>
                <tr>
                    <td><label>Style</label></td>
                  	<td><input type="text" id="style" class="error" /><span class="error">This is a required field.</span></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
              	</tr>
            </table>
      </div>
          <hr />
          <div class="box round first grid">
            <div class="block">
        
          	<div id="jq_tbl"></div>
          
          </div>
          </div>
		  <br/><br/><br/>
    </div>	  
</div>
<div class="clear"></div>
<div class="clear"></div>   