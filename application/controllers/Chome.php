<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chome extends CI_Controller {

	function __construct(){
		parent::__construct();
	    //$this->load->model('Mlogin');
	}
	public function index(){
		$data = "";
		$this->load->view('layout/header');
		$this->load->view('vhome',$data);
		$this->load->view('layout/footer');
	}
}