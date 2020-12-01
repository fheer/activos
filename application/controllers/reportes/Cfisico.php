<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cfisico extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Persona_model');
		$this->load->model('Asignar_model');

		require_once  APPPATH.'controllers/reportes/PDF_MC_Table.php';
	}

	public function datos_fisico_valorado($idPersona)
	{
		$data = $this->Asignar_model->get_ativos_fijos_asignados_by_idpersona($idPersona);
		$data_persona = $this->Persona_model->get_persona($idPersona);
		$nombreCompleto = $data_persona['nombres'].' '.$data_persona['apellidoPaterno'].' '.$data_persona['apellidoMaterno'];
		$pdf = new PDF_MC_Table();
		$pdf->AddPage();

		//$pdf->Header();
		//Table with 20 rows and 4 columns
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30);
		$pdf->Cell(120,10,utf8_decode('Fisico Valorado Asignado a: ').$nombreCompleto,0,0,'C');
		$pdf->Ln(10);
		$pdf->SetWidths(array(10,50,50,30,50));

		$indice=1;
		$pdf->Row(array(utf8_decode("Nº"),"Activo Fijo",utf8_decode("Código"),utf8_decode("Fecha"),utf8_decode("Monto")));
		$pdf->SetFont('Arial','',12);
		$montoTotal = 0;
		foreach ($data as $row) {
			$pdf->Row(array($indice,utf8_decode($row['nombre']),utf8_decode($row['codigo']),utf8_decode($row['fechaCompra']),utf8_decode($row['valorInicial'].' Bs.')));
			$indice++;
			$montoTotal += 	$row['valorInicial'];
		}
		$pdf->Ln(5);
		$pdf->Cell(10,5,'','',0,'C',0);
		$pdf->Cell(50,5,'','',0,'C',0);
		$pdf->Cell(50,5,'','',0,'C',0);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,5,utf8_decode("Monto Total:"),'TBLR',0,'C',0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(50,5,$montoTotal.' Bs.','TBLR',0,'C',0);

		$pdf->Output("fisicovalorado.pdf","I");
	}
}
