<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CUsuario extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_model');
	}

	/*
     * Listing of usuario
     */
	function index()
	{
		//$data['usuario'] = $this->Usuario_model->get_all_usuario();
		$data['usuario'] = $this->Usuario_model->get_name_all_usuario_personal();
		$data['mensaje'] = '';
		$this->load->view('layout/header');
		$this->load->view('usuarios/vlista',$data);
		$this->load->view('layout/footer');
	}

	/*
	 * Insert User
	 */
	function insertUser(){
		$data['persona'] = $this->Usuario_model->get_name_all__personas();
		$data['mensaje'] = '';
		$this->load->view('layout/header');
		$this->load->view('usuarios/vusuario',$data);
		$this->load->view('layout/footer');
	}

	/*
     * Get email
     */
	function get_email_persona($idPersona)
	{
		$data = $this->Usuario_model->get_email_persona($idPersona);
		echo $data;
	}

	/*
     * Get ci
     */
	function get_ci_persona($idPersona)
	{
		$data = $this->Usuario_model->get_ci_persona($idPersona);
		echo $data;
	}


	/*
     * Adding a new usuario
     */
	function add()
	{
			if ($this->Usuario_model->verify_user_name($this->input->post('user'))== 0)
			{
				$checbox1 = $this->input->post('personal');
				$checbox2 = $this->input->post('activos');
				$checbox3 = $this->input->post('movimientos');
				$checbox4 = $this->input->post('usuarios');

				$permisos = '';

				if (isset($checbox1)) {
					$permisos .= md5('Personal').'#';
				}
				if (isset($checbox2)) {
					$permisos .= md5('Activos').'#';
				}
				if (isset($checbox3)) {
					$permisos .= md5('Movimientos').'#';
				}
				if (isset($checbox4)) {
					$permisos .= md5('Usuarios');
				}
				$claveHash1 = $this->hash_generate_password($this->input->post('clave'));
				$params = array(
					'user' => trim($this->input->post('user')),
					'clave' => $claveHash1,
					'permiso' => $permisos,
					'idPersona' => $this->input->post('idPersona'),
				);
				$this->sendEmail( $this->input->post('email'), $this->input->post('user'), $this->input->post('clave'));
				$this->Usuario_model->add_usuario($params);
				redirect('usuarios/CUsuario','refresh');
			}
			else
			{
				$data['persona'] = $this->Usuario_model->get_name_all__personas();
				$data['mensaje'] = "El nombre de usuario ". $this->input->post('user') ." esta en uso";
				$this->load->view('layout/header');
				$this->load->view('usuarios/vusuario',$data);
				$this->load->view('layout/footer');
			}

	}

	/*
     * Editing a usuario
     */
	function edit($idUsuario)
	{
		// check if the usuario exists before trying to edit it
		$data['usuario'] = $this->Usuario_model->get_usuario($idUsuario);

				$params = array(
					'eliminado' => $this->input->post('eliminado'),
					'user' => $this->input->post('user'),
					'clave' => $this->input->post('claveHash'),
					'permiso' => $this->input->post('permiso'),
					'idPersona' => $this->input->post('idPersona'),
				);

				$this->Usuario_model->update_usuario($idUsuario,$params);
				redirect('cusuario/index');

	}

	/*
     * Deleting usuario
     */
	function remove()
	{
		$idUsuario = $this->input->post('idUsuarioDelete');

		$params = array(
			'eliminado' => 0,
		);
		if(isset($idUsuario))
		{
			$this->Usuario_model->delete_usuario($idUsuario,$params);
			redirect(base_url().'usuarios/CUsuario');
		}
	}

	/*
	 * Generate User Name
	 */
	public function generate_user_name($idPersona){
		$data = $this->Usuario_model->generate_user_name($idPersona);
		foreach($data as $obj){
			$param = strtolower(substr(trim($obj['nombres']), 0,1)).strtolower(trim($obj['apellidoPaterno']));
		}
		echo $param;
	}

	/*
	 * Generate passsword
	 */
	public function generate_password()
	{
		// Genera contraseña
		$cadena =  'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
		$password = '';
		$cantidad = strlen($cadena) - 1;

		for ($i=0; $i < 10; $i++)
		{
			$password .= $cadena[rand(0, $cantidad)];
		}
		// Fin Genera contraseña

		echo $password;
	}

	/*
	 * Generate hash passsword
	 */
	public function hash_generate_password($password)
	{
		// Hash
		$password = password_hash($password, PASSWORD_BCRYPT,[5]);
		// Hash
		$hash = substr($password, 0, 60);
		return $hash;
	}

	/*
	 * Generate hash passsword
	 */
	public function hash_generate_password_for_js($password)
	{
		// Hash
		$password = password_hash($password, PASSWORD_BCRYPT,[5]);
		// Hash
		echo $password;
	}

	/*
	 * Send email
	 */
	public function sendEmail($emailTo, $user, $psw)
	{
		$mensaje = "Tu datos de acceso a la App Activos fijos son:"."<br>";
		$mensaje .= "Usuario: ".$user."<br>";
		$mensaje .= "Contraseña: ".$psw."<br>";


		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.googlemail.com',
			'smtp_user' => 'tester.030820@gmail.com', //Su Correo de Gmail Aqui
			'smtp_pass' => 'Abcd.12345', // Su Password de Gmail aqui
			'smtp_port' => '465',
			'smtp_crypto' => 'ssl',
			'mailtype' => 'html',
			'wordwrap' => TRUE,
			'charset' => 'utf-8'
		);
		$this->load->library('email',$config);
		$this->email->from('tester.030820@gmail.com','Admin');
		$this->email->to($emailTo);

		$this->email->subject("Usuario y contraseña Activos Fijos");
		$this->email->message($mensaje);
		$this->email->send();

		if($this->email->send()){
			//echo $this->email->print_debugger(array('headers'));
		}else {
			//echo "error: ".$this->email->print_debugger(array('headers'));
		}
	}
}
