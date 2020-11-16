<?php

/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 16/11/2020
 * Time: 10:14 AM
 */
class Estado_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/*
     * Get all records of estado
     */
	function get_all_estado()
	{
		$this->db->order_by('estado', 'asc');
		return $this->db->get('estado')->result_array();
	}

	/*
     * Get all records of estado
     */
	function get_nombre_estado($idEstado)
	{
		$this->db->select('estado');
		return $this->db->get_where('estado',array('idEstado'=>$idEstado))->row_array();

	}

}
