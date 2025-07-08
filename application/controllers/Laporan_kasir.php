<?php
defined('BASEPATH') or exit('No Direct script access allowed');
class Laporan_kasir extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        // cek_HakAkses();
        check_access([1, 2]);
    }
    public function laporan_produk()
    {
        $data['judul'] = 'Laporan Data Produk';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['produk'] = $this->ModelProduk->getProduk()->result_array();
        $data['kategori'] = $this->ModelProduk->getKategori()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/kasir/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('produk/laporan_produk', $data);
        $this->load->view('templates/footer');
    }

    public function cetak_laporan_produk()
    {
        $data['produk'] = $this->ModelProduk->getProduk()->result_array();
        $data['kategori'] = $this->ModelProduk->getKategori()->result_array();

        $this->load->view('produk/laporan_print_produk', $data);
    }
    
    public function laporan_produk_pdf()
    {
        $data['produk'] = $this->ModelProduk->getProduk()->result_array();
        $data['kategori'] = $this->ModelProduk->getKategori()->result_array();
        // $this->load->library('dompdf_gen');
        $sroot = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/web-cafe/application/third_party/dompdf/autoload.inc.php";
        $dompdf = new Dompdf\Dompdf();
        $this->load->view('produk/laporan_pdf_produk', $data);
        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape';
        //tipe format kertas potrait ataulandscape
        $html = $this->output->get_output();
        // $dompdf->setpaper($paper_size, $orientation);
        $dompdf->set_paper($paper_size, $orientation);

        //Convert to PDF
        // $dompdf->loadhtml($html);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream(
            "laporan_data_produk.pdf",
            array(
                'Attachment' =>
                    0
            )
        );
        // nama file pdf yang di hasilkan
    }

    public function export_excel()
    {
        $data = array('title' => 'Laporan Produk', 'produk' => $this->ModelProduk->getProduk()->result_array());
        $this->load->view('produk/export_excel_produk', $data);
    }

    // public function laporan_beli()
    // {
    //     $data['judul'] = 'Laporan Data Pembelian';
    //     $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    //     $data['laporan'] = $this->db->query("select * from beli b,detail_beli d,produk p,user u where d.id_produk=p.id and b.id_user=u.id and b.no_beli=d.no_pinjam")->result_array();
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/kasir/sidebar');
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('pinjam/laporan-pinjam', $data);
    //     $this->load->view('templates/footer');
    // }
    
    // public function cetak_laporan_beli()
    // {
    //     $data['laporan'] = $this->db->query("select * from beli b,detail_beli d,produk p,user u where d.id_produk=p.id and b.id_user=u.id and b.no_beli=d.no_pinjam")->result_array();
    //     $this->load->view('beli/laporan-print-beli', $data);
    // }
    
    // public function laporan_beli_pdf()
    // {
    //     $data['laporan'] = $this->db->query("select * from beli b,detail_beli d,produk p,user u where d.id_produk=p.id and b.id_user=u.id and b.no_beli=d.no_pinjam")->result_array();
    //     // $this->load->library('dompdf_gen');
    //     $sroot = $_SERVER['DOCUMENT_ROOT'];
    //     include $sroot . "/web-cafe/application/third_party/dompdf/autoload.inc.php";
    //     $dompdf = new Dompdf\Dompdf();
    //     $this->load->view('beli/laporan-pdf-beli', $data);
    //     $paper_size = 'A4'; // ukuran kertas
    //     $orientation = 'landscape'; //tipe format kertas potrait atau landscape
    //     $html = $this->output->get_output();
    //     $dompdf->set_paper($paper_size, $orientation);
    //     //Convert to PDF
    //     $dompdf->load_html($html);
    //     $dompdf->render();
    //     $dompdf->stream("laporan data pembelian.pdf", array('Attachment' => 0));
    //     // nama file pdf yang di hasilkan
    // }

    // public function export_excel_beli()
    // {
    //     $data = array('title' => 'Laporan Data Pembelian', 'laporan' => $this->db->query("select * from beli b,detail_pinjam d,produk p,user u where d.id_produk=p.id and b.id_user=u.id and b.no_beli=d.no_beli")->result_array());
    //     $this->load->view('beli/export-excel-beli', $data);
    // }

}