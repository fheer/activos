<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// Cargamos la librería HTML2PDF
require APPPATH.'third_party/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
class CEtiquetas extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Activofijo_model');
		//$this->load->library('qrcode/Ciqrcode');
	}

	public function print_labels($activofijo)
	{
		$html2pdf = new Html2Pdf();
		$data = $this->Activofijo_model->get_activofijo($activofijo);
		$i = 1;
		$content = '';
		//foreach ($data as $row) {
			$img = '<img src="'. base_url().'fotos/qr/'.$data['qr'].'" width="100" height="100">';
			$content .= '
			  <table border>'.'
				<tr>'.'
				  <td style="width: 20%;">
				  	<label align="center"><strong>U.E.E. - Cochabamba</strong></label>
				  	<br>
				  	<label align="center"><strong>U.A.F. '.date('Y').'</strong></label>
				  	  <br>
				   	<label align="center"><strong>Activo Fijo</strong></label>
				   	<br>
				   	<label align="center"><strong>Codigo: '.$data['codigo'].'</strong></label>
				  </td>
				  <td style="width: 80%;">'.$img.'</td>
				</tr>
			  '.
			 '</table>';
		//	$i++;
		//}

		$html2pdf->writeHTML($content);
		$html2pdf->output();
	}

	public function print_all_labels()
	{
		$html2pdf = new Html2Pdf();
		$data = $this->Activofijo_model->get_all_activofijo();
		$i = 1;
		$content = '<table border="1">';
		foreach ($data as $row) {
		$img = '<img src="'. base_url().'fotos/qr/'.$row['qr'].'" width="100" height="100">';
			if (($i == 1) ) {
				$content .=
					'<tr>'.'
					  <td align="center" colspan="2">
						<label ><strong>U.E.E. - Cochabamba</strong></label>
						<br>
						<label ><strong>U.A.F. '.date('Y').'</strong></label>
						  <br>
						<label ><strong>Activo Fijo</strong></label>
						<br>
						<label><strong>Código: '.$row['codigo'].'</strong></label>
					  </td>
					  <td>'.$img.'</td>
					';
			}else{
				$content .=
					'<td align="center" colspan="2">
						<label ><strong>U.E.E. - Cochabamba</strong></label>
						<br>
						<label><strong>U.A.F. '.date('Y').'</strong></label>
						 <br>
						<label><strong>Activo Fijo</strong></label>
						<br>
						<label><strong>Codigo: '.$row['codigo'].'</strong></label>
					</td>
					<td ">'.$img.'</td>';
				if ($i == 3){
					$i = 1;
					$content .= '</tr>';
				}
			}
			$i++;
		}
		$content .= '</table>';
		print_r($content);
		//$html2pdf->writeHTML($content);
		//$html2pdf->output();
	}
}
