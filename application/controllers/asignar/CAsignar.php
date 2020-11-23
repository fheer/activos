<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CAsignar extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Activofijo_model');
		$this->load->model('Persona_model');
		$this->load->model('Asignar_model');
		$this->load->library('qrcode/Ciqrcode');
	}

	/*
     * index function
     */
	function index()
	{
		//$data['activofijo'] = $this->Activofijo_model->get_all_activofijo();
		$data['mensaje'] = '';
		$this->load->view('layout/header');
		$this->load->view('asignar/vlista',$data);
		$this->load->view('layout/footer');
	}

	/*
     * Asignar function
     */
	function asignar()
	{
		$data['persona'] = $this->Persona_model->get_all_persona();
		$data['activofijo'] = $this->Asignar_model->get_ativos_fijos_asignados_by_idpersona($this->session->userdata('s_idPersona'));
		$data['mensaje'] = '';
		$this->load->view('layout/header');
		$this->load->view('asignar/vasignar', $data);
		$this->load->view('layout/footer');
	}

	/**
	 * add activos fijos asignados
	 */
	function add()
	{
		$idPersona = $this->session->userdata('s_idPersona');
		$checkboxArray = $this->input->post('asignado');
		if (!empty($checkboxArray)) {
			foreach ($checkboxArray as $checkbox){
				date_default_timezone_set("America/La_Paz");
				$params = array(
					'idPersona' => $this->input->post('idPersona'),
					'idActivofijo' => $checkbox,
					'fechaEntrega' => date('Y-m-d H:i:s', time()),
					'idNewOwner' => $this->input->post('idPersona'),
				);
				$paramsUpdateIdNewOnwer = array(
					'idNewOwner' => $this->input->post('idPersona'),
					'idActivofijo' => $checkbox,
					'fechaLiberacion' => date('Y-m-d H:i:s', time()),
					'fechaEntrega' => date('Y-m-d H:i:s', time()),
				);

				$data['activofijo'] = $this->Asignar_model->add_asginacion($params, $paramsUpdateIdNewOnwer, $checkbox, $idPersona);
				//$this->Activofijo_model->update_activofijo($checkbox, $paramsActivoFijo);
			}
			$idPersonaAsignada = $this->input->post('idPersona');
			//redirigir a la lista de acta
			redirect(base_url().'reportes/CEntrega/entrega_actas_pdf/'.$idPersonaAsignada,'refresh');
		}else {
			$data['persona'] = $this->Persona_model->get_all_persona();
			$data['activofijo'] = $this->Activofijo_model->get_all_activofijo();
			$data['mensaje'] = 'No selecciono ningun Activo fijo';
			$this->load->view('layout/header');
			$this->load->view('asignar/vasignar',$data);
			$this->load->view('layout/footer');
		}
	}

	/*
	 * Function parameters
	 */
	function parametros()
	{
		$checkboxArray = $this->input->post('asignado');
		if (!empty($checkboxArray)) {
			foreach ($checkboxArray as $checkbox){
				$params = array(
					'idPersona' => $this->input->post('idPersona'),
					'idActivofijo' => $checkbox,
					'fechaEntrega' => date('Y-m-d H:i:s', time()),
					'idNewOwner' => $this->input->post('idPersona'),
				);
			}
			return $params;
		}else {
			return 0;
		}
	}
}
