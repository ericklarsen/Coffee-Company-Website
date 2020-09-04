<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Utama extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Md_artikel');
        $this->load->model('Md_artikelKind');
        $this->load->model('Md_item');
        $this->load->model('Md_itemHighlight');
        $this->load->model('Md_itemKind');
        $this->load->model('Md_workshop');
        $this->load->model('Md_gallery');
        $this->load->model('Md_slideshow');
        $this->load->model('Md_background');
        $this->load->model('Md_logo');
        $this->load->model('Md_user');
        $this->load->model('Md_order');
        $this->load->model('Md_contact');
        $this->load->model('Md_testimoni');
        $this->load->model('Md_sosmed');
        $this->load->model('Md_email');
        $this->load->model('Md_kopiOption');

        $this->load->helper('format');
        $this->load->helper('verifikasi');
    }

    public function index()
    {
        $page_data['carousel'] = $this->Md_slideshow->getAllData();
        $page_data['shop'] = $this->Md_item->getAllData_Limit(2);
        $page_data['background'] = $this->Md_background->getAllData();
        $page_data['sosmed'] = $this->Md_sosmed->getAllData();
        $page_data['itemHighlight'] = $this->Md_itemHighlight->getAllData();
        $page_data['testimoni'] = $this->Md_testimoni->getAllData();
        $page_data['title'] = 'Kopi Mahal';
        $page_data['page_name'] = 'index';
        $page_data['page_function'] = __FUNCTION__;
        $this->load->view('utama/index', $page_data);
    }

    public function gallery()
    {
        $page_data['gallery'] = $this->Md_gallery->getAllData();
        $page_data['sosmed'] = $this->Md_sosmed->getAllData();
        $page_data['background'] = $this->Md_background->getAllData();
        $page_data['title'] = 'Galeri - Kopi Mahal';
        $page_data['page_name'] = 'gallery';
        $page_data['page_function'] = __FUNCTION__;
        $this->load->view('utama/gallery', $page_data);
    }

    public function contact_us($param1 = '')
    {
        $page_data['background'] = $this->Md_background->getAllData();
        $page_data['sosmed'] = $this->Md_sosmed->getAllData();
        if ($param1 == 'pesan') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('first_name', 'first_name', 'required');
            $this->form_validation->set_rules('last_name', 'last_name', 'required');
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('phone', 'phone', 'required');
            $this->form_validation->set_rules('message', 'message', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', "gagal");
            } else {
                $data1['first_name'] = $this->input->post('first_name');
                $data1['last_name'] = $this->input->post('last_name');
                $data1['email'] = $this->input->post('email');
                $data1['phone'] = $this->input->post('phone');
                $data1['message'] = $this->input->post('message');

                $this->Md_contact->addContact($data1);
                $this->session->set_flashdata('message', "berhasil");

                $dataEmail = $this->Md_email->getAllData();
                $notif = $this->load->view('staff/email_notif', $data1, true);
                sendEmail('Pesan Baru!', $dataEmail[1]['email'], $notif, $dataEmail[0]['email'], $dataEmail[0]['password']);
            }

            redirect('utama/contact_us');
        } else {
            $page_data['title'] = 'Kontak Kami - Kopi Mahal';
            $page_data['page_name'] = 'contact_us';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('utama/contact-us', $page_data);
        }
    }

    public function artikel($param1 = '', $param2 = '')
    {
        $page_data['background'] = $this->Md_background->getAllData();
        $page_data['sosmed'] = $this->Md_sosmed->getAllData();
        if ($param1 == 'detail') {
            $page_data['artikel'] = $this->Md_artikel->getDataById($param2);
            $page_data['rekomendasi'] = $this->Md_artikel->getAllData_Limit(2);
            $page_data['title'] = 'Artikel - Kopi Mahal';
            $page_data['id_artikel'] = $param2;
            $page_data['page_name'] = 'artikel';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('utama/artikel-detail', $page_data);
        } elseif ($param2) {
            // Load Library
            $this->load->library('pagination');

            // Config
            $config['base_url'] = base_url() . 'artikel/' . $param1;
            $config['total_rows'] = count($this->Md_item->getAllItem());
            $config['per_page'] = 12;

            // Initialize
            $this->pagination->initialize($config);

            $start = $param2;
            $page_data['artikel'] = $this->Md_item->getAllItem($config['per_page'], $start);
        } else {
            // Styling
            $config['full_tag_open'] = '<div class="store-page">';
            $config['full_tag_close'] = '</div>';

            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<a>';
            $config['first_tag_close'] = '</a>';

            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<a>';
            $config['last_tag_close'] = '</a>';

            $config['next_link'] = '<i class="fa fa-caret-right" aria-hidden="true"></i>';
            $config['next_tag_open'] = '<a>';
            $config['next_tag_close'] = '</a>';

            $config['prev_link'] = '<i class="fa fa-caret-left" aria-hidden="true"></i>';
            $config['prev_tag_open'] = '<a>';
            $config['prev_tag_close'] = '</a>';

            $config['cur_tag_open'] = '<a class="active">';
            $config['cur_tag_close'] = '</a>';

            $config['num_tag_open'] = '<a>';
            $config['num_tag_close'] = '</a>';


            // Load Library
            $this->load->library('pagination');

            // Config
            $config['base_url'] = base_url() . 'utama/artikel/';
            $config['total_rows'] = count($this->Md_artikel->getAllArtikel());
            $config['per_page'] = 9;

            // Initialize
            $this->pagination->initialize($config);

            $start = $this->uri->segment(3);
            $page_data['artikel'] = $this->Md_artikel->getAllArtikel($config['per_page'], $start);
            $page_data['artikel_top'] = $this->Md_artikel->getDataByTopPage(1);


            $list_artikelKind = $this->Md_artikelKind->getAllData();
            $select_artikelKind[''] = 'Select Type';
            foreach ($list_artikelKind as $row) {
                $select_artikelKind[($row->id_artikelKind)] = $row->name;
            }
            $page_data['artikelKind'] = $select_artikelKind;

            $page_data['title'] = 'Artikel - Kopi Mahal';
            $page_data['page_name'] = 'artikel';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('utama/artikel', $page_data);
        }
    }

    public function workshop()
    {
        $page_data['workshop'] = $this->Md_workshop->getAllData();
        $page_data['title'] = 'Workshop - Kopi Mahal';
        $page_data['background'] = $this->Md_background->getAllData();
        $page_data['sosmed'] = $this->Md_sosmed->getAllData();
        $page_data['page_name'] = 'workshop';
        $page_data['page_function'] = __FUNCTION__;
        $this->load->view('utama/workshop', $page_data);
    }

    public function tentang_kami()
    {
        $page_data['title'] = 'Kopi Mahal';
        $page_data['background'] = $this->Md_background->getAllData();
        $page_data['sosmed'] = $this->Md_sosmed->getAllData();
        $page_data['page_name'] = 'tentang-kami';
        $page_data['page_function'] = __FUNCTION__;
        $this->load->view('utama/tentang-kami', $page_data);
    }

    public function penyajianKopi($param1 = '')
    {
        $list_penyajian = $this->Md_kopiOption->getDataByOption('penyajian');
        foreach ($list_penyajian as $row) {
            if ($row->id_kopiOption == $param1) {
                echo $row->description;
                echo "<a target='blank' href='" . base_url() . 'utama/artikel/detail/' . $row->id_artikel . "' class='artikel'>Baca lebih lanjut &nbsp;<i class='fa fa-caret-right'></i></a>";
            }
        }
    }

    public function bijiKopi($param1 = '')
    {
        $list_biji = $this->Md_kopiOption->getDataByOption('biji');
        foreach ($list_biji as $row) {
            if ($row->id_kopiOption == $param1) {
                echo $row->description;
                echo "<a target='blank' href='" . base_url() . 'utama/artikel/detail/' . $row->id_artikel . "' class='artikel'>Baca lebih lanjut &nbsp;<i class='fa fa-caret-right'></i></a>";
            }
        }
    }

    public function brewingKopi($param1 = '')
    {
        $list_brewing = $this->Md_kopiOption->getDataByOption('brewing');
        foreach ($list_brewing as $row) {
            if ($row->id_kopiOption == $param1) {
                echo $row->description;
                echo "<a target='blank' href='" . base_url() . 'utama/artikel/detail/' . $row->id_artikel . "' class='artikel'>Baca lebih lanjut &nbsp;<i class='fa fa-caret-right'></i></a>";
            }
        }
    }

    // public function roastedLevel($param1 = '')
    // {
    //     $list_roasted = $this->Md_kopiOption->getDataByOption('roasted');
    //     foreach ($list_roasted as $row) {
    //         if ($row->id_kopiOption == $param1) {
    //             echo $row->description;
    //             echo "<a target='blank' href='" . base_url() . 'utama/artikel/detail/' . $row->id_artikel . "' class='artikel'>Baca lebih lanjut &nbsp;<i class='fa fa-caret-right'></i></a>";
    //         }
    //     }
    // }

    function kopi($param1 = '', $param2 = '')
    {
        if ($param1 == 'pesan') {
            $this->load->library('form_validation');
            $opsiPesanan = $this->input->post('opsiPesanan');
            $opsiPesanan2 = $this->input->post('opsiPesanan2');
            if ($opsiPesanan == '0' || $opsiPesanan2 == '0') {
                if ($opsiPesanan2 == '0') {
                    $this->form_validation->set_rules('nama_pemesan2', 'nama_pemesan2', 'required');
                    $this->form_validation->set_rules('telp2', 'telp2', 'required');
                    $this->form_validation->set_rules('whatsapp2', 'whatsapp2', 'required');
                    $this->form_validation->set_rules('email2', 'email2', 'required');
                    $this->form_validation->set_rules('alamat2', 'alamat2', 'required');
                    $this->form_validation->set_rules('kelurahan2', 'kelurahan2', 'required');
                    $this->form_validation->set_rules('kecamatan2', 'kecamatan2', 'required');
                    $this->form_validation->set_rules('catatan2', 'catatan2', 'required');
                } else {
                    $this->form_validation->set_rules('nama_pemesan', 'nama_pemesan', 'required');
                    $this->form_validation->set_rules('telp', 'telp', 'required');
                    $this->form_validation->set_rules('whatsapp', 'whatsapp', 'required');
                    $this->form_validation->set_rules('email', 'email', 'required');
                    $this->form_validation->set_rules('alamat', 'alamat', 'required');
                    $this->form_validation->set_rules('kelurahan', 'kelurahan', 'required');
                    $this->form_validation->set_rules('kecamatan', 'kecamatan', 'required');
                    $this->form_validation->set_rules('catatan', 'catatan', 'required');
                }
                $this->form_validation->set_rules('biji_kopi', 'biji_kopi', 'required');
                $this->form_validation->set_rules('penyajian_kopi', 'penyajian_kopi', 'required');
                $this->form_validation->set_rules('volume_kopi', 'volume_kopi', 'required');
                $this->form_validation->set_rules('brewing_method', 'brewing_method', 'required');
                $this->form_validation->set_rules('roasted_level', 'roasted_level', 'required');

                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'title' => 'Pemesanan Gagal!', 'msg' => 'Harap mengisi seluruh form dengan lengkap');
                } else {
                    $data1['id_order_form'] = 'ON-' . date("YmdHis");
                    $data1['id_order_detail'] = 'OD-' . date("YmdHis");
                    if ($opsiPesanan2 == '0') {
                        $data1['opsiPesanan'] = $this->input->post('opsiPesanan2');
                        $data1['nama_pemesan'] = $this->input->post('nama_pemesan2');
                        $data1['telp'] = $this->input->post('telp2');
                        $data1['whatsapp'] = $this->input->post('whatsapp2');
                        $data1['email'] = $this->input->post('email2');
                        $data1['alamat'] = $this->input->post('alamat2');
                        $data1['kelurahan'] = $this->input->post('kelurahan2');
                        $data1['kecamatan'] = $this->input->post('kecamatan2');
                        $data1['kota'] = $this->input->post('name_kota_penerima2');
                        $data1['provinsi'] = $this->input->post('name_provinsi_penerima2');
                        $data1['catatan'] = $this->input->post('catatan2');
                        $data3['nama_pemesan'] = $this->input->post('nama_pemesan2');
                    } else {
                        $data1['opsiPesanan'] = $this->input->post('opsiPesanan');
                        $data1['nama_pemesan'] = $this->input->post('nama_pemesan');
                        $data1['telp'] = $this->input->post('telp');
                        $data1['whatsapp'] = $this->input->post('whatsapp');
                        $data1['email'] = $this->input->post('email');
                        $data1['alamat'] = $this->input->post('alamat');
                        $data1['kelurahan'] = $this->input->post('kelurahan');
                        $data1['kecamatan'] = $this->input->post('kecamatan');
                        $data1['kota'] = $this->input->post('name_kota_penerima');
                        $data1['provinsi'] = $this->input->post('name_provinsi_penerima');
                        $data1['catatan'] = $this->input->post('catatan');
                        $data3['nama_pemesan'] = $this->input->post('nama_pemesan');
                    }
                    $data1['status'] = 'Belum Selesai';

                    $data2['id_order_form'] = 'ON-' . date("YmdHis");
                    $data2['id_order_detail'] = 'OD-' . date("YmdHis");
                    $data2['biji_kopi'] = $this->input->post('biji_kopi');
                    $data2['penyajian_kopi'] = $this->input->post('penyajian_kopi');
                    $data2['volume_kopi'] = $this->input->post('volume_kopi');
                    $data2['brewing_method'] = $this->input->post('brewing_method');
                    $data2['roasted_level'] = $this->input->post('name_roasted_level');
                    $data2['roasted_level_note'] = $this->input->post('roasted_level_note');

                    $this->Md_order->addOrder($data1);
                    $this->Md_order->addOrderDetail($data2);


                    $data3['biji_kopi'] = $this->input->post('name_biji_kopi');
                    $data3['penyajian_kopi'] = $this->input->post('name_penyajian_kopi');
                    $data3['volume_kopi'] = $this->input->post('volume_kopi');
                    $data3['brewing_method'] = $this->input->post('name_brewing_method');
                    $data3['roasted_level'] = $this->input->post('name_roasted_level');
                    $data3['roasted_level_note'] = $this->input->post('roasted_level_note');


                    $dataEmail = $this->Md_email->getAllData();
                    $message = $this->load->view('staff/email', $data3, true);
                    $notif = $this->load->view('staff/email_notif', $data3, true);

                    sendEmail('Detail Pemesanan', $data1['email'], $message, $dataEmail[0]['email'], $dataEmail[0]['password']);
                    sendEmail('Pemesanan Baru!', $dataEmail[1]['email'], $notif, $dataEmail[0]['email'], $dataEmail[0]['password']);

                    $result = array('status' => 'success', 'title' => 'Pesanan Berhasil!', 'msg' => 'Harap menunggu balasan admin melalui WhatsApp dan cek email untuk melihat detail pemesanan.');
                }
            } else {
                if ($opsiPesanan2 == '1') {
                    $this->form_validation->set_rules('nama_pengirim4', 'nama_pengirim4', 'required');
                    $this->form_validation->set_rules('nama_pemesan4', 'nama_pemesan4', 'required');
                    $this->form_validation->set_rules('telp_pengirim4', 'telp_pengirim4', 'required');
                    $this->form_validation->set_rules('telp4', 'telp4', 'required');
                    $this->form_validation->set_rules('whatsapp_pengirim4', 'whatsapp_pengirim4', 'required');
                    $this->form_validation->set_rules('email_pengirim4', 'email_pengirim4', 'required');
                    $this->form_validation->set_rules('alamat4', 'alamat4', 'required');
                    $this->form_validation->set_rules('kelurahan4', 'kelurahan4', 'required');
                    $this->form_validation->set_rules('kecamatan4', 'kecamatan4', 'required');
                    $this->form_validation->set_rules('catatan4', 'catatan4', 'required');
                } else {
                    $this->form_validation->set_rules('nama_pengirim3', 'nama_pengirim3', 'required');
                    $this->form_validation->set_rules('nama_pemesan3', 'nama_pemesan3', 'required');
                    $this->form_validation->set_rules('telp_pengirim3', 'telp_pengirim3', 'required');
                    $this->form_validation->set_rules('telp3', 'telp3', 'required');
                    $this->form_validation->set_rules('whatsapp_pengirim3', 'whatsapp_pengirim3', 'required');
                    $this->form_validation->set_rules('email_pengirim3', 'email_pengirim3', 'required');
                    $this->form_validation->set_rules('alamat3', 'alamat3', 'required');
                    $this->form_validation->set_rules('kelurahan3', 'kelurahan3', 'required');
                    $this->form_validation->set_rules('kecamatan3', 'kecamatan3', 'required');
                    $this->form_validation->set_rules('catatan3', 'catatan3', 'required');
                }
                $this->form_validation->set_rules('biji_kopi', 'biji_kopi', 'required');
                $this->form_validation->set_rules('penyajian_kopi', 'penyajian_kopi', 'required');
                $this->form_validation->set_rules('volume_kopi', 'volume_kopi', 'required');
                $this->form_validation->set_rules('brewing_method', 'brewing_method', 'required');
                $this->form_validation->set_rules('roasted_level', 'roasted_level', 'required');

                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'title' => 'Pemesanan Gagal!', 'msg' => 'Harap mengisi seluruh form dengan lengkap');
                } else {
                    $data1['id_order_form'] = 'ON-' . date("YmdHis");
                    $data1['id_order_detail'] = 'OD-' . date("YmdHis");
                    $data1['opsiPesanan'] = $this->input->post('opsiPesanan2');
                    if ($opsiPesanan2 == '1') {
                        $data1['nama_pengirim'] = $this->input->post('nama_pengirim4');
                        $data1['nama_pemesan'] = $this->input->post('nama_pemesan4');
                        $data1['telp_pengirim'] = $this->input->post('telp_pengirim4');
                        $data1['telp'] = $this->input->post('telp4');
                        $data1['whatsapp_pengirim'] = $this->input->post('whatsapp_pengirim4');
                        $data1['email_pengirim'] = $this->input->post('email_pengirim4');
                        $data1['alamat'] = $this->input->post('alamat4');
                        $data1['kelurahan'] = $this->input->post('kelurahan4');
                        $data1['kecamatan'] = $this->input->post('kecamatan4');
                        $data1['kota'] = $this->input->post('name_kota_penerima4');
                        $data1['provinsi'] = $this->input->post('name_provinsi_penerima4');
                        $data1['catatan'] = $this->input->post('catatan4');
                    } else {
                        $data1['nama_pengirim'] = $this->input->post('nama_pengirim3');
                        $data1['nama_pemesan'] = $this->input->post('nama_pemesan3');
                        $data1['telp_pengirim'] = $this->input->post('telp_pengirim3');
                        $data1['telp'] = $this->input->post('telp3');
                        $data1['whatsapp_pengirim'] = $this->input->post('whatsapp_pengirim3');
                        $data1['email_pengirim'] = $this->input->post('email_pengirim3');
                        $data1['alamat'] = $this->input->post('alamat3');
                        $data1['kelurahan'] = $this->input->post('kelurahan3');
                        $data1['kecamatan'] = $this->input->post('kecamatan3');
                        $data1['kota'] = $this->input->post('name_kota_penerima3');
                        $data1['provinsi'] = $this->input->post('name_provinsi_penerima3');
                        $data1['catatan'] = $this->input->post('catatan3');
                    }
                    $data1['status'] = 'Belum Selesai';

                    $data2['id_order_form'] = 'ON-' . date("YmdHis");
                    $data2['id_order_detail'] = 'OD-' . date("YmdHis");
                    $data2['biji_kopi'] = $this->input->post('biji_kopi');
                    $data2['penyajian_kopi'] = $this->input->post('penyajian_kopi');
                    $data2['volume_kopi'] = $this->input->post('volume_kopi');
                    $data2['brewing_method'] = $this->input->post('brewing_method');
                    $data2['roasted_level'] = $this->input->post('name_roasted_level');
                    $data2['roasted_level_note'] = $this->input->post('roasted_level_note');

                    $this->Md_order->addOrder($data1);
                    $this->Md_order->addOrderDetail($data2);

                    if ($opsiPesanan2 == '1') {
                        $data3['nama_pemesan'] = $this->input->post('nama_pengirim4');
                    } else {
                        $data3['nama_pemesan'] = $this->input->post('nama_pengirim3');
                    }

                    $data3['biji_kopi'] = $this->input->post('name_biji_kopi');
                    $data3['penyajian_kopi'] = $this->input->post('name_penyajian_kopi');
                    $data3['volume_kopi'] = $this->input->post('volume_kopi');
                    $data3['brewing_method'] = $this->input->post('name_brewing_method');
                    $data3['roasted_level'] = $this->input->post('name_roasted_level');
                    $data3['roasted_level_note'] = $this->input->post('roasted_level_note');


                    $message = $this->load->view('staff/email', $data3, true);
                    $dataEmail = $this->Md_email->getAllData();
                    $notif = $this->load->view('staff/email_notif', $data3, true);
                    sendEmail('Pemesanan Baru!', $dataEmail[1]['email'], $notif, $dataEmail[0]['email'], $dataEmail[0]['password']);
                    sendEmail('Detail Pemesanan', $data1['email_pengirim'], $message, $dataEmail[0]['email'], $dataEmail[0]['password']);

                    $result = array('status' => 'success', 'title' => 'Pesanan Berhasil!', 'msg' => 'Harap menunggu balasan admin melalui WhatsApp dan cek email untuk melihat detail pemesanan.');
                }
            }
            echo json_encode($result);
            die;
            // redirect('utama/kopi');
        } else {
            $page_data['rekomendasi'] = $this->Md_item->getAllData_Limit(4);
            $page_data['title'] = 'Pesan Kopi - Kopi Mahal';
            $page_data['page_name'] = 'kopi';
            $page_data['page_function'] = __FUNCTION__;
            $page_data['background'] = $this->Md_background->getAllData();
            $page_data['sosmed'] = $this->Md_sosmed->getAllData();

            $list_biji = $this->Md_kopiOption->getDataByOption('biji');
            $select_biji[''] = 'Pilih Biji Kopi';
            foreach ($list_biji as $row) {
                $select_biji[($row->id_kopiOption)] = $row->name;
            }
            $page_data['biji'] = $select_biji;

            $list_penyajian = $this->Md_kopiOption->getDataByOption('penyajian');
            $select_penyajian[''] = 'Pilih Penyajian';
            foreach ($list_penyajian as $row) {
                $select_penyajian[($row->id_kopiOption)] = $row->name;
            }
            $page_data['penyajian'] = $select_penyajian;

            $list_brewing = $this->Md_kopiOption->getDataByOption('brewing');
            $select_brewing[''] = 'Pilih Brewing';
            foreach ($list_brewing as $row) {
                $select_brewing[($row->id_kopiOption)] = $row->name;
            }
            $page_data['brewing'] = $select_brewing;

            $list_roasted = $this->Md_kopiOption->getDataByOption('roasted');
            $select_roasted[''] = 'Pilih Roasted Level';
            foreach ($list_roasted as $row) {
                $select_roasted[($row->id_kopiOption)] = $row->name;
            }
            $select_roasted['Tidak, Saya Punya Permintaan Khusus'] = 'Tidak, Saya Punya Permintaan Khusus';
            $page_data['roasted'] = $select_roasted;

            $this->load->view('utama/kopi', $page_data);
        }
    }

    public function toko($param1 = '', $param2 = '', $param3 = '')
    {

        // Styling
        $page_data['background'] = $this->Md_background->getAllData();
        $page_data['sosmed'] = $this->Md_sosmed->getAllData();
        $config['full_tag_open'] = '<div class="store-page">';
        $config['full_tag_close'] = '</div>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<a>';
        $config['first_tag_close'] = '</a>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<a>';
        $config['last_tag_close'] = '</a>';

        $config['next_link'] = '<i class="fa fa-caret-right" aria-hidden="true"></i>';
        $config['next_tag_open'] = '<a>';
        $config['next_tag_close'] = '</a>';

        $config['prev_link'] = '<i class="fa fa-caret-left" aria-hidden="true"></i>';
        $config['prev_tag_open'] = '<a>';
        $config['prev_tag_close'] = '</a>';

        $config['cur_tag_open'] = '<a class="active">';
        $config['cur_tag_close'] = '</a>';

        $config['num_tag_open'] = '<a>';
        $config['num_tag_close'] = '</a>';

        if ($param1 == 'detail') {
            $page_data['shop'] = $this->Md_item->getDataById($param2);
            $page_data['photo'] = $this->Md_item->getPhotoById($param2);
            $page_data['rekomendasi'] = $this->Md_item->getAllData_Limit(4);
            $page_data['title'] = 'Toko - Kopi Mahal';
            $page_data['id_item'] = $param2;
            $page_data['page_name'] = 'toko';
            $page_data['page_function'] = __FUNCTION__;

            $list_biji = $this->Md_kopiOption->getDataByOption('biji');
            $select_biji[''] = 'Pilih Biji Kopi';
            foreach ($list_biji as $row) {
                $select_biji[($row->id_kopiOption)] = $row->name;
            }
            $page_data['biji'] = $select_biji;

            $list_penyajian = $this->Md_kopiOption->getDataByOption('penyajian');
            $select_penyajian[''] = 'Pilih Penyajian';
            foreach ($list_penyajian as $row) {
                $select_penyajian[($row->id_kopiOption)] = $row->name;
            }
            $page_data['penyajian'] = $select_penyajian;

            $list_brewing = $this->Md_kopiOption->getDataByOption('brewing');
            $select_brewing[''] = 'Pilih Brewing';
            foreach ($list_brewing as $row) {
                $select_brewing[($row->id_kopiOption)] = $row->name;
            }
            $page_data['brewing'] = $select_brewing;

            $this->load->view('utama/toko-detail', $page_data);
        } elseif ($param1 == 'pesanAnother') {
            $this->load->library('form_validation');
            $opsiPesanan = $this->input->post('opsiPesanan');
            $opsiPesanan2 = $this->input->post('opsiPesanan2');
            if ($opsiPesanan == '0' || $opsiPesanan2 == '0') {
                if ($opsiPesanan2 == '0') {
                    $this->form_validation->set_rules('nama_pemesan2', 'nama_pemesan2', 'required');
                    $this->form_validation->set_rules('telp2', 'telp2', 'required');
                    $this->form_validation->set_rules('whatsapp2', 'whatsapp2', 'required');
                    $this->form_validation->set_rules('email2', 'email2', 'required');
                    $this->form_validation->set_rules('alamat2', 'alamat2', 'required');
                    $this->form_validation->set_rules('kelurahan2', 'kelurahan2', 'required');
                    $this->form_validation->set_rules('kecamatan2', 'kecamatan2', 'required');
                    $this->form_validation->set_rules('catatan2', 'catatan2', 'required');
                } else {
                    $this->form_validation->set_rules('nama_pemesan', 'nama_pemesan', 'required');
                    $this->form_validation->set_rules('telp', 'telp', 'required');
                    $this->form_validation->set_rules('whatsapp', 'whatsapp', 'required');
                    $this->form_validation->set_rules('email', 'email', 'required');
                    $this->form_validation->set_rules('alamat', 'alamat', 'required');
                    $this->form_validation->set_rules('kelurahan', 'kelurahan', 'required');
                    $this->form_validation->set_rules('kecamatan', 'kecamatan', 'required');
                    $this->form_validation->set_rules('catatan', 'catatan', 'required');
                }
                $this->form_validation->set_rules('jumlah', 'jumlah', 'required');

                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'title' => 'Pemesanan Gagal!', 'msg' => 'Harap mengisi seluruh form dengan lengkap');
                } else {
                    if ($opsiPesanan2 == '0') {
                        $data1['id_order_item'] = 'OI-' . date("YmdHis");
                        $data1['id_item'] = $this->input->post('id_item');
                        $data1['jumlah'] = $this->input->post('jumlah');
                        $data1['opsiPesanan'] = $this->input->post('opsiPesanan2');
                        $data1['nama_pemesan'] = $this->input->post('nama_pemesan2');
                        $data1['telp'] = $this->input->post('telp2');
                        $data1['whatsapp'] = $this->input->post('whatsapp2');
                        $data1['email'] = $this->input->post('email2');
                        $data1['alamat'] = $this->input->post('alamat2');
                        $data1['kelurahan'] = $this->input->post('kelurahan2');
                        $data1['kecamatan'] = $this->input->post('kecamatan2');
                        $data1['kota'] = $this->input->post('name_kota_penerima2');
                        $data1['provinsi'] = $this->input->post('name_provinsi_penerima2');
                        $data1['catatan'] = $this->input->post('catatan2');

                        $data3['nama_pemesan'] = $this->input->post('nama_pemesan2');
                    } else {
                        $data1['id_order_item'] = 'OI-' . date("YmdHis");
                        $data1['id_item'] = $this->input->post('id_item');
                        $data1['jumlah'] = $this->input->post('jumlah');
                        $data1['opsiPesanan'] = $this->input->post('opsiPesanan');
                        $data1['nama_pemesan'] = $this->input->post('nama_pemesan');
                        $data1['telp'] = $this->input->post('telp');
                        $data1['whatsapp'] = $this->input->post('whatsapp');
                        $data1['email'] = $this->input->post('email');
                        $data1['alamat'] = $this->input->post('alamat');
                        $data1['kelurahan'] = $this->input->post('kelurahan');
                        $data1['kecamatan'] = $this->input->post('kecamatan');
                        $data1['kota'] = $this->input->post('name_kota_penerima');
                        $data1['provinsi'] = $this->input->post('name_provinsi_penerima');
                        $data1['catatan'] = $this->input->post('catatan');

                        $data3['nama_pemesan'] = $this->input->post('nama_pemesan');
                    }
                    $data1['status'] = 'Belum Selesai';

                    $parameters = $this->Md_order->addOrderItem($data1);

                    $data3['jumlah'] = $this->input->post('jumlah');
                    $data3['name_item'] = $this->input->post('name_item');
                    $data3['name'] = $this->input->post('name');

                    $dataEmail = $this->Md_email->getAllData();
                    $message = $this->load->view('staff/email_another', $data3, true);
                    $notif = $this->load->view('staff/email_notif', $data3, true);

                    sendEmail('Detail Pemesanan', $data1['email'], $message, $dataEmail[0]['email'], $dataEmail[0]['password']);
                    sendEmail('Pemesanan Baru!', $dataEmail[1]['email'], $notif, $dataEmail[0]['email'], $dataEmail[0]['password']);

                    $result = array('status' => 'success', 'title' => 'Pesanan Berhasil!', 'msg' => 'Harap menunggu balasan admin melalui WhatsApp dan cek email untuk melihat detail pemesanan.');
                }
            } else {
                if ($opsiPesanan2 == '1') {
                    $this->form_validation->set_rules('nama_pengirim4', 'nama_pengirim4', 'required');
                    $this->form_validation->set_rules('nama_pemesan4', 'nama_pemesan4', 'required');
                    $this->form_validation->set_rules('telp_pengirim4', 'telp_pengirim4', 'required');
                    $this->form_validation->set_rules('telp4', 'telp4', 'required');
                    $this->form_validation->set_rules('whatsapp_pengirim4', 'whatsapp_pengirim4', 'required');
                    $this->form_validation->set_rules('email_pengirim4', 'email_pengirim4', 'required');
                    $this->form_validation->set_rules('alamat4', 'alamat4', 'required');
                    $this->form_validation->set_rules('kelurahan4', 'kelurahan4', 'required');
                    $this->form_validation->set_rules('kecamatan4', 'kecamatan4', 'required');
                    $this->form_validation->set_rules('catatan4', 'catatan4', 'required');
                } else {
                    $this->form_validation->set_rules('nama_pengirim3', 'nama_pengirim3', 'required');
                    $this->form_validation->set_rules('nama_pemesan3', 'nama_pemesan3', 'required');
                    $this->form_validation->set_rules('telp_pengirim3', 'telp_pengirim3', 'required');
                    $this->form_validation->set_rules('telp3', 'telp3', 'required');
                    $this->form_validation->set_rules('whatsapp_pengirim3', 'whatsapp_pengirim3', 'required');
                    $this->form_validation->set_rules('email_pengirim3', 'email_pengirim3', 'required');
                    $this->form_validation->set_rules('alamat3', 'alamat3', 'required');
                    $this->form_validation->set_rules('kelurahan3', 'kelurahan3', 'required');
                    $this->form_validation->set_rules('kecamatan3', 'kecamatan3', 'required');
                    $this->form_validation->set_rules('catatan3', 'catatan3', 'required');
                }
                $this->form_validation->set_rules('jumlah', 'jumlah', 'required');

                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'title' => 'Pemesanan Gagal!', 'msg' => 'Harap mengisi seluruh form dengan lengkap');
                } else {
                    $data1['id_order_item'] = 'OI-' . date("YmdHis");
                    $data1['id_item'] = $this->input->post('id_item');
                    $data1['jumlah'] = $this->input->post('jumlah');
                    if ($opsiPesanan2 == '1') {
                        $data1['opsiPesanan'] = $this->input->post('opsiPesanan2');
                        $data1['nama_pengirim'] = $this->input->post('nama_pengirim4');
                        $data1['nama_pemesan'] = $this->input->post('nama_pemesan4');
                        $data1['telp_pengirim'] = $this->input->post('telp_pengirim4');
                        $data1['telp'] = $this->input->post('telp4');
                        $data1['whatsapp_pengirim'] = $this->input->post('whatsapp_pengirim4');
                        $data1['email_pengirim'] = $this->input->post('email_pengirim4');
                        $data1['alamat'] = $this->input->post('alamat4');
                        $data1['kelurahan'] = $this->input->post('kelurahan4');
                        $data1['kecamatan'] = $this->input->post('kecamatan4');
                        $data1['kota'] = $this->input->post('name_kota_penerima4');
                        $data1['provinsi'] = $this->input->post('name_provinsi_penerima4');
                        $data1['catatan'] = $this->input->post('catatan4');
                        $data3['nama_pemesan'] = $this->input->post('nama_pengirim4');
                    } else {
                        $data1['opsiPesanan'] = $this->input->post('opsiPesanan');
                        $data1['nama_pengirim'] = $this->input->post('nama_pengirim3');
                        $data1['nama_pemesan'] = $this->input->post('nama_pemesan3');
                        $data1['telp_pengirim'] = $this->input->post('telp_pengirim3');
                        $data1['telp'] = $this->input->post('telp3');
                        $data1['whatsapp_pengirim'] = $this->input->post('whatsapp_pengirim3');
                        $data1['email_pengirim'] = $this->input->post('email_pengirim3');
                        $data1['alamat'] = $this->input->post('alamat3');
                        $data1['kelurahan'] = $this->input->post('kelurahan3');
                        $data1['kecamatan'] = $this->input->post('kecamatan3');
                        $data1['kota'] = $this->input->post('name_kota_penerima3');
                        $data1['provinsi'] = $this->input->post('name_provinsi_penerima3');
                        $data1['catatan'] = $this->input->post('catatan3');
                        $data3['nama_pemesan'] = $this->input->post('nama_pengirim3');
                    }
                    $data1['status'] = 'Belum Selesai';

                    $this->Md_order->addOrderItem($data1);

                    $data3['jumlah'] = $this->input->post('jumlah');
                    $data3['name_item'] = $this->input->post('name_item');
                    $data3['name'] = $this->input->post('name');

                    $dataEmail = $this->Md_email->getAllData();
                    $message = $this->load->view('staff/email_another', $data3, true);
                    $notif = $this->load->view('staff/email_notif', $data3, true);

                    sendEmail('Detail Pemesanan', $data1['email_pengirim'], $message, $dataEmail[0]['email'], $dataEmail[0]['password']);
                    sendEmail('Pemesanan Baru!', $dataEmail[1]['email'], $notif, $dataEmail[0]['email'], $dataEmail[0]['password']);

                    $result = array('status' => 'success', 'title' => 'Pesanan Berhasil!', 'msg' => 'Harap menunggu balasan admin melalui WhatsApp dan cek email untuk melihat detail pemesanan.');
                }
            }
            echo json_encode($result);
            die;
        } elseif ($param1 == 'filter') {
            if ($param2 == 'all') {
                redirect('utama/toko');
            } else {
                // Load Library
                $this->load->library('pagination');

                // Config
                $config['base_url'] = base_url() . 'utama/toko/filter/' . $param2 . '/';
                $config['total_rows'] = count($this->Md_item->getAllItem_filter($param2));
                $config['per_page'] = 6;

                // Initialize
                $this->pagination->initialize($config);

                $start = $param3;
                $page_data['item'] = $this->Md_item->getAllItem_filter($param2, $config['per_page'], $start);

                // $page_data['item'] = $this->Md_item->getAllData();
                $list_itemKind = $this->Md_itemKind->getAllData();
                $select_itemKind['all'] = 'Select Type';
                foreach ($list_itemKind as $row) {
                    $select_itemKind[($row->id_itemKind)] = $row->name;
                }
                $page_data['itemKind'] = $select_itemKind;
                $page_data['title'] = 'Toko';
                $page_data['page_name'] = 'toko';
                $page_data['filter'] = $param2;
                $page_data['page_function'] = __FUNCTION__;
                $this->load->view('utama/toko', $page_data);
            }
        } else {
            // Load Library
            $this->load->library('pagination');

            // Config
            $config['base_url'] = base_url() . 'utama/toko/';
            $config['total_rows'] = count($this->Md_item->getAllItem());
            $config['per_page'] = 6;

            // Initialize
            $this->pagination->initialize($config);

            $start = $this->uri->segment(3);
            $page_data['item'] = $this->Md_item->getAllItem($config['per_page'], $start);

            // $page_data['item'] = $this->Md_item->getAllData();
            $list_itemKind = $this->Md_itemKind->getAllData();
            $select_itemKind[''] = 'Select Type';
            foreach ($list_itemKind as $row) {
                $select_itemKind[($row->id_itemKind)] = $row->name;
            }
            $page_data['itemKind'] = $select_itemKind;
            $page_data['title'] = 'Toko';
            $page_data['page_name'] = 'toko';
            $page_data['filter'] = '';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('utama/toko', $page_data);
        }
    }

    public function cost($param1 = '', $param2 = '', $param3 = '', $param4 = '')
    {
        if (empty($param1) || empty($param2) || $param2 == 'null' || empty($param3) || empty($param4)) {
            echo "<h4>Harap isi data dengan lengkap!</h4>";
        } else {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "origin=" . $param1 . "&destination=" . $param2 .
                    "&weight=" . $param3 . "&courier=" . $param4,
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded",
                    "key: bc9abcdefb6ecc5c865718b8396e1bc6"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $ongkir = $response;
                $biaya = json_decode($ongkir, true);
                if ($biaya['rajaongkir']['status']['code'] == '200') {
                    foreach ($biaya['rajaongkir']['results'][0]['costs'] as $row) {
                        echo "<div class='ekspedisi'>";
                        echo "<h5 class='ekspedisi-title1'><b>" . $row['service'] . "</b></h5>";
                        echo "<span class='ekpedisi-title2'>" . $row['description'] . "</span>";
                        echo "<span class='ekspedisi-price'>Rp. " . number_format($row['cost'][0]['value'], 0, ',', '.') . "</span>";
                        echo "<span class='ekspedisi-duration'>Estimasi pengiriman : " . $row['cost'][0]['etd'] . " hari</span>";
                        echo "</div>";
                    }
                }
            }
        }
    }


    public function kota($provinsi)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=" . $provinsi,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: bc9abcdefb6ecc5c865718b8396e1bc6"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $kota = json_decode($response, true);

            if ($kota['rajaongkir']['status']['code'] == '200') {
                echo '<option value="null">Pilih Kota</option>';
                foreach ($kota['rajaongkir']['results'] as $row) {
                    echo '<option value=' . $row['city_id'] . '>' . $row['city_name'] . '</option>';
                }
            }
        }
    }
}
