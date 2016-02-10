<link href="jquery_autocompleter/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script src="jquery_autocompleter/jquery.autocomplete.js" type="text/javascript"></script>
	<script type="text/javascript">
    $(document).ready(function () {
		$('#msg').hide();
        setDatePicker('date-picker');
		var err	=true;
		
		$("#date-picker").keydown(function(event){
			if(event.keyCode == 13 )
				{
				 	 
				
				}
					
			});
			
			$("#btn_show").click(function(event){
			
					var section_id			=$('#section_id').val();
					var block_name			=$('#block_name').val();
           	 		var datepicker			=$('#date-picker').val();
					if(section_id!='' && datepicker!='')
					$("#jq_tbl").load('includes/fixed_extra_ot/emp_list.php',{'section_id':section_id,'block_name':block_name,'datepicker':datepicker},function(){});	
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
		
		
        
        $('#btn_save').live('click',function(){
            var section_id			=$('#section_id').val();
			var block_name			=$('#block_name').val();
            var date_condition		=$('#date_condition').val();
            var datepicker			=$('#date-picker').val();
            var total_day_of_month	=$('#total_day_of_month').val();
			var friday				=$('#friday').val(); 
            var cardno				=$('#cardno').val();
            var name				=$.trim($('#name').val());
            var eot					=$('#eot').val();
			
            var datastr	='section_id='+section_id+'&date_condition='+date_condition+'&datepicker='+datepicker+'&total_day_of_month='+total_day_of_month+'&cardno='+cardno+'&name='+name+'&atten='+atten+'&block_name='+block_name;
			//alert(datastr);
            if(name=='')
				{
							alert('Please Select vaild Emp');
							$("#cardno").focus();
				}					
			else
				{
					$.ajax({
					type	:'post',
					url		:'includes/fixed_extra_ot/fixed_eot_enty.php',
					data	:datastr,
					cache	:false,
					success	:function(str)
					{
						$('#msg').html(str);
						$('#msg').show();
						$('#cardno').focus();
						btn_reset();
					}
				
				});
			}
        });
		
		
		$('#btn_saveall').live('click',function(){
		
			var section_id			=$('#section_id').val();
			var block_name			=$('#block_name').val();
			var datepicker			=$('#date-picker').val();
			
			var atn_ids = document.getElementsByName('user_id[]');
			var a_ids	="";
			var eot		="";
			
			var len = atn_ids.length;
			//alert(len);
			for(var i=0; i<len; i++)
			{
				var id = atn_ids[i].value;
				//alert(id);
				if(a_ids=="")
					a_ids = atn_ids[i].value;
				else
					a_ids += '|'+atn_ids[i].value;
						
				var rate_field = 'eot'+id;
				if(eot=="")
					eot += document.getElementById(rate_field).value;
				else
					eot += '|'+document.getElementById(rate_field).value;	
			}
			var datastr = 'atn_ids='+a_ids+'&eot='+eot;
			
			$.ajax({
				type:"post",
				url:"includes/fixed_extra_ot/update_eot.php",
				data:datastr,
				success:function(str)
					{
						alert(str);
						
						$("#jq_tbl").load('includes/fixed_extra_ot/emp_list.php',{'section_id':section_id,'block_name':block_name,'datepicker':datepicker},function(){});	
							
					}
				});
				
			});	
});
</script>
<script>
var sec_id2='';
function get_block(sec_id)
{
    var datastr	='sec_id='+sec_id;
    $.ajax({
            type	:'post',
            url		:'includes/fixed_extra_ot/get_block.php',
            data	:datastr,
            cache	:false,
            success	:function(str)
            {
				var stringParts = str.split('!@#$');
				$('#block_id').html(stringParts[0]);
				
				sec_id2	=parseInt(stringParts[1]);
				
				$("#cardno").unbind('.autocomplete').autocomplete("includes/fixed_attendence_info/get_code_num.php?sec_id="+sec_id2, {
					 cacheLength: 1,
					 selectFirst: true
				});
				
            }
            
        });
}
function get_section(type_id)
{
	var datastr	='type_id='+type_id;
	$.ajax({
		type	:'post',
		url		:'includes/fixed_attendence_info/get_section.php',
		data	:datastr,
		cache	:false,
		success	:function(str)
		{
			
			$('#section_id').html(str);
			btn_reset();
		}
	});
}

function getname(card_no)
{
	var datastr	='card_no='+card_no;
	$.ajax({
			type	:'post',
			url		:'includes/fixed_salary_employee_info/get_name.php',
			data	:datastr,
			cache	:false,
			success	:function(str)
			{
				$('#name').val(str);	
			}
		});
}
function btn_reset()
{
	var cardno				=$('#cardno').val('');
	var name				=$('#name').val('');
	var eot					=$('#eot').val('');
	var atn_tab_id			=$('#atn_tab_id').val('');
	
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
        <h2> Extra OT All</h2>
      <div class="block" id ="block">
        <div class='message info' id="msg"></div>
          <div id="details">
            <table width="91%" class="form">
  <tr>
                	<td><label>Section Type</label></td><td><select id="section_type" name="section_type" onchange="get_section(this.value)" style="width:150px;">
                    	<option value="">NONE</option>
                        <option value="F">Fixed</option>
                        <option value="P">Production</option>
                        </select></td><td><label>Date</label></td><td><input type="text" id="date-picker" class="error" /></td>
                </tr>
				<tr>
                    <td  width="20%"><label>Section</label></td>
					
  					<td  width="29%">
  					  <select id="section_id" name="section_id" onchange="get_block(this.value)" style="width:150px;">
                   	  </select>
                  </td >
					
                  <td width="12%"><label>Block/Line</label></td>
                  <td width="39%">
                    <div id="block_id">
                    <select id="block_name" name="block_name" style="width:150px;">
                    	<option value="">None</option>
                    </select>
                    </div><br /><input type="button" name="btn_show" id="btn_show" value="Show" class="btn btn-blue" />
                    </td>
           	  </tr>
            </table>
		  </div>

        </div>

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