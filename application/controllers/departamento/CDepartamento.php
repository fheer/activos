<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CDepartamento extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Departamento_model');
	}

	function get_persona_by_departamento($idDepartamento)
	{
		echo  json_encode($this->Departamento_model->get_persona_by_departamento($idDepartamento));
	}

	/*
     * Index of Departamento
     */
	function index()
	{
		$data['departamento'] = $this->Departamento_model->get_all_departamento();
		$this->load->view('layout/header');
		$this->load->view('departamento/vlista',$data);
		$this->load->view('layout/footer');
	}

	/*
     * Load view of departamento
     */
	function insert_departamento()
	{
		$data['departamento'] = $this->Departamento_model->get_all_departamento();
		$this->load->view('layout/header');
		$this->load->view('departamento/vdepartamento',$data);
		$this->load->view('layout/footer');
	}

	/*
	 * Go to Edit departamento
	 */
	function update_departamento($iddepartamento)
	{
		$data['departamento'] = $this->Departamento_model->get_departamento($iddepartamento);
		//print_r($data);
		$this->load->view('layout/header');
		$this->load->view('departamento/vudepartamento',$data);
		$this->load->view('layout/footer');
	}

	/*
     * Adding a new Activo fijo
     */
	function add()
	{

		$this->formValidation();
		if($this->form_validation->run()) {
			$departamento = $this->Departamento_model->validate_departamento(trim($this->input->post('departamento')));
			if ($departamento == 0)
			{
				$params = $this->parametros();
				$response = $this->Departamento_model->add_departamento($params);
				if($response > 0){
					redirect('departamento/Cdepartamento/index');
				}else{
					$data['mensaje'] = 'El Departamento NO fue registrado, hubo errores';
					$this->load->view('layout/header');
					$this->load->view('departamento/vdepartamento',$data);
					$this->load->view('layout/footer');
				}
			}
			else
			{
				$data['mensaje'] = 'El departamento: '.$this->input->post('departamento').'. Se encuentra registrado';
				$this->load->view('layout/header');
				$this->load->view('departamento/vdepartamento',$data);
				$this->load->view('layout/footer');
			}
		}
		else
		{
			$data['mensaje'] = '';
			$this->load->view('layout/header');
			$this->load->view('departamento/vdepartamento',$data);
			$this->load->view('layout/footer');
		}
	}

	/*
    * Editing a persona
    */
	function edit()
	{
		$idDepartamento = $this->input->post('idDepartamento');
		// check if the persona exists before trying to edit it
		//$data['departamento'] = $this->Departamento_model->get_departamento($idDepartamento);

			$this->load->library('form_validation');

			$this->formValidation();

			if($this->form_validation->run())
			{
				$params = $this->parametros();

				$this->Departamento_model->update_departamento($idDepartamento,$params);

				redirect(base_url().'departamento/Cdepartamento');
			}
			else
			{
				$this->update_departamento($idDepartamento);
			}
	}

	/*
     * Deleting persona
     */
	function remove()
	{
		$idDepartamento = $this->input->post('idDepartamentoDelete');

		$params = array(
			'eliminado' => 0,
		);

		$this->Departamento_model->delete_departamento($idDepartamento, $params);

		redirect('departamento/Cdepartamento/index');

	}

	/**
	 * Form validation method
	 */
	private function formValidation()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('departamento','Departamento','required|callback_alpha_space');
	}

	/**
	 * Parameters Method
	 */
	private function parametros()
	{
		date_default_timezone_set("America/La_Paz");
		$params = array(
			'departamento' => trim($this->input->post('departamento')),
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
