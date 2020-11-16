<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Obtenido_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/*
     * Get all records of obtenido
     */
	function get_all_obtenido()
	{
		$this->db->order_by('obtenido', 'asc');
		return $this->db->get('obtenido')->result_array();
	}
}
