<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HargaTempatController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in' !== TRUE)) {
			redirect('/');
		}
	}

	public function index()
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Harga Tempat"
			);
			$data['admin'] 			= $this->db->query("SELECT * FROM harga WHERE id_harga= 1 ")->result();
			$this->load->view('pages/Admin/harga/index.php', $data);
		} else {
			redirect('/');
		}
	}

	public function update()
	{
		$id						  = $this->input->post('id');
		$kios					  = $this->input->post('kios');
		$los					  = $this->input->post('los');

		$data = array(
			'kios'		  => $kios,
			'los'		  => $los
		);
		$where = array('id_harga' => $id);
		$this->db->update('harga', $data, $where);
		redirect('admin/harga_tempat');
	}
}
