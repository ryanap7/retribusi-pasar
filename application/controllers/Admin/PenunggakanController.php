<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenunggakanController extends CI_Controller
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
				'title' => "Data Penunggakan Retribusi"
			);
			$data['admin']	 	= $this->db->query("SELECT * FROM penunggakan INNER JOIN pedagang ON penunggakan.id_pedagang = pedagang.id_pedagang")->result();
			$this->load->view('pages/Admin/penunggakan/index.php', $data);
		} else {
			redirect('/');
		}
	}

	public function create()
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Penunggakan Retribusi"
			);

			$data['pedagang']	 	= $this->db->query("SELECT * FROM pedagang")->result();
			$this->load->view('pages/Admin/penunggakan/add', $data);
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
			'bayar'				  => $jumlah
		);

		$this->db->insert('penunggakan', $data);
		redirect('admin/penunggakan');
	}

	public function edit($id)
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Penunggakan Pegawai"
			);

			$data['pedagang']	 	= $this->db->query("SELECT * FROM pedagang")->result();
			$data['admin'] 			= $this->db->query("SELECT * FROM penunggakan INNER JOIN pedagang ON penunggakan.id_pedagang = pedagang.id_pedagang WHERE id_penunggakan='$id'")->result();
			$this->load->view('pages/Admin/penunggakan/edit', $data);
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
			'bayar'			  => $jumlah
		);

		$where = array('id_penunggakan' => $id);
		$this->db->update('penunggakan', $data, $where);
		redirect('admin/penunggakan');
	}

	public function delete($id)
	{
		$where = array('id_penunggakan' => $id);
		$this->db->delete('penunggakan', $where);
		redirect('admin/penunggakan');
	}

	public function search()
	{
		$id_pedagang = $_GET['id_pedagang'];

		$result					= $this->db->query("SELECT * FROM pedagang WHERE id_pedagang = '$id_pedagang'")->result();

		echo json_encode($result);
	}
}
