<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Depreciacion_model extends CI_Model
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
		$this->db->select('AF.nombre, AF.codigo, AF.fechaCompra, D.valorInicial, D.valorDepreciacion, D.valorAcumuladoDepreciacion');
		$this->db->from('depreciacion D, activofijo AF');
		$this->db->where('D.idActivofijo=AF.idActivofijo');
		$this->db->where('D.idActivofijo',$idActivofijo);

		return $this->db->get()->result_array();
		//return $this->db->get()->row_array();
	}

	/*
     * Get transaccione by idTransacciones
     */
	function get_transacciones($idTransacciones)
	{
		return $this->db->get_where('transacciones',array('idTransacciones'=>$idTransacciones))->row_array();
	}

	/*
     * Get transaccione by idTransacciones
     */
	function get_transacciones_activo($idActivofijo)
	{

		$this->db->select('AF.codigo, AF.valorInicial, T.tipoTransaccion, T.idActivofijo, T.fecha');
		$this->db->from('transacciones T, activofijo AF');
		$this->db->where('T.idActivofijo',$idActivofijo);
		$this->db->where('AF.idActivofijo',$idActivofijo);
		$this->db->order_by('T.fecha','asc');

		return $this->db->get()->result_array();
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
	function add_depreciacion($params)
	{
		return $this->db->insert('depreciacion',$params);
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
