<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cactivofijo extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Activofijo_model');
		$this->load->library('qrcode/Ciqrcode');
	}

	/*
     * Listing of Activo fijo
     */
	function index()
	{
		$data['activofijo'] = $this->Activofijo_model->get_all_activofijo();
		$this->load->view('layout/header');
		$this->load->view('activos/vlista',$data);
		$this->load->view('layout/footer');
	}

	/*
	 * Go to Insert Activo fijo
	 */
	function insertActivo()
	{
		$data['tipoactivofijo'] = $this->Activofijo_model->get_all_tipoactivofijo();
		$data['estado'] = $this->Activofijo_model->get_all_estado();
		$data['lugar'] = $this->Activofijo_model->get_all_Lugar();
		$data['mensaje'] = '';
		$this->load->view('layout/header');
		$this->load->view('activos/vactivo',$data);
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
				$paramsMov = $this->parametros_movimientos();
				$ok = $this->Activofijo_model->add_activofijo($params, $paramsMov);

					redirect('activos/Cactivofijo/index');
			}
			else
			{
				$data['tipoactivofijo'] = $this->Activofijo_model->get_all_tipoactivofijo();
				$data['estado'] = $this->Activofijo_model->get_all_estado();
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
			$data['mensaje'] = 'El codigo: '.$this->input->post('codigo').'. Se encuentra registrado';
			$this->load->view('layout/header');
			$this->load->view('activos/vactivo',$data);
			$this->load->view('layout/footer');
		}
	}

	/*
     * Editing a activofijo
     */
	function edit()
	{
		// check if the activofijo exists before trying to edit it
		$idActivofijo = $this->input->post('idActivofijo');
		$data['activofijo'] = $this->Activofijo_model->get_activofijo($idActivofijo);

		if ($this->Activofijo_model->get_codigo($this->input->post('codigo')) == 0)
		{
			if(isset($data['activofijo']['idActivofijo']))
			{
				$this->formValidation();

				if($this->form_validation->run())
				{
					$params = $this->parametros();

					$this->Activofijo_model->update_activofijo($idActivofijo,$params);
					redirect('activos/Cactivofijo/index');
				}
				else
				{
					$this->select_activofijo($idActivofijo);
				}
			}
		}
		else
		{
			$data['tipoactivofijo'] = $this->Activofijo_model->get_all_tipoactivofijo();
			$data['estado'] = $this->Activofijo_model->get_all_estado();
			$data['mensaje'] = 'El codigo: '.$this->input->post('codigo').'. Se encuentra registrado';
			$this->load->view('layout/header');
			$this->load->view('activos/vactivo',$data);
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
				return $this->input->post('foto');
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
		$datos = json_encode($this->Activofijo_model->select_activofijo($idActivoFijo));
		$array = json_decode($datos);
		foreach($array as $obj){
			$param['idActivofijo'] = $idActivoFijo;
			$param['codigo'] = $obj->codigo;
			$param['numeroSerie'] = $obj->numeroSerie;
			$param['nombre'] = $obj->nombre;
			$param['descripcion'] = $obj->descripcion;
			$param['imagen'] = $obj->imagen;
			$param['estado'] = $obj->estado;
			$param['fechaCompra'] = $obj->fechaCompra;
			$param['valorInicial'] = $obj->valorInicial;
			$param['nombreEstado'] = $obj->estado;
			$param['idTipoActivoFijo'] = $obj->idTipoActivoFijo;
			$param['idLugar'] = $obj->idLugar;
			$param['lugar'] = $this->Activofijo_model->get_Lugar($obj->idLugar);
			$param['qr'] = $obj->qr;
		}
		$data['tipoactivofijo'] = $this->Activofijo_model->get_all_tipoactivofijo();
		$data['estado'] = $this->Activofijo_model->get_all_estado();
		$param['lugarAll'] = $this->Activofijo_model->get_all_Lugar();
		$this->load->view('layout/header');
		$this->load->view('activos/vuactivo',$param);
		$this->load->view('layout/footer');
	}

	/**
	 * Generate qr code
	 */
	private function generateQR($code, $serialNumber)
	{
		//hacemos configuraciones
		$params['data'] = $code.'#'.$serialNumber;
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
		$params = array(
			'idTipoActivoFijo' => trim($this->input->post('idTipoActivoFijo')),
			'codigo' => trim($this->onlyOneSpace($this->input->post('codigo'))),
			'numeroSerie' => trim($this->onlyOneSpace($this->input->post('numeroSerie'))),
			'nombre' => trim($this->onlyOneSpace($this->input->post('nombre'))),
			'descripcion' => trim($this->onlyOneSpace($this->input->post('descripcion'))),
			'imagen' => trim($this->subirImagen()),
			'estado' => trim($this->onlyOneSpace($this->input->post('idEstado'))),
			'estado' => trim($this->onlyOneSpace($this->input->post('idEstado'))),
			'qr' => trim($this->generateQR($code, $serie)),
			'fechaCompra' => trim(($fechaCompra)),
			'valorInicial' =>trim( $this->onlyOneSpace($this->input->post('valorInicial'))),
			//'idLugar' => $this->onlyOneSpace($this->input->post('idLugar')),
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
			'idLugar' => $this->onlyOneSpace($this->input->post('idLugar')),
			'fechaDe' => date("Y-m-d"),
			'fechaHasta' => $hasta,
			'fijo' => $fijo,
		);
		return $params;
	}

	/**
	 * Form validation method
	 */
	private function formValidation()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('codigo','Código','required|callback_alpha_dash');
		$this->form_validation->set_rules('numeroSerie','Número Serie','required|callback_alpha_dash');
		$this->form_validation->set_rules('nombre','Nombre','required|callback_alpha_space');
		$this->form_validation->set_rules('descripcion','Descripción','required|callback_alpha_space');
		$this->form_validation->set_rules('valorInicial','Valor Inicial','required|numeric');
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
		foreach($porciones as $posicion=>$jugador)
		{
			$nuevaCadena .=" ". $jugador;
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
}
