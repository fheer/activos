<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CFisicoActivo extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Transacciones_model');

		require_once  APPPATH.'controllers/reportes/PDF_MC_Table.php';
	}

	public function datos_transacciones($idActivofijo)
	{

		$data = $this->Transacciones_model->get_transacciones_activo($idActivofijo);
		//print_r($data);
		foreach ($data as $row) {
			$codigo = $row['codigo'];
			$valorInicial = $row['valorInicial'];
		}
		$pdf=new PDF_MC_Table();
		$pdf->AddPage();
		//Table with 20 rows and 4 columns
		$pdf->SetFont('Arial','B',12);

		$pdf->Cell(180,10,utf8_decode('Kardex Físico Valorado para el Activo: ').$codigo,0,0,'C');
		$pdf->Ln(5);
		$pdf->Cell(180,10,utf8_decode('Valor Inicial: ').$valorInicial,0,0,'C');
		$pdf->Ln(10);
		$pdf->SetWidths(array(10,140,30));
		$indice=1;
		$pdf->Row(array(utf8_decode("Nº"),"Transaccion",utf8_decode("Fecha")));
		$pdf->SetFont('Arial','',12);
		foreach ($data as $row) {
			$pdf->Row(array($indice,utf8_decode($row['tipoTransaccion']),utf8_decode($row['fecha'])));
			$indice++;
		}
		$pdf->Output("listafisico.pdf","I");
	}
}
