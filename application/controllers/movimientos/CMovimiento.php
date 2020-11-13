<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CMovimiento extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Movimiento_model');
	}

	/*
    * Listing of bitacora_movimiento
    */
	function index()
	{
		$data['bitacora_movimiento'] = $this->Movimiento_model->get_all_bitacora_movimiento();

		$data['_view'] = 'bitacora_movimiento/index';
		$this->load->view('layouts/main', $data);
	}

	/*
    * Adding a new bitacora_movimiento
    */
	function listaLugares($idLugar)
	{
		$data['lugares'] = $this->Movimiento_model->get_all_lugar($idLugar);
		$data['foto'] = $this->Movimiento_model->get_photo_place_mov($idLugar);
		$data['idLugar'] = $idLugar;
		$this->load->view('layout/header');
		$this->load->view('movimientos/vmovimiento', $data);
		$this->load->view('layout/footer');
	}

	/*
    * List of activos
    */

	function listaActivosLugar($idLugar)
	{
		$data['nombre'] = $this->Movimiento_model->get_name_lugar($idLugar);
		$data['foto'] = $this->Movimiento_model->get_photo_place_mov($idLugar);
		$data['idLugar'] = $idLugar;
		$this->load->view('layout/header');
		$this->load->view('movimientos/vactivoslugar', $data);
		$this->load->view('layout/footer');
	}

	/*
    * List of activos
    */

	function asignar()
	{
		$data['activo'] = $this->Movimiento_model->get_all_activo();
		$data['lugar'] = $this->Movimiento_model->get_all_lugar();
		$this->load->view('layout/header');
		$this->load->view('movimientos/vasignar', $data);
		$this->load->view('layout/footer');
	}


	/*
	* Get name
	*/
	function get_name_lugar($idLugar)
	{
		return $this->Movimiento_model->get_name_lugar($idLugar);
	}

	/*
	* Adding a new bitacora_movimiento
	*/
	function add()
	{
		$params = array(
			'movimiento' => 'Asginar',
			'idActivofijo' => $this->input->post('idActivofijo'),
			'idLugar' => $this->input->post('idLugar'),
			'fechaDe' => $this->input->post('fechaDe'),
			'fechaHasta' => $this->input->post('fechaHasta'),
		);

		$this->Movimiento_model->add_movimiento($params);
		redirect(base_url() . 'movimientos/CMovimiento/listaLugares/1');
	}


	/*
	* Editing a bitacora_movimiento
	*/
	function edit($idBitacora)
	{
		$params = array(
			'movimiento' => 'Asginar',
			'idActivofijo' => $this->input->post('idActivofijo'),
			'idLugar' => $this->input->post('idLugar'),
			'fechaDe' => $this->input->post('fechaDe'),
			'fechaHasta' => $this->input->post('fechaHasta'),
		);

		$this->Movimiento_model->update_bitacora_movimiento($idBitacora, $params);
		redirect(base_url() . 'movimientos/CMovimiento');

	}

	/*
	* Deleting bitacora_movimiento
	*/
	function remove($idBitacora)
	{
		$this->Movimiento_model->delete_bitacora_movimiento($idBitacora);
		redirect('cbitacora_movimiento/index');
	}
}
