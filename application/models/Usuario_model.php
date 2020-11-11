<?php

class Usuario_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/*
     * Get all users and persona
     */
	function get_name_all_usuario_personal()
	{
		$this->db->select(" concat_ws(' ', IFNULL(P.apellidoPaterno,''), IFNULL(P.apellidoMaterno,''), P.nombres) As nombre, 
						  P.foto, U.user, U.permiso, U.idUsuario");
		$this->db->from("persona P");
		$this->db->join('usuario U','U.idPersona = P.idPersona', 'inner');
		$this->db->where('U.eliminado=', 1);
		return $this->db->get()->result_array();
	}

	/*
     * Get all personas
     */
	function get_name_all__personas()
	{
		$this->db->select(" concat_ws(' ', IFNULL(P.apellidoPaterno,''), IFNULL(P.apellidoMaterno,''), P.nombres) As nombre, 
						  P.idPersona, P.email");
		$this->db->from("persona P");
		return $this->db->get()->result_array();
	}

	/*
     * Get meail persona
     */
	function get_email_persona($idPersona)
	{
		$this->db->select("email");
		$this->db->from("persona");
		$this->db->where("idPersona",$idPersona);
		$r = $this->db->get();

		$resultado = $r->row();
		return $resultado->email;
	}

	/*
     * Get meail persona
     */
	function verify_user_name($user)
	{
		//$this->db->select("email");
		$this->db->from("usuario");
		$this->db->where("user",$user);
		$r = $this->db->get();

		return $r->num_rows();
		if ($r->num_rows() == 1) {
			return 1;
		}else{
			return 0;
		}
	}

	/*
     * Get usuario by idUsuario
     */
	function get_usuario($idUsuario)
	{
		return $this->db->get_where('usuario',array('idUsuario'=>$idUsuario))->row_array();
	}

	/*
     * Get all usuario
     */
	function get_all_usuario()
	{
		$this->db->order_by('idUsuario', 'desc');
		return $this->db->get('usuario')->result_array();
	}

	/*
     * function to add new usuario
     */
	function add_usuario($params)
	{
		$this->db->insert('usuario',$params);
		return $this->db->insert_id();
	}

	/*
     * function to update usuario
     */
	function update_usuario($idUsuario,$params)
	{
		$this->db->where('idUsuario',$idUsuario);
		return $this->db->update('usuario',$params);
	}

	/*
     * function to delete usuario
     */
	function delete_usuario($idUsuario, $params)
	{
		$this->db->where('idUsuario',$idUsuario);
		return $this->db->update('usuario',$params);
	}

	/*
	 * Genenetare User Name
	 */
	public function generate_user_name($idPersona){
		$this->db->select('idPersona, nombres, apellidoPaterno');
		$this->db->from('persona');
		$this->db->where('idPersona',$idPersona);

		return $this->db->get()->result_array();
	}
}
