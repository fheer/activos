<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transacciones_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param $idActivofijo
	 * @return mixed
	 */
	function get_data_depreciacion($idActivofijo)
	{
		$this->db->select('AF.nombre, AF.codigo, AF.fechaCompra, T.valorInicial, T.valorDepreciacion, T.valorAcumuladoDepreciacion');
		$this->db->from('transacciones T, activofijo AF');
		$this->db->where('T.idActivofijo=AF.idActivofijo');
		$this->db->where('T.idActivofijo',$idActivofijo);

		return $this->db->get()->result_array();
	}

	/*
     * Get transaccione by idTransacciones
     */
	function get_transacciones($idTransacciones)
	{
		return $this->db->get_where('transacciones',array('idTransacciones'=>$idTransacciones))->row_array();
	}

	/*
     * Get all transacciones
     */
	function get_all_transacciones()
	{
		$this->db->order_by('idTransacciones', 'desc');
		return $this->db->get('transacciones')->result_array();
	}

	/*
     * function to add new transaccione
     */
	function add_transacciones($params)
	{
		return $this->db->insert('transacciones',$params);
		//return $this->db->insert_id();
	}

	/*
     * function to update transaccione
     */
	function update_transacciones($idTransacciones,$params)
	{
		$this->db->where('idTransacciones',$idTransacciones);
		return $this->db->update('transacciones',$params);
	}

	/*
     * function to delete transaccione
     */
	function delete_transacciones($idTransacciones)
	{
		return $this->db->delete('transacciones',array('idTransacciones'=>$idTransacciones));
	}
}
