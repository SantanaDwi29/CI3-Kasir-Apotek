<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function pdf_create($html, $filename='', $paper='A4', $orientation='portrait') {
    require_once("./application/libraries/dompdf/autoload.inc.php");
    
    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paper, $orientation);
    $dompdf->render();
    
    if($filename) {
        $dompdf->stream($filename.".pdf", array("Attachment" => 0));
    } else {
        return $dompdf->output();
    }
}