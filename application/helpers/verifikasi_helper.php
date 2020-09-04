<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function sendEmail($subject= '',$email='', $isi = '',$smtpEmail = '', $smtpPassword = '')
{
    $CI = get_instance();
    // Konfigurasi email
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => $smtpEmail,  // Email gmail
            'smtp_pass'   => $smtpPassword,  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $CI->load->library('email', $config);
        $CI->email->set_mailtype("html");


        // Email dan nama pengirim
        $CI->email->from('admin@kopimahal.com', 'KOPI MAHAL');

        // Email penerima
        $CI->email->to($email); // Ganti dengan email tujuan

        // Lampiran email, isi dengan url/path file
        // $CI->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

        // Subject email
        $CI->email->subject($subject,'Support');

        // Isi email
        $CI->email->message($isi);

        // Tampilkan pesan sukses atau error
        if ($CI->email->send()) {
            return 'Sukses! email berhasil dikirim.';
        } else {
            return 'Error! email tidak dapat dikirim.';
        }
    }
    

