<?php

class CEtiqueta extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Activofijo_model');

		require_once  APPPATH.'third_party/fpdf/Fpdf.php';
	}

	/*
     * Index of Etiquetas
     */
	function index()
	{
		$data['activofijo'] = $this->Activofijo_model->get_all_activofijo();
		$this->load->view('layout/header');
		$this->load->view('etiqueta/vlista',$data);
		$this->load->view('layout/footer');
	}

	function print_labels()
	{
		$this->pdf = new FPDF();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(300,300,300);
		$this->pdf->SetFont('Arial','B',8);

		$checkboxArray = $this->input->post('asignado');
		if (!empty($checkboxArray)) {
			$y=10;
			foreach ($checkboxArray as $checkbox)
			{
				$data = $this->Activofijo_model->get_activofijo($checkbox);
				date_default_timezone_set("America/La_Paz");
				$this->pdf->Cell(50,10,utf8_decode('UNIDAD EDUCATIVA DEL EJERCITO'),0,0,'C');
				$this->pdf->Ln(5);
				$this->pdf->Cell(50,10,utf8_decode('U.A.F. '.date('Y')),0,0,'C');
				$this->pdf->Ln(5);
				$this->pdf->Cell(50,10,utf8_decode('Activo Fijo '),0,0,'C');
				$this->pdf->Ln(5);
				$this->pdf->Cell(50,10,utf8_decode('COD. No.: '.$data['codigo']),0,0,'C');
				$this->pdf->Ln(5);
				$this->pdf->Image(base_url().'fotos/qr/'.$data['qr'],70, $y,25);
				$this->pdf->Ln(10);
				$y = $y + 220;
			}
		}
		$this->pdf->Output("etiquetas.pdf","I");
	}
}
