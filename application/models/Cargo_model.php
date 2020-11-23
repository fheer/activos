<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cargo_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/*
     * Get cargo by idCargo
     */
	function get_cargo($idCargo)
	{
		return $this->db->get_where('cargo',array('idCargo'=>$idCargo))->row_array();
	}

	/*
     * Get cargo by idCargo
     */
	function validate_cargo($cargo)
	{
		$this->db->select('idCargo,cargo');
		$this->db->from('cargo');
		$this->db->where('cargo=',$cargo);

		$resultado = $this->db->get();

		if ($resultado->num_rows() > 0) {
			return 1;
		}else{
			return 0;
		}
	}

	/*
     * Get all cargo
     */
	function get_all_cargo()
	{
		$this->db->where('eliminado=1');
		$this->db->order_by('idCargo', 'desc');
		return $this->db->get('cargo')->result_array();
	}

	/*
     * function to add new cargo
     */
	function add_cargo($params)
	{
		$this->db->insert('cargo',$params);
		return $this->db->insert_id();
	}

	/*
     * function to update cargo
     */
	function update_cargo($idCargo, $params)
	{
		$this->db->where('idCargo',$idCargo);
		return $this->db->update('cargo',$params);
	}

	/*
     * function to delete cargo
     */
	function delete_cargo($idCargo, $params)
	{
		$this->db->where('idCargo',$idCargo);
		return $this->db->update('cargo',$params);
	}
}
