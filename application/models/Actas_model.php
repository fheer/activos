<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Actas_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	/*
     * Actas count
     */
	function actas_count()
	{
		$this->db->from('actas');
		return $this->db->count_all_results();
	}

	/*
     * function to add new persona
     */
	function add_acta($params)
	{
		$this->db->insert('actas',$params);
		return $this->db->insert_id();
	}

	/*
     * get all acta
     */
	function get_all_actas()
	{
		$this->db->order_by('fecha', 'desc');
		return $this->db->get('actas')->result_array();
	}

	/*
     * get acta ny idPersona
     */
	function get_actas_($idPersona)
	{
		$this->db->where('idPersona', $idPersona);
		$this->db->order_by('fecha', 'desc');
		return $this->db->get('actas')->result_array();
	}
}
