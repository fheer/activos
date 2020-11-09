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
		$this->load->view('layout/header');
		$this->load->view('activos/vactivo',$data);
		$this->load->view('layout/footer');
	}

	/*
     * Adding a new Activo fijo
     */
	function add()
	{
		$this->formValidation();

		if($this->form_validation->run())
		{
			$params = $this->parametros();
			$activofijo_id = $this->Activofijo_model->add_activofijo($params);
			redirect('activos/Cactivofijo/index');
		}
		else
		{
			$data['tipoactivofijo'] = $this->Activofijo_model->get_all_tipoactivofijo();
			$data['estado'] = $this->Activofijo_model->get_all_estado();
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
			$param['qr'] = $obj->qr;
		}
		$data['tipoactivofijo'] = $this->Activofijo_model->get_all_tipoactivofijo();
		$data['estado'] = $this->Activofijo_model->get_all_estado();

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

		//decimos el directorio a guardar el codigo qr, en este
		//caso una carpeta en la raíz llamada qr_code
		$params['savename'] = FCPATH ."fotos/qr/qr_$code.png";
		//generamos el código qr
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

		$params = array(
			'idTipoActivoFijo' => $this->input->post('idTipoActivoFijo'),
			'codigo' => $this->onlyOneSpace($this->input->post('codigo')),
			'numeroSerie' => $this->onlyOneSpace($this->input->post('numeroSerie')),
			'nombre' => $this->onlyOneSpace($this->input->post('nombre')),
			'descripcion' => $this->onlyOneSpace($this->input->post('descripcion')),
			'imagen' => $this->subirImagen(),
			'estado' => $this->onlyOneSpace($this->input->post('idEstado')),
			'estado' => $this->onlyOneSpace($this->input->post('idEstado')),
			'qr' => $this->generateQR($code, $serie),
			'fechaCompra' => ($fechaCompra),
			'valorInicial' => $this->onlyOneSpace($this->input->post('valorInicial')),
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
