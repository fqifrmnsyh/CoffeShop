<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        // cek_HakAkses();
        check_access([1,2]);
    }

    public function index()
    {
        $data['judul'] = 'My Profile';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $role_id = $this->session->userdata('role_id');
        if ($role_id==1){
            $this->load->view('templates/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
        } elseif ($role_id==2){
        $this->load->view('templates/header', $data);
        $this->load->view('templates/kasir/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
        }
    }

    public function anggota()
    {
        check_access([1]);

        $data['judul'] = 'User Data';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        // $this->db->where('role_id', 1);
        $data['anggota'] = $this->db->get('user')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/anggota', $data);
        $this->load->view('templates/footer');

        
    }

    public function daftar() 
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
            'role_id' => 2, 
            'is_active' => 1, 
            'tanggal_input' => time() 
        ];
        $this->ModelUser->simpanData($data); 
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Selamat!! akun anggota anda sudah dibuat.</div>');         
        redirect('user/anggota'); 
    } 
     

    public function ubahProfil()
    {
        $data['judul'] = 'Ubah Profil';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('telepon', 'Nomor Telepon', 'min_length[11]', [
            // 'required' => 'Nomor telepon tidak Boleh Kosong',
            'min_length' => 'Nomor telepon terlalu pendek'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat tidak Boleh Kosong'
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = $this->input->post('nama', true);
            $telepon = $this->input->post('telepon', true);
            $alamat = $this->input->post('alamat', true);
            $email = $this->input->post('email', true);

            //jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '10000';
                $config['max_width'] = '1024';
                $config['max_height'] = '1000';
                $config['file_name'] = 'pro' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $gambar_lama = $data['user']['image'];
                    if ($gambar_lama != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
                    }

                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else { }
            }

            $this->db->set('nama', $nama);
            $this->db->set('telepon', $telepon);
            $this->db->set('alamat', $alamat);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Profil Berhasil diubah </div>');
            redirect('user');
        }
    }

    public function ubahPassword()
    {
        $data['judul'] = 'Ubah Password';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('password_sekarang', 'Password Saat ini', 'required|trim', [
            'required' => 'Password saat ini harus diisi'
        ]);

        $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[4]|matches[password_baru2]', [
            'required' => 'Password Baru harus diisi',
            'min_length' => 'Password tidak boleh kurang dari 4 digit',
            'matches' => 'Password Baru tidak sama dengan ulangi password'
        ]);

        $this->form_validation->set_rules('password_baru2', 'Konfirmasi Password Baru', 'required|trim|min_length[4]|matches[password_baru1]', [
            'required' => 'Ulangi Password harus diisi',
            'min_length' => 'Password tidak boleh kurang dari 4 digit',
            'matches' => 'Ulangi Password tidak sama dengan password baru'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/ubah-password', $data);
            $this->load->view('templates/footer');
        } else {
            $pwd_skrg = $this->input->post('password_sekarang', true);
            $pwd_baru = $this->input->post('password_baru1', true);
            if (!password_verify($pwd_skrg, $data['user']['password'])) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password Saat ini Salah!!! </div>');
                redirect('user/ubahPassword');
            } else {
                if ($pwd_skrg == $pwd_baru) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password Baru tidak boleh sama dengan password saat ini!!! </div>');
                    redirect('user/ubahPassword');
                } else {
                    //password ok
                    $password_hash = password_hash($pwd_baru, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Password Berhasil diubah</div>');
                    redirect('user/ubahPassword');
                }
            }
        }
    }

    public function hapus($id) {
        // Hapus anggota berdasarkan ID
        $this->ModelUser->hapusAnggota($id);
        // Set flash data untuk pesan sukses
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Anggota berhasil dihapus!</div>');
        // Redirect ke halaman anggota
        redirect('user/anggota');
    }
}
