<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ctransacciones extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Transacciones_model');
	}

	/*
     * Listing of transacciones
     */
	function index()
	{
		$data['transacciones'] = $this->Transaccione_model->get_all_transacciones();

		$data['_view'] = 'transaccione/index';
		$this->load->view('layouts/main',$data);
	}

	/*
     * Adding a new transaccione
     */
	function add()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('tipoTransaccion','TipoTransaccion','required|max_length[45]');
		$this->form_validation->set_rules('valorActual','ValorActual','required');
		$this->form_validation->set_rules('valorDepreciacion','ValorDepreciacion','required');
		$this->form_validation->set_rules('valorAcumuladoDepreciacion','ValorAcumuladoDepreciacion','required');
		$this->form_validation->set_rules('idActivofijo','IdActivofijo','required|integer');

		if($this->form_validation->run())
		{
			$params = array(
				'idActivofijo' => $this->input->post('idActivofijo'),
				'tipoTransaccion' => $this->input->post('tipoTransaccion'),
				'valorActual' => $this->input->post('valorActual'),
				'valorDepreciacion' => $this->input->post('valorDepreciacion'),
				'valorAcumuladoDepreciacion' => $this->input->post('valorAcumuladoDepreciacion'),
			);

			$transaccione_id = $this->Transaccione_model->add_transaccione($params);
			redirect('ctransacciones/index');
		}
		else
		{
			$data['_view'] = 'transaccione/add';
			$this->load->view('layouts/main',$data);
		}
	}

	/*
     * Editing a transaccione
     */
	function edit($idTransacciones)
	{
		// check if the transaccione exists before trying to edit it
		$data['transaccione'] = $this->Transaccione_model->get_transaccione($idTransacciones);

		if(isset($data['transaccione']['idTransacciones']))
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('tipoTransaccion','TipoTransaccion','required|max_length[45]');
			$this->form_validation->set_rules('valorActual','ValorActual','required');
			$this->form_validation->set_rules('valorDepreciacion','ValorDepreciacion','required');
			$this->form_validation->set_rules('valorAcumuladoDepreciacion','ValorAcumuladoDepreciacion','required');
			$this->form_validation->set_rules('idActivofijo','IdActivofijo','required|integer');

			if($this->form_validation->run())
			{
				$params = array(
					'idActivofijo' => $this->input->post('idActivofijo'),
					'tipoTransaccion' => $this->input->post('tipoTransaccion'),
					'valorActual' => $this->input->post('valorActual'),
					'valorDepreciacion' => $this->input->post('valorDepreciacion'),
					'valorAcumuladoDepreciacion' => $this->input->post('valorAcumuladoDepreciacion'),
				);

				$this->Transaccione_model->update_transaccione($idTransacciones,$params);
				redirect('ctransacciones/index');
			}
			else
			{
				$data['_view'] = 'transaccione/edit';
				$this->load->view('layouts/main',$data);
			}
		}
		else
			show_error('The transaccione you are trying to edit does not exist.');
	}

	/*
     * Deleting transaccione
     */
	function remove($idTransacciones)
	{
		$transaccione = $this->Transaccione_model->get_transaccione($idTransacciones);

		// check if the transaccione exists before trying to delete it
		if(isset($transaccione['idTransacciones']))
		{
			$this->Transaccione_model->delete_transaccione($idTransacciones);
			redirect('ctransacciones/index');
		}
		else
			show_error('The transaccione you are trying to delete does not exist.');
	}

}
