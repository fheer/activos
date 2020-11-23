<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CActas extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Actas_model');
	}

	function index(){
		$data['actas'] = $this->Actas_model->get_all_actas();
		$this->load->view('layout/header');
		$this->load->view('actas/vlista',$data);
		$this->load->view('layout/footer');
	}

	function get_all_actas()
	{

	}

}
