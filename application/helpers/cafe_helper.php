<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('autentifikasi');
    }
}

// function cek_HakAkses()
// {
//     $ci = get_instance();
//     if ($ci->session->userdata('role_id') != 1 && $ci->session->userdata('role_id') != 2) {
//         redirect('autentifikasi/blok');
//     }
// }


function uang($angka){
	
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah;
}