<?php if ( ! defined('BASEPATH')) {exit('No direct script access allowed'); }

class PdfGenerator {

	public function __construct() {

		require_once APPPATH.'third_party/dompdf/autoload.inc.php';

		use Dompdf/dompdf;

		$pdf = new DOMPDF();

		$CI =& get_instance();

		$CI->dompdf = $pdf;

	}

}