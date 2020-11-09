<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CMovimiento extends CI_Controller{
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
$this->load->view('layouts/main',$data);
}

	/*
    * Adding a new bitacora_movimiento
    */
function listaLugares($idLugar)
{
	$data['lugares'] = $this->Movimiento_model->get_all_lugar($idLugar);
	$data['foto'] = $this->Movimiento_model->get_photo_place_mov($idLugar);
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
	$this->load->view('layout/header');
	$this->load->view('movimientos/vactivoslugar', $data);
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
$this->load->library('form_validation');

$this->form_validation->set_rules('eliminado','Eliminado','required');
$this->form_validation->set_rules('movimiento','Movimiento','required|max_length[45]');
$this->form_validation->set_rules('idActivofijo','IdActivofijo','required|integer');
$this->form_validation->set_rules('idLugar','IdLugar','required');
$this->form_validation->set_rules('fechaDe','FechaDe','required');
$this->form_validation->set_rules('fechaHasta','FechaHasta','required');

if($this->form_validation->run())
{
$params = array(
'eliminado' => $this->input->post('eliminado'),
'movimiento' => $this->input->post('movimiento'),
'idActivofijo' => $this->input->post('idActivofijo'),
'idLugar' => $this->input->post('idLugar'),
'fechaDe' => $this->input->post('fechaDe'),
'fechaHasta' => $this->input->post('fechaHasta'),
);

$bitacora_movimiento_id = $this->Bitacora_movimiento_model->add_bitacora_movimiento($params);
redirect('cbitacora_movimiento/index');
}
else
{
$data['_view'] = 'bitacora_movimiento/add';
$this->load->view('layouts/main',$data);
}
}

/*
* Editing a bitacora_movimiento
*/
function edit($idBitacora)
{
// check if the bitacora_movimiento exists before trying to edit it
$data['bitacora_movimiento'] = $this->Bitacora_movimiento_model->get_bitacora_movimiento($idBitacora);

if(isset($data['bitacora_movimiento']['idBitacora']))
{
$this->load->library('form_validation');

$this->form_validation->set_rules('eliminado','Eliminado','required');
$this->form_validation->set_rules('movimiento','Movimiento','required|max_length[45]');
$this->form_validation->set_rules('idActivofijo','IdActivofijo','required|integer');
$this->form_validation->set_rules('idLugar','IdLugar','required');
$this->form_validation->set_rules('fechaDe','FechaDe','required');
$this->form_validation->set_rules('fechaHasta','FechaHasta','required');

if($this->form_validation->run())
{
$params = array(
'eliminado' => $this->input->post('eliminado'),
'movimiento' => $this->input->post('movimiento'),
'idActivofijo' => $this->input->post('idActivofijo'),
'idLugar' => $this->input->post('idLugar'),
'fechaDe' => $this->input->post('fechaDe'),
'fechaHasta' => $this->input->post('fechaHasta'),
);

$this->Bitacora_movimiento_model->update_bitacora_movimiento($idBitacora,$params);
redirect('cbitacora_movimiento/index');
}
else
{
$data['_view'] = 'bitacora_movimiento/edit';
$this->load->view('layouts/main',$data);
}
}
else
show_error('The bitacora_movimiento you are trying to edit does not exist.');
}

/*
* Deleting bitacora_movimiento
*/
function remove($idBitacora)
{
$bitacora_movimiento = $this->Bitacora_movimiento_model->get_bitacora_movimiento($idBitacora);

// check if the bitacora_movimiento exists before trying to delete it
if(isset($bitacora_movimiento['idBitacora']))
{
$this->Bitacora_movimiento_model->delete_bitacora_movimiento($idBitacora);
redirect('cbitacora_movimiento/index');
}
else
show_error('The bitacora_movimiento you are trying to delete does not exist.');
}

}
