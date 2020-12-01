<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CReporteBaja extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Activofijo_model');

		require_once  APPPATH.'controllers/reportes/PDF_MC_Table.php';
	}

	public function datos_baja()
	{
		$de = date('Y').'-01-01';
		$hasta = date('Y').'-12-31';
		$data = $this->Activofijo_model->get_bajas_date($de, $hasta);

		$pdf=new PDF_MC_Table();
		$pdf->AddPage();
		//Table with 20 rows and 4 columns
			$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30);
		$pdf->Cell(120,10,utf8_decode('Lista Activos fijos dados de Baja Gestión ').date('Y'),0,0,'C');
		$pdf->Ln(10);
		$pdf->SetWidths(array(10,50,50,50,30));
		//srand(microtime()*1000000);
		$indice=1;
		$pdf->Row(array(utf8_decode("Nº"),"Activo Fijo",utf8_decode("Código"),utf8_decode("Motivo"),utf8_decode("Fecha")));
		$pdf->SetFont('Arial','',12);
		foreach ($data as $row) {
			$pdf->Row(array($indice,utf8_decode($row['nombre']),utf8_decode($row['codigo']),utf8_decode($row['motivo']),utf8_decode($row['fecha'])));
			$indice++;
		}
		$pdf->Output("listabajas.pdf","I");




	}
}
