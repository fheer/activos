<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CEtiquetas extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Activofijo_model');

		require_once  APPPATH.'third_party/fpdf/Fpdf.php';
		//require_once './assets/qrcode/qrcode.php';
		$this->load->library('qrcode/Ciqrcode');
	}

	public function print_labels()
	{
		$this->pdf = new FPDF();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(300, 300, 300);
		$this->pdf->SetFont('Arial', 'B', 12);
		$this->pdf->Cell(30);

		$data = $this->Activofijo_model->get_all_activofijo();

		$this->pdf->Cell(10, 5, utf8_decode("UNIDAD EDUCATIVA DEL EJERCITO"), 'TBLR', 0, 'C', 1);
		$this->pdf->Cell(40, 5, utf8_decode("Código"), 'TBLR', 0, 'L', 1);
		$this->pdf->Cell(100, 5, utf8_decode("Características"), 'TBLR', 0, 'L', 1);
		$this->pdf->Cell(30, 5, utf8_decode("Estado"), 'TBLR', 0, 'C', 1);
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial', '', 12);
		$indice = 1;
		foreach ($data as $row) {
			$activoFijo = $this->Activofijo_model->get_activofijo($row['idActivofijo']);
			$codigoActivo = $activoFijo['codigo'];
			$descripcionActivo = $activoFijo['descripcion'];
			$estado = $this->Estado_model->get_nombre_estado($activoFijo['idEstado']);
			$descripcionEstado = $estado['estado'];
			$qrcode = new QRcode($codigoActivo, 'H');
			// error level : L, M, Q, H
			$qrcode->displayFPDF($this->pdf, 115, 68, 14);
			//$this->pdf->Cell(32,  * 2, '', 1, 0, 'C');
			$this->pdf->Cell(10, 5, utf8_decode($indice), 'TBLR', 0, 'C', 1);
			$this->pdf->Cell(40, 5, utf8_decode($codigoActivo), 'TBLR', 0, 'L', 1);
			$this->pdf->Cell(100, 5, utf8_decode($descripcionActivo), 'TBLR', 0, 'L', 1);
			$this->pdf->Cell(30, 5, utf8_decode($descripcionEstado), 'TBLR', 0, 'C', 1);
			$this->pdf->Ln(5);
			$indice++;
		}
	}
}
