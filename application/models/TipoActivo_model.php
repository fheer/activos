<?php

class TipoActivo_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/*
     * Get tipoactivofijo by idTipoActivoFijo
     */
	function get_tipoactivofijo($idTipoActivoFijo)
	{
		return $this->db->get_where('tipoactivofijo',array('idTipoActivoFijo'=>$idTipoActivoFijo))->row_array();
	}

	/*
     * Get all tipoactivofijo
     */
	function get_all_tipoactivofijo()
	{
		$this->db->where('eliminado', 1);
		$this->db->order_by('idTipoActivoFijo', 'desc');
		return $this->db->get('tipoactivofijo')->result_array();
	}

	/*
     * function to add new tipoactivofijo
     */
	function add_tipoactivofijo($params)
	{
		$this->db->insert('tipoactivofijo',$params);
		return $this->db->insert_id();
	}

	/*
     * function to update tipoactivofijo
     */
	function update_tipoactivofijo($idTipoActivoFijo,$params)
	{
		$this->db->where('idTipoActivoFijo',$idTipoActivoFijo);
		return $this->db->update('tipoactivofijo',$params);
	}

	/*
     * function to delete tipoactivofijo
     */
	function delete_tipoactivofijo($idTipoActivoFijo, $params)
	{
		$this->db->where('idTipoActivoFijo',$idTipoActivoFijo);
		return $this->db->update('tipoactivofijo',$params);
	}

	/*
 * Validate tipo activo by activo
 */
	function validate_tipo_activo($tipo)
	{
		$this->db->select('idTipoActivoFijo,tipo');
		$this->db->from('tipoactivofijo');
		$this->db->where('tipo=',$tipo);

		$resultado = $this->db->get();

		if ($resultado->num_rows() > 0) {
			return 1;
		}else{
			return 0;
		}
	}
}
