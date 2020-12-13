<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class CreportePersona extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Persona_model');

		//require_once  APPPATH.'third_party/fpdf/Fpdf.php';
		require_once  APPPATH.'controllers/reportes/PDF_MC_Table.php';
	}

	public function datosPersona()
	{
		$data = $this->Persona_model->getPersonas();

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
		$this->pdf->SetFont('Arial','',12);
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

	public function datosPersona_id($idPersona)
	{


		$data = $this->Persona_model->select_persona_id($idPersona);

		$pdf = new PDF_MC_Table();
		$pdf->AddPage();
		$pdf->AliasNbPages();
		$pdf->SetLeftMargin(15);
		$pdf->SetRightMargin(15);
		$pdf->SetFillColor(300,300,300);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(120,10,'C.I.: '.$data['ci']. ' ' .$data['expedido'],0,0,'L');
		$pdf->Ln(5);
		$pdf->Cell(120,10,'Nombres: '.utf8_decode($data['nombres']),0,0,'L');
		$pdf->Ln(5);
		$pdf->Cell(120,10,'Apellidos: '.utf8_decode($data['ap']). ' ' .utf8_decode($data['am']),0,0,'L');
		$pdf->Ln(5);
		$pdf->Cell(120,10,utf8_decode('Dirección: ').utf8_decode($data['direccion']),0,0,'L');
		$pdf->Ln(5);
		$pdf->Cell(120,10,utf8_decode('Telefono: ').$data['telefono'],0,0,'L');
		$pdf->Ln(5);
		$pdf->Cell(120,10,utf8_decode('Email: ').utf8_decode($data['email']),0,0,'L');
		$pdf->Ln(10);

		$pdf->Output("listapersonal.pdf","I");
	}
}
