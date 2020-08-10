<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PegawaiController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in' !== TRUE)) {
			redirect('/auth');
		}
	}

	public function index()
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Pegawai"
			);
			$data['admin']	 	= $this->db->query("SELECT * FROM pegawai")->result();
			$this->load->view('pages/Admin/pegawai/index.php', $data);
		} else {
			redirect('/');
		}
	}

	public function create()
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Pegawai"
			);
			$this->load->view('pages/Admin/pegawai/add', $data);
		} else {
			redirect('/');
		}
	}

	public function store()
	{
		$name         	          = $this->input->post('name');
		$jabatan         	      = $this->input->post('jabatan');
		$telp       	  	      = $this->input->post('telp');
		$alamat         	      = $this->input->post('alamat');

		$data = array(
			'nama'			=> $name,
			'jabatan'		=> $jabatan,
			'no_hp'			=> $telp,
			'alamat'		=> $alamat
		);

		$this->db->insert('pegawai', $data);
		redirect('admin/pegawai');
	}

	public function edit($id)
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Pegawai"
			);

			$data['admin'] 			= $this->db->query("SELECT * FROM pegawai WHERE id_pegawai='$id'")->result();
			$this->load->view('pages/Admin/pegawai/edit', $data);
		} else {
			redirect('/');
		}
	}

	public function update()
	{
		$id_pegawai         	  = $this->input->post('id');
		$name         	          = $this->input->post('name');
		$jabatan         	      = $this->input->post('jabatan');
		$telp       	  	      = $this->input->post('telp');
		$alamat         	      = $this->input->post('alamat');

		$data = array(
			'id_pegawai'	=> $id_pegawai,
			'nama'			=> $name,
			'jabatan'		=> $jabatan,
			'no_hp'			=> $telp,
			'alamat'		=> $alamat
		);
		$where = array('id_pegawai' => $id_pegawai);
		$this->db->update('pegawai', $data, $where);
		redirect('admin/pegawai');
	}

	public function delete($id)
	{
		$where = array('id_pegawai' => $id);
		$this->db->delete('pegawai', $where);
		redirect('admin/pegawai');
	}
}
