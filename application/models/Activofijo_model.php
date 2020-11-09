<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 04/11/2020
 * Time: 08:45 AM
 */
class Activofijo_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get activo fijo by id
	 */
	function select_activofijo($idActivofijo)
	{
		$query = $this->db->where('idActivofijo',$idActivofijo);
		$query = $this->db->get('activofijo');
		return $query->result();
	}
	/*
     * Get activofijo by idActivofijo
     */
	function get_activofijo($idActivofijo)
	{
		return $this->db->get_where('activofijo',array('idActivofijo'=>$idActivofijo))->row_array();
	}

	/*
     * Get all activofijo
     */
	function get_all_activofijo()
	{
		$this->db->where('eliminado=',1);
		$this->db->order_by('idActivofijo', 'desc');
		return $this->db->get('activofijo')->result_array();
	}

	/*
     * Get all Tipo activo fijo
     */
	function get_all_tipoactivofijo()
	{
		$this->db->order_by('tipo', 'asc');
		return $this->db->get('tipoactivofijo')->result_array();
	}

	/*
     * Get all estado
     */
	function get_all_estado()
	{
		//$this->db->order_by('esatado', 'asc');
		return $this->db->get('estado')->result_array();
	}

	/*
     * function to add new activofijo
     */
	function add_activofijo($params)
	{
		$this->db->insert('activofijo',$params);
		return $this->db->insert_id();
	}

	/*
     * function to update activofijo
     */
	function update_activofijo($idActivofijo,$params)
	{
		$this->db->where('idActivofijo',$idActivofijo);
		return $this->db->update('activofijo',$params);
	}

	/*
     * function to delete activofijo
     */
	function delete_activofijo($idActivofijo, $params)
	{
		$this->db->where('idActivofijo',$idActivofijo);
		return $this->db->update('activofijo',$params);
	}

	/*
     * function to delete activofijo
     */
	function getEstado($idTipoActivoFijo)
	{

		$this->db->select('idTipoActivoFijo,tipo');
		$this->db->FROM('tipoactivofijo');
		$this->db->WHERE('idTipoActivoFijo',$idTipoActivoFijo);

		$resultado = $this->db->get();

		if ($resultado->num_rows() == 1) {
			$r = $resultado->row();
			return $r->tipo;
		}else{
			return 0;
		}
	}
}
