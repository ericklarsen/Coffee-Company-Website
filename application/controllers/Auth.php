<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Md_user');
    }

    public function index()
    {
		$this->load->view('login');
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $remember = $this->input->post('remember');

        $where = array(
            'username' => $username,
            'password' => $password
        );

        $cek = $this->Md_user->cek_login($where)->num_rows();
        $data = $this->Md_user->getDataById($username);

        if ($cek > 0) {
            $data_session = array(
                'username' => $data->username,
                'name' => $data->name,
            );

            if (!empty($remember)) {
                setcookie("username",$username,time()+(10*365*24*60*60));
                setcookie("password",$password,time()+(10*365*24*60*60));
            }else{
                setcookie("username",'');
                setcookie("password",'');
            }

            $this->session->set_userdata($data_session);

            redirect('staff');

            // $this->session->set_flashdata('success', "Welcome");
        } else {
            $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> Username/Password Salah!
            </div>");
            redirect('Home');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level');
        $this->session->unset_userdata('nama');
        $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button> <small>Terima kasih telah menggunakan halaman admin!</small>
            </div>");
        redirect('auth');
    }
}
