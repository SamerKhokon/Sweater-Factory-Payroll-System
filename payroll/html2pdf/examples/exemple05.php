<?php

    ob_start();
    include(dirname(__FILE__).'/res/exemple05.php');
	 //include(dirname(__FILE__).'/res/exemple06.php');
  $content = ob_get_clean();

 	/*$content = file_get_contents(dirname(__FILE__).'/../_tcpdf_'.HTML2PDF_USED_TCPDF_VERSION.'/res/exemple05.php');
    $content = '<page style="font-family: freeserif"><br />'.nl2br($content).'</page>';
*/

    // convert to PDF
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('L', 'A4', 'fr');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('mojid.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>