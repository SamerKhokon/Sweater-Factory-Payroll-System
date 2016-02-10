<?php
function tbl_header($dateid)
{
global	$conn;
$sql	="select COMPANY_NAME,ADDRESS,ID from TBL_COMPANY_INFO where ID='".$_SESSION['company_id']."'";
$stm  = oci_parse($conn,$sql);
oci_execute($stm);
if($rs = oci_fetch_array($stm,OCI_BOTH))
{
	$com_name =$rs[0];
	$com_add =$rs[1];	
}
return $tbl_h	='<table border="0" cellpadding="0" cellspacing="0"  align="center" class="head">
	<tr>
       <td align="left"><img src="../company_logo/1.gif" /></td>
     </tr>
     <tr>
     	<td>'.$com_add.'<br>&nbsp;</td>
     </tr>
     <tr>
     <td>'.$dateid.'</td>
     </tr>
</table>';	
}
function tbl_footer()
{
	
}
?>