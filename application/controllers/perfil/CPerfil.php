<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CPerfil extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Usuario_model');
		$this->load->model('Persona_model');
		$this->load->model('Departamento_model');
		$this->load->model('Cargo_model');
	}

	public function index(){
		$persona = $this->Persona_model->get_persona($this->session->userdata('s_idPersona'));
		$data['persona'] = $this->Persona_model->get_persona($this->session->userdata('s_idPersona'));
		$data['dpto'] = $this->Departamento_model->get_departamento($persona['idDepartamento']);
		$data['cargoNombre'] = $this->Cargo_model->get_cargo($persona['idCargo']);
		$this->load->view('layout/header');
		$this->load->view('perfil/vperfil', $data);
		$this->load->view('layout/footer');
	}

	public function change_password(){

		$data['usuario'] = $this->Usuario_model->get_user_name($this->session->userdata('s_idUsuario'));

		$this->load->view('layout/header');
		$this->load->view('perfil/vcambiaruser', $data);
		$this->load->view('layout/footer');
	}

	/*
     * Editing a usuario
     */
	function edit($idUsuario)
	{
		$this->formValidation();
		if($this->form_validation->run()) {
			$params = array(
				'user' => $this->input->post('user'),
				'clave' => $this->hash_generate_password($this->input->post('clave')),
				'nuevo' => 'N',
			);
			$s_user = array(
				's_idPersona' => $this->session->userdata('s_idPersona'),
				's_ci' => $this->session->userdata('s_ci'),
				's_nomUser' => $this->session->userdata('s_nomUser'),
				's_foto' => $this->session->userdata('s_foto'),
				's_cargo' => $this->session->userdata('s_cargo'),
				's_nuevo' => 'N',
				's_idUsuario' => $this->session->userdata('s_idUsuario'),
				's_logueado' => TRUE
			);
			$this->session->set_userdata($s_user);
			$this->Usuario_model->update_usuario($idUsuario, $params);
			$data['countPersona'] = $this->persona_count();
			$data['mensaje'] = 'Su contraseña fue cambiada correctamente';
			$this->load->view('layout/header');
			$this->load->view('vhome', $data);
			$this->load->view('layout/footer');
		}else {
			$data['usuario'] = $this->Usuario_model->get_user_name($this->session->userdata('s_idUsuario'));
			$data['mensaje'] = '';
			$this->load->view('layout/header');
			$this->load->view('perfil/vcambiaruser', $data);
			$this->load->view('layout/footer');
		}
	}

	/*
	 * Form Validation
	 */
	private function formValidation() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('user','Nombre de usuario','callback_alpha_dash');
		$this->form_validation->set_rules('clave','Contraseña','callback_alpha_numeric_spaces');
	}

	/*
	 * Generate hash passsword
	 */
	public function hash_generate_password($password)
	{
		// Hash
		$password = password_hash($password, PASSWORD_BCRYPT,[5]);
		// fin Hash
		return $password;
	}

	/**
	 * Alpha-numeric with underscores and dashes
	 *
	 * @param	string
	 * @return	bool
	 */
	public function alpha_dash($str)
	{
		if (preg_match('/^[0-9a-zA-Z_]+$/i', $str))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('user', 'El campo {field} puede contener números, caracteres alfabéticos, y/o guion bajo _.');
			return FALSE;
		}
	}

	/**
	 * Alpha-numeric with underscores and dashes
	 *
	 * @param	string
	 * @return	bool
	 */
	public function alpha_numeric_spaces($str)
	{
		if (preg_match('/^[0-9a-zA-Z{}=+!@#%*()_]+$/i', $str))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('clave', 'El campo {field} puede contener números, caracteres alfabéticos, y/o estos caracteres {}=+!@#%*()_');
			return FALSE;
		}
	}

	function persona_count(){
		return $this->Persona_model->persona_count();;
	}
}

