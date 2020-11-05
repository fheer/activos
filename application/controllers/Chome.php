<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chome extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Persona_model');
	}
	public function index(){
		$data['countPersona'] = $this->persona_count();
		$this->load->view('layout/header');
		$this->load->view('vhome',$data);
		$this->load->view('layout/footer');
	}
	function persona_count(){
		return $this->Persona_model->persona_count();;
	}
}
