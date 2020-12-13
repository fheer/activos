<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CTipoActivo extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('TipoActivo_model');
	}

	function get_persona_by_tipo($idtipo)
	{
		echo  json_encode($this->TipoActivo_model->get_persona_by_tipo($idtipo));
	}

	/*
     * Index of tipo
     */
	function index()
	{
		$data['tipoactivo'] = $this->TipoActivo_model->get_all_tipoactivofijo();
		$this->load->view('layout/header');
		$this->load->view('tipo/vlista',$data);
		$this->load->view('layout/footer');
	}

	/*
     * Load view of tipo
     */
	function insert_tipo()
	{
		$data['tipoactivo'] = $this->TipoActivo_model->get_all_tipoactivofijo();
		$this->load->view('layout/header');
		$this->load->view('tipo/vtipo',$data);
		$this->load->view('layout/footer');
	}

	/*
	 * Go to Edit tipo
	 */
	function update_tipo($idtipo)
	{
		$data['tipo'] = $this->TipoActivo_model->get_tipoactivofijo($idtipo);
		//print_r($data);
		$this->load->view('layout/header');
		$this->load->view('tipo/vutipo',$data);
		$this->load->view('layout/footer');
	}

	/*
     * Adding a new Activo fijo
     */
	function add()
	{
		$this->formValidation();
		if($this->form_validation->run()) {
			$tipo = $this->TipoActivo_model->validate_tipo_activo(trim($this->input->post('tipo')));
			if ($tipo == 0)
			{
				$params = $this->parametros();
				$response = $this->TipoActivo_model->add_tipoactivofijo($params);
				if($response > 0){
					redirect('tipo/CTipoActivo/index');
				}else{
					$data['mensaje'] = 'El Tipo de Activo Fijo NO fue registrado, hubo errores';
					$this->load->view('layout/header');
					$this->load->view('tipo/vtipo',$data);
					$this->load->view('layout/footer');
				}
			}
			else
			{
				$data['mensaje'] = 'El Tipo de Activo Fijo: '.$this->input->post('tipo').'. Se encuentra registrado';
				$this->load->view('layout/header');
				$this->load->view('tipo/vtipo',$data);
				$this->load->view('layout/footer');
			}
		}
		else
		{
			$data['mensaje'] = '';
			$this->load->view('layout/header');
			$this->load->view('tipo/vtipo',$data);
			$this->load->view('layout/footer');
		}
	}

	/*
    * Editing a persona
    */
	function edit()
	{
		$idtipo = $this->input->post('idTipoActivoFijo');
		// check if the persona exists before trying to edit it
		//$data['tipo'] = $this->tipo_model->get_tipo($idtipo);

		$this->load->library('form_validation');

		$this->formValidation();

		if($this->form_validation->run())
		{
			$params = $this->parametros();

			$this->TipoActivo_model->update_tipoactivofijo($idtipo,$params);

			redirect(base_url().'tipo/CTipoActivo');
		}
		else
		{
			$this->update_tipo($idtipo);
		}
	}

	/*
     * Deleting persona
     */
	function remove()
	{
		$idtipo = $this->input->post('idTipoActivoFijoDelete');

		$params = array(
			'eliminado' => 0,
		);

		$this->TipoActivo_model->delete_tipoactivofijo($idtipo, $params);

		redirect('tipo/CTipoActivo');

	}

	/**
	 * Form validation method
	 */
	private function formValidation()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('tipo','Tipo de Activo Fijo','required|callback_alpha_space|min_length[7]|max_length[55]');
		$this->form_validation->set_rules('vidautil','Vida Util','required|callback_numeric');
	}

	/**
	 * Parameters Method
	 */
	private function parametros()
	{
		date_default_timezone_set("America/La_Paz");
		$params = array(
			'tipo' => trim($this->input->post('tipo')),
			'vidautil' => trim($this->input->post('vidautil')),
		);
		return $params;
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
	 * Numeric
	 *
	 * @param	string
	 * @return	bool
	 */
	public function numeric($str)
	{
		if (preg_match('/^[0-9]+$/', $str))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('numeric', 'El campo {field} solo puede contener números enteros.');
			return FALSE;
		}
	}
}


