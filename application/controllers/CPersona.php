<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CPersona extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Persona_model');
		$this->load->model('Departamento_model');
		$this->load->model('Cargo_model');
	}

	/*
     * Listing of persona
     */
	function index()
	{
		$data['persona'] = $this->Persona_model->get_all_persona();
		$this->load->view('layout/header');
		$this->load->view('persona/vlista',$data);
		$this->load->view('layout/footer');
	}

	/*
	 * Go to Insert Person
	 */
	function insertPerson()
	{
		$data['departamento'] = $this->Departamento_model->get_all_departamento();
		$data['cargo'] = $this->Cargo_model->get_all_cargo();
		$data['expedido'] = $this->Persona_model->get_expedido();
		$this->load->view('layout/header');
		$this->load->view('persona/vpersona',$data);
		$this->load->view('layout/footer');
	}

	/*
	 * Go to Edit Person
	 */
	function updatePerson($idPersona)
	{
		$persona = $this->Persona_model->get_persona($idPersona);
		$data['persona'] = $this->Persona_model->get_persona($idPersona);
		$data['departamento'] = $this->Departamento_model->get_all_departamento();
		$data['cargo'] = $this->Cargo_model->get_all_cargo();
		$data['dpto'] = $this->Departamento_model->get_departamento($persona['idDepartamento']);
		$data['cargoNombre'] = $this->Cargo_model->get_cargo($persona['idCargo']);
		$data['expedido'] = $this->Persona_model->get_expedido();
		$this->load->view('layout/header');
		$this->load->view('persona/vupersona',$data);
		$this->load->view('layout/footer');
	}

	/**
	 * Get persona by idPersona
	 */
	function get_persona()
	{
		echo json_encode($this->Persona_model->get_persona($this->input->post('idPersona')));
	}

	/*
	 * Get persona by idPersona
	 */
	public function get_all_personas(){
		echo json_encode($this->Persona_model->get_all_personas());
	}

	/*
	 * Form Validation
	 */
	private function formValidation() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('ci','Ci','required|callback_alpha_dash|max_length[20]');
		$this->form_validation->set_rules('nombre','Nombre','callback_alpha_space|max_length[70]');
		$this->form_validation->set_rules('apellidoPaterno','ApellidoPaterno','required|callback_alpha|max_length[70]');
		$this->form_validation->set_rules('apellidoMaterno','ApellidoMaterno','required|callback_alpha|max_length[70]');
		$this->form_validation->set_rules('direccion','Direccion','callback_address|max_length[70]');
		$this->form_validation->set_rules('telefono','Telefono','required|integer');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('idCargo','Cargo','required');
	}

	/*
	 * Upload photo
	 */
	public function subirImagen(){
		$config['upload_path'] = './fotos/personas/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '2048';
		$config['max_width'] = '2024';
		$config['max_height'] = '2008';

		$this->load->library('upload',$config);

		if (!$this->upload->do_upload("archivo")) {
			if ($this->input->post('option')==1){
				return $this->input->post('foto');
			}else{
			return "sinfoto.jpg";
			}
		} else {

			$file_info = $this->upload->data();
			$imagen = $file_info['file_name'];
			$data['imagen'] = $imagen;
			return $imagen;
		}
	}

	/*
	 * fucntion for Parameters add and update
	 */
	private function parametros()
	{
		$params = array(
			'idCargo' => trim($this->input->post('idCargo')),
			'idDepartamento' => trim($this->input->post('idDepartamento')),
			'ci' => trim($this->input->post('ci')),
			'nombres' => trim($this->onlyOneSpace($this->input->post('nombre'))),
			'apellidoPaterno' => trim($this->onlyOneSpace($this->input->post('apellidoPaterno'))),
			'apellidoMaterno' => trim($this->onlyOneSpace($this->input->post('apellidoMaterno'))),
			'direccion' => trim($this->onlyOneSpace($this->input->post('direccion'))),
			'telefono' => trim($this->input->post('telefono')),
			'email' => trim($this->input->post('email')),
			'fechaRegistro' => trim(date("Y-m-d H:m:s")),
			'expedido' => trim($this->input->post('idExpedido')),
			'foto' => $this->subirImagen(),
		);
		return $params;
	}
	/*
     * Adding a new persona
     */
	function add()
	{
		if ($this->Persona_model->get_ci($this->input->post('ci')) == 0) {
			$this->formValidation();
			$data = array();
			if($this->form_validation->run())
			{
				$params = $this->parametros();
				$persona_id = $this->Persona_model->add_persona($params);
				redirect(base_url().CPersona);
			}
			else
			{
				$data['departamento'] = $this->Departamento_model->get_all_departamento();
				$data['cargo'] = $this->Cargo_model->get_all_cargo();
				$data['expedido'] = $this->Persona_model->get_expedido();
				$data['expedido'] = $this->Persona_model->get_expedido();
				$data['mensaje'] = '';
				$this->load->view('layout/header');
				$this->load->view('persona/vpersona',$data);
				$this->load->view('layout/footer');
			}
		}
		else{
			$data['departamento'] = $this->Departamento_model->get_all_departamento();
			$data['cargo'] = $this->Cargo_model->get_all_cargo();
			$data['expedido'] = $this->Persona_model->get_expedido();
			$data['expedido'] = $this->Persona_model->get_expedido();
			$data['mensaje'] = 'El Ci: '.$this->input->post('ci').'. Se encuentra registrado';
			$this->load->view('layout/header');
			$this->load->view('persona/vpersona',$data);
			$this->load->view('layout/footer');
		}
	}

	public function addNew() {

		$this->formValidation();
		$data = array();
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'code' => 1,
				'ci' => form_error('ci'),
				'nombre' => form_error('nombre'),
				'apellidoPaterno' => form_error('apellidoPaterno'),
				'apellidoMaterno' => form_error('apellidoMaterno'),
				'direccion' => form_error('direccion'),
				'telefono' => form_error('telefono'),
				'email' => form_error('email'),
				'cargo' => form_error('cargo')

			);
			$data['departamento'] = $this->Departamento_model->get_all_departamento();
			$data['cargo'] = $this->Cargo_model->get_all_cargo();
			$data['expedido'] = $this->Persona_model->get_expedido();
			$this->load->view('layout/header');
			$this->load->view('persona/vpersona',$data);
			$this->load->view('layout/footer');
		} else {
			$params = array(
				'cargo' => trim($this->input->post('cargo')),
				'ci' => trim($this->input->post('ci')),
				'nombres' => trim($this->onlyOneSpace($this->input->post('nombre'))),
				'apellidoPaterno' => trim($this->onlyOneSpace($this->input->post('apellidoPaterno'))),
				'apellidoMaterno' => trim($this->onlyOneSpace($this->input->post('apellidoMaterno'))),
				'direccion' => trim($this->onlyOneSpace($this->input->post('direccion'))),
				'telefono' => trim($this->input->post('telefono')),
				'email' => trim($this->input->post('email')),
				'fechaRegistro' => trim(date("Y-m-d H:m:s")),
			);

			$this->Persona_model->add_persona($params);
			$data['persona'] = $this->Persona_model->get_all_persona();
			redirect(base_url() . 'CPersona', 'refresh');
		}
	}

	/*
    * Editing a persona
    */
	function edit()
	{
		$idPersona = $this->input->post('idPersona');
		// check if the persona exists before trying to edit it
		$data['persona'] = $this->Persona_model->get_persona($idPersona);
		//if ($this->Persona_model->get_ci($this->input->post('ci')) == 0) {
			$this->load->library('form_validation');

			$this->formValidation();

			if($this->form_validation->run())
			{
				$params = $this->parametros();
				$this->Persona_model->update_persona($idPersona,$params);
				if ($this->input->post('destino')=='P') {
					redirect(base_url().'perfil/CPerfil');
				}else{
					redirect(base_url().'CPersona');
				}
			}
			else
			{
				$persona = $this->Persona_model->get_persona($idPersona);
				$data['persona'] = $this->Persona_model->get_persona($idPersona);
				$data['departamento'] = $this->Departamento_model->get_all_departamento();
				$data['cargo'] = $this->Cargo_model->get_all_cargo();
				$data['dpto'] = $this->Departamento_model->get_departamento($persona['idDepartamento']);
				$data['cargoNombre'] = $this->Cargo_model->get_cargo($persona['idCargo']);
				$data['expedido'] = $this->Persona_model->get_expedido();
				$this->load->view('layout/header');
				$this->load->view('persona/vupersona',$data);
				$this->load->view('layout/footer');
			}
		/*}else{
			$persona = $this->Persona_model->get_persona($idPersona);
			$data['persona'] = $this->Persona_model->get_persona($idPersona);
			$data['departamento'] = $this->Departamento_model->get_all_departamento();
			$data['cargo'] = $this->Cargo_model->get_all_cargo();
			$data['dpto'] = $this->Departamento_model->get_departamento($persona['idDepartamento']);
			$data['cargoNombre'] = $this->Cargo_model->get_cargo($persona['idCargo']);
			$data['expedido'] = $this->Persona_model->get_expedido();
			$data['mensaje'] = 'El Ci: '.$this->input->post('ci').'. Se encuentra registrado';
			$this->load->view('layout/header');
			$this->load->view('persona/vupersona',$data);
			$this->load->view('layout/footer');
		}*/



	}

	/*
     * Deleting persona
     */
	function remove($idPersona)
	{
		$persona = $this->Persona_model->get_persona($idPersona);

		$params = array(
			'eliminado' => 0,
		);
		if(isset($persona['idPersona']))
		{
			$this->Persona_model->delete_persona($idPersona,$params);
			//redirect(base_url().CPersona,refesh);
			$data['persona'] = $this->Persona_model->get_all_persona();
			//$data['_view'] = 'Cpersona/index';
			$this->load->view('layout/header');
			$this->load->view('persona/eliminar',$data);
			$this->load->view('layout/footer');
		}
	}

	/*
     * Deleting persona
     */
	function removeNew()
	{
		$idPersona = $this->input->post('idPersonaDelete');
		$persona = $this->Persona_model->get_persona($idPersona);
		$params = array(
			'eliminado' => 0,
		);
		if(isset($persona['idPersona']))
		{
			$this->Persona_model->delete_persona($idPersona,$params);
			redirect(base_url().CPersona);
		}
	}

	/**
	 * Alpha and spaces
	 *
	 * @param	string
	 * @return	bool
	 */
	public function alpha_space($str)
	{

		if (preg_match('/^[a-záéíóú ]+$/i', $str))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('alpha_space', 'El campo {field} solo puede contener caracteres alfabéticos y un espacio.');
			return FALSE;
		}
	}
	// --------------------------------------------------------------------

	/**
	 * Alpha
	 *
	 * @param	string
	 * @return	bool
	 */
	public function alpha($str)
	{
		if (preg_match('/^[a-záéíóú]+$/i', $str))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('alpha', 'El campo {field} solo puede contener caracteres alfabéticos.');
			return FALSE;
		}
	}
	// --------------------------------------------------------------------

	/**
	 * address
	 *
	 * @param	string
	 * @return	bool
	 */
	public function address($str)
	{

		if (preg_match('/^[A-Z0-9áéíóú.# ]+$/i', $str))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('address', 'El campo {field} solo puede contener caracteres alfabéticos . y/o #  .');
			return FALSE;
		}
	}

	/**
	 * @param string
	 * @return string
	 */
	public function onlyOneSpace($srt)
	{
		$porciones = explode(" ", $srt);
		$nuevaCadena= "";
		foreach($porciones as $posicion=>$jugador)
		{
			$nuevaCadena .=$jugador." ";
		}
		return $nuevaCadena;
	}

	/**
	 * Alpha-numeric with underscores and dashes
	 *
	 * @param	string
	 * @return	bool
	 */
	public function alpha_dash($str)
	{
		if (preg_match('/^[0-9-a-zA-Z]+$/i', $str))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('ci', 'El campo {field} puede contener números, y/0 guión y 
			caracteres alfabéticos.');
			return FALSE;
		}
	}
}

