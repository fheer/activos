<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
		$this->db->where('idActivofijo',$idActivofijo);
		$query = $this->db->get('activofijo');
		return $query->row_array();
	}

	/*
     * Get activofijo by idActivofijo
     */
	function get_activofijo($idActivofijo)
	{
		return $this->db->get_where('activofijo',array('idActivofijo'=>$idActivofijo))->row_array();
	}

	/*
     * Get activofijo by numero de serie
     */
	function get_activofijo_codigo_numeroSerie($codigo)
	{
		return $this->db->get_where('activofijo',array('codigo'=>$codigo))->row_array();
	}

	/*
     * Get all activofijo
     */
	function get_all_activofijo()
	{
		$this->db->where('eliminado=',1);
		$this->db->order_by('codigo', 'desc');
		return $this->db->get('activofijo')->result_array();
	}

	/*
     * Get all Tipo activo fijo
     */
	function get_all_tipoactivofijo()
	{
		$this->db->where('eliminado',1);
		$this->db->order_by('tipo', 'asc');
		return $this->db->get('tipoactivofijo')->result_array();
	}

	/**
	 * Get Tipo activo fijo by id
	 * @return mixed
	 */
	function get_tipoactivofijo($idTipoActivoFijo)
	{
		$this->db->where('idTipoActivoFijo', $idTipoActivoFijo);
		return $this->db->get('tipoactivofijo')->row_array();
	}

	/*
     * Get all estado
     */
	function get_all_estado()
	{
		$this->db->where('eliminado',1);
		$this->db->order_by('estado', 'asc');
		return $this->db->get('estado')->result_array();
	}

	/*
     * function to add new activofijo
     */
	function add_activofijo($params, $idPersona)
	{
		//Iniciamos la transacción.
		$this->db->trans_begin();
		$this->db->insert('activofijo',$params);
		$idActivofijo = $this->db->insert_id();
		date_default_timezone_set("America/La_Paz");
		$paramsAsignar = array(
			'idPersona' => $idPersona,
			'idActivofijo' => $idActivofijo,
			'fechaEntrega' => date('Y-m-d H:i:s', time()),
			'idNewOwner' => $this->input->post('idPersona'),
		);
		$this->db->insert('asignacion',$paramsAsignar);

		if ($this->db->trans_status() === FALSE){
			//Hubo errores en la consulta, entonces se cancela la transacción.
			$this->db->trans_rollback();
			return 0;
		}else{
			//Todas las consultas se hicieron correctamente.
			$this->db->trans_commit();
			return $idActivofijo;
		}

	}

	/*
     * function to add new baja
     */
	function add_baja($idActivofijo, $params)
	{
		$this->db->trans_begin();
		$this->db->insert('baja',$params);
		//$idActivofijo = $this->db->insert_id();
		date_default_timezone_set("America/La_Paz");
		$paramsActivo = array(
			'eliminado' => 0,
		);
		$this->db->where('idActivofijo',$idActivofijo);
		$this->db->update('activofijo',$paramsActivo);

		if ($this->db->trans_status() === FALSE){
			//Hubo errores en la consulta, entonces se cancela la transacción.
			$this->db->trans_rollback();
			return false;
		}else{
			//Todas las consultas se hicieron correctamente.
			$this->db->trans_commit();
			return true;
		}
	}

	function list_bajas()
	{
		$this->db->select('AF.codigo, AF.nombre, MB.motivo, B.fecha');
		$this->db->from('baja B');
		$this->db->join('activofijo AF','AF.idActivofijo=B.idActivofijo','inner');
		$this->db->join('motivobaja MB','MB.idMotivoBaja=B.idMotivoBaja','inner');
		return $this->db->get()->result_array();
	}

	function get_bajas_date($de, $hasta)
	{
		$this->db->select('AF.codigo, AF.nombre, MB.motivo, B.fecha');
		$this->db->from('baja B');
		$this->db->join('activofijo AF','AF.idActivofijo=B.idActivofijo','inner');
		$this->db->join('motivobaja MB','MB.idMotivoBaja=B.idMotivoBaja','inner');
		$this->db->where("B.fecha BETWEEN '".$de."' AND '" .$hasta."'");
		return $this->db->get()->result_array();
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

	/*
     * Get lugares
     */
	function get_all_Lugar()
	{
		$this->db->where('eliminado=', 1);
		$this->db->order_by('lugar', 'asc');
		return $this->db->get('lugar')->result_array();
	}

	/*
     * Get lugares
     */
	function get_all_activo()
	{
		$this->db->where('eliminado=', 1);
		$this->db->order_by('nombre', 'asc');
		return $this->db->get('activofijo')->result_array();
	}

	/*
     * Get lugares
     */
	function get_Lugar($idLugar)
	{
		$this->db->select('idLugar, lugar');
		$this->db->FROM('lugar');
		$this->db->WHERE('idLugar',$idLugar);

		$resultado = $this->db->get();

		if ($resultado->num_rows() == 1) {
			$r = $resultado->row();
			return $r->lugar;
		}else{
			return 0;
		}
	}

	/*
     * Saca el ultimo id registrado
     */
	function get_last_id()
	{

		$this->db->select('max(idActivofijo) as idActivofijo');
		$this->db->FROM('activofijo');

		$resultado = $this->db->get();

		if ($resultado->num_rows() == 1) {
			$r = $resultado->row();
			return $r->idActivofijo;
		}else{
			return 0;
		}
	}

	function get_codigo($codigo)
	{

		$this->db->select('idActivofijo,codigo');
		$this->db->FROM('activofijo');
		$this->db->WHERE('codigo',$codigo);

		$resultado = $this->db->get();

		if ($resultado->num_rows() == 1) {
			return 1;
		}else{
			return 0;
		}
	}

	/*
     * Saca el ultimo id registrado
     */
	function get_vida_util($id)
	{

		$this->db->select('vidautil');
		$this->db->from('tipoactivofijo');
		$this->db->where('idTipoActivoFijo=', $id);
		$resultado = $this->db->get();

		if ($resultado->num_rows() == 1) {
			$r = $resultado->row();
			return $r->vidautil;
		}else{
			return 0;
		}
	}

	/*
     * activo fijo count
     */
	function activo_fijo_count()
	{
		$this->db->where('eliminado=1');
		$this->db->from('activofijo');
		return $this->db->count_all_results();
	}

	/*
     * activo fijo count
     */
	function activo_fijo_count_generar()
	{
		$this->db->from('activofijo');
		return $this->db->count_all_results();
	}
}
