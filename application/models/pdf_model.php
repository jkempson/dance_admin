<?php

class Pdf_model extends CI_Model
{
    public function load($html, $file, $orient)
    {
		  require_once('assets/dompdf/dompdf_config.inc.php');
		  $dompdf = new DOMPDF();
		  $dompdf->load_html($html);
		  $dompdf->set_paper("A4", $orient);
		  $dompdf->render();
		  $dompdf->stream($file, array("Attachment" => false));
    }
}
?>