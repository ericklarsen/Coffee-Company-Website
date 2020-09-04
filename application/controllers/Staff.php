<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Md_artikel');
        $this->load->model('Md_artikelKind');
        $this->load->model('Md_item');
        $this->load->model('Md_logo');
        $this->load->model('Md_itemHighlight');
        $this->load->model('Md_itemKind');
        $this->load->model('Md_workshop');
        $this->load->model('Md_gallery');
        $this->load->model('Md_slideshow');
        $this->load->model('Md_background');
        $this->load->model('Md_user');
        $this->load->model('Md_order');
        $this->load->model('Md_email');
        $this->load->model('Md_testimoni');
        $this->load->model('Md_sosmed');
        $this->load->model('Md_contact');
        $this->load->model('Md_kopiOption');

        $this->load->helper('format');
        $this->load->helper('verifikasi');

        if (!isset($_SESSION['username'])) {
            redirect('auth');
        }
    }

    public function index()
    {
        redirect('staff/item');
    }

    public function contact($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_contact->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $th1 = $row->first_name . ' ' . $row->last_name;
                $th2 = $row->email;
                $th3 = $row->phone;
                $th4 = $row->message;
                $th5 = date('d M Y', strtotime($row->tanggal));
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Contact Data';
            $page_data['page_name'] = 'contact';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/contact', $page_data);
        }
    }

    public function sosmed($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_sosmed->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->id_sosmed;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_sosmed/edit/' . $id . '" title="Ubah sosmed" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>';

                $th1 = $row->name;
                $th2 = $row->link;
                $th3 = $btn_edit;
                $data[] = gathered_data(array($th1, $th2, $th3));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Akun Sosial Media';
            $page_data['page_name'] = 'sosmed';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/sosmed', $page_data);
        }
    }

    public function menu_sosmed($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'edit_action') {
            $id_sosmed = $this->input->post('id_sosmed');

            $data['link'] = $this->input->post('link');

            $this->Md_sosmed->updateSosmed($data, $id_sosmed);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button> Data berhasil diedit!
                        </div>");

            redirect('staff/sosmed');
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Akun';
            $page_data['id_sosmed'] = $param2;
            $page_data['data'] = $this->Md_sosmed->getDataById($param2);
            $page_data['page_name'] = 'sosmed';
            $this->load->view('staff/sosmed_edit', $page_data);
        }
    }

    public function testimoni($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_testimoni->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->id_testimoni;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_testimoni/edit/' . $id . '" title="Ubah testimoni" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>';

                $th1 = $row->name;
                $th2 = $row->description;
                $th3 = $btn_edit;
                $data[] = gathered_data(array($th1, $th2, $th3));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Testimoni';
            $page_data['page_name'] = 'testimoni';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/testimoni', $page_data);
        }
    }

    public function menu_testimoni($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'edit_action') {
            $id_testimoni = $this->input->post('id_testimoni');

            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');

            $this->Md_testimoni->updateTestimoni($data, $id_testimoni);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button> Data berhasil diedit!
                        </div>");

            redirect('staff/testimoni');
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Testimoni';
            $page_data['id_testimoni'] = $param2;
            $page_data['data'] = $this->Md_testimoni->getDataById($param2);
            $page_data['page_name'] = 'testimoni';
            $this->load->view('staff/testimoni_edit', $page_data);
        }
    }

    public function email($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_email->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->id_email;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_email/edit/' . $id . '" title="Ubah email" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>';

                $th1 = $row->keterangan;
                $th2 = $row->email;
                $th3 = $btn_edit;
                $data[] = gathered_data(array($th1, $th2, $th3));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Email';
            $page_data['page_name'] = 'email';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/emailList', $page_data);
        }
    }

    public function menu_email($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'edit_action') {
            $id_email = $this->input->post('id_email');

            $data['password'] = $this->input->post('password');
            $data['email'] = $this->input->post('email');

            $this->Md_email->updateEmail($data, $id_email);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button> Data berhasil diedit!
                        </div>");

            redirect('staff/email');
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Email';
            $page_data['id_email'] = $param2;
            $page_data['data'] = $this->Md_email->getDataById($param2);
            $page_data['page_name'] = 'email';
            $this->load->view('staff/emailList_edit', $page_data);
        }
    }

    public function orderAnother($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_order->getAllDataTables2();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id_order_item = $row->id_order_item;
                $btn_detail = '<a href="' . base_url() . 'staff/menu_orderAnother/detail/' . $id_order_item . '" title="Detail Order" class="btn btn-xs btn-primary">Lihat Detail</a> &nbsp';
                $btn_hapus = '<a onClick=\'delete_function("staff/menu_orderAnother/delete/' . $id_order_item . '")\' href="#" title="Hapus Order" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a> &nbsp';
                $btn_status = '';

                if ($row->status == 'Belum Selesai') {
                    $btn_status = '<a href="' . base_url() . 'staff/menu_orderAnother/status/' . $id_order_item . '" title="Status Order" class="btn btn-xs btn-success">Selesai</a>';
                }

                if ($row->opsiPesanan == '0') {
                    $th1 = 'Untuk Sendiri';
                    $th3 = $row->nama_pemesan;
                } else {
                    $th1 = 'Untuk Orang Lain';
                    $th3 = $row->nama_pengirim;
                }

                $th2 = $row->name_item;
                $th4 = date('d M Y', strtotime($row->tanggal));
                $th5 = $row->status;
                $th6 = $btn_detail . $btn_hapus . $btn_status;
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Order Non Kopi';
            $page_data['page_name'] = 'orderAnother';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/orderAnother', $page_data);
        }
    }

    public function menu_orderAnother($param1 = '', $param2 = '')
    {
        if ($param1 == 'add_action') {
            $data1['id_order_item'] = 'OI-' . date("YmdHis");
            $data1['id_item'] = $this->input->post('id_item');
            $data1['jumlah'] = $this->input->post('jumlah');
            $data1['nama_pemesan'] = $this->input->post('nama_pemesan');
            $data1['telp'] = $this->input->post('telp');
            $data1['whatsapp'] = $this->input->post('whatsapp');
            $data1['email'] = $this->input->post('email');
            $data1['paket_diterima'] = $this->input->post('paket_diterima');
            $data1['alamat'] = $this->input->post('alamat');
            $data1['catatan'] = $this->input->post('catatan');
            $data1['status'] = 'Belum Selesai';

            $this->Md_order->addOrderItem($data1);

            $data3['nama_pemesan'] = $this->input->post('nama_pemesan');
            $data3['jumlah'] = $this->input->post('jumlah');
            $data3['name_item'] = $this->input->post('name_item');
            $data3['name'] = $this->input->post('name');

            $message = $this->load->view('staff/email_another', $data3, true);
            sendEmail($data1['email'], $message);

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diinput!
                </div>");

            redirect('staff/orderAnother');
        } elseif ($param1 == 'add') {
            $page_data['title'] = 'Add Order';
            $page_data['page_name'] = 'orderAnother';


            $list_item = $this->Md_item->getAllData();
            $select_item[''] = 'Select Item';
            foreach ($list_item as $row) {
                $select_item[($row->id_item)] = $row->name_item;
            }
            $page_data['item'] = $select_item;

            $this->load->view('staff/orderAnother_add', $page_data);
        } elseif ($param1 == 'status') {
            $data['status'] = 'Selesai';
            $this->Md_order->updateOrder_Another($data, $param2);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Order Selesai!
                </div>");

            redirect('staff/orderAnother');
        } elseif ($param1 == 'detail') {
            $page_data['title'] = 'Detail Order';
            $page_data['page_name'] = 'orderAnother';
            $page_data['detail'] = $this->Md_order->getDataById_another($param2);
            $this->load->view('staff/orderAnother_detail', $page_data);
        } elseif ($param1 == 'delete') {
            $this->Md_order->deleteOrderAnother($param2);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
                </div>");

            redirect('staff/orderAnother');
        }
    }

    public function order($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_order->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id_order               = $row->id_order_form;
                $id_order_detail        = $row->id_order_detail;
                $btn_detail = '<a href="' . base_url() . 'staff/menu_order/detail/' . $id_order . '" title="Detail Order" class="btn btn-xs btn-primary">Lihat Detail</a> &nbsp';
                $btn_hapus = '<a onClick=\'delete_function("staff/menu_order/delete/' . $id_order . '")\' href="#" title="Hapus Order" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a> &nbsp';
                $btn_status = '';

                if ($row->status == 'Belum Selesai') {
                    $btn_status = '<a href="' . base_url() . 'staff/menu_order/status/' . $id_order . '" title="Status Order" class="btn btn-xs btn-success">Selesai</a>';
                }

                if ($row->opsiPesanan == '0') {
                    $th1 = 'Untuk Sendiri';
                    $th3 = $row->nama_pemesan;
                } else {
                    $th1 = 'Untuk Orang Lain';
                    $th3 = $row->nama_pengirim;
                }

                $th2 = $row->id_order_form;
                $th4 = date('d M Y', strtotime($row->tanggal));
                $th5 = $row->status;
                $th6 = $btn_detail . $btn_hapus . $btn_status;
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Order Kopi';
            $page_data['page_name'] = 'order';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/order', $page_data);
        }
    }

    public function menu_order($param1 = '', $param2 = '')
    {
        if ($param1 == 'add_action') {
            $data1['id_order_form'] = 'ON-' . date("YmdHis");
            $data1['id_order_detail'] = 'OD-' . date("YmdHis");
            $data1['nama_pemesan'] = $this->input->post('nama_pemesan');
            $data1['telp'] = $this->input->post('telp');
            $data1['whatsapp'] = $this->input->post('whatsapp');
            $data1['email'] = $this->input->post('email');
            $data1['paket_diterima'] = $this->input->post('paket_diterima');
            $data1['alamat'] = $this->input->post('alamat');
            $data1['catatan'] = $this->input->post('catatan');
            $data1['status'] = 'Belum Selesai';

            $data2['id_order_form'] = 'ON-' . date("YmdHis");
            $data2['id_order_detail'] = 'OD-' . date("YmdHis");
            $data2['biji_kopi'] = $this->input->post('biji_kopi');
            $data2['penyajian_kopi'] = $this->input->post('penyajian_kopi');
            $data2['volume_kopi'] = $this->input->post('volume_kopi');
            $data2['brewing_method'] = $this->input->post('brewing_method');
            $data2['roasted_level'] = $this->input->post('roasted_level');
            $data2['roasted_level_note'] = $this->input->post('roasted_level_note');

            $this->Md_order->addOrder($data1);
            $this->Md_order->addOrderDetail($data2);

            $data3['nama_pemesan'] = $this->input->post('nama_pemesan');
            $data3['biji_kopi'] = $this->input->post('biji_kopi');
            $data3['penyajian_kopi'] = $this->input->post('penyajian_kopi');
            $data3['volume_kopi'] = $this->input->post('volume_kopi');
            $data3['brewing_method'] = $this->input->post('brewing_method');
            $data3['roasted_level'] = $this->input->post('roasted_level');
            $data3['roasted_level_note'] = $this->input->post('roasted_level_note');

            $message = $this->load->view('staff/email', $data3, true);
            $hasil = sendEmail($data1['email'], $message);

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diinput!
                </div>");

            // $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
            //     <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            //         <span aria-hidden='true'>&times;</span>
            //     </button> Data berhasil diinput!
            // </div>");

            redirect('staff/order');
        } elseif ($param1 == 'status') {
            $data['status'] = 'Selesai';
            $this->Md_order->updateOrder($data, $param2);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Order Selesai!
                </div>");

            redirect('staff/order');
        } elseif ($param1 == 'add') {
            $page_data['ongkir'] = '';
            if (count($_POST)) {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "origin=" . $this->input->post('kota') . "&destination=" . $this->input->post('kota_penerima') .
                        "&weight=" . $this->input->post('berat') . "&courier=" . $this->input->post('ekspedisi'),
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
                    $page_data['ongkir'] = $response;
                }
            }

            $page_data['title'] = 'Add Order';
            $page_data['page_name'] = 'order';
            $this->load->view('staff/order_add', $page_data);
        } elseif ($param1 == 'detail') {
            $page_data['title'] = 'Detail Order';
            $page_data['page_name'] = 'order';
            $page_data['detail'] = $this->Md_order->getDataById($param2);
            $page_data['kopiOption'] = $this->Md_kopiOption->getAllData();
            $this->load->view('staff/order_detail', $page_data);
        } elseif ($param1 == 'delete') {
            $this->Md_order->deleteOrder($param2);
            $this->Md_order->deleteOrderDetail($param2);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
                </div>");

            redirect('staff/order');
        }
    }

    public function cost($param1 = '', $param2 = '', $param3 = '', $param4 = '')
    {
        if (empty($param1) || empty($param2) || empty($param3) || empty($param4)) {
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
                        echo "<h4>" . $row['service'] . "</h4>";
                        echo "<p>" . $row['description'] . "</p>";
                        echo "<p>Rp. " . number_format($row['cost'][0]['value'], 0, ',', '.') . "</p>";
                        echo "<p>Estimasi pengiriman : " . $row['cost'][0]['etd'] . " hari</p>";
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
                echo '<option>Pilih Kota</option>';
                foreach ($kota['rajaongkir']['results'] as $row) {
                    echo '<option value=' . $row['city_id'] . '>' . $row['city_name'] . '</option>';
                }
            }
        }
    }

    public function user($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_user->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->username;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_user/edit/' . $id . '" title="Ubah User" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>&nbsp;';
                $btn_hapus = '<a onClick=\'delete_function("staff/menu_user/delete/' . $id . '")\' href="#" title="Hapus User" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';

                $th1 = $row->username;
                $th2 = $row->name;
                $th3 = $btn_edit . $btn_hapus;
                $data[] = gathered_data(array($th1, $th2, $th3));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Data User';
            $page_data['page_name'] = 'user';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/user', $page_data);
        }
    }

    public function menu_user($param1 = '', $param2 = '')
    {
        if ($param1 == 'add_action') {
            $data['username'] = $this->input->post('username');
            $data['name'] = $this->input->post('name');
            $data['password'] = $this->input->post('password');

            $this->Md_user->addUser($data);

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diinput!
                </div>");

            redirect('staff/user');
        } elseif ($param1 == 'edit_action') {
            $username = $this->input->post('username');
            $data['name'] = $this->input->post('name');
            $data['password'] = $this->input->post('password');

            $this->Md_user->updateUser($data, $username);

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diedit!
                </div>");

            redirect('staff/user');
        } elseif ($param1 == 'add') {
            $page_data['title'] = 'Tambah User';
            $page_data['page_name'] = 'user';
            $this->load->view('staff/user_add', $page_data);
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit User';
            $page_data['data'] = $this->Md_user->getDataById($param2);
            $page_data['page_name'] = 'user';
            $this->load->view('staff/user_edit', $page_data);
        } elseif ($param1 == 'delete') {
            $this->Md_user->deleteUser($param2);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
                </div>");

            redirect('staff/user');
        }
    }

    public function background($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_background->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->id_background;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_background/edit/' . $id . '" title="Ubah Background" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>';

                $th1 = $row->name;
                $th2 = '<img width=150 src="' . base_url() . 'assets_upload/background/' . $row->cover_background . '">';
                $th3 = $btn_edit;
                $data[] = gathered_data(array($th1, $th2, $th3));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Background';
            $page_data['page_name'] = 'background';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/background', $page_data);
        }
    }

    public function menu_background($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'edit_action') {
            $id_background = $this->input->post('id_background');
            $cover_background_old = $this->input->post('cover_background_old');

            if (!empty($_FILES['cover_background']['name'])) {
                $config['upload_path']       = './assets_upload/background';
                $config['allowed_types']     = 'jpg|png|jpeg';
                $config['overwrite']         = true;
                $config['max_size']          = 3072;
                $new_name = time() . $_FILES["cover_background"]['name'];
                $config['file_name'] = $new_name;

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('cover_background')) {

                    $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button> Gambar tidak support/kegedean! maks 3mb
                        </div>");
                    redirect('staff/menu_background/edit/' . $id_background);
                } else {
                    $path = './assets_upload/background/';
                    @unlink($path . $cover_background_old);

                    $gambar1 = $this->upload->file_name;
                    $data['cover_background'] = $gambar1;

                    $this->Md_background->updateBackground($data, $id_background);
                    $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button> Data berhasil diedit!
                        </div>");

                    redirect('staff/background');
                }
            } else {
                $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Data berhasil diedit!
                    </div>");

                redirect('staff/background');
            }
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Article';
            $page_data['id_background'] = $param2;
            $page_data['data'] = $this->Md_background->getDataById($param2);
            $page_data['page_name'] = 'item';
            $this->load->view('staff/background_edit', $page_data);
        }
    }

    public function slideshow($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_slideshow->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->id_slideshow;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_slideshow/edit/' . $id . '" title="Ubah Slideshow" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>';

                $ar_title = '-';

                $artikel = $this->Md_artikel->getDataById($row->id_artikel);
                if ($artikel) {
                    $ar_title = $artikel->title;
                }
                $th1 = $row->id_slideshow;
                $th2 = $row->title;
                $th3 = $row->description;
                $th4 = $ar_title;
                $th5 = '<img width=150 src="' . base_url() . 'assets_upload/slideshow/' . $row->cover_slideshow . '">';
                $th6 = $btn_edit;
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Slideshow';
            $page_data['page_name'] = 'slideshow';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/slideshow', $page_data);
        }
    }

    public function menu_slideshow($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'edit_action') {
            $id_slideshow = $this->input->post('id_slideshow');
            $cover_slideshow_old = $this->input->post('cover_slideshow_old');

            if (!empty($_FILES['cover_slideshow']['name'])) {
                $config['upload_path']       = './assets_upload/slideshow';
                $config['allowed_types']     = 'jpg|png|jpeg';
                $config['overwrite']         = true;
                $config['max_size']          = 3072;
                $new_name = time() . $_FILES["cover_slideshow"]['name'];
                $config['file_name'] = $new_name;

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('cover_slideshow')) {

                    $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button> Gambar tidak support/kegedean! maks 3mb
                        </div>");
                    redirect('staff/menu_slideshow/edit/' . $id_slideshow);
                } else {
                    $path = './assets_upload/slideshow/';
                    @unlink($path . $cover_slideshow_old);

                    $gambar1 = $this->upload->file_name;
                    $data['title'] = $this->input->post('title');
                    $data['id_artikel'] = $this->input->post('id_artikel');
                    $data['description'] = $this->input->post('description_slideshow');
                    $data['cover_slideshow'] = $gambar1;

                    $this->Md_slideshow->updateSlideshow($data, $id_slideshow);
                    $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button> Data berhasil diedit!
                        </div>");

                    redirect('staff/slideshow');
                }
            } else {
                $data['title'] = $this->input->post('title');
                $data['id_artikel'] = $this->input->post('id_artikel');
                $data['description'] = $this->input->post('description_slideshow');

                $this->Md_slideshow->updateSlideshow($data, $id_slideshow);

                $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Data berhasil diedit!
                    </div>");

                redirect('staff/slideshow');
            }
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Slideshow';
            $page_data['id_slideshow'] = $param2;
            $page_data['data'] = $this->Md_slideshow->getDataById($param2);
            $page_data['page_name'] = 'slideshow';


            $list_artikel = $this->Md_artikel->getAllData();
            $select_artikel[''] = 'Select Article';
            foreach ($list_artikel as $row) {
                $select_artikel[($row->id_artikel)] = $row->title;
            }
            $page_data['artikel'] = $select_artikel;
            $this->load->view('staff/slideshow_edit', $page_data);
        }
    }

    public function gallery($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_gallery->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->id_gallery;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_gallery/edit/' . $id . '" title="Ubah Gallery" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>&nbsp;';
                $btn_hapus = '<a onClick=\'delete_function("staff/menu_gallery/delete/' . $id . '/' . $row->cover_gallery . '")\' href="#" title="Hapus Gallery" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';

                $th1 = $row->title;
                $th2 = $row->kind;
                $th3 = $row->description;
                if ($row->kind == 'Photo') {
                    $th4 = '<img width=150 src="' . $row->cover_gallery . '">';
                } else {
                    $th4 = '<iframe src=' . $row->cover_gallery . '></iframe>';
                }
                $th5 = $btn_edit . $btn_hapus;
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Gallery';
            $page_data['page_name'] = 'gallery';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/gallery', $page_data);
        }
    }

    public function menu_gallery($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'add_action') {

            // $config['upload_path']       = './assets_upload/gallery';
            // $config['allowed_types']     = 'jpg|png|jpeg';
            // $config['overwrite']         = true;
            // $config['max_size']          = 3072;
            // $new_name = time() . $_FILES["cover_gallery"]['name'];
            // $config['file_name'] = $new_name;

            // $this->upload->initialize($config);
            // if (!$this->upload->do_upload('cover_gallery')) {

            //     $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
            //         <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            //         <span aria-hidden='true'>&times;</span>
            //         </button> Gambar tidak support/kegedean! maks 3mb
            //         </div>");
            //     redirect('staff/menu_gallery/add');
            // } else {
            //     $gambar1 = $this->upload->file_name;
            //     $data['kind'] = $this->input->post('kind');
            //     $data['title'] = $this->input->post('title');
            //     $data['description'] = $this->input->post('description_gallery');
            //     $data['cover_gallery'] = $gambar1;

            //     $this->Md_gallery->addGallery($data);
            //     $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
            //         <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            //         <span aria-hidden='true'>&times;</span>
            //         </button> Data berhasil diinput!
            //         </div>");

            //     redirect('staff/gallery');
            // }

            $data['kind'] = $this->input->post('kind');
            $data['title'] = $this->input->post('title');
            $photo = $this->input->post('cover_galleryPhoto');
            $video = $this->input->post('cover_galleryVideo');

            if (!empty($photo)) {
                $data['cover_gallery'] = $photo;
                $data['description'] = $this->input->post('description_gallery');
            } else {
                $data['cover_gallery'] = $video;
            }

            $this->Md_gallery->addGallery($data);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Data berhasil diinput!
                    </div>");

            redirect('staff/gallery');
        } elseif ($param1 == 'edit_action') {
            $id_gallery = $this->input->post('id_gallery');
            // $cover_gallery_old = $this->input->post('cover_gallery_old');

            // if (!empty($_FILES['cover_gallery']['name'])) {
            //     $config['upload_path']       = './assets_upload/gallery';
            //     $config['allowed_types']     = 'jpg|png|jpeg';
            //     $config['overwrite']         = true;
            //     $config['max_size']          = 3072;
            //     $new_name = time() . $_FILES["cover_gallery"]['name'];
            //     $config['file_name'] = $new_name;

            //     $this->upload->initialize($config);
            //     if (!$this->upload->do_upload('cover_gallery')) {

            //         $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
            //             <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            //             <span aria-hidden='true'>&times;</span>
            //             </button> Gambar tidak support/kegedean! maks 3mb
            //             </div>");
            //         redirect('staff/menu_gallery/edit/' . $id_gallery);
            //     } else {
            //         $path = './assets_upload/gallery/';
            //         @unlink($path . $cover_gallery_old);

            //         $gambar1 = $this->upload->file_name;
            //         $data['kind'] = $this->input->post('kind');
            //         $data['title'] = $this->input->post('title');
            //         $data['description'] = $this->input->post('description_gallery');
            //         $data['cover_gallery'] = $gambar1;

            //         $this->Md_gallery->updateGallery($data, $id_gallery);
            //         $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
            //             <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            //             <span aria-hidden='true'>&times;</span>
            //             </button> Data berhasil diedit!
            //             </div>");

            //         redirect('staff/gallery');
            //     }
            // } else {
            //     $data['kind'] = $this->input->post('kind');
            //     $data['title'] = $this->input->post('title');
            //     $data['description'] = $this->input->post('description_gallery');

            //     $this->Md_gallery->updateGallery($data, $id_gallery);

            //     $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
            //         <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            //         <span aria-hidden='true'>&times;</span>
            //         </button> Data berhasil diedit!
            //         </div>");

            //     redirect('staff/gallery');
            // }

            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description_gallery');
            $data['cover_gallery'] = $this->input->post('cover_gallery');

            $this->Md_gallery->updateGallery($data, $id_gallery);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Data berhasil diinput!
                    </div>");

            redirect('staff/gallery');
        } elseif ($param1 == 'add') {
            $page_data['title'] = 'Add Gallery';
            $page_data['page_name'] = 'gallery';
            $this->load->view('staff/gallery_add', $page_data);
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Gallery';
            $page_data['id_gallery'] = $param2;
            $page_data['data'] = $this->Md_gallery->getDataById($param2);
            $page_data['page_name'] = 'gallery';
            $this->load->view('staff/gallery_edit', $page_data);
        } elseif ($param1 == 'delete') {
            $this->Md_gallery->deleteGallery($param2);
            $path = './assets_upload/gallery/';
            @unlink($path . $param3);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
                </div>");

            redirect('staff/gallery');
        }
    }

    public function workshop($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_workshop->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->id_workshop;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_workshop/edit/' . $id . '" title="Ubah Workshop" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>&nbsp;';
                $btn_hapus = '<a onClick=\'delete_function("staff/menu_workshop/delete/' . $id . '/' . $row->cover_workshop . '")\' href="#" title="Hapus Workshop" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';

                $th1 = $row->name;
                $th2 = $row->description;
                $th3 = '<img width=150 src="' . base_url() . 'assets_upload/cover_workshop/' . $row->cover_workshop . '">';
                $th4 = $btn_edit . $btn_hapus;
                $data[] = gathered_data(array($th1, $th2, $th3, $th4));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Workshop';
            $page_data['page_name'] = 'workshop';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/workshop', $page_data);
        }
    }

    public function menu_workshop($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'add_action') {

            $config['upload_path']       = './assets_upload/cover_workshop';
            $config['allowed_types']     = 'jpg|png|jpeg';
            $config['overwrite']         = true;
            $config['max_size']          = 3072;
            $new_name = time() . $_FILES["cover_workshop"]['name'];
            $config['file_name'] = $new_name;

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('cover_workshop')) {

                $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Gambar tidak support/kegedean! maks 3mb
                    </div>");
                redirect('staff/menu_workshop/add');
            } else {
                $gambar1 = $this->upload->file_name;
                $data['name'] = $this->input->post('name');
                $data['description'] = $this->input->post('description_workshop');
                $data['cover_workshop'] = $gambar1;

                $this->Md_workshop->addWorkshop($data);
                $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Data berhasil diinput!
                    </div>");

                redirect('staff/workshop');
            }
        } elseif ($param1 == 'edit_action') {
            $id_workshop = $this->input->post('id_workshop');
            $cover_workshop_old = $this->input->post('cover_workshop_old');

            if (!empty($_FILES['cover_workshop']['name'])) {
                $config['upload_path']       = './assets_upload/cover_workshop';
                $config['allowed_types']     = 'jpg|png|jpeg';
                $config['overwrite']         = true;
                $config['max_size']          = 3072;
                $new_name = time() . $_FILES["cover_workshop"]['name'];
                $config['file_name'] = $new_name;

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('cover_workshop')) {

                    $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button> Gambar tidak support/kegedean! maks 3mb
                        </div>");
                    redirect('staff/menu_workshop/edit/' . $id_workshop);
                } else {
                    $path = './assets_upload/cover_workshop/';
                    @unlink($path . $cover_workshop_old);

                    $gambar1 = $this->upload->file_name;
                    $data['name'] = $this->input->post('name');
                    $data['description'] = $this->input->post('description_workshop');
                    $data['cover_workshop'] = $gambar1;

                    $this->Md_workshop->updateWorkshop($data, $id_workshop);
                    $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button> Data berhasil diedit!
                        </div>");

                    redirect('staff/workshop');
                }
            } else {
                $data['name'] = $this->input->post('name');
                $data['description'] = $this->input->post('description_workshop');

                $this->Md_workshop->updateWorkshop($data, $id_workshop);

                $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Data berhasil diedit!
                    </div>");

                redirect('staff/workshop');
            }
        } elseif ($param1 == 'add') {
            $page_data['title'] = 'Add Workshop';
            $page_data['page_name'] = 'workshop';
            $this->load->view('staff/workshop_add', $page_data);
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Workshop';
            $page_data['id_workshop'] = $param2;
            $page_data['data'] = $this->Md_workshop->getDataById($param2);
            $page_data['page_name'] = 'workshop';
            $this->load->view('staff/workshop_edit', $page_data);
        } elseif ($param1 == 'delete') {
            $this->Md_workshop->deleteWorkshop($param2);
            $path = './assets_upload/cover_workshop/';
            @unlink($path . $param3);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
                </div>");

            redirect('staff/workshop');
        }
    }

    public function artikelKind($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_artikelKind->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->id_artikelKind;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_artikelKind/edit/' . $id . '" title="Ubah Jenis Item" class="btn btn-xs yellow"><i class="fa fa-edit"></i></a>';
                $btn_hapus = '<a onClick=\'delete_function("staff/menu_artikelKind/delete/' . $id .  '")\' href="#" title="Hapus Jenis Item" class="btn btn-xs red"><i class="fa fa-trash"></i></a>';

                $th1 = $row->name;
                $th2 = $btn_edit . $btn_hapus;
                $data[] = gathered_data(array($th1, $th2));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Type of Item';
            $page_data['page_name'] = 'artikelKind';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/artikelKind', $page_data);
        }
    }

    public function menu_artikelKind($param1 = '', $param2 = '')
    {
        if ($param1 == 'add_action') {
            $data['name'] = $this->input->post('name');

            $this->Md_artikelKind->addArtikelKind($data);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diinput!
                </div>");
            redirect('staff/artikelKind');
        } elseif ($param1 == 'edit_action') {
            $id_artikelKind = $this->input->post('id_artikelKind');
            $data['name'] = $this->input->post('name');

            $this->Md_artikelKind->updateArtikelKind($data, $id_artikelKind);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diedit!
                </div>");
            redirect('staff/artikelKind');
        } elseif ($param1 == 'add') {
            $page_data['title'] = 'Add Type of Artikel';
            $page_data['page_name'] = 'artikelKind';
            $this->load->view('staff/artikelKind_add', $page_data);
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Type of Artikel';
            $page_data['id_item'] = $param2;
            $page_data['data'] = $this->Md_artikelKind->getDataById($param2);
            $page_data['page_name'] = 'artikelKind';
            $this->load->view('staff/artikelKind_edit', $page_data);
        } elseif ($param1 == 'delete') {
            $this->Md_artikelKind->deleteArtikelKind($param2);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
                </div>");

            redirect('staff/artikelKind');
        }
    }

    public function artikel($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_artikel->getAllDataTables();
            $data  = array();
            $check = 0;

            foreach ($dt['data'] as $row2) {
                if ($row2->top_page == 1) {
                    $check++;
                }
            }
            foreach ($dt['data'] as $row) {
                $id       = $row->id_artikel;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_artikel/edit/' . $id . '" title="Ubah Artikel" class="btn btn-xs btn-warning mr-2">Edit</a>';
                $btn_hapus = '<a onClick=\'delete_function("staff/menu_artikel/delete/' . $id . '/' . $row->cover_artikel .  '")\'  href="#" title="Hapus Artikel" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
                $btn_top = '';


                if ($row->top_page == 1) {
                    $btn_top = '<a href="' . base_url() . 'staff/menu_artikel/disable/' . $id . '" title="Hapus Artikel" class="btn btn-xs red"><b>Disable</b></a>';
                } elseif ($row->top_page == 0) {
                    $btn_top = '<a href="' . base_url() . 'staff/menu_artikel/active/' . $id . '" title="Hapus Artikel" class="btn btn-xs red"><b>Active</b></a>';
                }

                $th1 = $row->title;
                $th2 = $row->name;
                // $th3 = '<a href="' . base_url() . ' ' . $id . '">Go to page</a>';
                $th4 = $row->write_by;
                $th5 = $row->date;
                $th6 = '<img width=150 src="' . base_url() . 'assets_upload/cover_artikel/' . $row->cover_artikel . '">';
                $th7 =  $btn_edit . $btn_hapus . $btn_top;
                $data[] = gathered_data(array($th1, $th2, $th4, $th5, $th6, $th7));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Article';
            $page_data['page_name'] = 'artikel';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/artikel', $page_data);
        }
    }

    public function menu_artikel($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'add_action') {

            $config['upload_path']       = './assets_upload/cover_artikel';
            $config['allowed_types']     = 'jpg|png|jpeg';
            $config['overwrite']         = true;
            $config['max_size']          = 3072;
            $new_name = time() . $_FILES["cover_artikel"]['name'];
            $config['file_name'] = $new_name;

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('cover_artikel')) {

                $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Gambar tidak support/kegedean! maks 3mb
                    </div>");
                redirect('staff/menu_artikel/add');
            } else {
                $gambar1 = $this->upload->file_name;
                $data['title'] = $this->input->post('title');
                $data['id_artikelKind'] = $this->input->post('id_artikelKind');
                $data['content'] = $this->input->post('content_artikel');
                $data['short_description'] = $this->input->post('short_description');
                $data['write_by'] = $_SESSION['name'];
                $data['cover_artikel'] = $gambar1;
                $checkTP = $this->Md_artikel->getDataByTopPage('1');
                if (empty($checkTP)) {
                    $data['top_page'] = 1;
                }

                if (!empty($data['id_artikelKind'])) {
                    $this->Md_artikel->addArtikel($data);
                    $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Data berhasil diinput!
                    </div>");

                    redirect('staff/artikel');
                } else {
                    $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Harap memilih tipe dari artikel
                    </div>");
                    redirect('staff/menu_artikel/add');
                }
            }
        } elseif ($param1 == 'edit_action') {
            $id_artikel = $this->input->post('id_artikel');
            $cover_artikel_old = $this->input->post('cover_artikel_old');

            if (!empty($_FILES['cover_artikel']['name'])) {
                $config['upload_path']       = './assets_upload/cover_artikel';
                $config['allowed_types']     = 'jpg|png|jpeg';
                $config['overwrite']         = true;
                $config['max_size']          = 3072;
                $new_name = time() . $_FILES["cover_artikel"]['name'];
                $config['file_name'] = $new_name;

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('cover_artikel')) {

                    $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button> Gambar tidak support/kegedean! maks 3mb
                        </div>");
                    redirect('staff/menu_artikel/edit/' . $id_artikel);
                } else {
                    $path = './assets_upload/cover_artikel/';
                    @unlink($path . $cover_artikel_old);

                    $gambar1 = $this->upload->file_name;
                    $data['title'] = $this->input->post('title');
                    $data['id_artikelKind'] = $this->input->post('id_artikelKind');
                    $data['content'] = $this->input->post('content_artikel');
                    $data['short_description'] = $this->input->post('short_description');
                    $data['cover_artikel'] = $gambar1;

                    $this->Md_artikel->updateArtikel($data, $id_artikel);
                    $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button> Data berhasil diedit!
                        </div>");

                    redirect('staff/artikel');
                }
            } else {

                $data['title'] = $this->input->post('title');
                $data['id_artikelKind'] = $this->input->post('id_artikelKind');
                $data['content'] = $this->input->post('content_artikel');
                $data['short_description'] = $this->input->post('short_description');

                $this->Md_artikel->updateArtikel($data, $id_artikel);

                $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Data berhasil diedit!
                    </div>");

                redirect('staff/artikel');
            }
        } elseif ($param1 == 'active') {
            $id_artikel = $param2;
            $data['top_page'] = 1;
            $data2['top_page'] = 0;

            $this->Md_artikel->updateArtikelTo0($data2, 1);
            $this->Md_artikel->updateArtikel($data, $id_artikel);
            redirect('staff/artikel');
        } elseif ($param1 == 'disable') {
            $id_artikel = $param2;
            $data['top_page'] = 0;

            $this->Md_artikel->updateArtikel($data, $id_artikel);
            redirect('staff/artikel');
        } elseif ($param1 == 'add') {
            $page_data['title'] = 'Add Article';
            $list_artikelKind = $this->Md_artikelKind->getAllData();
            $select_artikelKind[''] = 'Select Type';
            foreach ($list_artikelKind as $row) {
                $select_artikelKind[($row->id_artikelKind)] = $row->name;
            }
            $page_data['artikelKind'] = $select_artikelKind;
            $page_data['page_name'] = 'artikel';


            $this->load->view('staff/artikel_add', $page_data);
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Article';
            $page_data['id_artikel'] = $param2;
            $page_data['data'] = $this->Md_artikel->getDataById($param2);
            $page_data['page_name'] = 'artikel';


            $list_artikelKind = $this->Md_artikelKind->getAllData();
            $select_artikelKind[''] = 'Select Type';
            foreach ($list_artikelKind as $row) {
                $select_artikelKind[($row->id_artikelKind)] = $row->name;
            }
            $page_data['artikelKind'] = $select_artikelKind;
            $this->load->view('staff/artikel_edit', $page_data);
        } elseif ($param1 == 'delete') {
            $checkAr = $this->Md_slideshow->getDataByIdAr($param2);
            $checkKo = $this->Md_kopiOption->getDataByIdAr($param2);

            if (empty($checkAr) && empty($checkKo)) {
                $this->Md_artikel->deleteArtikel($param2);
                $this->Md_slideshow->deleteSlideshow_idArtikel($param2);
                $path = './assets_upload/cover_artikel/';
                @unlink($path . $param3);
                $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Data berhasil dihapus!
                    </div>");

                redirect('staff/artikel');
            } else {
                $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Data Gagal dihapus!, Harap cek di menu Slideshow dan Option Kopi Order apakah data masih digunakan atau tidak.
                    </div>");

                redirect('staff/artikel');
            }
        }
    }

    public function itemKind($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_itemKind->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->id_itemKind;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_itemKind/edit/' . $id . '" title="Ubah Jenis Item" class="btn btn-xs yellow"><i class="fa fa-edit"></i></a>';
                $btn_hapus = '<a onClick=\'delete_function("staff/menu_itemKind/delete/' . $id . '")\' href="#" title="Hapus Jenis Item" class="btn btn-xs red" onClick=\'delete_function("' . $id . '")\'><i class="fa fa-trash"></i></a>';

                $th1 = $row->name;
                $th2 = $btn_edit . $btn_hapus;
                $data[] = gathered_data(array($th1, $th2));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Type of Item';
            $page_data['page_name'] = 'item';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/itemKind', $page_data);
        }
    }

    public function menu_itemKind($param1 = '', $param2 = '')
    {
        if ($param1 == 'add_action') {
            $data['name'] = $this->input->post('name');

            $this->Md_itemKind->addItemKind($data);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diinput!
                </div>");

            redirect('staff/itemKind');
        } elseif ($param1 == 'edit_action') {
            $id_itemKind = $this->input->post('id_itemKind');
            $data['name'] = $this->input->post('name');

            $this->Md_itemKind->updateItemKind($data, $id_itemKind);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diedit!
                </div>");

            redirect('staff/itemKind');
        } elseif ($param1 == 'add') {
            $page_data['title'] = 'Add Type of Item';
            $page_data['page_name'] = 'item';
            $this->load->view('staff/itemKind_add', $page_data);
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Type of Item';
            $page_data['id_item'] = $param2;
            $page_data['data'] = $this->Md_itemKind->getDataById($param2);
            $page_data['page_name'] = 'item';
            $this->load->view('staff/itemKind_edit', $page_data);
        } elseif ($param1 == 'delete') {
            $this->Md_itemKind->deleteItemKind($param2);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
                </div>");

            redirect('staff/itemKind');
        }
    }


    public function kopiOption($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_kopiOption->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->id_kopiOption;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_kopiOption/edit/' . $id . '" title="Ubah Option" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>';
                $btn_hapus = '<a href="#" title="Hapus Option" class="btn btn-xs btn-danger" onClick=\'delete_function("staff/menu_kopiOption/delete/' . $id . '")\'><i class="fa fa-trash"></i></a>';
                // $btn_hapus = '<a href="' . base_url() . 'staff/menu_kopiOption/delete/' . $id . '" title="Hapus Option" class="btn btn-xs red"><i class="fa fa-trash"></i></a>';

                $th1 = $row->name;
                $th2 = $row->option;
                $th3 = $row->description;
                $th4 = $row->title;
                $th5 = '<center>' . $btn_edit . $btn_hapus . '</center>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Option Order';
            $page_data['page_name'] = 'kopiOption';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/kopiOption', $page_data);
        }
    }

    public function menu_kopiOption($param1 = '', $param2 = '')
    {
        if ($param1 == 'add_action') {
            $data['name'] = $this->input->post('name');
            $data['option'] = $this->input->post('option');
            $data['description'] = $this->input->post('desc_kopiOption');
            $data['id_artikel'] = $this->input->post('id_artikel');

            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('option', 'option', 'required');
            $this->form_validation->set_rules('desc_kopiOption', 'desc_kopiOption', 'required');
            $this->form_validation->set_rules('id_artikel', 'id_artikel', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data gagal diinput!
                </div>");
                redirect('staff/menu_kopiOption/add');
            } else {
                $this->Md_kopiOption->addKopiOption($data);
                $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diinput!
                </div>");

                redirect('staff/kopiOption');
            }
        } elseif ($param1 == 'edit_action') {
            $id_kopiOption = $this->input->post('id_kopiOption');
            $data['name'] = $this->input->post('name');
            $data['option'] = $this->input->post('option');
            $data['description'] = $this->input->post('desc_kopiOption');
            $data['id_artikel'] = $this->input->post('id_artikel');

            $this->Md_kopiOption->updateKopiOption($data, $id_kopiOption);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diedit!
                </div>");

            redirect('staff/kopiOption');
        } elseif ($param1 == 'add') {
            $page_data['title'] = 'Add Option Order';
            $page_data['page_name'] = 'kopiOption';
            $list_artikel = $this->Md_artikel->getAllData();
            $select_artikel[''] = 'Select Type';
            foreach ($list_artikel as $row) {
                $select_artikel[($row->id_artikel)] = $row->title;
            }
            $page_data['artikel'] = $select_artikel;
            $this->load->view('staff/kopiOption_add', $page_data);
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Type of Item';
            $page_data['id_item'] = $param2;
            $page_data['data'] = $this->Md_kopiOption->getDataById($param2);
            $page_data['page_name'] = 'kopiOption';
            $list_artikel = $this->Md_artikel->getAllData();
            $select_artikel[''] = 'Select Type';
            foreach ($list_artikel as $row) {
                $select_artikel[($row->id_artikel)] = $row->title;
            }
            $page_data['artikel'] = $select_artikel;
            $this->load->view('staff/kopiOption_edit', $page_data);
        } elseif ($param1 == 'delete') {
            $this->Md_kopiOption->deleteKopiOption($param2);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
                </div>");

            redirect('staff/kopiOption');
        }
    }

    public function itemHighlight($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_itemHighlight->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->id_itemHighlight;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_itemHighlight/edit/' . $id . '" title="Ubah Item Highlight" class="btn btn-xs yellow"><i class="fa fa-edit"></i></a>';

                $th1 = $row->type;
                $th2 = $row->name_item;
                $th3 = $btn_edit;
                $data[] = gathered_data(array($th1, $th2, $th3));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Highlight Item Homepage';
            $page_data['page_name'] = 'itemHighlight';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/itemHighlight', $page_data);
        }
    }

    public function menu_itemHighlight($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'edit_action') {
            $id_itemHighlight = $this->input->post('id_itemHighlight');

            $data['id_item'] = $this->input->post('id_item');
            $data['type'] = $this->input->post('type');

            $this->Md_itemHighlight->updateItemHighlight($data, $id_itemHighlight);

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Data berhasil diedit!
                    </div>");

            redirect('staff/itemHighlight');
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Article';
            $page_data['id_itemHighlight'] = $param2;
            $page_data['data'] = $this->Md_itemHighlight->getDataById($param2);
            $page_data['page_name'] = 'itemHighlight';


            $list_item = $this->Md_item->getAllData();
            $select_item[''] = 'Select Article';
            foreach ($list_item as $row) {
                $select_item[($row->id_item)] = $row->name_item;
            }
            $page_data['item'] = $select_item;
            $this->load->view('staff/itemHighlight_edit', $page_data);
        }
    }

    public function item($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_item->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->id_item;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_item/edit/' . $id . '" title="Ubah Item" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>';
                $btn_hapus = '<a href="#" title="Hapus Item" class="btn btn-xs btn-danger" onClick=\'delete_function("staff/menu_item/delete/' . $id . '/' . $row->cover_item . '")\'><i class="fa fa-trash"></i></a>';

                $th1 = $row->name_item;
                $th2 = $row->name;
                $th3 = $row->price_item . ' - Disc (' . $row->disc_item . ')';
                $th4 = $row->stock_item;
                $th5 = $row->weight_item . ' gram';
                // $th5 = $row->desc_item;
                $th6 = '<img width=150 src="' . base_url() . 'assets_upload/cover_item/' . $row->cover_item . '">';
                $th7 = '<a href="' . base_url() . 'staff/menu_item/photo/' . $id . '" title="Ubah Item" class="btn btn-xs btn-primary">Photo</a>';
                $th8 = '<center>' . $btn_edit . $btn_hapus . '</center>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Store Item';
            $page_data['page_name'] = 'item';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/item', $page_data);
        }
    }

    public function menu_item($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'add_action') {

            $config['upload_path']       = './assets_upload/cover_item';
            $config['allowed_types']     = 'jpg|png|jpeg';
            $config['overwrite']         = true;
            $config['max_size']          = 3072;
            $new_name = time() . $_FILES["cover_item"]['name'];
            $config['file_name'] = $new_name;

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('cover_item')) {

                $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Gambar tidak support/kegedean! maks 3mb
                    </div>");
                redirect('staff/menu_item/add');
            } else {
                $gambar1 = $this->upload->file_name;
                $data['name_item'] = $this->input->post('name_item');
                $data['id_itemKind'] = $this->input->post('id_itemKind');
                $data['price_item'] = $this->input->post('price_item');
                $data['disc_item'] = $this->input->post('disc_item');
                $data['desc_item'] = $this->input->post('desc_item');
                $data['stock_item'] = $this->input->post('stock_item');
                $data['weight_item'] = $this->input->post('weight_item');
                $data['cover_item'] = $gambar1;

                $this->Md_item->addItem($data);
                $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Data berhasil diinput!
                    </div>");

                redirect('staff/item');
            }
        } elseif ($param1 == 'addPhoto_action') {
            $url = $this->input->post('url');
            $id_item = $this->input->post('id_item');
            $data = array();
            $checkData = $this->Md_item->getPhotoById($id_item);
            if ($checkData) {
                $this->Md_item->deleteItemPhoto($id_item);
            }
            $index = 0;
            foreach ($url as $row) {
                array_push($data, array(
                    'id_item' => $id_item,
                    'url' => $row
                ));
                $index++;
            }

            $this->Md_item->addItemPhotoBatch($data);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button> Data berhasil diinput!
                        </div>");


            redirect('staff/menu_item/photo/' . $id_item);
        } elseif ($param1 == 'edit_action') {
            $id_item = $this->input->post('id_item');
            $cover_item_old = $this->input->post('cover_item_old');

            if (!empty($_FILES['cover_item']['name'])) {
                $config['upload_path']       = './assets_upload/cover_item';
                $config['allowed_types']     = 'jpg|png|jpeg';
                $config['overwrite']         = true;
                $config['max_size']          = 3072;
                $new_name = time() . $_FILES["cover_item"]['name'];
                $config['file_name'] = $new_name;

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('cover_item')) {

                    $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button> Gambar tidak support/kegedean! maks 3mb
                        </div>");
                    redirect('staff/menu_item/edit/' . $id_item);
                } else {
                    $path = './assets_upload/cover_item/';
                    @unlink($path . $cover_item_old);

                    $gambar1 = $this->upload->file_name;
                    $data['name_item'] = $this->input->post('name_item');
                    $data['id_itemKind'] = $this->input->post('id_itemKind');
                    $data['price_item'] = $this->input->post('price_item');
                    $data['disc_item'] = $this->input->post('disc_item');
                    $data['desc_item'] = $this->input->post('desc_item');
                    $data['weight_item'] = $this->input->post('weight_item');
                    $data['stock_item'] = $this->input->post('stock_item');
                    $data['cover_item'] = $gambar1;

                    $this->Md_item->updateItem($data, $id_item);
                    $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button> Data berhasil diedit!
                        </div>");

                    redirect('staff/item');
                }
            } else {
                $data['name_item'] = $this->input->post('name_item');
                $data['id_itemKind'] = $this->input->post('id_itemKind');
                $data['price_item'] = $this->input->post('price_item');
                $data['disc_item'] = $this->input->post('disc_item');
                $data['desc_item'] = $this->input->post('desc_item');
                $data['stock_item'] = $this->input->post('stock_item');
                $data['weight_item'] = $this->input->post('weight_item');

                $this->Md_item->updateItem($data, $id_item);

                $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button> Data berhasil diedit!
                    </div>");

                redirect('staff/item');
            }
        } elseif ($param1 == 'add') {
            $page_data['title'] = 'Add Item';
            $list_itemKind = $this->Md_itemKind->getAllData();
            $select_itemKind[''] = 'Select Type';
            foreach ($list_itemKind as $row) {
                $select_itemKind[($row->id_itemKind)] = $row->name;
            }
            $page_data['itemKind'] = $select_itemKind;
            $page_data['page_name'] = 'item';


            $this->load->view('staff/item_add', $page_data);
        } elseif ($param1 == 'photo') {
            $page_data['title'] = 'Add Photo';
            $page_data['page_name'] = 'item';
            $page_data['id_item'] = $param2;
            $page_data['photo'] = $this->Md_item->getPhotoById($param2);
            $this->load->view('staff/item_photo', $page_data);
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Item';
            $page_data['id_item'] = $param2;
            $page_data['data'] = $this->Md_item->getDataById($param2);
            $page_data['page_name'] = 'item';


            $list_itemKind = $this->Md_itemKind->getAllData();
            $select_itemKind[''] = 'Select Type';
            foreach ($list_itemKind as $row) {
                $select_itemKind[($row->id_itemKind)] = $row->name;
            }
            $page_data['itemKind'] = $select_itemKind;
            $this->load->view('staff/item_edit', $page_data);
        } elseif ($param1 == 'delete') {
            $this->Md_item->deleteItem($param2);
            $path = './assets_upload/cover_item/';
            @unlink($path . $param3);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
                </div>");

            redirect('staff/item');
        }
    }

    public function logo($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'edit_action') {
            $id_logo = $this->input->post('id_logo');
            $cover_logo_old = $this->input->post('cover_logo_old');

            if (!empty($_FILES['cover_logo']['name'])) {
                $config['upload_path']       = './assets_upload/background';
                $config['allowed_types']     = 'jpg|png|jpeg|svg';
                $config['overwrite']         = true;
                $config['max_size']          = 3072;
                $new_name = time() . $_FILES["cover_logo"]['name'];
                $config['file_name'] = $new_name;

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('cover_logo')) {

                    $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button> Gambar tidak support/kegedean! maks 3mb
                        </div>");
                    redirect('staff/logo');
                } else {
                    $path = './assets_upload/background/';
                    @unlink($path . $cover_logo_old);

                    $gambar1 = $this->upload->file_name;
                    $data['cover_logo'] = $gambar1;

                    // $config['image_library'] = 'gd2';
                    // $config['source_image'] = './assets_upload/background/' . $gambar1;
                    // $config['create_thumb'] = TRUE;
                    // $config['maintain_ratio'] = TRUE;
                    // $config['width']         = 75;
                    // $config['height']       = 50;

                    // $this->load->library('image_lib');
                    // $this->image_lib->initialize($config);
                    // $this->image_lib->resize();
                    // if (!$this->image_lib->resize()) {
                    //     echo $this->image_lib->display_errors();
                    // }

                    $this->Md_logo->updateLogo($data, $id_logo);
                    $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button> Data berhasil diedit!
                        </div>");

                    redirect('staff/logo');
                }
            }
        } else {
            $page_data['title'] = 'Logo';
            $page_data['id_logo'] = $param2;
            $page_data['data'] = $this->Md_logo->getDataById(1);
            $page_data['page_name'] = 'logo';
            $this->load->view('staff/logo', $page_data);
        }
    }

    public function home()
    {
        $data['title'] = "Dashboard";
        $this->load->view('staff/home', $data);
    }
}
