<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//function pdf_create($html, $filename='', $stream=TRUE) 

function pdf_create($html, $filename='', $papersize = 'A4', $orientation = 'landscape', $stream=TRUE)
{
	
	
    require_once("system/helpers/dompdf/dompdf_config.inc.php");

    $dompdf = new DOMPDF();
	$dompdf->set_paper($papersize, $orientation);
    $dompdf->load_html($html);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } else {
        return $dompdf->output();
    }
}


?>