<?php
	//$my_data = mysql_real_escape_string($q);		
	$my_data = trim($_GET['q']);	
	$con=mysql_connect('localhost','root','') or die("Database Error");
	mysql_select_db("test",$con);

	$sql="SELECT name FROM one WHERE  name LIKE '$my_data%' ORDER BY name asc";
	$result = mysql_query($sql);	
	if($result)
	{
		while($row=mysql_fetch_array($result))
		{
			echo $row['name']."\n";
		}
	}
?>