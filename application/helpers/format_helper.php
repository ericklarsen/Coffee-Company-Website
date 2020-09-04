<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
function echo_array($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

/** 
 * @Desc: Fungsi untuk mengatur pesan untuk form validation 
 * @Category: Controller 
 * @Author: Alhadi Budiyanto 
 * @Date: 2019-10-06 14:56:42 
 * @Param1:  
 * @Param2:   
 */
function setMsgValidation()
{
    $CI = get_instance();

    $CI->form_validation->set_error_delimiters('<h6 id="text-error" class="help-block help-block-error">', '</h6>');
    $CI->form_validation->set_message('min_length', 'Jumlah karakter minimal adalah {param}.');
    $CI->form_validation->set_message('required', '{field} wajib diisi.');
    $CI->form_validation->set_message('alpha_numeric_spaces', 'Isi {field} dengan benar.');
    $CI->form_validation->set_message('valid_email', 'Isi dengan format email yang benar.');
    $CI->form_validation->set_message('is_unique', '{field} sudah terdaftar');
    $CI->form_validation->set_message('matches', '{field} tidak cocok dengan {param}.');
    $CI->form_validation->set_message('numeric', '{field} harus diisi dengan angka.');
    $CI->form_validation->set_message('max_length', 'Jumlah karakter maksimal adalah {param}.');
}


function rupiah_format($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}

function commaToDot($angka)
{
    return str_replace(",", ".", $angka);
}

function remove_number_format($angka)
{
    $angka = str_replace(".", "", $angka);
    $angka = str_replace(",", "", $angka);
    return $angka;
}

function remove_rupiah_format($angka)
{
    $angka = str_replace("Rp ", "", $angka);
    $angka = str_replace(".", "", $angka);
    $angka = str_replace(",00", "", $angka);
    return $angka;
}

// function word_cut($text, $num_char)
// {
//     $char     = $text{
//         $num_char - 1};
//     while ($char != ' ') {
//         $char = $text{
//             ++$num_char}; // Cari spasi pada posisi 51, 52, 53, dst...
//     }
//     return substr($text, 0, $num_char) . '...';
// }

function gathered_data($th = array())
{
    for ($i = 0; $i < count($th); $i++) {
        $row[]  = $th[$i];
    }
    return $row;
}

function number_format_decimal($angka)
{
    return number_format($angka, 2, '.', ',');
}

function generate_breadcrumb($link)
{
    $x = array('<a href="' . base_url() . 'pengelola_scc/dashboard">Beranda</a>');
    $count = 0;
    foreach ($link as $lnk) {
        $count++;
        if ($count != count($link)) {
            $lnk2 = str_replace(' ', '_', $lnk);
            //Jika sudah sama, berarti sampai pada page terakhir sehingga harus "active" 
            $lnk = '<a href="' . base_url() . 'pengelola_scc/' . strtolower($lnk2) . '">' . $lnk . '</a>';
        }
        array_push($x, $lnk);
    }
    return $x;
}

function generate_breadcrumb2($link)
{
    $x = array('<a href="' . base_url() . 'perusahaan/dashboard">Beranda</a>');
    $count = 0;
    foreach ($link as $lnk) {
        $count++;
        if ($count != count($link)) {
            $lnk2 = str_replace(' ', '_', $lnk);
            //Jika sudah sama, berarti sampai pada page terakhir sehingga harus "active" 
            $lnk = '<a href="' . base_url() . 'perusahaan/' . strtolower($lnk2) . '">' . $lnk . '</a>';
        }
        array_push($x, $lnk);
    }
    return $x;
}

function generate_breadcrumb3($link)
{
    $x = array('<a href="' . base_url() . 'pelamar/dashboard">Beranda</a>');
    $count = 0;
    foreach ($link as $lnk) {
        $count++;
        if ($count != count($link)) {
            $lnk2 = str_replace(' ', '_', $lnk);
            //Jika sudah sama, berarti sampai pada page terakhir sehingga harus "active" 
            $lnk = '<a href="' . base_url() . 'pelamar/' . strtolower($lnk2) . '">' . $lnk . '</a>';
        }
        array_push($x, $lnk);
    }
    return $x;
}

function check_empty_form($data, $exclude_list = array())
{
    $empty = 0;
    foreach ($data as $key => $val) {
        if (!$val && !in_array($key, $exclude_list))
            $empty++;
    }
    return $empty;
}
