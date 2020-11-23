<?php

class Estado_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/*
     * Get all records of estado
     */
	function get_all_estado()
	{
		$this->db->where('eliminado=1');
		$this->db->order_by('estado', 'asc');
		return $this->db->get('estado')->result_array();
	}

	/*
     * Get all records of estado
     */
	function get_nombre_estado($idEstado)
	{
		$this->db->select('estado');
		return $this->db->get_where('estado',array('idEstado'=>$idEstado))->row_array();

	}

	/*
     * Get estado by idestado
     */
	function get_estado($idEstado)
	{
		return $this->db->get_where('estado',array('idEstado'=>$idEstado))->row_array();
	}

	/*
     * Get estado by idestado
     */
	function validate_estado($estado)
	{
		$this->db->select('idEstado,estado');
		$this->db->from('estado');
		$this->db->where('estado=',$estado);

		$resultado = $this->db->get();

		if ($resultado->num_rows() > 0) {
			return 1;
		}else{
			return 0;
		}
	}

	/*
     * function to add new estado
     */
	function add_estado($params)
	{
		$this->db->insert('estado',$params);
		return $this->db->insert_id();
	}

	/*
     * function to update estado
     */
	function update_estado($idEstado, $params)
	{
		$this->db->where('idestado',$idEstado);
		return $this->db->update('estado',$params);
	}

	/*
     * function to delete estado
     */
	function delete_estado($idEstado, $params)
	{
		$this->db->where('idestado',$idEstado);
		return $this->db->update('estado',$params);
	}

}
