
নাম<br />







<table style="font-family:solaimanlipi, Arial, Helvetica, sans-serif;">
	<tr>
    	<td>Name/নাম	:</td><td>Name/নাম	:</td><td>Name/নাম	:</td>
    </tr>
</table>
<?php
include('html2pdf.class.php');
$content = ob_get_clean();
try
{
	$html2pdf = new HTML2PDF('L', 'Legal', 'fr', true, 'UTF-8');
	$html2pdf-> pdf-> AddFont ('solaimanlipi', 'b', 'solaimanlipi.php');
	$html2pdf-> pdf-> SetFont ('solaimanlipi', 'b', 35);
	$html2pdf->pdf->SetDisplayMode('fullpage');
	$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
	$html2pdf->Output('mojid.pdf');
}
catch(HTML2PDF_exception $e) {
	echo $e;
	exit;
}

?>