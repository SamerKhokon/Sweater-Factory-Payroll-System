<?php
if ($c=OCILogon("payroll", "payroll123456", "ORCL"))
{
echo "c = $c<br />\n";
echo "Connected.<br />\n";
OCILogoff($c);
}

else
{
echo $err = OCIError();
echo "Oracle Connect Error " . $err[text];
}

?>


