 <div class="grid_2">
    <div class="box sidemenu">
        <div class="block" id="section-menu">
            <ul class="section menu">
            <?php




$sql="select * from menu order by order_id";	  			 
$result=mysql_query($sql)
       or die(mysql_error());
 

while($row=mysql_fetch_array($result))
{   



$main_menu_id=$row['menu_id'];
$sql_sub="select * from sub_menu1 where main_menu_id =$main_menu_id";			
$result_sub=mysql_query($sql_sub);


      
while($row_sub=mysql_fetch_array($result_sub))
{	   
$sub_menu_name=$row_sub["sub_menu_name"];
$sub_menu_content=$row_sub["sub_menu_content"];	
$main_menu_id=$row_sub["main_menu_id"]; 
$sm_id=$row_sub["sub_menu_id"];
    
echo "<li><a class='menuitem' href=\"index.php?pagetitle=$sub_menu_content&menu_id=$main_menu_id&sm_id=$sm_id\">$sub_menu_name</a><ul class='submenu'>
                        <li><a>Submenu 1</a> </li>
                        <li><a>Submenu 2</a> </li>
                      
                    </ul>
                </li>";  		 
}

}
?>
            </ul>
        </div>
    </div>
</div>