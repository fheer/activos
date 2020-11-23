<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CReporteEstado extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Estado_model');

		require_once  APPPATH.'third_party/fpdf/Fpdf.php';
	}

	public function datos_estado()
	{
		$data = $this->Estado_model->get_all_estado();

		$this->pdf = new FPDF();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(300,300,300);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(30);
		$this->pdf->Cell(120,10,'Lista de Estados',0,0,'C');

		$this->pdf->Ln(10);

		$this->pdf->Cell(30,5,utf8_decode("No."),'TBLR',0,'C',1);
		$this->pdf->Cell(150,5,utf8_decode("Estado"),'TBLR',0,'L',1);
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial','',12);
		$indice=1;
		foreach ($data as $row) {
			$estado=$row['estado'];

			$this->pdf->Cell(30,5,utf8_decode($indice),'TBLR',0,'C',1);
			$this->pdf->Cell(150,5,utf8_decode($estado),'TBLR',0,'L',1);
			$this->pdf->Ln(5);
			$indice++;
		}
		$this->pdf->Output("listestado.pdf","I");
	}

}
