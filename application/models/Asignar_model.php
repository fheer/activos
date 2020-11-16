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
	function add_asginacion($params)
	{
		$this->db->insert('asignacion',$params);
		return $this->db->insert_id();
	}
}
