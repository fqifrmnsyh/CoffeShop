<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('check_access')) {
    /**
     * Fungsi untuk memeriksa akses pengguna berdasarkan role_id.
     *
     * @param array $allowed_roles Daftar role_id yang diizinkan mengakses halaman.
     */
    function check_access($allowed_roles = [])
    {
        $ci = get_instance();
        $role_id = $ci->session->userdata('role_id');
        
        if (!in_array($role_id, $allowed_roles)) {
            redirect('autentifikasi/blok');
        }
    }
}
?>
