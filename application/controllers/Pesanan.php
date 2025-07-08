<?php defined('BASEPATH') or exit('No Direct Script Access Allowed');
date_default_timezone_set('Asia/Jakarta');

class Pesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        // cek_HakAkses();
        check_access([1, 2, 3]);
        $this->load->model(['ModelPesanan', 'ModelUser']);
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        // $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = "Orders";
        $data['orders'] = $this->db->query("SELECT * FROM pesanan where status='InOrder'")->result_array();
        $role_id = $this->session->userdata('role_id');
        if ($role_id == 1) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pesanan/daftar-transaksi', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/kasir/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pesanan/daftar-transaksi', $data);
            $this->load->view('templates/footer');
        }
    }
    public function keranjang()
    {
        // $id = ['pes.id_user' => $this->uri->segment(3)];
        $id_user = $this->session->userdata('id_user');
        // $data['pesanan'] = $this->ModelPesanan->joinOrder($id)->result();
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $user['nama'];

        //Cek Keranjang Kosong
        $dtb = $this->ModelPesanan->showtemp(['id_user' => $id_user])->num_rows();
        if ($dtb < 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alertmassege alert-danger" role="alert">Tidak Ada Pesanan dikeranjang</div>');
            redirect(base_url('Home'));
        } else {
            $data['temp'] = $this->db->query("select * from temp where id_user='$id_user'")->result_array();
        }
        $data['judul'] = "Keranjang";

        $this->load->view('templates/user/header-user', $data);
        $this->load->view('pesanan/keranjang', $data);
        $this->load->view('templates/user/footer-user');
    }

    public function cekItemKeranjang()
    {
        $id_produk = $this->input->post('id_produk');
        $id_user = $this->session->userdata('id_user');

        $temp = $this->ModelPesanan->getDataWhere('temp', ['id_produk' => $id_produk, 'id_user' => $id_user])->num_rows();

        echo json_encode(['exists' => $temp > 0]);
    }
    public function getJumlahItemKeranjang()
{
    $id_user = $this->session->userdata('id_user');

    $jumlah = $this->db->where('id_user', $id_user)
                       ->count_all_results('temp');

    echo json_encode(['jumlah' => $jumlah]);
}

    public function pesanandetail()
    {
        $id_user = $this->session->userdata('id_user');

        // Cek Id user Memiliki Pesanan dengan status "inorder"
        $cekstatusorder = $this->db->get_where('pesanan', ['id_user' => $id_user, 'status' => 'InOrder'])->row_array();

        if (!$cekstatusorder) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Pesanan tidak ditemukan atau sudah selesai</div>');
            redirect(base_url('Home'));
            return;
        }

        $id_pesanan = $cekstatusorder['id_pesanan'];

        // Ambil data user berdasarkan email dari sesi
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $user['nama'];

        // Cek status pesanan berdasarkan id_user dan id_pesanan
        $pesanan = $this->db->query("SELECT status FROM pesanan WHERE id_user='$id_user' AND id_pesanan='$id_pesanan'")->row_array();

        if ($pesanan['status'] == 'Complete') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Pesanan telah selesai</div>');
            redirect(base_url('Home'));
            return;
        } else {
            $dtb = $this->ModelPesanan->GetDataWhere('pesanan_detail', ['id_user' => $id_user, 'id_pesanan' => $id_pesanan])->num_rows();
            if ($dtb < 1) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Tidak Ada Pesanan di keranjang</div>');
                redirect(base_url('Home'));
                return;
            } else {
                $data['detail_pesanan'] = $this->db->query("SELECT * FROM pesanan_detail WHERE id_user='$id_user' AND id_pesanan='$id_pesanan'")->result_array();
                $data['id_pesanan'] = $id_pesanan;
            }
        }

        $data['judul'] = "Order Detail";
        $this->load->view('templates/user/header-user', $data);
        $this->load->view('pesanan/detail_pesanan', $data);
        $this->load->view('templates/user/footer-user');
    }
    public function pesanandetailBackEnd()
    {
        $id_pesanan = $this->uri->segment(3);
        $id_user = $this->session->userdata('id_user');
        // $data['pesanan'] = $this->ModelPesanan->joinOrder($id)->result();
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        // $data['user'] = $user['nama'];
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['pesanan'] = $this->ModelPesanan->getPesananById($id_pesanan);

        // Ambil detail pesanan berdasarkan ID pesanan
        $data['detail_pesanan'] = $this->ModelPesanan->getDetailPesananById($id_pesanan);


        // $data['order'] = $this->db->query("SELECT * FROM pesanan WHERE id_pesanan='$id_pesanan' AND id_user='$id_user'")->row_array();
        // $data['detail_pesanan'] = $this->db->query("SELECT * FROM pesanan_detail WHERE id_pesanan='$id_pesanan'")->result_array();

        // if (empty($data['order'])) {
        //     $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Pesanan tidak ditemukan</div>');
        //     redirect(base_url('pesanan'));
        // }

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
            $this->load->view('pesanan/daftar-detail_transaksi', $data);
            $this->load->view('templates/footer');
        } elseif ($role_id == 2) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/kasir/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pesanan/daftar-detail_transaksi', $data);
            $this->load->view('templates/footer');
        }
    }

    public function tambahPesanan()
    {
        $id_produk = $this->uri->segment(3);
        $quantity = $this->input->post('quantity');
        $note = $this->input->post('note');
        //memilih data buku yang untuk dimasukkan ke tabel temp/keranjang melalui  variabel $isi 
        $d = $this->db->query("Select*from produk where id='$id_produk'")->row();
        //berupa data2 yang akan disimpan ke dalam tabel temp/keranjang 
        if ($quantity == Null) {
            $quantity = 1;
        }
        $sub_total = $quantity * $d->harga;
        $isi = [
            'id_produk' => $id_produk,
            'nama' => $d->nama,
            'id_user' => $this->session->userdata('id_user'),
            // 'email_user' => $this->session->userdata('email'),
            // 'tgl_booking' => date('Y-m-d H:i:s'),
            'image' => $d->image,
            'harga' => $d->harga,
            'catatan' => $note,
            'jml_item' => $quantity,
            'sub_total' => $sub_total,
        ];

        // Menambahkan produk ke keranjang
        $this->ModelPesanan->insertData('temp', $isi);
        // Pesan sukses
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Item berhasil ditambahkan ke keranjang</div>');

        redirect('home');
    }

    public function updateQuantity()
    {
        $id_produk = $this->input->post('id_produk');
        $quantity = $this->input->post('quantity');
        $id_user = $this->session->userdata('id_user');

        // Jika kuantitas kurang dari 1, set ke 1
        if ($quantity < 1) {
            $quantity = 1;
        }

        // Update quantity and subtotal in temp table
        $product = $this->db->get_where('produk', ['id' => $id_produk])->row();
        $sub_total = $quantity * $product->harga;

        $data = [
            'jml_item' => $quantity,
            'sub_total' => $sub_total
        ];

        $this->db->where(['id_produk' => $id_produk, 'id_user' => $id_user]);
        $this->db->update('temp', $data);

        echo json_encode(['status' => 'success']);
    }

    public function updateNote()
    {
        $id_produk = $this->input->post('id_produk');
        $note = $this->input->post('note');
        $id_user = $this->session->userdata('id_user');

        $this->ModelPesanan->updateData('temp', ['catatan' => $note], ['id_produk' => $id_produk, 'id_user' => $id_user]);

        echo json_encode(['status' => 'success']);
    }

    public function hapuspesanan()
    {
        $id_produk = $this->uri->segment(3);
        $id_user = $this->session->userdata('id_user');
        $this->ModelPesanan->deleteData(['id_produk' => $id_produk, 'id_user' => $id_user], 'temp');
        $kosong = $this->db->query("select*from temp where id_user='$id_user'")->num_rows();

        if ($kosong < 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-massege alert-danger" role="alert">Tidak Ada Pesanan dikeranjang</div>');
            redirect(base_url('home'));
        } else {
            redirect(base_url() . 'pesanan/keranjang');
        }
    }

    // public function confirm() {
    //     $data['title'] = 'Confirmation';
    //     $this->load->view('confirmation_view', $data);
    // }
    public function konfirmasiPesanan()
    {
        $id_user = $this->session->userdata('id_user');

        // Ambil data pesanan dari tabel temp untuk user tersebut
        $keranjang = $this->db->get_where('temp', ['id_user' => $id_user])->result_array();

        // Jika tidak ada pesanan di keranjang, kembalikan dengan pesan error
        if (empty($keranjang)) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Tidak Ada Pesanan di keranjang</div>');
            redirect(base_url('home'));
            return;
        }

        // Generate new invoice regardless of existing orders
        $date_part = date('Ymd');
        $this->db->select('MAX(RIGHT(id_pesanan, 4)) as max_invoice');
        $this->db->like('id_pesanan', 'CX' . $date_part, 'after');
        $query = $this->db->get('pesanan');
        $max_invoice = $query->row()->max_invoice;
        $new_invoice_number = $max_invoice ? sprintf("%04d", $max_invoice + 1) : '0001';
        $invoice = 'CX' . $date_part . $new_invoice_number;

        $total_harga = 0;
        $total_item = 0;

        foreach ($keranjang as $item) {
            $total_harga += $item['sub_total'];
            $total_item += $item['jml_item'];
        }

        // Ambil metode pembayaran dari input form
        // $metodepembayaran = $this->input->post('MetodePembayaran');

        // Buat pesanan baru
        $data_pesanan = [
            'id_user' => $id_user,
            'id_pesanan' => $invoice,
            'total_item' => $total_item,
            'total_harga' => $total_harga,
            'tgl_pesanan' => date('Y-m-d H:i:s'),
            'status' => 'InOrder',
            // 'Pembayaran' => $metodepembayaran,
            // 'NominalBayar' => $total_harga
        ];
        $this->db->insert('pesanan', $data_pesanan);

        // Insert pesanan ke dalam tabel detail pesanan
        foreach ($keranjang as $item) {
            $data_detailpesanan = [
                'id_pesanan' => $invoice,
                'id_user' => $id_user,
                'id_produk' => $item['id_produk'],
                'image' => $item['image'],
                'nama' => $item['nama'],
                'harga' => $item['harga'],
                'catatan' => $item['catatan'],
                'jml_item' => $item['jml_item'],
                'sub_total' => $item['sub_total'],
                'tgl_pesanan' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('pesanan_detail', $data_detailpesanan);
            // Update stok dan sold pada tabel produk dengan query sederhana
            $this->db->query("UPDATE produk SET stok = stok - {$item['jml_item']}, sold = sold + {$item['jml_item']} WHERE id = {$item['id_produk']}");
        }

        // Hapus semua data di temp untuk user tersebut setelah dikonfirmasi
        $this->db->delete('temp', ['id_user' => $id_user]);

        // Set pesan sukses
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Pesanan berhasil dikonfirmasi</div>');

        redirect(base_url('customer/PembayaranSelesai'));
    }

    public function pesananSelesai()
    {
        $id_pesanan = $this->input->post('id_pesanan');
        $nominal_dibayar = $this->input->post('nominal_dibayar_hidden');
        $pesanan = $this->ModelPesanan->getPesananById($id_pesanan);

        // Pastikan ID pesanan ada
        if (!$id_pesanan) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">ID Pesanan tidak ditemukan</div>');
            redirect(base_url('pesanan'));
            return;
        }

        // Ambil data pesanan berdasarkan ID
        if (empty($pesanan) || $pesanan['status'] != 'InOrder') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Pesanan tidak ditemukan atau sudah diantar</div>');
            redirect(base_url('pesanan'));
            return;
        }

        // Simpan nominal dibayar ke dalam database
        $data = array(
            'NominalBayar' => $nominal_dibayar,
        );
        $this->db->where('id_pesanan', $id_pesanan);
        $this->db->update('pesanan', $data);

        // Update status pesanan menjadi Complete
        if ($this->ModelPesanan->updateStatusPesanan($id_pesanan, 'Complete')) {
            // Ambil semua detail pesanan berdasarkan ID pesanan
            $detail_pesanan = $this->ModelPesanan->getDetailPesananByPesananId($id_pesanan);

            // Update status semua detail pesanan menjadi Complete
            foreach ($detail_pesanan as $detail) {
                $this->ModelPesanan->updateStatusDetailPesanan($detail['id'], 'Complete');
            }

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Status pesanan dan detail pesanan berhasil diperbarui menjadi Complete</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Gagal memperbarui status pesanan</div>');
        }

        redirect(base_url('pesanan/pesanandetailBackEnd'));
    }

    public function cancelPesanan()
    {
        $this->load->model('ModelPesanan'); // Memuat model pesanan

        $id_detail_pesanan = $this->input->post('id_detail_pesanan');
        $detail_pesanan = $this->ModelPesanan->getDetailPesananById($id_detail_pesanan);
        $id_pesanan = $detail_pesanan['id_pesanan'];

        //Update Status
        $this->ModelPesanan->updateStatusDetailPesanan($id_detail_pesanan, 'Canceled');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Pesanan dibatalkan</div>');

        redirect(base_url('pesanan/pesanandetailBackEnd/') . $id_pesanan);
    }
    // public function cancelPesanan()
    // {
    //     $id_pesanan = $this->input->post('id_detail_pesanan');

    //     // Ambil detail pesanan berdasarkan ID
    //     $detail = $this->ModelPesanan->getDetailPesananById($id_pesanan);

    //     if ($detail && $detail['status'] == 'Pending') {
    //         // Update status detail pesanan menjadi 'Canceled'
    //         if ($this->ModelPesanan->updateStatusDetailPesanan($id_pesanan, 'Canceled')) {
    //             $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Detail pesanan berhasil dibatalkan</div>');
    //         } else {
    //             $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Gagal membatalkan detail pesanan</div>');
    //         }
    //     } else {
    //         $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Detail pesanan tidak ditemukan atau sudah diproses</div>');
    //     }

    //     redirect(base_url('pesanan/pesanandetailBackEnd/') . $id_pesanan);
    // }




    // public function pesananSelesai()
    // {
    //     $id_pesanan = $this->input->post('id_pesanan');
    //     $pesanan = $this->ModelPesanan->getPesananById($id_pesanan);
    //     $nominal_dibayar = $this->input->post('nominal_dibayar_hidden');

    //     // Pastikan ID pesanan ada
    //     if (!$id_pesanan) {
    //         $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">ID Pesanan tidak ditemukan</div>');
    //         redirect(base_url('pesanan'));
    //         return;
    //     }

    //     // Ambil data pesanan berdasarkan ID
    //     if (empty($pesanan) || $pesanan['status'] != 'InOrder') {
    //         $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Pesanan tidak ditemukan atau sudah diantar</div>');
    //         redirect(base_url('pesanan'));
    //         return;
    //     }

    //     $data = array(
    //         'NominalDibayar' => $nominal_dibayar,
    //     );

    //     // Update status pesanan menjadi Complete
    //     if ($this->ModelPesanan->updateStatusPesanan($id_pesanan, 'Complete')) {
    //         // Ambil semua detail pesanan berdasarkan ID pesanan
    //         $detail_pesanan = $this->ModelPesanan->getDetailPesananByPesananId($id_pesanan);

    //         // Update status semua detail pesanan menjadi Complete
    //         foreach ($detail_pesanan as $detail) {
    //             $this->ModelPesanan->updateStatusDetailPesanan($detail['id'], 'Complete');
    //         }

    //         $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Status pesanan dan detail pesanan berhasil diperbarui menjadi Complete</div>');
    //     } else {
    //         $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Gagal memperbarui status pesanan</div>');
    //     }

    //     redirect(base_url('pesanan/pesanandetailBackEnd'));
    // }

    public function UpdateStatusDetailPesanan()
    {
        $this->load->model('ModelPesanan'); // Memuat model pesanan

        $id_detail_pesanan = $this->input->post('id_detail_pesanan');
        $detail_pesanan = $this->ModelPesanan->getDetailPesananById($id_detail_pesanan);
        $id_pesanan = $detail_pesanan['id_pesanan'];

        //Update Status
        $this->ModelPesanan->updateStatusDetailPesanan($id_detail_pesanan, 'Complete');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Status detail pesanan berhasil diperbarui menjadi complete</div>');

        redirect(base_url('pesanan/pesanandetailBackEnd/') . $id_pesanan);

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

        // Pastikan variabel $pesanan ada
        if (empty($data['pesanan'])) {
            show_error('Pesanan tidak ditemukan', 404);
        }

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