<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cactivofijo extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Activofijo_model');
		$this->load->model('Asignar_model');
		$this->load->model('Obtenido_model');
		$this->load->model('Estado_model');
		$this->load->model('Departamento_model');
		$this->load->model('Motivobaja_model');
		$this->load->model('Transacciones_model');
		$this->load->library('qrcode/Ciqrcode');
	}

	public function get_data_depreciacion($idActivofijo)
	{
		$data['depreciacion'] = $this->Transacciones_model->get_data_depreciacion($idActivofijo);
		$data['activofijo'] = $this->Activofijo_model->get_activofijo($idActivofijo);
		$data_tipo = $this->Activofijo_model->get_activofijo($idActivofijo);
		$idTipoActivoFijo = $data_tipo['idTipoActivoFijo'];
		$data['vidautil'] = $this->Activofijo_model->get_tipoactivofijo($idTipoActivoFijo);
		$this->load->view('layout/header');
		$this->load->view('activos/vlistadepreciacion',$data);
		$this->load->view('layout/footer');
	}

	/*
     * Index of Activo fijo
     */
	function index()
	{
		$data['activofijo'] = $this->Activofijo_model->get_all_activofijo();
		$this->load->view('layout/header');
		$this->load->view('activos/vlista',$data);
		$this->load->view('layout/footer');
	}

	/*
     * Get activofijo by idActivofijo
     */
	function get_activofijo($idActivofijo)
	{
		return $this->Activofijo_model->get_activofijo($idActivofijo);
	}

	/*
     * Listing of Activo fijo
     */
	function ver($codigo)
	{
		$data['activofijo'] = $this->Activofijo_model->get_activofijo_codigo_numeroSerie($codigo);
		//$this->load->view('layout/header');
		$this->load->view('activos/vmostrar',$data);
		//$this->load->view('layout/footer');
	}

	/*
	 * Go to Insert Activo fijo
	 */
	function insertActivo()
	{
		$data['tipoactivofijo'] = $this->Activofijo_model->get_all_tipoactivofijo();
		$data['estado'] = $this->Activofijo_model->get_all_estado();
		$data['obtenido'] = $this->Obtenido_model->get_all_obtenido();
		$data['mensaje'] = '';
		$this->load->view('layout/header');
		$this->load->view('activos/vactivo',$data);
		$this->load->view('layout/footer');
	}

	function baja_activo()
	{
		$data['activo'] = $this->Activofijo_model->get_all_activofijo();
		$data['motivo'] = $this->Motivobaja_model->get_all_motivobaja();
		$data['mensaje'] = '';

		$this->load->view('layout/header');
		$this->load->view('activos/vbaja',$data);
		$this->load->view('layout/footer');
	}

	/*
	 *
	 */
	function listadepreciacion($vidaUtil, $valorInicial)
	{
		//$idActivofijo = $this->input->post('idActivofijo');
		$data['activo'] = $this->Activofijo_model->get_all_activofijo();
		//$data['motivo'] = $this->Motivobaja_model->get_all_motivobaja();

		$data['mensaje'] = '';

		$this->load->view('layout/header');
		$this->load->view('activos/vlistadepreciacion',$data);
		$this->load->view('layout/footer');

	}

	/*
     * Adding a new Activo fijo
     */
	function add()
	{

		if ($this->Activofijo_model->get_codigo($this->input->post('codigo')) == 0)
		{
			$this->formValidation();

			if($this->form_validation->run())
			{
				$params = $this->parametros();
				$response = $this->Activofijo_model->add_activofijo($params,$this->input->post('idPersona'));
				if($response>0){

					$idActivofijo = $response;
					$data = $this->Activofijo_model->get_activofijo($idActivofijo);

					$idTipoActivoFijo = $data['idTipoActivoFijo'];
					$data_activo = $this->Activofijo_model->get_tipoactivofijo($idTipoActivoFijo);

					$vidaUtil = $data_activo['vidautil'];
					$valorInicial = $this->input->post('valorInicial');

					$valorDepreciacion = $this->calcular_cuota_depreciacion($vidaUtil, $valorInicial);

					for ($i=1;$i<=$vidaUtil;$i++)
					{
						$valorAcumuladoDepreciacion = $valorDepreciacion * $i;
						$params = array(
							'valorInicial' => $valorInicial,
							'valorDepreciacion' => $valorDepreciacion,
							'valorAcumuladoDepreciacion' => $valorAcumuladoDepreciacion,
							'idActivofijo' => $idActivofijo,
						);
						$this->Transacciones_model->add_transacciones($params);
					}
					echo $idActivofijo.'<br>';
					redirect('activos/Cactivofijo/index');
				}else{
					$data['tipoactivofijo'] = $this->Activofijo_model->get_all_tipoactivofijo();
					$data['estado'] = $this->Activofijo_model->get_all_estado();
					$data['obtenido'] = $this->Obtenido_model->get_all_obtenido();
					$data['mensaje'] = 'El Activo fijo NO fue registrado, porque hubo errores';
					$this->load->view('layout/header');
					$this->load->view('activos/vactivo',$data);
					$this->load->view('layout/footer');
				}
			}
			else
			{
				$data['tipoactivofijo'] = $this->Activofijo_model->get_all_tipoactivofijo();
				$data['estado'] = $this->Activofijo_model->get_all_estado();
				$data['departamento'] = $this->Departamento_model->get_all_departamento();
				$data['obtenido'] = $this->Obtenido_model->get_all_obtenido();
				$data['mensaje'] = '';
				$this->load->view('layout/header');
				$this->load->view('activos/vactivo',$data);
				$this->load->view('layout/footer');
			}
		}
		else
		{
			$data['tipoactivofijo'] = $this->Activofijo_model->get_all_tipoactivofijo();
			$data['estado'] = $this->Activofijo_model->get_all_estado();
			$data['obtenido'] = $this->Obtenido_model->get_all_obtenido();
			$data['mensaje'] = 'El codigo: '.$this->input->post('codigo').'. Se encuentra registrado';
			$this->load->view('layout/header');
			$this->load->view('activos/vactivo',$data);
			$this->load->view('layout/footer');
		}
	}

	/**
	 * @param $vidaUtil
	 * @param $valorInicial
	 * @return float|int
	 */
	function calcular_cuota_depreciacion($vidaUtil, $valorInicial) {
			return $valorInicial / $vidaUtil ;
	}

	function get_format($df) {

		$str = '';
		$str .= ($df->invert == 1) ? ' - ' : '';
		if ($df->y > 0) {
			$str .= $df->y;
		} else{
			$str = 0;
		}
		return $str;
	}
	/*
     * Editing a activofijo
     */
	function edit()
	{
		$idActivofijo = $this->input->post('idActivofijo');
		if ($this->Activofijo_model->get_codigo($this->input->post('codigo')) > 0) {
			$this->formValidation();

			if($this->form_validation->run())
			{
				$params = $this->parametros();
				echo 'llego aqui';
				$this->Activofijo_model->update_activofijo($idActivofijo, $params);
				redirect('activos/Cactivofijo/','refresh');
			}
			else
			{
				$data['tipoactivofijo'] = $this->Activofijo_model->get_all_tipoactivofijo();
				$data['estado'] = $this->Activofijo_model->get_all_estado();
				$data['update'] = $this->Activofijo_model->get_activofijo($idActivofijo);
				$data['obtenido'] = $this->Obtenido_model->get_all_obtenido();
				$data['mensaje'] = '';
				$this->load->view('layout/header');
				$this->load->view('activos/vuactivo',$data);
				$this->load->view('layout/footer');
			}
		}
		else
		{
			$data['tipoactivofijo'] = $this->Activofijo_model->get_all_tipoactivofijo();
			$data['estado'] = $this->Activofijo_model->get_all_estado();
			$data['update'] = $this->Activofijo_model->get_activofijo($idActivofijo);
			$data['obtenido'] = $this->Obtenido_model->get_all_obtenido();
			$data['mensaje'] = 'El codigo: '.$this->input->post('codigo').'. NO Se encuentra registrado';
			$this->load->view('layout/header');
			$this->load->view('activos/vuactivo',$data);
			$this->load->view('layout/footer');

		}

	}

	/*
     * Deleting activofijo
     */
	function remove()
	{
		$idActivofijo = $this->input->post('idActivoDelete');

		$params = array(
			'eliminado' => 0,
		);
		if(isset($idActivofijo))
		{
			$this->Activofijo_model->delete_activofijo($idActivofijo,$params);
			redirect(base_url()."activos/Cactivofijo");
		}
	}

	/*
     * Baja Activo Fijo
     */
	function baja()
	{
		$this->formValidation_baja();

			if($this->form_validation->run())
			{
				date_default_timezone_set("America/La_Paz");
				foreach ($_POST['idActivofijo'] as $idsActivos)
				{
					$params = array(
						'idActivofijo' => $idsActivos,
						'idMotivoBaja' => $this->input->post('idMotivo'),
						'observaciones' => $this->input->post('observaciones'),
						'fecha' => date('Y-m-d'),
					);
					$success = $this->Activofijo_model->add_baja($idsActivos, $params);
				}

				if ($success) {
					$data['activo'] = $this->Activofijo_model->get_all_activofijo();
					$data['mensaje'] = '';
					redirect(base_url()."activos/Cactivofijo/list_bajas");
				}
			}
			else
			{
				$data['activo'] = $this->Activofijo_model->get_all_activofijo();
				$data['motivo'] = $this->Motivobaja_model->get_all_motivobaja();
				$data['mensaje'] = '';

				$this->load->view('layout/header');
				$this->load->view('activos/vbaja',$data);
				$this->load->view('layout/footer');
			}
	}

	function list_bajas()
	{
		$data['bajas'] = $this->Activofijo_model->list_bajas();
		$this->load->view('layout/header');
		$this->load->view('activos/vlistabaja',$data);
		$this->load->view('layout/footer');
	}

	/*
	 * Upload photo
	 */
	public function subirImagen(){
		$config['upload_path'] = './fotos/activos/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '2048';
		$config['max_width'] = '2024';
		$config['max_height'] = '2008';

		$this->load->library('upload',$config);

		if (!$this->upload->do_upload("archivo")) {
			if ($this->input->post('option')==1){
				return $this->input->post('imagen');
			}else{
				return "sinfoto.jpg";
			}
		} else {
			$file_info = $this->upload->data();
			$imagen = $file_info['file_name'];
			$data['imagen'] = $imagen;
			return $imagen;
		}
	}

	/**
	 * Go to form update activo fijo
	 */
	public function select_activofijo($idActivoFijo)
	{
		$data['update'] = $this->Activofijo_model->select_activofijo($idActivoFijo);
		$data['obtenido'] = $this->Obtenido_model->get_all_obtenido();
		$data['tipoactivofijo'] = $this->Activofijo_model->get_all_tipoactivofijo();
		$data['estado'] = $this->Estado_model->get_all_estado();

		$this->load->view('layout/header');
		$this->load->view('activos/vuactivo',$data);
		$this->load->view('layout/footer');
	}

	/**
	 * Generate qr code
	 */
	private function generateQR($code)
	{
		//hacemos configuraciones
		$params['data'] = base_url()."activos/Cactivo/ver/".$code;
		$params['level'] = 'H';
		$params['size'] = 10;

		$params['savename'] = FCPATH ."fotos/qr/qr_$code.png";

		$this->ciqrcode->generate($params);

		return "qr_$code.png";
	}

	/**
	 * Parameters Method
	 */
	private function parametros()
	{
		$code = $this->input->post('codigo');
		date_default_timezone_set("America/La_Paz");
		$params = array(
			'idTipoActivoFijo' => trim($this->input->post('idTipoActivoFijo')),
			'codigo' => trim($this->onlyOneSpace($this->input->post('codigo'))),
			'numeroSerie' => trim($this->onlyOneSpace($this->input->post('numeroSerie'))),
			'nombre' => trim($this->onlyOneSpace($this->input->post('nombreActivo'))),
			'descripcion' => trim($this->onlyOneSpace($this->input->post('descripcion'))),
			'imagen' => trim($this->subirImagen()),
			'idEstado' => trim($this->onlyOneSpace($this->input->post('idEstado'))),
			'qr' => trim($this->generateQR($code)),
			'fechaCompra' => $this->input->post('fechaCompra'),
			'valorInicial' =>trim($this->onlyOneSpace($this->input->post('valorInicial'))),
			'idPersona' =>trim(($this->input->post('idPersona'))),
			'idObtenido' =>trim(($this->input->post('idObtenido'))),
		);
		return $params;
	}

	/**
	 * Parameters Method to movimientos;
	 */
	private function parametros_movimientos()
	{
		$fechaCompra = $this->input->post('anio')."-".$this->input->post('mes')."-".$this->input->post('dia');
		$code = $this->input->post('codigo');
		$serie = $this->input->post('numeroSerie');
		$checkbox = $this->input->post('fijo');
		if ($checkbox)
		{
			$fijo = 1;
		}
		else{
			$fijo = 0;
		}
		$idActivofijo = $this->Activofijo_model->get_last_id()+ 1;
		$vidautil = $this->Activofijo_model->get_vida_util($this->input->post('idTipoActivoFijo'));
		$anio = date("Y");
		$mes = date("m");
		$dia = date("d");
		$hasta = $anio+$vidautil."-".$mes."-".$dia;
		$params = array(
			'idActivofijo' => $idActivofijo,
			'movimiento' => "Asignado",
			'idDepartamento' => $this->onlyOneSpace($this->input->post('idDepartamento')),
			'fechaDe' => date("Y-m-d"),
			'fechaHasta' => $hasta,
			'fijo' => $fijo,
		);
		return $params;
	}

	/**
	 * Form validation method insert and update
	 */
	private function formValidation()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('codigo','Código','required');
		$this->form_validation->set_rules('numeroSerie','Número Serie','required|callback_alpha_dash|min_length[5]|max_length[35]');
		$this->form_validation->set_rules('nombreActivo','Nombre','required|callback_alpha_space|min_length[6]|max_length[45]');
		$this->form_validation->set_rules('descripcion','Descripción','required');
		$this->form_validation->set_rules('valorInicial','Valor Inicial','required|numeric');
		$this->form_validation->set_rules('idPersona','Nombre personal','required');
	}

	/**
	 * Form validation method baja
	 */
	private function formValidation_baja()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('observaciones','Observaciones','required|callback_alpha_dash');
	}

	/**
	 * Alpha and spaces
	 *
	 * @param	string
	 * @return	bool
	 */
	public function alpha_space($str)
	{

		if (preg_match('/^[a-záéíóú ]+$/i', $str))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('alpha_space', 'El campo {field} solo puede contener caracteres alfabéticos y un espacio.');
			return FALSE;
		}
	}
	// --------------------------------------------------------------------

	/**
	 * Alpha
	 *
	 * @param	string
	 * @return	bool
	 */
	public function alpha($str)
	{
		if (preg_match('/^[a-záéíóú]+$/i', $str))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('alpha', 'El campo {field} solo puede contener caracteres alfabéticos.');
			return FALSE;
		}
	}
	// --------------------------------------------------------------------

	/**
	 * address
	 *
	 * @param	string
	 * @return	bool
	 */
	public function address($str)
	{

		if (preg_match('/^[A-Z0-9áéíóú.# ]+$/i', $str))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('address', 'El campo {field} solo puede contener caracteres alfabéticos . y/o #  .');
			return FALSE;
		}
	}

	/**
	 * @param string
	 * @return string
	 */
	public function onlyOneSpace($srt)
	{
		$porciones = explode(" ", $srt);
		$nuevaCadena= "";
		foreach($porciones as $posicion=>$cadena)
		{
			$nuevaCadena .=$cadena. " ";
		}
		return $nuevaCadena;
	}

	/**
	 * Alpha-numeric with underscores and dashes
	 *
	 * @param	string
	 * @return	bool
	 */
	public function alpha_dash($str)
	{
		if (preg_match('/^[0-9-a-zA-Z]+$/i', $str))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('ci', 'El campo {field} puede contener números al empezar, y/0 guión y 
			caracteres alfabéticos.');
			return FALSE;
		}
	}

	/**
	 * Generate codiogo activo fijo
	 */
	public function generate_code_af()
	{
		$contarActivos = $this->Activofijo_model->activo_fijo_count_generar() + 1;
		echo 'UEE-C-AF-'.$contarActivos;
	}

}
