<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CDepartamento extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Departamento_model');
	}

	function get_persona_by_departamento($idDepartamento)
	{
		echo  json_encode($this->Departamento_model->get_persona_by_departamento($idDepartamento));
	}
}
