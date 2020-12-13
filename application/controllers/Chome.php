<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chome extends CI_Controller {

	function __construct(){

		parent::__construct();

		$this->load->model('Persona_model');
		$this->load->model('Activofijo_model');
		$this->load->model('Usuario_model');
		$this->load->model('Persona_model');
		$this->load->model('Departamento_model');
		$this->load->model('Cargo_model');
		$this->load->model('Asignar_model');
		$this->load->model('Actas_model');
	}

	public function index(){
		/*$data['countPersona'] = $this->persona_count();
		$data['countActivo'] = $this->activos_count();
		$data['countUsuario'] = $this->usuarios_count();
		$this->load->view('layout/header');
		$this->load->view('vhome',$data);
		$this->load->view('layout/footer');*/
		$persona = $this->Persona_model->get_persona($this->session->userdata('s_idPersona'));
		$data['persona'] = $this->Persona_model->get_persona($this->session->userdata('s_idPersona'));
		$data['dpto'] = $this->Departamento_model->get_departamento($persona['idDepartamento']);
		$data['cargoNombre'] = $this->Cargo_model->get_cargo($persona['idCargo']);
		$this->load->view('layout/header');
		$this->load->view('vhome', $data);
		$this->load->view('layout/footer');
	}

	/**
	 * Count personas
	 * @return cantidad personas
	 */
	function persona_count(){
		return $this->Persona_model->persona_count();
	}

	/**
	 * Count personas
	 * @return cantidad personas
	 */
	function activos_count(){
		return $this->Activofijo_model->activo_fijo_count();
	}

	/**
	 * Count personas
	 * @return cantidad personas
	 */
	function movimientos_count(){
		return $this->Persona_model->persona_count();
	}

	/**
	 * Count personas
	 * @return cantidad personas
	 */
	function usuarios_count(){
		return $this->Usuario_model->usuario_count();
	}
}
