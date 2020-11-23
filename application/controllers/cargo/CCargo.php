<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CCargo extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Cargo_model');
	}

	/*
     * Index of Cargo
     */
	function index()
	{
		$data['cargo'] = $this->Cargo_model->get_all_cargo();
		$this->load->view('layout/header');
		$this->load->view('cargo/vlista',$data);
		$this->load->view('layout/footer');
	}

	/*
     * Load view of Cargo
     */
	function insert_cargo()
	{
		$data['cargo'] = $this->Cargo_model->get_all_cargo();
		$this->load->view('layout/header');
		$this->load->view('cargo/vcargo',$data);
		$this->load->view('layout/footer');
	}

	/*
	 * Go to Edit Cargo
	 */
	function update_cargo($idCargo)
	{
		$data['cargo'] = $this->Cargo_model->get_cargo($idCargo);
		//print_r($data);
		$this->load->view('layout/header');
		$this->load->view('cargo/vucargo',$data);
		$this->load->view('layout/footer');
	}

	/*
     * Adding a new Activo fijo
     */
	function add()
	{

		$this->formValidation();
		if($this->form_validation->run()) {
			$cargo = $this->Cargo_model->validate_cargo(trim($this->input->post('cargo')));
			if ($cargo == 0)
			{
				$params = $this->parametros();
				$response = $this->Cargo_model->add_cargo($params);
				if($response > 0){
					redirect('cargo/CCargo/index');
				}else{
					$data['mensaje'] = 'El Activo fijo NO fue registrado, porque hubo errores';
					$this->load->view('layout/header');
					$this->load->view('cargo/vcargo',$data);
					$this->load->view('layout/footer');
				}
			}
			else
			{
				$data['mensaje'] = 'El cargo: '.$this->input->post('cargo').'. Se encuentra registrado';
				$this->load->view('layout/header');
				$this->load->view('cargo/vcargo',$data);
				$this->load->view('layout/footer');
			}
		}
		else
		{
			$data['mensaje'] = '';
			$this->load->view('layout/header');
			$this->load->view('cargo/vcargo',$data);
			$this->load->view('layout/footer');
		}
	}

	/*
    * Editing a persona
    */
	function edit()
	{
		$idCargo = $this->input->post('idCargo');
		// check if the persona exists before trying to edit it
		$data['cargo'] = $this->Cargo_model->get_cargo($idCargo);

		if(isset($data['cargo']['idCargo']))
		{
			$this->load->library('form_validation');

			$this->formValidation();

			if($this->form_validation->run())
			{
				$params = $this->parametros();

				$this->Cargo_model->update_cargo($idCargo,$params);

				redirect(base_url().'cargo/CCargo');
			}
			else
			{
				$this->update_cargo($idCargo);
			}
		}
	}

	/*
     * Deleting persona
     */
	function remove()
	{
		$idCargo = $this->input->post('idCargoDelete');

		$params = array(
			'eliminado' => 0,
		);

		$this->Cargo_model->delete_cargo($idCargo, $params);

		redirect('cargo/CCargo/index');

	}

	/**
	 * Form validation method
	 */
	private function formValidation()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('cargo','Cargo','required|callback_alpha_space');
	}

	/**
	 * Parameters Method
	 */
	private function parametros()
	{
		date_default_timezone_set("America/La_Paz");
		$params = array(
			'cargo' => trim($this->input->post('cargo')),
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
