<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CActas extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Persona_model');
		$this->load->model('Activofijo_model');
		$this->load->model('Departamento_model');
		$this->load->model('Asignar_model');
		$this->load->add_package_path(APPPATH .'third_party/fpdf');
	}

	public function paginaHeaderFooter()
	{

		$pdf = new PDF();
		$pdf->AddPage('P','A4',0);
		$pdf->SetFont('Arial','B',12);
		// Se crean números para generar algunas páginas en el documento
		for ($i=0; $i < 200; $i++) {
			$pdf->Cell(0,10,utf8_decode('Repitiendo un número para ver header y footer ') . $i ,0,1,'C');
			$pdf->Ln();
		}
		$pdf->Output('paginaEnBlanco.pdf' , 'I' );
	}

	/*
	 public function formulario_aff05()
	{
		$data = $this->Persona_model->getPersonas();
		//$datos = $this->Mreport->getCadetes();
		//$datos = $datos->result();

		$this->pdf = new \FPDF();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(300,300,300);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(30);
		$this->pdf->Cell(120,10,'Lista del Personal',0,0,'C');

		$this->pdf->Ln(10);

		$this->pdf->Cell(10,5,utf8_decode("No."),'TBLR',0,'L',1);
		$this->pdf->Cell(80,5,utf8_decode("NOMBRES Y APELLIDOS"),'TBLR',0,'L',1);
		$this->pdf->Cell(30,5,utf8_decode("Telefono"),'TBLR',0,'L',1);
		$this->pdf->Cell(60,5,utf8_decode("email"),'TBLR',0,'L',1);
		$this->pdf->Ln(5);

		$indice=1;
		foreach ($data as $row) {
			$apellidoPaterno=$row->apellidoPaterno;
			$apellidoMaterno=$row->apellidoMaterno;
			$nombres=$row->nombres;
			$telefono=$row->telefono;
			$email=$row->email;
			$this->pdf->Cell(10,5,utf8_decode($indice),'TBLR',0,'L',1);
			$this->pdf->Cell(80,5,utf8_decode($apellidoPaterno.' '.$apellidoMaterno.' '.$nombres),'TBLR',0,'L',1);
			$this->pdf->Cell(30,5,utf8_decode($telefono),'TBLR',0,'L',1);
			$this->pdf->Cell(60,5,utf8_decode($email),'TBLR',0,'L',1);
			$this->pdf->Ln(5);
			$indice++;
		}

		$this->pdf->Output("listapersonal.pdf","I");
	}
	 */


}
