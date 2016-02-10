<style type="text/css">
<!--
table
{
    width:  94%;
    border: solid 1px #000;
}

th
{
    text-align: center;
    border: solid 1px #000;
    /*background: #EEFFEE;*/
	
}

td
{
    text-align: left;
    border: solid 1px #000;
}

td.col1
{
    border: solid 1px #000;
    text-align: right;
}


</style>
<table border="1" cellpadding="0" cellspacing="0">
    <col style="width: 5%" class="col1">
    <col style="width: 25%">
    <col style="width: 30%">
    <col style="width: 40%">
     
    
    <thead>
    	<tr>
        	<th colspan="5">আইডি
jjjj</th>
        </tr>
		
        <tr>
            <th rowspan="2">n°</th>
            <th rowspan="2">P°</th>
            <th colspan="3" style="font-size: 16px;">Title Header </th>
            
            
        </tr>
       
        <tr>
            <th>Colonne 1</th>
            <th>Colonne 2</th>
            <th>Colonne 3</th>
            
        </tr>
   
        
    </thead>
<?php
    for ($k=0; $k<=150; $k++) {
?>
    <tr>
        <td><?php echo $k; ?></td>
        <td><?php echo $k; ?></td>
        <td>test </td>
        <td>test </td>
        <td>test </td>
    </tr>
<?php
    }
?>
    <tfoot>
        <tr>
            <th colspan="5" style="font-size: 16px;">
                 Title footer
            </th>
        </tr>
    </tfoot>
</table>