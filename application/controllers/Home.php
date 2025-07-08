<?php 

class Home extends CI_Controller{

    function __construct(){
        parent::__construct();
    }

    public function index(){
        $data = [
            'judul' => "Katalog Produk",
            'produk' => $this->ModelProduk->getProduk()->result(),
            'kategori' => $this->ModelProduk->getKategori()->result(),
            //show by category
            'produk_by_kategori' => array(
                'Makanan' => $this->ModelProduk->get_produk_by_kategori_id(1), // id_kategori untuk Makanan
                'Minuman' => $this->ModelProduk->get_produk_by_kategori_id(2),  // id_kategori untuk Minuman
                'Snack' => $this->ModelProduk->get_produk_by_kategori_id(3)  // id_kategori untuk Minuman
            ),
        ];
        //view for show by category
        // $this->load->view('produk/daftarproduk2', $data);

        //jika sudah login dan jika belum login
        if ($this->session->userdata('email')) {
            $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

            $data['user'] = $user['nama'];
            $this->load->view('templates/user/header-user', $data);
            $this->load->view('produk/katalog', $data);
            $this->load->view('templates/user/footer-user');
        } else {
            $data['user'] = 'Pengunjung';
            $this->load->view('templates/user/header-user', $data);
            $this->load->view('produk/katalog', $data);
            $this->load->view('templates/user/footer-user');
        }
    }

    public function about(){
        $data = [
            'judul' => "About Us",
        ];
        if ($this->session->userdata('email')) {
            $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

            $data['user'] = $user['nama'];
            $this->load->view('templates/user/header-user', $data);
            $this->load->view('produk/about', $data);
            $this->load->view('templates/user/footer-user');
        } else {
            $data['user'] = 'Pengunjung';
            $this->load->view('templates/user/header-user', $data);
            $this->load->view('produk/about', $data);
            $this->load->view('templates/user/footer-user');
        }
    }

    public function faq(){
        $data = [
            'judul' => "About Us",
        ];
        if ($this->session->userdata('email')) {
            $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

            $data['user'] = $user['nama'];
            $this->load->view('templates/user/header-user', $data);
            $this->load->view('produk/faq', $data);
            $this->load->view('templates/user/footer-user');
        } else {
            $data['user'] = 'Pengunjung';
            $this->load->view('templates/user/header-user', $data);
            $this->load->view('produk/faq', $data);
            $this->load->view('templates/user/footer-user');
        }
    }

    public function detailProduk(){

        $id = $this->uri->segment(3);
        $produk = $this->ModelProduk->joinKategoriProduk(['produk.id' => $id])->result();
        $data['produk'] = $this->ModelProduk->getProduk()->result_array();
        
        $data['judul'] = "Detail Produk";
        
        foreach ($produk as $fields) {
            $data['nama'] = $fields->nama;
            $data['harga'] = $fields->harga;
            $data['kategori'] = $fields->kategori;
            $data['gambar'] = $fields->image;
            $data['stok'] = $fields->stok;
            $data['id'] = $id;
            $data['deskripsi'] = $fields->deskripsi;
        }
        


        if ($this->session->userdata('email')) {
            $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

            $data['user'] = $user['nama'];
            $this->load->view('templates/user/header-user', $data);
        $this->load->view('produk/menu-detail', $data);
        $this->load->view('templates/user/footer-user');
        } else {
            $data['user'] = 'Pengunjung';
            $this->load->view('templates/user/header-user', $data);
        $this->load->view('produk/menu-detail', $data);
        $this->load->view('templates/user/footer-user');
        }
    }
    
}

?>