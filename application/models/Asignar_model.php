<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Asignar_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/*
     * function to add new asingned activo fijo
     */
	function add_asginacion($params, $paramsUpdateIdNewOnwer, $idActivofijo, $idPersona, $newidPersona)
	{
		$this->db->trans_begin();
		//echo $idActivofijo.' persona '.$newidPersona;
		if ($this->find_asginacion($newidPersona, $idActivofijo)>0) {
			$data = $this->find_idActivofijo_asginacion($idActivofijo);
			print_r($this->find_idActivofijo_asginacion($idActivofijo));
			date_default_timezone_set("America/La_Paz");
			foreach ($data as $row){
				$params = array(
					'idNewOwner' => $newidPersona,
					'fechaEntrega' => date('Y-m-d H:i:s', time()),
				);
				$this->db->where('idActivofijo',$row['idActivofijo']);
				$this->db->where('idPersona',$row['idPersona']);
				$this->db->update('asignacion',$params);
			}
		}else{
			$this->db->insert('asignacion',$params);
			//return $this->db->insert_id();
			$this->db->where('idActivofijo',$idActivofijo);
			$this->db->where('idPersona',$idPersona);
			$this->db->update('asignacion',$paramsUpdateIdNewOnwer);
		}
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

	/**
	 * @param $idPersona
	 * @param $idActivofijo
	 * @return bool
	 */
	function find_asginacion($idPersona, $idActivofijo)
	{
		$this->db->select('COUNT(idPersona) AS contar');
		$this->db->FROM('asignacion');
		$this->db->WHERE('idPersona',$idPersona);
		$this->db->WHERE('idActivofijo',$idActivofijo);
		$resultado = $this->db->get();
		$r = $resultado->row();
		return $r->contar;
	}


	function find_idActivofijo_asginacion($idActivofijo)
	{

		$this->db->FROM('asignacion');
		$this->db->WHERE('idActivofijo',$idActivofijo);
		return $this->db->get()->result_array();
		/*$resultado = $this->db->get();
		return $resultado->num_rows() ;*/

	}

	/*
     * function to add new asingned activo fijo
     */
	function update_asginacion($params, $idActivofijo, $idPersona)
	{
		$this->db->trans_begin();
		$this->db->like('idActivofijo',$idActivofijo);
		$this->db->update('asignacion',$params);

		date_default_timezone_set("America/La_Paz");

		$params = array(
			'fechaLiberacion' => date('Y-m-d H:i:s', time()),
			'tipo' => 'L',
		);
		$this->db->like('idActivofijo',$idActivofijo);
		$this->db->where('idPersona',$idPersona);
		$this->db->update('asignacion',$params);

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

	/*
     * function to add new asingned activo fijo
     */
	function get_ativos_fijos_asignados_by_idpersona($idPersona)
	{
		$this->db->from('activofijo AF');
		$this->db->join('asignacion A','A.idActivofijo=AF.idActivofijo','inner');
		$this->db->where('A.idPersona=', $idPersona);
		$this->db->where('A.idNewOwner=', $idPersona);
		$this->db->order_by('AF.idTipoActivoFijo', 'asc');

		return $this->db->get()->result_array();
	}

	/*
     * function to add new asingned activo fijo
     */
	function get_activos_fijos_devueltos_by_idpersona($idPersona)
	{
		date_default_timezone_set("America/La_Paz");
		$fechaDe = date('Y-m-d');
		$fechaHasta = date('Y-m-d');
		$between = "A.fechaLiberacion BETWEEN '".$fechaDe."' AND '". $fechaHasta."'";
		$this->db->from('activofijo AF');
		$this->db->join('asignacion A','A.idActivofijo=AF.idActivofijo','inner');
		$this->db->where('A.idPersona=', $idPersona);
		$this->db->where('A.tipo=', 'L');
		//$this->db->where("A.fechaLiberacion BETWEEN '".$fechaDe."' AND '". $fechaHasta."'");
		return $this->db->get()->result_array();
	}
}
