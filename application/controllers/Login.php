<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
	{        
        $this->load->view('login_page');
    }

    public function auth(){
        $username=$this->input->post('username');
        $password=$this->input->post('password');
       
        $this->load->model('Modlogin');
        $cekuser=$this->Modlogin->ceklogin($username,$password);
        if($cekuser!=0){
            foreach ($cekuser as $key => $value) {
                $nama       = $value->name;
                $username   = $value->username;
                $previledge = $value->previladge;
            }
            $array = array(
                'nama'       => $nama,
                'username'   => $username,
                'previledge' => $previledge,
                'logged_in'  => TRUE
        );        
        $this->session->set_userdata($array);
        redirect('Home/form_kegiatan');

        }else{
            redirect('Login/index'); 

        }



    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('Login/index'); 

    }


}