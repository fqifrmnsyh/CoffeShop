<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        // cek_HakAkses();
        check_access([1, 2]);
    }

    //manajemen Produk
    public function index()
    {
        $data['judul'] = 'Product Data';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['produk'] = $this->ModelProduk->getProduk()->result_array();
        $data['kategori'] = $this->ModelProduk->getKategori()->result_array();
        // $data['produk'] = $this->db->query("SELECT produk.*, kategori.kategori FROM produk JOIN kategori ON produk.id_kategori = kategori.id");
        $role_id = $this->session->userdata('role_id');
        $query = $this->db->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id");


        $this->form_validation->set_rules('nama', 'Nama Produk', 'required|min_length[0]', [
            'required' => 'Nama produk tidak boleh kosong',
            // 'min_length' => 'Judul produk terlalu pendek'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Belum memilih kategori produk',
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'required|min_length[3]', [
            'required' => 'Harga tidak boleh kosong',
            'min_length' => 'Harga terlalu murah'
        ]);
        $this->form_validation->set_rules('kode', 'Kode Produk', 'required|min_length[3]', [
            'required' => 'Kode produk tidak boleh kosong',
            'min_length' => 'Kode produk terlalu pendek'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [
            'required' => 'Stok tidak boleh kosong',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|min_length[1]', [
            'required' => 'Deskripsi tidak boleh kosong',
            'min_length' => 'Deskripsi terlalu pendek'
        ]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '';
        $config['max_width'] = '';
        $config['max_height'] = '';
        $config['file_name'] = 'img' . time();

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {

            if ($role_id == 1) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/admin/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('produk/index', $data);
                $this->load->view('templates/footer');
            } else {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/kasir/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                // $this->load->view('templates/templates-user/navbar');
                $this->load->view('produk/index', $data);
                // $this->load->view('templates/templates-user/modal');
                $this->load->view('templates/footer');
            }
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else {
                $gambar = '';
            }

            $data = [
                'nama' => $this->input->post('nama', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'harga' => $this->input->post('harga', true),
                'kode' => $this->input->post('kode', true),
                'stok' => $this->input->post('stok', true),
                'deskripsi' => $this->input->post('deskripsi', true),
                'image' => $gambar
            ];

            $this->ModelProduk->simpanProduk($data);
            redirect('produk');
        }
    }

    public function hapusProduk()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelProduk->hapusProduk($where);
        redirect('produk');
    }

    public function ubahProduk()
    {
        $data['judul'] = 'Edit Product';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['produk'] = $this->ModelProduk->produkWhere(['id' => $this->uri->segment(3)])->result_array();
        $kategori = $this->ModelProduk->joinKategoriProduk(['produk.id' => $this->uri->segment(3)])->result_array();
        foreach ($kategori as $k) {
            $data['id'] = $k['id_kategori'];
            $data['k'] = $k['kategori'];
        }
        $data['kategori'] = $this->ModelProduk->getKategori()->result_array();

        $this->form_validation->set_rules('nama', 'Nama Produk', 'required|min_length[0]', [
            'required' => 'Nama produk tidak boleh kosong',
            // 'min_length' => 'Judul produk terlalu pendek'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Belum memilih kategori produk',
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'required|min_length[3]', [
            'required' => 'Harga tidak boleh kosong',
            'min_length' => 'Harga terlalu murah'
        ]);
        $this->form_validation->set_rules('kode', 'Kode Produk', 'required|min_length[3]', [
            'required' => 'Kode produk tidak boleh kosong',
            'min_length' => 'Kode produk terlalu pendek'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [
            'required' => 'Stok tidak boleh kosong',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|min_length[1]', [
            'required' => 'Deskripsi tidak boleh kosong',
            'min_length' => 'Deskripsi terlalu pendek'
        ]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '';
        $config['max_width'] = '';
        $config['max_height'] = '';
        $config['file_name'] = 'img' . time();

        //memuat atau memanggil library upload
        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('produk/ubah_produk', $data); //ubah nanti
            // $this->load->view('produk/ubah_produk', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));
                $gambar = $image['file_name'];
            } else {
                $gambar = $this->input->post('old_pict', TRUE);
            }

            $data = [
                'nama' => $this->input->post('nama', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'harga' => $this->input->post('harga', true),
                'kode' => $this->input->post('kode', true),
                'stok' => $this->input->post('stok', true),
                'deskripsi' => $this->input->post('deskripsi', true),
                'image' => $gambar
            ];

            $this->ModelProduk->updateProduk($data, ['id' => $this->input->post('id')]);
            redirect('produk');
        }
    }

    //manajemen kategori
    public function kategori()
    {
        $data['judul'] = 'Product Category';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelProduk->getKategori()->result_array();

        $this->form_validation->set_rules('kategori', 'Kategori', 'required', [
            'required' => 'Nama Produk harus diisi'
        ]);
        $this->form_validation->set_rules('kode', 'Kode', 'required', [
            'required' => 'Nama Produk harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            // $this->load->view('buku/kategori', $data);
            $this->load->view('produk/kategori', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kategori' => $this->input->post('kategori', TRUE),
                'kode' => $this->input->post('kode', TRUE)
            ];

            $this->ModelProduk->simpanKategori($data);
            // redirect('buku/kategori');
            redirect('produk/kategori');
        }
    }

    public function ubahKategori()
    {
        $data['judul'] = 'Ubah Data Kategori';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelProduk->kategoriWhere(['id' => $this->uri->segment(3)])->result_array();


        $this->form_validation->set_rules('kategori', 'Nama Kategori', 'required|min_length[3]', [
            'required' => 'Nama Kategori harus diisi',
            'min_length' => 'Nama Kategori terlalu pendek'
        ]);
        $this->form_validation->set_rules('kode', 'Kode Kategori', 'required|min_length[2]', [
            'required' => 'Kode Kategori harus diisi',
            'min_length' => 'Kode Kategori terlalu pendek'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('produk/ubah_kategori', $data);
            // $this->load->view('produk/ubah_kategori', $data);
            $this->load->view('templates/footer');
        } else {

            $data = [
                'kategori' => $this->input->post('kategori', true),
                'kode' => $this->input->post('kode', true)
            ];

            $this->ModelProduk->updateKategori(['id' => $this->input->post('id')], $data);
            // redirect('buku/kategori');
            redirect('produk/kategori');
        }
    }

    public function hapusKategori()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelProduk->hapusKategori($where);
        // redirect('buku/kategori');
        redirect('produk/kategori');
    }
}
