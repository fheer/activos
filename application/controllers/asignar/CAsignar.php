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
		$data['activofijo'] = $this->Activofijo_model->get_all_activofijo();
		$data['mensaje'] = '';
		$this->load->view('layout/header');
		$this->load->view('asignar/vasignar',$data);
		$this->load->view('layout/footer');
	}

	/**
	 * add activos fijos asignados
	 */
	function add()
	{
		$checkboxArray = $this->input->post('asignado');
		if (!empty($checkboxArray)) {
			foreach ($checkboxArray as $checkbox){
				date_default_timezone_set("America/La_Paz");
				$params = array(
					'idPersona' => $this->input->post('idPersona'),
					'idActivofijo' => $checkbox,
					'fechaEntrega' => date('Y-m-d H:i:s', time()),
				);
				$paramsActivoFijo = array(
					'idActivofijo' => $checkbox,
					'fechaEntrega' => date('Y-m-d H:i:s', time()),
				);
				$data['activofijo'] = $this->Asignar_model->add_asginacion($params);
				//$this->Activofijo_model->update_activofijo($checkbox, $paramsActivoFijo);

			}
			redirect(base_url().'asignar/CAsignar','refresh');
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
				);
			}
			return $params;
		}else {
			return 0;
		}
	}
}
