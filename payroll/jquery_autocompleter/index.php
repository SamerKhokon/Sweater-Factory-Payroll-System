<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Auto Complete Input box</title>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.autocomplete.js"></script>
<script>
$(document).ready(function(){
    $("#tag").focus();
	$("#tag").autocomplete("action.php", {
		selectFirst: true
	});
	$('#bangla_btn').click(function(){
	   var bangla = $('#bangla').val();
	   $.ajax({
	     type:'post' ,
		 url:'x.php' ,
		 data:'bangla='+bangla,
		 success:function(st){
		   
		 }
	   });
	});
});
</script>
</head>
<body>
    <label>Tag:</label>
    <input name="tag" type="text" id="tag" size="50"/>
</body>
</html>
