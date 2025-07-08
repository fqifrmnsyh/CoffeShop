<?php
class HistoriTransaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        // cek_HakAkses();
        check_access([1, 2, 3,]);
    }

    public function index()
    {
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = "Transaction History";
        $data['orders'] = $this->db->query("SELECT * FROM pesanan where status='Complete'")->result_array();
        $role_id = $this->session->userdata('role_id');
        if ($role_id == 1) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pesanan/histori-transaksi', $data);
            $this->load->view('templates/footer');
        } elseif ($role_id == 2) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/kasir/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pesanan/histori-transaksi', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/user/header-user', $data);
            $this->load->view('customer/histori-transaksi', $data);
            $this->load->view('templates/user/footer-user');
        }
    }
    public function pesananCustomer()
    {
        // $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $id_user = $this->session->userdata('id_user');
        $data['user'] = $user['nama'];
        $data['judul'] = "Orders";
        $data['orders'] = $this->db->query("SELECT * FROM pesanan where id_user = $id_user order by tgl_pesanan desc")->result_array();
        $role_id = $this->session->userdata('role_id');

        $this->load->view('templates/user/header-user', $data);
        $this->load->view('customer/histori-transaksi', $data);
        $this->load->view('templates/user/footer-user');

    }

    public function pesanandetailBackEnd()
    {
        $id_pesanan = $this->uri->segment(3);
        // $id_user = $this->session->userdata('id_user');
        // $data['pesanan'] = $this->ModelPesanan->joinOrder($id)->result();
        // $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        // $data['user'] = $user['nama'];
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['pesanan'] = $this->ModelPesanan->getPesananById($id_pesanan);

        // Ambil detail pesanan berdasarkan ID pesanan
        $data['detail_pesanan'] = $this->ModelPesanan->getDetailPesananById($id_pesanan);

        $dtb = $this->ModelPesanan->GetDataWhere('pesanan_detail', ['id_pesanan' => $id_pesanan])->num_rows();

        // echo var_dump($dtb);
        // die;
        if ($dtb < 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alertmassege alert-danger" role="alert">Tidak Ada Pesanan dikeranjang</div>');
            redirect(base_url('pesanan'));
        } else {
            $data['detail_pesanan'] = $this->db->query("select * from pesanan_detail where id_pesanan='$id_pesanan'")->result_array();
        }
        $data['judul'] = "Order Detail";

        $role_id = $this->session->userdata('role_id');
        if ($role_id == 1) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pesanan/histori-detail_transaksi', $data);
            $this->load->view('templates/footer');
        } elseif ($role_id == 2) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/kasir/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            // $this->load->view('templates/templates-user/navbar');
            $this->load->view('pesanan/histori-detail_transaksi', $data);
            // $this->load->view('templates/templates-user/modal');
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/user/header-user', $data);
            $this->load->view('customer/histori-detail_transaksi', $data);
            $this->load->view('templates/user/footer-user');
        }
    }
    public function pesanandetailCustomer()
    {
        $id_pesanan = $this->uri->segment(3);
        // $id_user = $this->session->userdata('id_user');
        // $data['pesanan'] = $this->ModelPesanan->joinOrder($id)->result();
        // $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        // $data['user'] = $user['nama'];
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $user['nama'];
        $data['pesanan'] = $this->ModelPesanan->getPesananById($id_pesanan);

        // Ambil detail pesanan berdasarkan ID pesanan
        $data['detail_pesanan'] = $this->ModelPesanan->getDetailPesananById($id_pesanan);

        $dtb = $this->ModelPesanan->GetDataWhere('pesanan_detail', ['id_pesanan' => $id_pesanan])->num_rows();

        // echo var_dump($dtb);
        // die;
        if ($dtb < 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alertmassege alert-danger" role="alert">Tidak Ada Pesanan dikeranjang</div>');
            redirect(base_url('pesanan'));
        } else {
            $data['detail_pesanan'] = $this->db->query("select * from pesanan_detail where id_pesanan='$id_pesanan'")->result_array();
        }
        $data['judul'] = "Order Detail";

        // $role_id = $this->session->userdata('role_id');

        $this->load->view('templates/user/header-user', $data);
        $this->load->view('customer/histori-detail_transaksi', $data);
        $this->load->view('templates/user/footer-user');

    }

    public function exportToPdf()
    {
        $id_pesanan = $this->input->post('id_pesanan'); // Mengambil id_pesanan dari form
        $data['judul'] = "Cetak Bukti Pesanan";
        $data['user'] = $this->session->userdata('nama');
        $data['useraktif'] = $this->ModelUser->cekData(['id' => $this->session->userdata('id_user')])->result();

        // Mengambil detail pesanan dan produk terkait
        $data['pesanan'] = $this->db->query("SELECT * FROM pesanan WHERE id_pesanan = '$id_pesanan'")->row_array();
        $data['detail_pesanan'] = $this->db->query("SELECT d.*, p.nama, p.image FROM pesanan_detail d JOIN produk p ON d.id_produk = p.id WHERE d.id_pesanan = '$id_pesanan'")->result_array();

        // Load library dompdf
        $sroot = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/web-cafe/application/third_party/dompdf/autoload.inc.php";
        $dompdf = new Dompdf\Dompdf();

        // Load view untuk PDF
        $this->load->view('pesanan/bukti-pdf', $data);
        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'portrait'; // tipe format kertas potrait atau landscape
        $html = $this->output->get_output();
        $dompdf->set_paper($paper_size, $orientation);

        // Convert to PDF
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("bukti-pesanan-{$id_pesanan}.pdf", array('Attachment' => 0));
    }

}