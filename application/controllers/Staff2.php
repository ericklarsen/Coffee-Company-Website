<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Md_supplier');
        $this->load->model('Md_penjualan');
        $this->load->model('Md_penjualan_barang');
        $this->load->model('Md_penjualan_jasa');
        $this->load->model('Md_pembelian');
        $this->load->model('Md_pembelian_barang');
        $this->load->model('Md_barang');
        $this->load->model('Md_eoq');
        $this->load->model('Md_eoq_barang');
        $this->load->model('Md_jasa');
        $this->load->model('Md_user');
        $this->load->helper('format');

        $this->load->library('pdf');
    }

    public function index()
    {
        redirect('staff/barang');
    }

    public function user($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_user->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->username;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_user/edit/' . $id . '" title="Ubah Jasa" class="btn btn-xs yellow"><i class="fa fa-edit"></i></a>';
                $btn_hapus = '<a href="' . base_url() . 'staff/menu_user/delete/' . $id . '" title="Hapus Jasa" class="btn btn-xs red" onClick=\'delete_function("' . $id . '")\'><i class="fa fa-trash"></i></a>';

                $th2 = $row->username;
                $th3 = $row->nama;
                $th4 = $row->level;
                $th5 = '<center>' . $btn_edit . $btn_hapus . '</center>';
                $data[] = gathered_data(array($th2, $th3, $th4, $th5));
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
            $data['nama'] = $this->input->post('nama');
            $data['level'] = $this->input->post('level');
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
            $data['nama'] = $this->input->post('nama');
            $data['level'] = $this->input->post('level');
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

    public function jasa($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_jasa->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->kode_jasa;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_jasa/edit/' . $id . '" title="Ubah Jasa" class="btn btn-xs yellow"><i class="fa fa-edit"></i></a>';
                $btn_hapus = '<a href="' . base_url() . 'staff/menu_jasa/delete/' . $id . '" title="Hapus Jasa" class="btn btn-xs red" onClick=\'delete_function("' . $id . '")\'><i class="fa fa-trash"></i></a>';

                $th2 = $row->nama_jasa;
                $th4 = "Rp " . number_format($row->harga_jual, 0, ',', '.');
                $th5 = '<center>' . $btn_edit . $btn_hapus . '</center>';
                $data[] = gathered_data(array($th2, $th4, $th5));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Data Jasa';
            $page_data['page_name'] = 'jasa';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/jasa', $page_data);
        }
    }

    public function menu_jasa($param1 = '', $param2 = '')
    {
        if ($param1 == 'add_action') {
            $data['nama_jasa'] = $this->input->post('nama_jasa');
            $data['harga_jual'] = str_replace(['Rp. ', '.'], "", $this->input->post('harga_jual'));

            $this->Md_jasa->addJasa($data);

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diinput!
            </div>");

            redirect('staff/jasa');
        } elseif ($param1 == 'edit_action') {
            $kode_jasa = $this->input->post('kode_jasa');
            $data['nama_jasa'] = $this->input->post('nama_jasa');
            $data['harga_jual'] = str_replace(['Rp. ', '.'], "", $this->input->post('harga_jual'));

            $this->Md_jasa->updateJasa($data, $kode_jasa);

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diedit!
            </div>");

            redirect('staff/jasa');
        } elseif ($param1 == 'add') {
            $page_data['title'] = 'Tambah Jasa';
            $page_data['page_name'] = 'jasa';
            $this->load->view('staff/jasa_add', $page_data);
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Jasa';
            $page_data['kode_jasa'] = $param2;
            $page_data['data'] = $this->Md_jasa->getDataById($param2);
            $page_data['page_name'] = 'jasa';
            $this->load->view('staff/jasa_edit', $page_data);
        } elseif ($param1 == 'delete') {
            $this->Md_jasa->deleteJasa($param2);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
            </div>");

            redirect('staff/jasa');
        }
    }

    public function barang($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_barang->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->kode_barang;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_barang/edit/' . $id . '" title="Ubah Barang" class="btn btn-xs yellow"><i class="fa fa-edit"></i></a>';
                $btn_hapus = '<a href="' . base_url() . 'staff/menu_barang/delete/' . $id . '" title="Hapus Barang" class="btn btn-xs red" onClick=\'delete_function("' . $id . '")\'><i class="fa fa-trash"></i></a>';

                $th2 = $row->nama_barang;
                $th3 = $row->stok;
                $th4 = $row->stok_awal;
                $th5 = "Rp " . number_format($row->harga_jual, 0, ',', '.');
                $th6 = '<center>' . $btn_edit . $btn_hapus . '</center>';
                $data[] = gathered_data(array($th2, $th3, $th4, $th5, $th6));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Data Barang';
            $page_data['page_name'] = 'barang';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/barang', $page_data);
        }
    }

    public function menu_barang($param1 = '', $param2 = '')
    {
        if ($param1 == 'add_action') {
        } elseif ($param1 == 'edit_action') {
            $kode_barang = $this->input->post('kode_barang');
            $data['nama_barang'] = $this->input->post('nama_barang');
            $data['stok'] = $this->input->post('stok');
            $data['harga_jual'] = str_replace(['Rp. ', '.'], "", $this->input->post('harga_jual'));

            $this->Md_barang->updateBarang($data, $kode_barang);

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diedit!
            </div>");

            redirect('staff/barang');
        } elseif ($param1 == 'add') {
            $page_data['title'] = 'Tambah Barang';
            $page_data['page_name'] = 'barang';
            $this->load->view('staff/barang_add', $page_data);
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Barang';
            $page_data['data'] = $this->Md_barang->getDataById($param2);
            $page_data['page_name'] = 'barang';
            $this->load->view('staff/barang_edit', $page_data);
        } elseif ($param1 == 'delete') {
            $this->Md_barang->deleteBarang($param2);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
            </div>");

            redirect('staff/barang');
        }
    }

    public function supplier($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_supplier->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->kode_supplier;
                $btn_edit = '<a href="' . base_url() . 'staff/menu_supplier/edit/' . $id . '" title="Ubah Supplier" class="btn btn-xs yellow"><i class="fa fa-edit"></i></a>';
                $btn_hapus = '<a href="' . base_url() . 'staff/menu_supplier/delete/' . $id . '" title="Hapus Supplier" class="btn btn-xs red" onClick=\'delete_function("' . $id . '")\'><i class="fa fa-trash"></i></a>';

                $th2 = $row->nama_supplier;
                $th3 = $row->alamat;
                $th4 = $row->telepon;
                $th5 = '<center>' . $btn_edit . $btn_hapus . '</center>';
                $data[] = gathered_data(array($th2, $th3, $th4, $th5));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Data Supplier';
            $page_data['page_name'] = 'supplier';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/supplier', $page_data);
        }
    }

    public function menu_supplier($param1 = '', $param2 = '')
    {
        if ($param1 == 'add_action') {
            $data['nama_supplier'] = $this->input->post('nama_supplier');
            $data['alamat'] = $this->input->post('alamat');
            $data['telepon'] = $this->input->post('telepon');

            $this->Md_supplier->addSupplier($data);

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diinput!
            </div>");

            redirect('staff/supplier');
        } elseif ($param1 == 'edit_action') {
            $kode_supplier = $this->input->post('kode_supplier');
            $data['nama_supplier'] = $this->input->post('nama_supplier');
            $data['alamat'] = $this->input->post('alamat');
            $data['telepon'] = $this->input->post('telepon');

            $this->Md_supplier->updateSupplier($data, $kode_supplier);

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diedit!
            </div>");

            redirect('staff/supplier');
        } elseif ($param1 == 'add') {
            $page_data['title'] = 'Tambah Supplier';
            $page_data['page_name'] = 'supplier';
            $this->load->view('staff/supplier_add', $page_data);
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Supplier';
            $page_data['page_name'] = 'supplier';
            $page_data['data'] = $this->Md_supplier->getDataById($param2);
            $this->load->view('staff/supplier_edit', $page_data);
        } elseif ($param1 == 'delete') {
            $this->Md_supplier->deleteSupplier($param2);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
            </div>");

            redirect('staff/supplier');
        }
    }

    public function pembelian($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_pembelian->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->kode_pembelian;
                $btn_hapus = '<a href="' . base_url() . 'staff/menu_pembelian/delete/' . $id . '" title="Hapus Pembelian" class="btn btn-xs red"><i class="fa fa-trash"></i></a>';

                $th1 = '<a href="' . base_url() . 'staff/menu_pembelian/detail/' . $id . '" title="Lihat Detail" class="btn btn-xs yellow">' . $row->kode_pembelian . '</a>';
                $th2 = $row->nama_supplier;
                $th3 = "Rp. " . number_format($row->total, 0, ',', '.');
                $th4 = $row->tanggal_pembelian;
                $th5 = '<center>'  . $btn_hapus . '</center>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Data Pembelian Barang';
            $page_data['page_name'] = 'pembelian';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/pembelian', $page_data);
        }
    }

    public function menu_pembelian($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'add_action') {
            $kode_supplier = $this->input->post('kode_supplier');
            $nama_barang = $this->input->post('nama_barang');
            $harga_jual = $this->input->post('harga_jual');
            $harga_beli = $this->input->post('harga_beli');
            $jumlah = $this->input->post('jumlah');

            $totalHarga = 0;
            $allInputData1 = array();
            for ($i = 0; $i < count($harga_beli); $i++) {
                $totalHarga += str_replace(['Rp. ', '.'], "", $harga_beli[$i]) * $jumlah[$i];
            }
            $allInputData1 = array(
                'kode_pembelian' => 'PB-' . date("YmdHis"),
                'kode_supplier' => $kode_supplier,
                'total' => $totalHarga,
            );

            $allInputData2 = array();
            $index = 0;
            foreach ($nama_barang as $nama) {
                array_push($allInputData2, array(
                    'kode_pembelian' => 'PB-' . date("YmdHis"),
                    'nama_barang' => $nama,
                    'jumlah' => $jumlah[$index],
                    'harga_beli' => str_replace(['Rp. ', '.'], "", $harga_beli[$index]),
                    'harga_jual' => str_replace(['Rp. ', '.'], "", $harga_jual[$index]),
                ));
                $index++;
            }

            $allInputData3 = array();
            $index = 0;
            foreach ($nama_barang as $nama) {
                array_push($allInputData3, array(
                    'nama_barang' => $nama,
                    'stok' => $jumlah[$index],
                    'stok_awal' => $jumlah[$index],
                    'harga_jual' => str_replace(['Rp. ', '.'], "", $harga_jual[$index]),
                ));
                $index++;
            }
            $this->Md_pembelian->addPembelian($allInputData1);
            $this->Md_pembelian_barang->addPbarang($allInputData2);
            $this->Md_barang->addBarang($allInputData3);

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diinput!
            </div>");

            redirect('staff/pembelian');
        } elseif ($param1 == 'add_action2') {
            $kode_pembelian = $this->input->post('kode_pembelian');
            $nama_barang = $this->input->post('nama_barang');
            $harga_jual = $this->input->post('harga_jual');
            $harga_beli = $this->input->post('harga_beli');
            $jumlah = $this->input->post('jumlah');

            $pembelian = $this->Md_pembelian->getDataById($kode_pembelian);

            $totalHarga = $pembelian->total;
            $allInputData1 = array();
            for ($i = 0; $i < count($harga_beli); $i++) {
                $totalHarga += str_replace(['Rp. ', '.'], "", $harga_beli[$i]) * $jumlah[$i];
            }

            $data['total'] = $totalHarga;
            $this->Md_pembelian->updatePembelian($data, $kode_pembelian);

            $allInputData2 = array();
            $index = 0;
            foreach ($nama_barang as $nama) {
                array_push($allInputData2, array(
                    'kode_pembelian' => $kode_pembelian,
                    'nama_barang' => $nama,
                    'jumlah' => $jumlah[$index],
                    'harga_beli' => str_replace(['Rp. ', '.'], "", $harga_beli[$index]),
                    'harga_jual' => str_replace(['Rp. ', '.'], "", $harga_jual[$index]),
                ));
                $index++;
            }

            $allInputData3 = array();
            $index = 0;
            foreach ($nama_barang as $nama) {
                array_push($allInputData3, array(
                    'nama_barang' => $nama,
                    'stok' => $jumlah[$index],
                    'harga_jual' => str_replace(['Rp. ', '.'], "", $harga_jual[$index]),
                ));
                $index++;
            }
            $this->Md_pembelian_barang->addPbarang($allInputData2);
            $this->Md_barang->addBarang($allInputData3);

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diinput!
            </div>");


            redirect('staff/pembelian');
        } elseif ($param1 == 'edit_action') {
            $id = $this->input->post('id');
            $data['kode_pembelian'] = $this->input->post('kode_pembelian');
            $data['nama_barang'] = $this->input->post('nama_barang');
            $data['harga_jual'] = str_replace(['Rp. ', '.'], "", $this->input->post('harga_jual'));
            $data['harga_beli'] = str_replace(['Rp. ', '.'], "", $this->input->post('harga_beli'));
            $data['jumlah'] = $this->input->post('jumlah');

            // Kurangin total di data lama
            $pembelian = $this->Md_pembelian->getDataById($data['kode_pembelian']);
            $pBarang = $this->Md_pembelian_barang->getDataById2($id);
            $data2['total'] = $pembelian->total - ($pBarang->harga_beli * $pBarang->jumlah);
            $this->Md_pembelian->updatePembelian($data2, $data['kode_pembelian']);

            // Update Barang di pembelian barang dulu
            $this->Md_pembelian_barang->updatePbarang($data, $id);

            // Update total harga di pembelian
            $pembelian2 = $this->Md_pembelian->getDataById($data['kode_pembelian']);
            $data3['total'] = $pembelian2->total + ($data['harga_beli'] * $data['jumlah']);
            $this->Md_pembelian->updatePembelian($data3, $data['kode_pembelian']);


            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diedit!
            </div>");

            redirect('staff/pembelian');
        } elseif ($param1 == 'add') {
            $list_supplier = $this->Md_supplier->getAllData();
            $select_supplier[''] = 'Pilih Supplier';
            foreach ($list_supplier as $row) {
                $select_supplier[($row->kode_supplier)] = $row->nama_supplier;
            }
            $page_data['supplier'] = $select_supplier;
            $page_data['title'] = 'Tambah Pembelian Barang';
            $page_data['page_name'] = 'pembelian';
            $this->load->view('staff/pembelian_add', $page_data);
        } elseif ($param1 == 'add_2') {
            $page_data['title'] = 'Tambah Pembelian Barang';
            $page_data['page_name'] = 'pembelian';
            $page_data['kode_pembelian'] = $param2;
            $this->load->view('staff/pembelian_add2', $page_data);
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Pembelian Barang';
            $page_data['data'] = $this->Md_pembelian_barang->getDataById2($param2);
            $page_data['kode_pembelian'] = $param3;
            $page_data['page_name'] = 'pembelian';
            $this->load->view('staff/pembelian_detail_edit', $page_data);
        } elseif ($param1 == 'detail') {
            $page_data['title'] = 'Detail Pembelian Barang';
            $page_data['pembelian'] = $this->Md_pembelian->getDataById($param2);
            $page_data['pembelian_barang'] = $this->Md_pembelian_barang->getDataById($param2);
            $page_data['page_name'] = 'pembelian';
            $this->load->view('staff/pembelian_detail', $page_data);
        } elseif ($param1 == 'delete') {
            $this->Md_pembelian->deletePembelian($param2);
            $this->Md_pembelian_barang->deletePbarang($param2);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
            </div>");

            redirect('staff/pembelian');
        } elseif ($param1 == 'delete2') {
            $pembelian = $this->Md_pembelian->getDataById($param3);
            $pBarang = $this->Md_pembelian_barang->getDataById2($param2);
            $data['total'] = $pembelian->total - ($pBarang->harga_beli * $pBarang->jumlah);

            $this->Md_pembelian->updatePembelian($data, $param3);
            $this->Md_pembelian_barang->deletePbarang2($param2);

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
            </div>");
            redirect('staff/pembelian');

            // redirect('staff/menu_pembelian/detail/'.$param3);
        }
    }

    public function penjualan($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_penjualan->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->kode_penjualan;
                $btn_hapus = '<a href="' . base_url() . 'staff/menu_penjualan/delete/' . $id . '" title="Hapus Barang" class="btn btn-xs red" onClick=\'delete_function("' . $id . '")\'><i class="fa fa-trash"></i></a>';

                $th1 = '<a href="' . base_url() . 'staff/menu_penjualan/detail/' . $id . '" title="Ubah Barang" class="btn btn-xs yellow">' . $row->kode_penjualan . '</a>';
                $th2 = '<small>' . $row->tanggal_penjualan . '</small>';
                $th3 = '<small>' . $row->nama_pembeli . '</small>';
                $th4 = '<small>' . $row->telepon . '</small>';
                $th5 = "Rp " . number_format($row->total, 0, ',', '.');
                $th6 = '<center>' . $btn_hapus . '</center>';
                $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'Data Penjualan Barang';
            $page_data['page_function'] = __FUNCTION__;
            $page_data['page_name'] = 'penjualan';
            $this->load->view('staff/penjualan', $page_data);
        }
    }

    public function menu_penjualan($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'add_action') {
            // data untuk tb_penjualan
            $data['kode_penjualan'] = 'PJ-' . date("YmdHis");
            $data['nama_pembeli'] = $this->input->post('nama_pembeli');
            $data['total'] = $this->input->post('total_belanja');
            $data['telepon'] = $this->input->post('telepon');
            $this->Md_penjualan->addPenjualan($data);

            // data untuk tb_penjualan_barang --- array
            $kode_barang = $this->input->post('kode_barang');
            $jumlah = $this->input->post('jumlah');
            $total = $this->input->post('total');

            // data untuk tb_penjualan_jasa --- array
            $kode_jasa = $this->input->post('kode_jasa');
            $jumlah_jasa = $this->input->post('jumlah_jasa');
            $total_jasa = $this->input->post('total_jasa');

            // untuk inputin data barang ke tb_penjualan_barang
            if ($kode_barang) {
                $allInputData1 = array();
                $index = 0;
                foreach ($kode_barang as $kode) {
                    array_push($allInputData1, array(
                        'kode_penjualan' => $data['kode_penjualan'],
                        'kode_barang' => $kode,
                        'total' => $total[$index],
                        'jumlah' => $jumlah[$index],
                    ));

                    // untuk update stok barang saat ini
                    $barang = $this->Md_barang->getDataById($kode);
                    $data2['stok'] = $barang->stok - $jumlah[$index];
                    $this->Md_barang->updateBarang($data2, $kode);
                    $index++;
                }
                $this->Md_penjualan_barang->addPJbarang($allInputData1);
            }


            // untuk inputin data jasa ke tb_penjualan_jasa
            if ($kode_jasa) {
                $allInputData2 = array();
                $index = 0;
                foreach ($kode_jasa as $kode) {
                    array_push($allInputData2, array(
                        'kode_penjualan' => $data['kode_penjualan'],
                        'kode_jasa' => $kode,
                        'total' => $total_jasa[$index],
                        'jumlah' => $jumlah_jasa[$index],
                    ));
                    $index++;
                }
                $this->Md_penjualan_jasa->addPJjasa($allInputData2);
            }

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diinput!
            </div>");

            redirect('staff/penjualan');
        } elseif ($param1 == 'add_action2') {
            $kode_penjualan = $this->input->post('kode_penjualan');
            $total_belanja = $this->input->post('total_belanja');

            // data untuk tb_penjualan_barang --- array
            $kode_barang = $this->input->post('kode_barang');
            $jumlah = $this->input->post('jumlah');
            $total = $this->input->post('total');

            // data untuk tb_penjualan_jasa --- array
            $kode_jasa = $this->input->post('kode_jasa');
            $jumlah_jasa = $this->input->post('jumlah_jasa');
            $total_jasa = $this->input->post('total_jasa');

            // untuk inputin data barang ke tb_penjualan_barang
            if ($kode_barang) {
                $allInputData1 = array();
                $index = 0;
                foreach ($kode_barang as $kode) {
                    array_push($allInputData1, array(
                        'kode_penjualan' => $kode_penjualan,
                        'kode_barang' => $kode,
                        'total' => $total[$index],
                        'jumlah' => $jumlah[$index],
                    ));

                    // untuk update stok barang saat ini
                    $barang = $this->Md_barang->getDataById($kode);
                    $data2['stok'] = $barang->stok - $jumlah[$index];
                    $this->Md_barang->updateBarang($data2, $kode);
                    $index++;
                }
                $this->Md_penjualan_barang->addPJbarang($allInputData1);
            }


            // untuk inputin data jasa ke tb_penjualan_jasa
            if ($kode_jasa) {
                $allInputData2 = array();
                $index = 0;
                foreach ($kode_jasa as $kode) {
                    array_push($allInputData2, array(
                        'kode_penjualan' => $kode_penjualan,
                        'kode_jasa' => $kode,
                        'total' => $total_jasa[$index],
                        'jumlah' => $jumlah_jasa[$index],
                    ));
                    $index++;
                }
                $this->Md_penjualan_jasa->addPJjasa($allInputData2);
            }

            // Update total harga di tb penjualan
            $penjualan2 = $this->Md_penjualan->getDataById($kode_penjualan);
            $data3['total'] = $penjualan2->total + $total_belanja;
            $this->Md_penjualan->updatePenjualan($data3, $kode_penjualan);

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diinput!
            </div>");


            redirect('staff/penjualan');
        } elseif ($param1 == 'edit_action') {
            $id = $this->input->post('id');
            $kode_barang = $this->input->post('kode_barang');
            $kode_penjualan = $this->input->post('kode_penjualan');
            $total_old = $this->input->post('total_old');
            $jumlah_old = $this->input->post('jumlah_old');

            $kode_penjualan = $this->input->post('kode_penjualan');
            $data['total'] = $this->input->post('total');
            $data['jumlah'] = $this->input->post('jumlah');

            // Kurangin stok di tb barang
            $barang = $this->Md_barang->getDataById($kode_barang);
            $data2['stok'] = ($barang->stok + $jumlah_old) - $data['jumlah'];
            $this->Md_barang->updateBarang($data2, $kode_barang);

            // Update Barang di tb penjualan barang dulu
            $this->Md_penjualan_barang->updatePJbarang($data, $id);

            // Update total harga di tb penjualan
            $penjualan2 = $this->Md_penjualan->getDataById($kode_penjualan);
            $data3['total'] = ($penjualan2->total - $total_old) + $data['total'];
            $this->Md_penjualan->updatePenjualan($data3, $kode_penjualan);


            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diedit!
            </div>");

            redirect('staff/penjualan');
        } elseif ($param1 == 'add') {
            $list_barang = $this->Md_barang->getAllData();
            $select_barang[''] = 'Pilih Barang';
            foreach ($list_barang as $row) {
                $select_barang[($row->kode_barang)] = $row->nama_barang;
            }
            $page_data['barang'] = $select_barang;

            $list_jasa = $this->Md_jasa->getAllData();
            $select_jasa[''] = 'Pilih Jasa';
            foreach ($list_jasa as $row) {
                $select_jasa[($row->kode_jasa)] = $row->nama_jasa;
            }
            $page_data['jasa'] = $select_jasa;

            $page_data['title'] = 'Tambah Penjualan Barang';
            $page_data['page_name'] = 'penjualan';
            $this->load->view('staff/penjualan_add', $page_data);
        } elseif ($param1 == 'add_2') {
            $list_barang = $this->Md_barang->getAllData();
            $select_barang[''] = 'Pilih Barang';
            foreach ($list_barang as $row) {
                $select_barang[($row->kode_barang)] = $row->nama_barang;
            }
            $page_data['barang'] = $select_barang;

            $list_jasa = $this->Md_jasa->getAllData();
            $select_jasa[''] = 'Pilih Jasa';
            foreach ($list_jasa as $row) {
                $select_jasa[($row->kode_jasa)] = $row->nama_jasa;
            }
            $page_data['jasa'] = $select_jasa;

            $page_data['title'] = 'Tambah Penjualan Barang';
            $page_data['kode_penjualan'] = $param2;
            $page_data['page_name'] = 'penjualan';
            $this->load->view('staff/penjualan_add2', $page_data);
        } elseif ($param1 == 'edit') {
            $page_data['title'] = 'Edit Penjualan Barang';
            $page_data['data'] = $this->Md_penjualan_barang->getDataById2($param2);
            $page_data['kode_penjualan'] = $param3;
            $page_data['harga_barang'] = $this->Md_barang->getNamaBarang($param2);

            $list_barang = $this->Md_barang->getAllData();
            $select_barang[''] = 'Pilih Barang';
            foreach ($list_barang as $row) {
                $select_barang[($row->kode_barang)] = $row->nama_barang;
            }
            $page_data['barang'] = $select_barang;
            $page_data['page_name'] = 'penjualan';
            $this->load->view('staff/penjualan_detail_edit', $page_data);
        } elseif ($param1 == 'detail') {
            $page_data['title'] = 'Detail Penjualan Barang';
            $page_data['penjualan'] = $this->Md_penjualan->getDataById($param2);
            $page_data['penjualan_barang'] = $this->Md_penjualan_barang->getDataById($param2);
            $page_data['penjualan_jasa'] = $this->Md_penjualan_jasa->getDataById($param2);
            $page_data['page_name'] = 'penjualan';
            $this->load->view('staff/penjualan_detail', $page_data);
        } elseif ($param1 == 'delete') {
            // Untuk nambahin stok nya ke barang lagi
            $PJbarang = $this->Md_penjualan_barang->getDataById($param2);
            foreach ($PJbarang as $row) {
                $barang = $this->Md_barang->getDataById($row->kode_barang);
                $data['stok'] = $barang->stok + $row->jumlah;
                $this->Md_barang->updateBarang($data, $row->kode_barang);
            }

            $this->Md_penjualan->deletePenjualan($param2);
            $this->Md_penjualan_barang->deletePJbarang($param2);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
            </div>");

            redirect('staff/penjualan');
        } elseif ($param1 == 'delete2') {
            $penjualan = $this->Md_penjualan->getDataById($param3);
            $PJbarang = $this->Md_penjualan_barang->getDataById2($param2);
            $barang = $this->Md_barang->getDataById($PJbarang->kode_barang);

            // untuk update total harga di tb penjualan
            $data['total'] = $penjualan->total - $PJbarang->total;
            $this->Md_penjualan->updatePenjualan($data, $param3);

            // untuk update stok di tb barang
            $data2['stok'] = $barang->stok + $PJbarang->jumlah;
            $this->Md_barang->updateBarang($data2, $PJbarang->jumlah);

            // delete datanya
            $this->Md_penjualan_barang->deletePJbarang2($param2);

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
            </div>");
            redirect('staff/penjualan');

            // redirect('staff/menu_pembelian/detail/'.$param3);
        } elseif ($param1 == 'delete3') {
            $penjualan = $this->Md_penjualan->getDataById($param3);
            $PJjasa = $this->Md_penjualan_jasa->getDataById2($param2);
            $jasa = $this->Md_jasa->getDataById($PJjasa->kode_jasa);

            // untuk update total harga di tb penjualan
            $data['total'] = $penjualan->total - $PJjasa->total;
            $this->Md_penjualan->updatePenjualan($data, $param3);

            // delete datanya
            $this->Md_penjualan_jasa->deletePJjasa2($param2);

            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
            </div>");
            redirect('staff/penjualan');

            // redirect('staff/menu_pembelian/detail/'.$param3);
        }
    }

    public function eoq($param1 = '')
    {
        if ($param1 == 'pagination') {
            $dt    = $this->Md_eoq->getAllDataTables();
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id       = $row->id_eoq;
                $btn_hapus = '<a href="' . base_url() . 'staff/menu_eoq/delete/' . $id . '" title="Hapus Laporan" class="btn btn-xs red" onClick=\'delete_function("' . $id . '")\'><i class="fa fa-trash"></i></a>';

                $th2 = '<a href="' . base_url() . 'staff/menu_eoq/detail/' . $id . '" title="Ubah Barang" class="btn btn-xs yellow">' . $row->id_eoq . '</a>';
                $th3 = $row->nama_user;
                $th4 = $row->tanggal_laporan;
                $th5 = '<center>' . $btn_hapus . '</center>';
                $data[] = gathered_data(array($th2, $th3, $th4, $th5));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else {

            $page_data['title'] = 'List Laporan EOQ dan ROP';
            $page_data['page_name'] = 'eoq';
            $page_data['page_function'] = __FUNCTION__;
            $this->load->view('staff/eoq', $page_data);
        }
    }

    public function menu_eoq($param1 = '', $param2 = '')
    {
        if ($param1 == 'add_action') {
            $kode_barang = $this->input->post('kode_barang');
            $jumlah_unit = $this->input->post('jumlah_unit');
            $biaya_pemesanan = $this->input->post('biaya_pemesanan');
            $biaya_penyimpanan = $this->input->post('biaya_penyimpanan');
            $lead_time = $this->input->post('lead_time');
            $p_rata = $this->input->post('p_rata');
            $p_maks = $this->input->post('p_maks');

            // data untuk tb_eoq
            $data['id_eoq'] = 'EOQ-' . date("YmdHis");
            $data['nama_user'] = $_SESSION['nama'];
            $this->Md_eoq->addEOQ($data);

            $jumlah_pemesanan = 0;
            $frekuensi_pemesanan = 0;
            $jarak_pemesanan = 0;
            $rop = 0;

            // untuk inputin ke tb_eoq_barang
            if ($kode_barang) {
                $allInputData1 = array();
                $index = 0;
                foreach ($kode_barang as $kode) {
                    $jumlah_pemesanan = sqrt((2 * $jumlah_unit[$index] * $biaya_pemesanan[$index]) / $biaya_penyimpanan[$index]);
                    $frekuensi_pemesanan = $jumlah_unit[$index] / $jumlah_pemesanan;
                    $jarak_pemesanan = 365 / $frekuensi_pemesanan;
                    $rop = ($lead_time[$index] * $p_rata[$index]) + ($p_maks[$index] - $p_rata[$index]);

                    array_push($allInputData1, array(
                        'id_eoq' => $data['id_eoq'],
                        'kode_barang' => $kode,
                        'jumlah_pemesanan' => $jumlah_pemesanan,
                        'frekuensi_pemesanan' => $frekuensi_pemesanan,
                        'jarak_pemesanan' => $jarak_pemesanan,
                        'rop' => $rop,
                    ));
                    $index++;
                }
                $this->Md_eoq_barang->addEOQbarang($allInputData1);
            }


            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil diinput!
            </div>");

            redirect('staff/eoq');
        } elseif ($param1 == 'add') {
            $page_data['title'] = 'Tambah Laporan EOQ dan ROP';

            $list_barang = $this->Md_barang->getAllData();
            $select_barang[''] = 'Pilih Barang';
            foreach ($list_barang as $row) {
                $select_barang[($row->kode_barang)] = $row->nama_barang;
            }
            $page_data['barang'] = $select_barang;

            $page_data['page_name'] = 'eoq';
            $this->load->view('staff/eoq_add', $page_data);
        } elseif ($param1 == 'detail') {
            $page_data['title'] = 'Detail Penjualan Barang';
            $page_data['eoq'] = $this->Md_eoq->getDataById($param2);
            $page_data['eoq_barang'] = $this->Md_eoq_barang->getDataById($param2);
            $page_data['page_name'] = 'eoq';
            $this->load->view('staff/eoq_detail', $page_data);
        } elseif ($param1 == 'delete') {
            $this->Md_eoq->deleteEOQ($param2);
            $this->Md_eoq_barang->deleteEOQbarang($param2);
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Data berhasil dihapus!
            </div>");

            redirect('staff/eoq');
        } elseif ($param1 == 'print') {
            $pdf = new FPDF('l', 'mm', 'A5');
            // membuat halaman baru
            $pdf->AddPage();
            // setting jenis font yang akan digunakan
            $pdf->SetFont('Arial', 'B', 20);
            // mencetak string 
            $pdf->Cell(190, 7, 'Laporan EOQ dan ROP', 0, 1, 'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(190, 7, 'Daftar Barang dan lain lain', 0, 1, 'C');
            // Memberikan space kebawah agar tidak terlalu rapat
            $pdf->Cell(10, 7, '', 0, 1);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(20, 6, 'Nama', 1, 0);
            $pdf->Cell(70, 6, 'Jumlah Pemesanan Ekonomis (EOQ)', 1, 0);
            $pdf->Cell(40, 6, 'Pemesanan / Tahun', 1, 0);
            $pdf->Cell(40, 6, 'Jarak Pemesanan', 1, 0);
            $pdf->Cell(25, 6, 'ROP', 1, 1);
            $pdf->SetFont('Arial', '', 10);
            
            $eoq = $this->Md_eoq->getDataById($param2);
            $eoq_barang = $this->Md_eoq_barang->getDataById($param2);
            foreach ($eoq_barang as $row) {
                $pdf->Cell(20, 6, $row->nama_barang, 1, 0);
                $pdf->Cell(70, 6, $row->jumlah_pemesanan, 1, 0);
                $pdf->Cell(40, 6, $row->frekuensi_pemesanan, 1, 0);
                $pdf->Cell(40, 6, $row->jarak_pemesanan, 1, 0);
                $pdf->Cell(25, 6, $row->rop, 1, 1);
            }

            $pdf->SetY(100);
            $pdf->SetX(-50);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0, 6,'Tanggal : '.$eoq->tanggal_laporan, 0, 0);

            $pdf->SetY(105);
            $pdf->SetX(-50);
            $pdf->Cell(0, 6,'Dibuat oleh : '.$eoq->nama_user, 0, 0);


            $pdf->Output();
        }
    }

    function fetch_harga($id)
    {
        if ($id) {
            echo $this->Md_barang->getNamaBarang($id);
        }
    }

    function fetch_harga2($id)
    {
        if ($id) {
            echo $this->Md_jasa->getNamaJasa($id);
        }
    }

    public function home()
    {
        $data['title'] = "Dashboard";
        $this->load->view('staff/home', $data);
    }
}
