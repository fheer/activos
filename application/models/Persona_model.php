<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persona_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/**
     * Get persona by idPersona
     */
	function select_persona($idPersona)
	{
		$this->db->select('idPersona,ci,expedido,nombres,apellidoPaterno,apellidoMaterno,direccion,telefono,foto,email,idCargo');
		$this->db->from('persona');
		$this->db->where('idPersona',$idPersona);

		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * Get persona by idPersona
	 */
	function select_persona_id($idPersona)
	{
		$this->db->select("idPersona,ci,expedido,nombres,ifnull(apellidoPaterno,'') as ap,ifnull(apellidoMaterno,'') as am,direccion,telefono,foto,email");
		$this->db->from('persona');
		$this->db->where('idPersona',$idPersona);

		return $this->db->get()->row_array();
		//return $query->result();
	}
	/*
     * Get persona by idPersona
     */
	function get_persona($idPersona)
	{
		return $this->db->get_where('persona',array('idPersona'=>$idPersona))->row_array();
	}

	function get_ci($ci)
	{

		$this->db->select('idPersona,ci');
		$this->db->FROM('persona');
		$this->db->WHERE('ci',$ci);

		$resultado = $this->db->get();

		if ($resultado->num_rows() == 1) {
			return 1;
		}else{
			return 0;
		}
	}

	/*
     * Get persona by idPersona
     */
	function get_persona_encargado_af()
	{
		return $this->db->get_where('persona',array('userActivos'=>'S'))->row_array();
	}

	/*
     * Persona_count count
     */
	function persona_count()
	{
		$this->db->from('persona');
		return $this->db->count_all_results();
	}

	/*
     * Get all persona count
     */
	function get_all_persona_count()
	{
		$this->db->from('persona');
		return $this->db->count_all_results();
	}

	function get_all_persona()
	{
		$this->db->where("eliminado",1);
		$this->db->order_by('apellidoPaterno', 'asc');
		return $this->db->get('persona')->result_array();
	}

	/*
   	 * Get all persona
  	 */
	function get_expedido()
	{
		$this->db->order_by('expedido', 'asc');
		return $this->db->get('expedido')->result_array();
	}

	/*
     * Get persona by idPersona
     */
	function get_firmas($idPersona)
	{
		return $this->db->get_where('firmas')->row_array();
	}


	/*
     * function to add new persona
     */
	function add_persona($params)
	{
		$this->db->insert('persona',$params);
		return $this->db->insert_id();
	}

	/*
    * function to update persona
    */
	function update_persona($idPersona,$params)
	{
		$this->db->where('idPersona',$idPersona);
		return $this->db->update('persona',$params);
	}

	/*
     * function to delete persona
     */
	function delete_persona($idPersona,$params)
	{
		$this->db->where('idPersona',$idPersona);
		return $this->db->update('persona',$params);
	}

	/*
	 *
	 */
	public function getPersonas(){
		$this->db->select('idPersona, ci, nombres, apellidoPaterno, apellidoMaterno, telefono, email');
		$this->db->from('persona');
	    $this->db->order_by('apellidoPaterno','asc');

		$r = $this->db->get();
		return $r->result();
	}
}
