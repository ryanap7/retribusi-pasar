<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PedagangController extends CI_Controller
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
				'title' => "Data Pedagang"
			);
			$data['admin']	 	= $this->db->query("SELECT * FROM pedagang")->result();
			$this->load->view('pages/Admin/pedagang/index.php', $data);
		} else {
			redirect('/');
		}
	}

	public function create()
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Pedagang"
			);
			$this->load->view('pages/Admin/pedagang/add', $data);
		} else {
			redirect('/');
		}
	}

	public function store()
	{
		$nama_tempat         	  = $this->input->post('nama_tempat');
		$luas         	          = $this->input->post('luas');
		$no_reg         	      = $this->input->post('no_reg');
		$date       	  	      = $this->input->post('date');
		$jenis         	      	  = $this->input->post('jenis');
		$nama         	      	  = $this->input->post('nama');
		$alamat         	      = $this->input->post('alamat');
		$telp         	     	  = $this->input->post('telp');
		$img 				      = $_FILES['img'];

		if ($img = '') {
			// Jika Field Kosong
			$img = 'default.png';
		} else {
			// Jika Field Ada
			$config['upload_path']		= './assets/img/pedagang';
			$config['allowed_types']	= 'jpg|png|jpeg';
			$config['max_size']			= 2048;
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('img')) {
				$img = $this->upload->data('file_name');
			} else {
				$img = 'default.png';
			}
		}

		$data = array(
			'nama_tempat'		  => $nama_tempat,
			'luas'				  => $luas,
			'no_registrasi'		  => $no_reg,
			'tanggal_registrasi'  => $date,
			'jenis_dagangan'	  => $jenis,
			'nama_pedagang'	      => $nama,
			'alamat'		      => $alamat,
			'no_hp'			      => $telp,
			'foto'				  => $img
		);

		$this->db->insert('pedagang', $data);
		redirect('admin/pedagang');
	}

	public function edit($id)
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Pedagang"
			);

			$data['admin'] 			= $this->db->query("SELECT * FROM pedagang WHERE id_pedagang='$id'")->result();
			$this->load->view('pages/Admin/pedagang/edit', $data);
		} else {
			redirect('/');
		}
	}

	public function update()
	{
		$id         	  		  = $this->input->post('id');
		$nama_tempat         	  = $this->input->post('nama_tempat');
		$luas         	          = $this->input->post('luas');
		$no_reg         	      = $this->input->post('no_reg');
		$date       	  	      = $this->input->post('date');
		$jenis         	      	  = $this->input->post('jenis');
		$nama         	      	  = $this->input->post('nama');
		$alamat         	      = $this->input->post('alamat');
		$telp         	     	  = $this->input->post('telp');
		$img 				      = $_FILES['img'];
		$result					  = $this->M_Admin->check_img($id);

		if ($result->num_rows() > 0) {
			$data	= $result->row_array();
			// Ambil data dari Database 
			$foto				= $data['foto'];
		}

		if ($img) {
			// Jika Field ada
			$config['upload_path']		= './assets/img/pedagang';
			$config['allowed_types']	= 'jpg|png|jpeg';
			$config['max_size']			= 2048;
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('img')) {
				$img = $this->upload->data('file_name');
				$this->db->set('foto', $img);
				if ($foto != 'default.png') {
					$target_file	= './assets/img/pedagang/' . $foto;
					unlink($target_file);
				}
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = array(
			'nama_tempat'		  => $nama_tempat,
			'luas'				  => $luas,
			'no_registrasi'		  => $no_reg,
			'tanggal_registrasi'  => $date,
			'jenis_dagangan'	  => $jenis,
			'nama_pedagang'	      => $nama,
			'alamat'		      => $alamat,
			'no_hp'			      => $telp
		);
		$where = array('id_pedagang' => $id);
		$this->db->update('pedagang', $data, $where);
		redirect('admin/pedagang');
	}

	public function delete($id)
	{
		$result					= $this->M_Admin->check_img($id);

		if ($result->num_rows() > 0) {
			$data	= $result->row_array();
			// Ambil data dari Database 
			$foto				= $data['foto'];
		}

		if ($foto != 'default.png') {
			$target_file	= './assets/img/pedagang/' . $foto;
			unlink($target_file);
		}
		$where = array('id_pedagang' => $id);
		$this->db->delete('pedagang', $where);
		redirect('admin/pedagang');
	}
}
