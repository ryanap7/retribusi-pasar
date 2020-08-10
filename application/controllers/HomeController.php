<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in' !== TRUE)) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data = array(
            'title' => "Pasar Sidamulya"
        );
        $data['pegawai']                     = $this->db->query('SELECT * FROM pegawai')->num_rows();
        $data['pedagang']                    = $this->db->query('SELECT * FROM pedagang')->num_rows();
        $data['setoran']                     = $this->db->query('SELECT SUM(jumlah) as total FROM setoran')->result();
        $this->load->view('home', $data);
    }
}
