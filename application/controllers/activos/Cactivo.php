<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cactivo extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Activofijo_model');
		$this->load->model('Asignar_model');
		$this->load->model('Obtenido_model');
		$this->load->model('Estado_model');
		$this->load->model('Departamento_model');
		$this->load->model('Motivobaja_model');
		$this->load->model('Transacciones_model');
		$this->load->model('Depreciacion_model');
		$this->load->library('qrcode/Ciqrcode');
	}

	/*
     * Listing of Activo fijo
     */
	function ver($codigo)
	{
		$data['activofijo'] = $this->Activofijo_model->get_activofijo_codigo_numeroSerie($codigo);
		$this->load->view('layout/header');
		$this->load->view('activos/vmostrar',$data);
		$this->load->view('layout/footer');
	}

}
