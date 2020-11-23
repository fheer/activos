<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CReporteCargo  extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Cargo_model');

		require_once  APPPATH.'third_party/fpdf/Fpdf.php';
	}

	public function datos_cargo()
	{
		$data = $this->Cargo_model->get_all_cargo();

		$this->pdf = new FPDF();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(300,300,300);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(30);
		$this->pdf->Cell(120,10,'Lista de Cargos',0,0,'C');

		$this->pdf->Ln(10);

		$this->pdf->Cell(30,5,utf8_decode("No."),'TBLR',0,'C',1);
		$this->pdf->Cell(150,5,utf8_decode("Cargo"),'TBLR',0,'L',1);
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial','',12);
		$indice=1;
		foreach ($data as $row) {
			$cargo=$row['cargo'];

			$this->pdf->Cell(30,5,utf8_decode($indice),'TBLR',0,'C',1);
			$this->pdf->Cell(150,5,utf8_decode($cargo),'TBLR',0,'L',1);
			$this->pdf->Ln(5);
			$indice++;
		}
		$this->pdf->Output("listcargos.pdf","I");
	}
}
