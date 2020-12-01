<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Motivobaja_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	/*
     * Get all activofijo
     */
	function get_all_motivobaja()
	{
		$this->db->where('eliminado=',1);
		$this->db->order_by('idMotivoBaja', 'asc');
		return $this->db->get('motivobaja')->result_array();
	}
}
