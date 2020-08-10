<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SettingController extends CI_Controller
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
				'title' => "Setting"
			);
			$data['admin'] 			= $this->db->query("SELECT * FROM setting WHERE id= 1 ")->result();
			$this->load->view('pages/Admin/setting/index.php', $data);
		} else {
			redirect('/');
		}
	}

	public function update()
	{
		$id						  = $this->input->post('id');
		$desc					  = $this->input->post('desc');
		$img 				      = $_FILES['img'];
		$result					  = $this->M_Admin->check_img_setting($id);

		if ($result->num_rows() > 0) {
			$data	= $result->row_array();
			// Ambil data dari Database 
			$foto				= $data['img'];
		}

		if ($img) {
			// Jika Field ada
			$config['upload_path']		= './assets/img/setting';
			$config['allowed_types']	= 'jpg|png|jpeg';
			$config['max_size']			= 2048;
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('img')) {
				$img = $this->upload->data('file_name');
				$this->db->set('img', $img);
				if ($foto != 'default.png') {
					$target_file	= './assets/img/setting/' . $foto;
					unlink($target_file);
				}
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = array(
			'desc'		  => $desc
		);
		$where = array('id' => $id);
		$this->db->update('setting', $data, $where);
		redirect('admin/setting');
	}
}
