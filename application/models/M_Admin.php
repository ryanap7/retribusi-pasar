<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Admin extends CI_Model
{

	public function check_img($id)
	{
		$this->db->select('*');
		$this->db->from('auth');
		$this->db->where('id_auth', $id);
		$query = $this->db->get();

		return $query;
	}

	public function check_img_setting($id)
	{
		$this->db->select('*');
		$this->db->from('setting');
		$this->db->where('id', $id);
		$query = $this->db->get();

		return $query;
	}
}
