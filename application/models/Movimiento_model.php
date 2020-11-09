<?php

class Movimiento_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/*
     * Get bitacora_movimiento by idBitacora
     */
	function get_movimiento($idBitacora)
	{
		return $this->db->get_where('bitacora_movimiento',array('idBitacora'=>$idBitacora))->row_array();
	}

	/*
     * Get lugas name
     */
	function get_name_lugar($idLugar)
	{
		$this->db->select('idLugar,lugar');
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
     * Get all lugares
     */
	function get_all_lugar()
	{
		$this->db->order_by('lugar', 'asc');
		return $this->db->get('lugar')->result_array();
	}

	/*
	 * Get photo del activo para cada lugar
	 */
	function get_photo_place_mov($idLugar)
	{
		$this->db->select(" AF.imagen, AF.idActivofijo, AF.nombre");
		$this->db->from("lugar L");
		$this->db->join('bitacora_movimiento BI','L.idLugar = Bi.idLugar', 'inner');
		$this->db->join('activofijo AF','BI.idActivofijo =  Af.idActivofijo', 'inner');
		$this->db->where('BI.idLugar',$idLugar);
		return $this->db->get()->result_array();
		//return $result->result();
	}

	/*
     * Get all movimiento
     */
	function get_all_movimiento()
	{
		$this->db->order_by('idBitacora', 'asc');
		return $this->db->get('bitacora_movimiento')->result_array();
	}

	/*
     * function to add new movimiento
     */
	function add_movimiento($params)
	{
		$this->db->insert('bitacora_movimiento',$params);
		return $this->db->insert_id();
	}

	/*
     * function to update movimiento
     */
	function update_movimiento($idBitacora,$params)
	{
		$this->db->where('idBitacora',$idBitacora);
		return $this->db->update('bitacora_movimiento',$params);
	}

	/*
     * function to delete movimiento
     */
	function delete_movimiento($idBitacora)
	{
		return $this->db->delete('bitacora_movimiento',array('idBitacora'=>$idBitacora));
	}
}
