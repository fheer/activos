<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CEstado extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Estado_model');
	}

	/*
     * Index of estado
     */
	function index()
	{
		$data['estado'] = $this->Estado_model->get_all_estado();
		$this->load->view('layout/header');
		$this->load->view('estado/vlista',$data);
		$this->load->view('layout/footer');
	}

	/*
     * Load view of estado
     */
	function insert_estado()
	{
		$data['estado'] = $this->Estado_model->get_all_estado();
		$this->load->view('layout/header');
		$this->load->view('estado/vestado',$data);
		$this->load->view('layout/footer');
	}

	/*
	 * Go to Edit estado
	 */
	function update_estado($idestado)
	{
		$data['estado'] = $this->Estado_model->get_estado($idestado);
		//print_r($data);
		$this->load->view('layout/header');
		$this->load->view('estado/vuestado',$data);
		$this->load->view('layout/footer');
	}

	/*
     * Adding a new Activo fijo
     */
	function add()
	{

		$this->formValidation();
		if($this->form_validation->run()) {
			$estado = $this->Estado_model->validate_estado(trim($this->input->post('estado')));
			if ($estado == 0)
			{
				$params = $this->parametros();
				$response = $this->Estado_model->add_estado($params);
				if($response > 0){
					redirect('estado/Cestado/index');
				}else{
					$data['mensaje'] = 'El Estado NO fue registrado, hubo errores';
					$this->load->view('layout/header');
					$this->load->view('estado/vestado',$data);
					$this->load->view('layout/footer');
				}
			}
			else
			{
				$data['mensaje'] = 'El Estado: '.$this->input->post('estado').'. Se encuentra registrado';
				$this->load->view('layout/header');
				$this->load->view('estado/vestado',$data);
				$this->load->view('layout/footer');
			}
		}
		else
		{
			$data['mensaje'] = '';
			$this->load->view('layout/header');
			$this->load->view('estado/vestado',$data);
			$this->load->view('layout/footer');
		}
	}

	/*
    * Editing a persona
    */
	function edit()
	{
		$idestado = $this->input->post('idEstado');

			$this->load->library('form_validation');

			$this->formValidation();

			if($this->form_validation->run())
			{
				$params = $this->parametros();

				$this->Estado_model->update_estado($idestado, $params);

				redirect(base_url().'estado/Cestado');
			}
			else
			{
				$this->update_estado($idestado);
			}
	}

	/*
     * Deleting persona
     */
	function remove()
	{
		$idestado = $this->input->post('idEstadoDelete');

		$params = array(
			'eliminado' => 0,
		);

		$this->Estado_model->delete_estado($idestado, $params);

		redirect('estado/Cestado/index');

	}

	/**
	 * Form validation method
	 */
	private function formValidation()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('estado','estado','required|callback_alpha_space');
	}

	/**
	 * Parameters Method
	 */
	private function parametros()
	{
		date_default_timezone_set("America/La_Paz");
		$params = array(
			'estado' => trim($this->input->post('estado')),
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
}
