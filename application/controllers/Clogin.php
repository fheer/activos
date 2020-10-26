<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clogin extends CI_Controller {

	function __construct(){
		parent::__construct();
	    $this->load->model('Mlogin');
	}
	public function index(){
		$data = "";
		$this->load->view('Vlogin',$data);
	}

 	public function ingresar(){
 		$user = $this->input->post('user');
 		$psw = $this->input->post('psw');
 		$res = $this->Mlogin->ingresar($user,$psw);
	
 		if ($res == 1){
 			redirect('Chome/index');
 		}else{
 			$data['mensaje'] = "Usuario y/o contraseña incorrectos";
 			$this->load->view('Vlogin',$data);
 		}
 	}
 	public function cerrar_sesion() {
      $usuario_data = array(
         'logueado' => FALSE
      );
      $this->session->set_userdata($usuario_data);
      $this->load->view('vlogin');
   }
}