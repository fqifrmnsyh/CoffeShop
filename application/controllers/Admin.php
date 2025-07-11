<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        // cek_HakAkses();
        check_access([1]);
    }
    public function index()
    {
        $data['judul'] = '<span class="text-danger">Admin</span> Dashboard';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['anggota'] = $this->ModelUser->getUserLimit()->result_array();
        $data['produk'] = $this->ModelProduk->getLimitProduk()->result_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
}
