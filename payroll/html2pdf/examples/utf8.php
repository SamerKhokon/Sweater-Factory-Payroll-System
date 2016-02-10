<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

    require_once(dirname(__FILE__).'/../html2pdf.class.php');
	$content = ob_get_clean();
    // get the HTML
    $content = file_get_contents(dirname(__FILE__).'/../_tcpdf_'.HTML2PDF_USED_TCPDF_VERSION.'/cache/bng.php');
    $content = '<page style="font-family: solaimanlipi"><br />'.nl2br($content).'</page>';

    // convert to PDF
    try
    {
        //$html2pdf = new HTML2PDF('P', 'A4', 'fr');
		$html2pdf = new HTML2PDF('L', 'Legal', 'fr', true, 'UTF-8');
		$html2pdf-> pdf-> AddFont ('solaimanlipi', 'b', 'solaimanlipi.php');
		//$html2pdf-> pdf-> AddFont ('gillsansstdb', 'b', 'gillsansstdb.php');
		//$html2pdf-> pdf-> AddFont ('nikoshban', 'b', 'nikoshban.php');
		$html2pdf-> pdf-> SetFont ('solaimanlipi', 'b', 35);
		//$html2pdf-> pdf-> SetFont ('avenirltstd45book', 'b', 35);
		//$html2pdf-> pdf-> SetFont ('nikoshban', 'b', 35);

        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('utf8.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }