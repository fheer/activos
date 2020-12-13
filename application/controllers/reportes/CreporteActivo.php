<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CreporteActivo extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Activofijo_model');

		require_once  APPPATH.'controllers/reportes/PDF_MC_Table.php';
	}

	public function datosActivo()
	{

		$data = $this->Activofijo_model->get_all_activofijo();

		$pdf=new PDF_MC_Table();
		$pdf->AddPage();
		//Table with 20 rows and 4 columns
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30);
		$pdf->Cell(120,10,utf8_decode('Lista Activos fijos'),0,0,'C');
		$pdf->Ln(10);
		$pdf->SetWidths(array(10,30,40,40,60));
		//srand(microtime()*1000000);
		$indice=1;
		$pdf->Row(array(utf8_decode("Nº"),utf8_decode("Código"),utf8_decode("Activo Fijo"),utf8_decode("Número de serie"),utf8_decode("Descripcion")));
		$pdf->SetFont('Arial','',11);
		foreach ($data as $row) {
			$pdf->Row(array($indice,utf8_decode($row['codigo']),utf8_decode($row['nombre']),utf8_decode($row['numeroSerie']),utf8_decode($row['descripcion'])));
			$indice++;
		}
		$pdf->Output("listabajas.pdf","I");
	}

}
