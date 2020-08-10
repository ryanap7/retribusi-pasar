<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SetoranController extends CI_Controller
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
				'title' => "Data Setoran Retribusi"
			);
			$data['admin']	 	= $this->db->query("SELECT * FROM setoran INNER JOIN pedagang ON setoran.id_pedagang = pedagang.id_pedagang")->result();
			$this->load->view('pages/Admin/setoran/index.php', $data);
		} else {
			redirect('/');
		}
	}

	public function create()
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Setoran Retribusi"
			);

			$data['pedagang']	 	= $this->db->query("SELECT * FROM pedagang")->result();
			$this->load->view('pages/Admin/setoran/add', $data);
		} else {
			redirect('/');
		}
	}

	public function store()
	{
		$pedagang         	      = $this->input->post('pedagang');
		$tanggal         	      = $this->input->post('date');
		$jumlah         	      = $this->input->post('jumlah');

		$data = array(
			'id_pedagang'		  => $pedagang,
			'tanggal'			  => $tanggal,
			'ket'				  => 'Lunas',
			'jumlah'			  => $jumlah
		);

		$this->db->insert('setoran', $data);
		redirect('admin/setoran');
	}

	public function edit($id)
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Setoran Pegawai"
			);

			$data['pedagang']	 	= $this->db->query("SELECT * FROM pedagang")->result();
			$data['admin'] 			= $this->db->query("SELECT * FROM setoran INNER JOIN pedagang ON setoran.id_pedagang = pedagang.id_pedagang WHERE id_setoran='$id'")->result();
			$this->load->view('pages/Admin/setoran/edit', $data);
		} else {
			redirect('/');
		}
	}

	public function update()
	{
		$id						  = $this->input->post('id');
		$pedagang         	      = $this->input->post('pedagang');
		$tanggal         	      = $this->input->post('date');
		$jumlah         	      = $this->input->post('jumlah');

		$data = array(
			'id_pedagang'		  => $pedagang,
			'tanggal'			  => $tanggal,
			'jumlah'			  => $jumlah
		);

		$where = array('id_setoran' => $id);
		$this->db->update('setoran', $data, $where);
		redirect('admin/setoran');
	}

	public function delete($id)
	{
		$where = array('id_setoran' => $id);
		$this->db->delete('setoran', $where);
		redirect('admin/setoran');
	}

	public function search()
	{
		$id_pedagang = $_GET['id_pedagang'];

		$result['pedagang']					= $this->db->query("SELECT * FROM pedagang WHERE id_pedagang = '$id_pedagang'")->result();
		$result['harga']					= $this->db->query("SELECT * FROM harga WHERE id_harga = 1")->result();

		echo json_encode($result);
	}
}
