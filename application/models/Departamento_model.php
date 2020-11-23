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
		$this->db->where('eliminado=1');
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

	/*
	* Get departamento by idDepartamento
	*/
	function get_departamento($idDepartamento)
	{
		return $this->db->get_where('departamento',array('idDepartamento'=>$idDepartamento))->row_array();
	}

	/*
     * Validate cargo by idDepartamento
     */
	function validate_departamento($idDepartamento)
	{
		$this->db->select('idDepartamento,departamento');
		$this->db->from('departamento');
		$this->db->where('departamento=',$idDepartamento);

		$resultado = $this->db->get();

		if ($resultado->num_rows() > 0) {
			return 1;
		}else{
			return 0;
		}
	}

	/*
     * function to add new departamento
     */
	function add_departamento($params)
	{
		$this->db->insert('departamento',$params);
		return $this->db->insert_id();
	}

	/*
     * function to update departamento
     */
	function update_departamento($idDepartamento, $params)
	{
		$this->db->where('idDepartamento',$idDepartamento);
		return $this->db->update('departamento',$params);
	}

	/*
     * function to delete departamento
     */
	function delete_departamento($idDepartamento, $params)
	{
		$this->db->where('idDepartamento',$idDepartamento);
		return $this->db->update('departamento',$params);
	}
}
