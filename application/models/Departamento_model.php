<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Departamento_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/*
     * Get all departamentos
     */
	function get_all_departamento()
	{
		$this->db->order_by('departamento', 'asc');
		return $this->db->get('departamento')->result_array();
	}

	/*
     * Get persona by departamento
     */
	function get_persona_by_departamento($idDepartamento)
	{
		$this->db->select("CONCAT_WS(' ', IFNULL(apellidoPaterno,''), IFNULL(apellidoMaterno,''), nombres) AS nombre,
						idPersona");
		$this->db->where('idDepartamento',$idDepartamento);
		$this->db->order_by('nombre', 'asc');
		return $this->db->get('persona')->result_array();
	}
}
