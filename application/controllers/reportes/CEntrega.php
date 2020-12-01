<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CEntrega extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Activofijo_model');
		$this->load->model('Asignar_model');
		$this->load->model('Actas_model');
		$this->load->model('Estado_model');
		$this->load->model('Persona_model');
		//$this->load->add_package_path(APPPATH .'third_party/fpdf/Fpdf.php');
		require_once  APPPATH.'third_party/fpdf/Fpdf.php';
	}

	function ver_actas()
	{
		$data['persona'] = $this->Persona_model->get_all_persona();
		$this->load->view('layout/header');
		$this->load->view('reportes/vlista',$data);
		$this->load->view('layout/footer');
	}

	public function entrega_actas_pdf($idPersona)
	{
		$data = $this->Asignar_model->get_ativos_fijos_asignados_by_idpersona($idPersona);
		$dataPersona = $this->Persona_model->get_persona($idPersona);
		$firmas = $this->Persona_model->get_firmas($idPersona);
		$nombreJefe = $firmas['jefeAF'];
		$nombreEncargado = $firmas['encargado'];
		$ciJefe = $firmas['ciJefe'];
		$ciEncargado = $firmas['ciEncargado'];
		//--------------------------------------------------
		$datosPersona = $dataPersona['apellidoPaterno'].' '.$dataPersona['apellidoMaterno'].' '.$dataPersona['nombres'];
		$ciPersona = $dataPersona['ci'].' '.$dataPersona['expedido'];
		$numeroActa = $this->Actas_model->actas_count() + 1;
		date_default_timezone_set("America/La_Paz");
		$fecha = 'Cochabamba, '.date('d'). ' de '.$this->mesCastellano(date('m')).' de '.date('Y');
		$parrafo = utf8_decode('En la ciudad de Cochabamba, a horas '.date('H:i:s',time()).' del día, '.date('d/m/Y').
			' se procedió a la entrega de ITEMS al Sr(a) '.$datosPersona.' con Cedula de Identidad No. '.$ciPersona.' de acuerdo al siguiente detalle:');
		$constancia = 'En Constancia de nuestra conformidad, firmamos al pie de la presente Acta de Entrega.';
		//------------------------------------------------
		$firmaRecibe = 'Recibi Conforme';
		$firmaJefeAF = 'Entregue Conforme';
		$firmaEncargadoAF = 'Entregue Conforme';
		//-------------------------------------------------
		$pie = utf8_decode('Nota: A partir de la fecha queda como depositario de todos los ítems  que se detallan en el formulario, cualquier pérdida, destrucción o mal trato que pueda sufrir será imputada directamente a su persona, mientras no demuestre lo contrario.');
		$art146 =utf8_decode('* Queda prohibida la transferencia de bienes de un servicio a otro sin la participación de la Unidad de Activos Fijos de la  Cámara de Senadores. La contravención dará lugar a posible responsabilidad administrativa, civil y penal. De acuerdo al DS 0181 en su Art. 146 (Asignación de Activos Fijos Muebles) I. La asignación de activos fijos  muebles es el acto administrativo mediante el cual se entrega a un servidor público un activo o conjunto de éstos, generando la consiguiente responsabilidad sobre su debido uso y custodia.');
		$art145 =utf8_decode('* Cuando deje de pertenecer a la entidad, tiene la obligación de hacer la devolución de los activos asignados a su cargo, la omisión de esta instrucción dará lugar a una posible responsabilidad administrativa civil y penal. De acuerdo al DS 0181 Art. 148 (Liberación de la Responsabilidad) I. Para ser liberado de la responsabilidad el servidor público deberá devolver a la unidad o responsable de Activos Fijos, el o los bienes que estaban a su cargo, debiendo recabar la conformidad escrita de esta Unidad o responsable. Mientras no lo haga estará sujeto al régimen de responsabilidad por la función pública establecida en la Ley 1178 y sus reglamentos.');

		$this->pdf = new FPDF();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(300,300,300);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(30);
		$this->pdf->Cell(120,10,utf8_decode('ACTA DE ENTREGA DE ACTIVOS FIJOS'),0,0,'C');
		$this->pdf->Ln(5);
		$this->pdf->Cell(180,10,utf8_decode('U.A.F Nº   '.$numeroActa.'  /'. date('Y')),0,0,'C');
		$this->pdf->Ln(10);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->MultiCell(180,5,$parrafo,0,'J');
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(10,5,utf8_decode("Item"),'TBLR',0,'C',1);
		$this->pdf->Cell(40,5,utf8_decode("Código"),'TBLR',0,'L',1);
		$this->pdf->Cell(100,5,utf8_decode("Características"),'TBLR',0,'L',1);
		$this->pdf->Cell(30,5,utf8_decode("Estado"),'TBLR',0,'C',1);
		$this->pdf->Ln(5);
		$this->pdf->SetFont('Arial','',12);
		$indice=1;
		foreach ($data as $row) {
			$activoFijo = $this->Activofijo_model->get_activofijo($row['idActivofijo']);
			$codigoActivo=$activoFijo['codigo'];
			$descripcionActivo = $activoFijo['descripcion'];
			$estado = $this->Estado_model->get_nombre_estado($activoFijo['idEstado']);
			$descripcionEstado = $estado['estado'];

			$this->pdf->Cell(10,5,utf8_decode($indice),'TBLR',0,'C',1);
			$this->pdf->Cell(40,5,utf8_decode($codigoActivo),'TBLR',0,'L',1);
			$this->pdf->Cell(100,5,utf8_decode($descripcionActivo),'TBLR',0,'L',1);
			$this->pdf->Cell(30,5,utf8_decode($descripcionEstado),'TBLR',0,'C',1);
			$this->pdf->Ln(5);
			$indice++;
		}
		$this->pdf->Ln(5);
		$this->pdf->MultiCell(180,5,$constancia,0,'J');
		$this->pdf->Ln(30);
		$this->pdf->Cell(90,5,utf8_decode($firmaRecibe),0,0,'C',1);
		$this->pdf->Cell(90,5,utf8_decode($firmaEncargadoAF),0,0,'C',1);
		$this->pdf->Ln(5);
		$this->pdf->Cell(90,5,utf8_decode($datosPersona),0,0,'C',1);
		$this->pdf->Cell(90,5,utf8_decode($nombreEncargado),0,0,'C',1);
		$this->pdf->Ln(5);
		$this->pdf->Cell(90,5,utf8_decode($ciPersona),0,0,'C',1);
		$this->pdf->Cell(90,5,utf8_decode($ciEncargado),0,0,'C',1);
		$this->pdf->Ln(20);
		$this->pdf->Cell(180,5,utf8_decode($firmaJefeAF),0,0,'C',1);
		$this->pdf->Ln(5);
		$this->pdf->Cell(180,5,utf8_decode($nombreJefe),0,0,'C',1);
		$this->pdf->Ln(5);
		$this->pdf->Cell(180,5,utf8_decode($ciJefe),0,0,'C',1);
		$this->pdf->Ln(10);
		$this->pdf->Cell(180,5,utf8_decode($fecha),0,0,'R',1);
		$this->pdf->Ln(10);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->MultiCell(180,5,$pie,0,'J');
		$this->pdf->MultiCell(180,5,$art146,0,'J');
		$this->pdf->MultiCell(180,5,$art145,0,'J');
		$nombre = 'acta'.$numeroActa.'.pdf';
		$url = $_SERVER['DOCUMENT_ROOT'].'/activos/actas/'.$nombre.'.pdf';
		//$url = $_SERVER['DOCUMENT_ROOT'].'/activos/actas/'.'acta'.$numeroActa.'.pdf';
		//$url = $_SERVER['DOCUMENT_ROOT'].'/activos/actas/'.$nombre.'.pdf';
		$param = array(
			'url' => $nombre,
			'tipo' => 'E',
			'fecha' => date('Y-m-d H:mm:ss'),
		);
		$this->pdf->Output('F', $url);

		$this->Actas_model->add_acta($param);

		redirect(base_url().'acta/CActas/','refresh');

		$nombre = 'acta-devolucion'.$numeroActa.'.pdf';
	}

	public function mesCastellano($mes)
	{
		switch ($mes) {
			case 1:
				return "Enero";
				break;
			case 2:
				return "Febrero";
				break;
			case 3:
				return "Marzo";
				break;
			case 4:
				return "Abril";
				break;
			case 5:
				return "Mayo";
				break;
			case 6:
				return "Junio";
				break;
			case 7:
				return "Julio";
				break;
			case 8:
				return "Agosto";
				break;
			case 9:
				return "Septiembre";
				break;
			case 10:
				return "Octubre";
				break;
			case 11:
				return "Noviembre";
				break;
			case 12:
				return "Diciembre";
				break;
		}
	}
}


