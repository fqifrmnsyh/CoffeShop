<?php

class Customer extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['judul'] = 'Registrasi';
        $this->load->view('templates/aute_header', $data);
        $this->load->view('customer/daftar');
        $this->load->view('templates/aute_footer');
    }
    public function daftarCustomer()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', [
            'required' => 'Nama Belum diis!!'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'required', [
            'required' => 'Alamat Belum diis!!'
        ]);
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[user.email]', [
            'valid_email' => 'Email Tidak Benar!!',
            'required' => 'Email Belum diisi!!',
            'is_unique' => 'Email Sudah Terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password 2]', [
            'matches' => 'Password Tidak Sama!!',
            'min_length' => 'Password Terlalu Pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');
        $email = $this->input->post('email', true);
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'alamat' => $this->input->post('alamat', true),
            'email' => htmlspecialchars($email),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'role_id' => 3,
            'is_active' => 1,
            'tanggal_input' => time()
        ];
        $this->ModelUser->simpanData($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Selamat!! akun anggota anda sudah dibuat.</div>');
        redirect(base_url());
        $this->load->view('templates/aute_header', $data);
        $this->load->view('customer/daftar');
        $this->load->view('templates/aute_footer');
    }
    public function PembayaranSelesai()
    {
        // Dapatkan data pesanan terakhir atau sesuai kebutuhan
        $id_user = $this->session->userdata('id_user');
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $user['nama'];
        $data['judul'] = "Pembayaran Selesai";

        $pesanan = $this->db->order_by('tgl_pesanan', 'DESC')->get_where('pesanan', ['id_user' => $id_user])->row_array();

        // Jika tidak ada pesanan ditemukan, alihkan ke halaman home
        if (!$pesanan) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Tidak ada pesanan yang ditemukan.</div>');
            redirect(base_url('home'));
            return;
        }

        $data['pesanan'] = $pesanan;

        $this->load->view('templates/user/header-user', $data);
        $this->load->view('customer/pembayaranselesai', $data);
        $this->load->view('templates/user/footer-user');

    }

    public function cetakPesanan($id_pesanan)
    {
        $sroot = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/web-cafe/application/third_party/dompdf/autoload.inc.php";

        $dompdf = new Dompdf\Dompdf();

        $data['pesanan'] = $this->db->get_where('pesanan', ['id_pesanan' => $id_pesanan])->row_array();
        $data['judul'] = "Cetak Rincian Pesanan";

        $this->load->view('customer/cetak', $data);

        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'portrait'; // orientasi kertas
        $html = $this->output->get_output();

        $dompdf->set_paper($paper_size, $orientation);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("pesanan_$id_pesanan.pdf", array('Attachment' => 0));
    }

    // public function cancelPesanan()
    // {
    //     $id_detail_pesanan = $this->input->post('id_detail_pesanan');

    //     // Ambil detail pesanan berdasarkan ID
    //     $detail = $this->ModelPesanan->getDetailPesananById($id_detail_pesanan);

    //     if ($detail && $detail['status'] == 'Pending') {
    //         // Update status detail pesanan menjadi 'Canceled'
    //         if ($this->ModelPesanan->updateStatusDetailPesanan($id_detail_pesanan, 'Canceled')) {
    //             $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Detail pesanan berhasil dibatalkan</div>');
    //         } else {
    //             $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Gagal membatalkan detail pesanan</div>');
    //         }
    //     } else {
    //         $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Detail pesanan tidak ditemukan atau sudah diproses</div>');
    //     }

    //     // Redirect kembali ke halaman detail pesanan
    //     redirect('HistoriTransaksi/pesanandetailCustomer/' . $id_detail_pesanan);
    // }


}

