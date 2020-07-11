<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


    
    public function __construct()
    {
        parent::__construct();
            if($this->session->userdata('nama')==""){
                redirect('Login/index'); 
            }

    }

	public function index()
	{        
        $data['name']="Welcome";
        // echo "tes";
         $this->template->load('theme','home',$data);
    }

    public function form_kegiatan($confirm='')
	{    
         

        $data['title']="Form Kegiatan";
        $data['confirm']=$confirm;

        $this->load->model('Modkegiatan');
        $data['read_kegiatan']=$this->Modkegiatan->read(); 
        
        $this->load->model('Modpropinsi');
        $data['read_propinsi']=$this->Modpropinsi->read();

         $this->template->load('theme','form/form_kegiatan',$data);
    }

    public function get_kota(){
        $id_propinsi=$this->input->post('id');
        $this->load->model('Modkota');
        $data['read_kota']=$this->Modkota->getid($id_propinsi);
        echo json_encode($data['read_kota']);

    }



    public function tes()
	{        
        $this->load->view('form/form_kegiatan.php');
    }

    public function save_form_kegiatan(){
        $data1['title']="Form Kegiatan";
        $confirm='<div class="alert btn-success" role="alert">
        <a href="#" class="alert-link">Success</a>
      </div>';

       
        $judul_kegiatan      = $this->input->post('judul_kegiatan');
        $pembicara           = $this->input->post('pembicara');
        $tanggal_pelaksanaan = $this->input->post('tanggal_pelaksanaan');
        $alamat              = $this->input->post('alamat');
        $propinsi            = $this->input->post('propinsi');
        $kota                = $this->input->post('kota');
        $full_path           =$this->upload_file('proposal');
        
       
        $data=array(
            'judul_kegiatan'=>$judul_kegiatan,
            'pembicara'=>$pembicara,
            'tanggal_pelaksanaan'=>$tanggal_pelaksanaan,
            'alamat'=>$alamat,
            'propinsi'=>$propinsi,
            'kota'=> $kota,
            'link_proposal'=>$full_path
                );

        $this->load->model('Modkegiatan');
        $this->Modkegiatan->save($data);    
        
         
        $this->form_kegiatan($confirm);
    }


    public function upload_file($name)
    {
            $config['upload_path']          = './dokumen/porposal/';
            $config['allowed_types']        = 'pdf|gif|jpg|png';
            $config['file_name']            = 'antarbangsa';
            

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload($name))
            {
                    $error = array('error' => $this->upload->display_errors());

            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());
                    return $this->upload->data('full_path'); 
                    
            }
    }

    
    
    
  
     

	
}

