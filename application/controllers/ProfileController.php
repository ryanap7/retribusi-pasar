<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in' !== TRUE)) {
			redirect('auth');
		}
	}

	public function edit()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data = array(
				'title' => "Edit Profile"
			);
			$data['profile'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
			$this->load->view('pages/profile/edit', $data);
		} else {
			echo "
				<script>
					alert('Access Denied');
					history.go(-1);
				</script>
			";
		}
	}

	public function update()
	{
		$id					= $this->input->post('id');
		$name				= $this->input->post('name');
		$email           	= $this->input->post('email');
		$img 				= $_FILES['img'];
		$result				= $this->M_Admin->check_img($id);

		if ($result->num_rows() > 0) {
			$data	= $result->row_array();
			// Ambil data dari Database 
			$foto				= $data['img'];
		}

		if ($img) {
			// Jika Field ada
			$config['upload_path']		= './assets/img/avatar';
			$config['allowed_types']	= 'jpg|png|jpeg';
			$config['max_size']			= 2048;
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('img')) {
				$img = $this->upload->data('file_name');
				$this->db->set('img', $img);
				if ($foto != 'default.png') {
					$target_file	= './assets/img/avatar/' . $foto;
					unlink($target_file);
				}
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = array(
			'name'			=> $name,
			'email'		=> $email
		);

		$where = array('id_auth' => $id);
		$this->M_Auth->update('auth', $data, $where);
		redirect('profile/edit');
	}

	public function changepassword()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data['profile'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();

			$this->form_validation->set_rules('lama', 'Current Password', 'trim|required');
			$this->form_validation->set_rules('baru', 'New Password', 'trim|required|min_length[3]|matches[konfirmasi]');
			$this->form_validation->set_rules('konfirmasi', 'Confirm New Password', 'trim|required|min_length[3]|matches[baru]');


			if ($this->form_validation->run()  == FALSE) {
				$data = array(
					'title' => "Ubah Password"
				);
				$data['profile'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
				$this->load->view('pages/profile/changepassword', $data);
			} else {
				$lama		= $this->input->post('lama');
				$baru		= $this->input->post('baru');
				$lama_hash 	= sha1($lama);
				if ($lama_hash == $data['profile']['password']) {
					if ($lama == $baru) {
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New Password cannot be the same!</div>');
						redirect('profile/changepassword');
					} else {
						$password_hash = sha1($baru);

						$this->db->set('password', $password_hash);
						$this->db->where('id_auth', $this->session->userdata('id'));
						$this->db->update('auth');

						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Changed</div>');
						redirect('profile/changepassword');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Current Password!</div>');
					redirect('profile/changepassword');
				}
			}
		} else {
			echo "
				<script>
					alert('Access Denied');
					history.go(-1);
				</script>
			";
		}
	}
}
